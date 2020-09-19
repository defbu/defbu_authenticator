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
    protected $fwAuthenticatorActive;

    /**
     * @var string
     */
    protected $fwAuthenticatorSecret;

    /**
     * @return boolean $fwAuthenticatorActive
     */
    public function getFwAuthenticatorActive()
    {
        return $this->fwAuthenticatorActive;
    }

    /**
     * @return string $fwAuthenticatorSecret
     */
    public function getFwAuthenticatorSecret()
    {
        return $this->fwAuthenticatorSecret;
    }

    /**
     * @param boolean $fwAuthenticatorActive
     */
    public function setFwAuthenticatorActive($fwAuthenticatorActive)
    {
        $this->fwAuthenticatorActive = $fwAuthenticatorActive;
    }

    /**
     * @param string $fwAuthenticatorSecret
     */
    public function setFwAuthenticatorSecret($fwAuthenticatorSecret)
    {
        $this->fwAuthenticatorSecret = $fwAuthenticatorSecret;
    }



}