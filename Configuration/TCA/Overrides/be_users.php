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