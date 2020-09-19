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

    'tx_fwauthenticator_active' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:fw_authenticator/Resources/Private/Language/locallang_db.xlf:Active',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
        ],
    ],
    'tx_fwauthenticator_secret' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:fw_authenticator/Resources/Private/Language/locallang_db.xlf:Secret',
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
    '--div--;Authenticator,tx_fwauthenticator_active,tx_fwauthenticator_secret'
);