<?php
/**
 * Copyright notice
 *
 * (c) 2020 FraJa WeB - DEFBU - Frank Buijze
 *
 * All rights reserved
 */
defined('TYPO3_MODE') || die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
    'FraJaWeB.FwAuthenticator',
    'system',
    'tx_fwauthenticator',
    'bottom',
    [
        Authenticator::class => 'index, activate, deactivate'
    ],
    [
        'access' => 'user',
        'icon' => 'EXT:fw_authenticator/Resources/Public/Icons/icon.svg',
        'labels' => 'LLL:EXT:fw_authenticator/Resources/Private/Language/locallang_mod.xlf:Authenticator',
    ]
    );

$GLOBALS['TYPO3_USER_SETTINGS']['columns']['tx_fwauthenticator_active'] = [
        'label' => 'LLL:EXT:fw_authenticator/Resources/Private/Language/locallang_db.xlf:Active',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'table' => 'be_users'
        ],
    ];
$GLOBALS['TYPO3_USER_SETTINGS']['columns']['tx_fwauthenticator_secret'] = [
        'label' => 'LLL:EXT:fw_authenticator/Resources/Private/Language/locallang_db.xlf:Secret',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'table' => 'be_users'
        ],
    ];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToUserSettings(
    '--div--;Authenticator,tx_fwauthenticator_active,tx_fwauthenticator_secret'
);