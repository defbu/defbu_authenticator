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
    'FraJaWeB.FwAuthentication',
    'system',
    'tx_fwauthentication',
    'bottom',
    [
        \TYPO3\CMS\FwAuthentication\Controller\AuthenticationController::class => 'index'
    ],
    [
        'access' => 'user',
        //'icon' => 'EXT:fw_authentication/Resources/Public/Icons/module-beuser.svg',
        'labels' => 'LLL:EXT:fw_authentication/Resources/Private/Language/locallang_mod.xlf',
    ]
    );

