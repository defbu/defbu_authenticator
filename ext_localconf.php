<?php
/**
 * Copyright notice
 *
 * (c) 2020 FraJa WeB - DEFBU - Frank Buijze
 *
 * All rights reserved
 */
defined('TYPO3_MODE') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService(
    // Extension Key
    'fw_authenticator',
    // Service type
    'auth',
    // Service key
    'FraJaWeB\FwAuthenticator\Service\TotpAuthService',
    array(
        'title' => 'Time-based One-Time Password authentication service',
        'description' => 'This authentication service adds support for authentication based on Time-based One-Time Passwords',

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
        'title' => 'Time-based One-Time Password Service',
        'description' => 'This service provides support for Time-based One-Time Passwords',

        'subtype' => '',

        'available' => true,
        'priority' => 60,
        'quality' => 80,

        'os' => '',
        'exec' => '',

        'className' => FraJaWeB\FwAuthenticator\Service\TotpService::class
    )
);