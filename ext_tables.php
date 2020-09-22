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


$GLOBALS['TBE_STYLES']['stylesheet2'] = '../typo3conf/ext/defbu_authenticator/Resources/Public/Css/defbu_authenticator.css';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
    'DEFBU.DefbuAuthenticator',
    'system',
    'tx_defbuauthenticator',
    'bottom',
    [
        Authenticator::class => 'index, activate, deactivate'
    ],
    [
        'access' => 'user',
        'icon' => 'EXT:defbu_authenticator/Resources/Public/Icons/icon.svg',
        'labels' => 'LLL:EXT:defbu_authenticator/Resources/Private/Language/locallang_mod.xlf:Authenticator',
    ]
);