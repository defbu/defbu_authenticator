<?php
/**
 * Copyright User Sense (c) 2019
 */
namespace FraJaWeB\FwAuthenticator\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;

/**
 * Authentication Login
 *
 * @author Frank Buijze - FraJa WeB
 *
 * All rights reserved
 */
class TotpAuthService extends \TYPO3\CMS\Core\Authentication\AuthenticationService
{

    public function authUser(array $user) {
        
        if ($user["fw_authenticator_active"])
        
        
        return 0;
    }


}