<?php
declare(strict_types=1);
namespace DEFBU\DefbuAuthenticator\Service;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 *
 * @author Frank Buijze - DEFBU <info@defbu.nl>
 */

use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Core\Core\Environment as Environment;

class TotpService extends \TYPO3\CMS\Core\Service\AbstractService {

    private $timeSpan = 30;

    private $keyLength = 6;

    private $secretLength = 32;

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
                $binary .= chr(($n & (0xFF << $j)) >> $j);
            }
        }

        return $binary;
    }

    public function generateSecretKey() {
        $chars 	= array_merge(range("2","7"),range("A","Z"));
        $s = "";
        for ($i = 0; $i < $this->secretLength; $i++) {
            $s .= $chars[array_rand($chars)];
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
        return str_pad($this->oathTruncate($hash), $this->keyLength, '0', STR_PAD_LEFT);

    }

    /**
     *
     * @param binary $hash
     * @return integer
     */
    private function oathTruncate($hash)
    {
        $offset = ord($hash[19]) & 0xf;

        $key =  (
            ((ord($hash[$offset+0]) & 0x7f) << 24 ) |
            ((ord($hash[$offset+1]) & 0xff) << 16 ) |
            ((ord($hash[$offset+2]) & 0xff) << 8 ) |
            (ord($hash[$offset+3]) & 0xff)
            ) % pow(10, $this->keyLength);

        return strval($key);
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
        if ((strlen($secret) == $this->secretLength) && (strlen($key) == $this->keyLength)) {
            $timeStamp = $this->getTimestamp();

            if ($useTimeStamp !== true) {
                $timeStamp = (int)$useTimeStamp;
            }

            $binarySeed = $this->base32Decode($secret);

            for ($ts = $timeStamp - $window; $ts <= $timeStamp + $window; $ts++) {
                $key1 = $this->oathHotp($binarySeed, $ts);
                if ($key1 == $key) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getUrl($username,$site,$secret) {
        $s = 'otpauth://totp/';

        if ($site != "") {
            $s .= $site;
        }
        else {
            $s .= "unknown";
        }
        if (isset($username)) {
            $s .= " (".$username.")";
        }
        $s .= '?secret='.$secret;
        return $s;
    }

    public function getQr($username,$site,$secret) {
        $url = $this->getUrl($username,$site,$secret);
        $publicPath = Environment::getPublicPath();
        require_once($publicPath.'/typo3conf/ext/defbu_authenticator/Library/phpqrcode/phpqrcode.php');
        $tempFile = $this->tempFile('qr');
        \QRcode::png($url,$tempFile);
        $data = file_get_contents($tempFile);
        $base64 = 'data:image/png;base64,'.base64_encode($data);
        $this->unlinkTempFiles();
        return $base64;
    }
}
