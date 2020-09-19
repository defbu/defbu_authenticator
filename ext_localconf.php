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
    'FraJaWeB\FwAuthenticator\Service\TotpAuthService',
    array(
        'title' => 'LLL:EXT:fw_authenticator/Resources/Private/Language/locallang_mod.xlf:TotpAuthService.title',
        'description' => 'LLL:EXT:fw_authenticator/Resources/Private/Language/locallang_mod.xlf:TotpAuthService.description',

        'subtype' => 'authUserBE',

        'available' => true,
        'priority' => 100,
        'quality' => 80,

        'os' => '',
        'exec' => '',
        'className' => FraJaWeB\FwAuthenticator\Service\TotpAuthService::class
    )
);

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['backend']['loginProviders'][1433416747]['provider'] = FraJaWeB\FwAuthenticator\LoginProvider\LoginProvider::class;


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService(
    // Extension Key
    'fw_authenticator',
    // Service type
    'totp',
    // Service key
    'FraJaWeB\FwAuthenticator\Service\TotpService',
    array(
        'title' => 'LLL:EXT:fw_authenticator/Resources/Private/Language/locallang_mod.xlf:TotpService.title',
        'description' => 'LLL:EXT:fw_authenticator/Resources/Private/Language/locallang_mod.xlf:TotpService.description',

        'subtype' => '',

        'available' => true,
        'priority' => 60,
        'quality' => 80,

        'os' => '',
        'exec' => '',

        'className' => FraJaWeB\FwAuthenticator\Service\TotpService::class
    )
);