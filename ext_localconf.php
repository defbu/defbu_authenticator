<?php
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
defined('TYPO3_MODE') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService(
    // Extension Key
    'defbu_authenticator',
    // Service type
    'auth',
    // Service key
    'DEFBU\DefbuAuthenticator\Service\TotpAuthService',
    array(
        'title' => 'Time-based One-Time Password authentication service',
        'description' => 'This authentication service adds support for authentication based on Time-based One-Time Passwords',

        'subtype' => 'authUserBE',

        'available' => true,
        'priority' => 100,
        'quality' => 80,

        'os' => '',
        'exec' => '',
        'className' => DEFBU\DefbuAuthenticator\Service\TotpAuthService::class
    )
);

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['backend']['loginProviders'][1433416747]['provider'] = DEFBU\DefbuAuthenticator\LoginProvider\LoginProvider::class;


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService(
    // Extension Key
    'defbu_authenticator',
    // Service type
    'totp',
    // Service key
    'DEFBU\DefbuAuthenticator\Service\TotpService',
    array(
        'title' => 'Time-based One-Time Password Service',
        'description' => 'This service provides support for Time-based One-Time Passwords',

        'subtype' => '',

        'available' => true,
        'priority' => 60,
        'quality' => 80,

        'os' => '',
        'exec' => '',

        'className' => DEFBU\DefbuAuthenticator\Service\TotpService::class
    )
);