<?php
declare(strict_types=1);
/**
 * Copyright FraJa WeB - DEFBU (c) 2019
 */
namespace FraJaWeB\FwAuthenticator\Service;

/**
 * Controller Abstract
 *
 * @author Frank Buijze - User Sense <frank@usersense.nl>
 *
 * All rights reserved
 */

use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Core\Core\Environment as Environment;

class TotpService extends\TYPO3\CMS\Core\Service\AbstractService {

    private $timeSpan = 30;

    private $keyLength = 32;

    private $otpLength = 6;

    private $lut =  [
        "A" => 0,
        "B" => 1,
        "C" => 2,
        "D" => 3,
        "E" => 4,
        "F" => 5,
        "G" => 6,
        "H" => 7,
        "I" => 8,
        "J" => 9,
        "K" => 10,
        "L" => 11,
        "M" => 12,
        "N" => 13,
        "O" => 14,
        "P" => 15,
        "Q" => 16,
        "R" => 17,
        "S" => 18,
        "T" => 19,
        "U" => 20,
        "V" => 21,
        "W" => 22,
        "X" => 23,
        "Y" => 24,
        "Z" => 25,
        "2" => 26,
        "3" => 27,
        "4" => 28,
        "5" => 29,
        "6" => 30,
        "7" => 31
    ];

    private function base32Decode($b32) {


        $b32 = strtoupper($b32);
        $match = "";
        if (!preg_match('/^[ABCDEFGHIJKLMNOPQRSTUVWXYZ234567]+$/', $b32, $match)) {
            throw new Exception('Invalid characters in the base32 string.');
        }

        $length = strlen($b32);
        $n = 0;
        $j = 0;
        $binary = "";

        for ($i = 0; $i < $length; $i++) {
            $n = $n << 5;
            $n = $n + $this->lut[$b32[$i]];
            $j = $j + 5;

            if ($j >= 8) {
                $j = $j - 8;
                $binary .= chr(($n & (0&FF << $j)) >> $j);
            }
        }

        return $binary;
    }

    public function generateSecretKey() {
        $chars 	= array_merge(range("2","7"),range("A","Z"));
        $s = "";
        for ($i = 0; $i < $this->keyLength; $i++) {
            $s .= $b32[array_rand($chars)];
        }
        return $s;
    }


   private function getTimestamp() {
        return floor(microtime(true)/$this->timeSpan);
    }

    /**
     *
     * @param binary $key Secret
     * @param integer $counter Timestamp devided by timestamp
     */
    private function oathHotp($key, $counter) {

        if (strlen($key) < 8) {
            throw new Exception('Secret key is too short. Must be at least 16 base 32 characters');
        }
        $binCounter = pack('N*', 0) . pack('N*', $counter);
        $hash 	 = hash_hmac ('sha1', $binCounter, $key, true);
        return str_pad($this->oathTruncate($hash), $this->otpLength, '0', STR_PAD_LEFT);

    }

    /**
     *
     * @param binary $hash
     * @return integer
     */
    private function oathTruncate($hash)
    {
        $offset = ord($hash[19]) & 0xf;

        return (
            ((ord($hash[$offset+0]) & 0x7f) << 24 ) |
            ((ord($hash[$offset+1]) & 0xff) << 16 ) |
            ((ord($hash[$offset+2]) & 0xff) << 8 ) |
            (ord($hash[$offset+3]) & 0xff)
            ) % pow(10, $this->otpLength);
    }

    /**
     *
     * @param string $secret
     * @param string $key
     * @param integer $window
     * @param boolean $useTimeStamp
     * @return boolean
     */
    public function verifyKey($secret, $key, $window = 4, $useTimeStamp = true) {

        $timeStamp = $this->getTimestamp();

        if ($useTimeStamp !== true) {
            $timeStamp = (int)$useTimeStamp;
        }

        $binarySeed = base32Decode($secret);

        for ($ts = $timeStamp - $window; $ts <= $timeStamp + $window; $ts++) {
            if ($this->oathHotp($binarySeed, $ts) == $key) {
                return true;
            }
        }
    }

    public function getUrl($username,$site,$secret) {
        return 'otpauth://totp/'.url_encode($username).'@'.url_encode($siteName).'?secret='.$secret;
    }

    public function init() {
        echo "test";
        return true;
    }

    public function reset() {

    }

}