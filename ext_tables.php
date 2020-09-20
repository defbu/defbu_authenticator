<?php
/**
 * Copyright notice
 *
 * (c) 2020 FraJa WeB - DEFBU - Frank Buijze
 *
 * All rights reserved
 */
defined('TYPO3_MODE') || die();


$GLOBALS['TBE_STYLES']['stylesheet2'] = '../typo3conf/ext/fw_authenticator/Resources/Public/Css/defbu_authenticator.css';

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
        'icon' => 'EXT:fw_authenticator/Resources/Public/Icons/icon.svg',
        'labels' => 'LLL:EXT:fw_authenticator/Resources/Private/Language/locallang_mod.xlf:Authenticator',
    ]
);