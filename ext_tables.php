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
        Authenticator::class => 'index'
    ],
    [
        'access' => 'user',
        //'icon' => 'EXT:fw_authenticator/Resources/Public/Icons/module-beuser.svg',
        'labels' => 'LLL:EXT:fw_authenticator/Resources/Private/Language/locallang_mod.xlf',
    ]
    );

$GLOBALS['TYPO3_USER_SETTINGS']['columns']['fw_authenticator_active'] = [
        'exclude' => 1,
        'label' => 'LLL:EXT:fw_authenticator/Resources/Private/Language/locallang_db.xlf:Active',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'table' => 'be_users'
        ],
    ];
$GLOBALS['TYPO3_USER_SETTINGS']['columns']['fw_authenticator_secret'] = [
        'exclude' => 0,
        'label' => 'LLL:EXT:fw_authenticator/Resources/Private/Language/locallang_db.xlf:Secret',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'table' => 'be_users'
        ],
    ];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToUserSettings(
    'LLL:EXT:fw_authenticator/Resources/Private/Language/locallang_db.xlf:Authenticator,fw_authenticator_active,fw_authenticator_secret',
    'after:email'
);