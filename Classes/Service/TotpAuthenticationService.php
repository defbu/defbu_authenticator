<?php
/**
 * Copyright User Sense (c) 2019
 */
namespace FraJaWeb\FwAuthenticator\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;

/**
 * Authentication Login
 *
 * @author Frank Buijze - FraJa WeB
 *
 * All rights reserved
 */
class TotpAuthenticationService extends \TYPO3\CMS\Core\Authentication\AbstractAuthenticationService
{
    public function initAuth($mode, $loginData, $authInfo, $pObj) {


        parent::initAuth($mode, $loginData, $authInfo, $pObj);
    }

    public function authUser(array $user) {
        print_r($user);
        return -1;
    }


}