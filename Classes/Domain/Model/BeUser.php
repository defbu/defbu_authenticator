<?php
declare(strict_types=1);
/**
 * Copyright DEFBU (c) 2020
 */
namespace DEFBU\DefbuAuthenticator\Domain\Model;

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
    protected $txDefbuauthenticatorActive;

    /**
     * @var string
     */
    protected $txDefbuauthenticatorSecret;
    /**
     * @return boolean $txDefbuauthenticatorActive
     */
    public function getTxDefbuauthenticatorActive()
    {
        return $this->txDefbuauthenticatorActive;
    }

    /**
     * @return string $txDefbuauthenticatorSecret
     */
    public function getTxDefbuauthenticatorSecret()
    {
        return $this->txDefbuauthenticatorSecret;
    }

    /**
     * @param boolean $txDefbuauthenticatorActive
     */
    public function setTxDefbuauthenticatorActive($txDefbuauthenticatorActive)
    {
        $this->txDefbuauthenticatorActive = $txDefbuauthenticatorActive;
    }

    /**
     * @param string $txDefbuauthenticatorSecret
     */
    public function setTxDefbuauthenticatorSecret($txDefbuauthenticatorSecret)
    {
        $this->txDefbuauthenticatorSecret = $txDefbuauthenticatorSecret;
    }






}