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
class TotpAuthenticationService extends \TYPO3\CMS\Frontend\Authentication\AbstractAuthentication
{

    public function init() {
        file_put_contents('/home/alfa10/auth','test'."\n",FILE_APPEND);
    }

    /**
     *
     * @param array $user
     * @return int
     */
    public function authUser($user){
        file_put_contents('/home/alfa10/auth','test3'."\n",FILE_APPEND);



        return -1;
    }


}