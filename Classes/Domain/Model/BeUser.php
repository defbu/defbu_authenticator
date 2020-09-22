<?php
declare(strict_types=1);
namespace DEFBU\DefbuAuthenticator\Domain\Model;
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