<?php
/**
 * Copyright User Sense (c) 2019

 * Extend fe_users
 *
 * @author Frank Buijze - User Sense <frank@usersense.nl>
 *
 * All rights reserved
 */
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$temporaryColumns = array (

    'tx_defbuauthenticator_active' => [
        'label' => 'LLL:EXT:defbu_authenticator/Resources/Private/Language/locallang_db.xlf:Active',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
        ],
    ],
    'tx_defbuauthenticator_secret' => [
        'label' => 'LLL:EXT:defbu_authenticator/Resources/Private/Language/locallang_db.xlf:Secret',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],

);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'be_users',
    $temporaryColumns
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'be_users',
    '--div--;LLL:EXT:defbu_authenticator/Resources/Private/Language/locallang_mod.xlf:Authenticator,tx_defbuauthenticator_active,tx_defbuauthenticator_secret'
);