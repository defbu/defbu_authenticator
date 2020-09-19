<?php
declare(strict_types=1);
/**
 * Copyright FraJa WeB - DEFBU (c) 2019
 */
namespace FraJaWeB\FwAuthenticator\Domain\Model;

/**
 * Domain model User
 *
 * @author Frank Buijze - User Sense <frank@usersense.nl>
 *
 * All rights reserved
 */
class BeUser extends \TYPO3\CMS\Extbase\Domain\Model\BackendUser {

    /**
     *
     * @var bool
     */
    protected $txFwauthenticatorActive;

    /**
     * @var string
     */
    protected $txFwauthenticatorSecret;
    /**
     * @return boolean $txFwauthenticatorActive
     */
    public function getTxFwauthenticatorActive()
    {
        return $this->txFwauthenticatorActive;
    }

    /**
     * @return string $txFwauthenticatorSecret
     */
    public function getTxFwauthenticatorSecret()
    {
        return $this->txFwauthenticatorSecret;
    }

    /**
     * @param boolean $txFwauthenticatorActive
     */
    public function setTxFwauthenticatorActive($txFwauthenticatorActive)
    {
        $this->txFwauthenticatorActive = $txFwauthenticatorActive;
    }

    /**
     * @param string $txFwauthenticatorSecret
     */
    public function setTxFwauthenticatorSecret($txFwauthenticatorSecret)
    {
        $this->txFwauthenticatorSecret = $txFwauthenticatorSecret;
    }






}