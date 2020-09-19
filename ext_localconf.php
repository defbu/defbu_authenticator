<?php
/**
 * Copyright notice
 *
 * (c) 2020 FraJa WeB - DEFBU - Frank Buijze
 *
 * All rights reserved
 */
defined('TYPO3_MODE') || die();

//$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication::class] = ['className' =>  UserSense\UserSense\Authentication\Login\StandardLogin::class];


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService(
    // Extension Key
    'fw_authenticator',
    // Service type
    'auth',
    // Service key
    'FraJaWeB\FwAuthenticator\Service\TotpService',
    array(
        'title' => 'Authenticator TOTP',
        'description' => 'Authenticator TOTP',

        'subtype' => '',

        'available' => true,
        'priority' => 60,
        'quality' => 80,

        'os' => '',
        'exec' => '',

        'className' => \FraJaWeB\FwAuthenticator\Service\TotpService::class
    )
);