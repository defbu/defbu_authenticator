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
$EM_CONF[$_EXTKEY] = [
    'title' => 'Authenticator',
    'description' => 'A simple 2FA time-based one-time authentication service for backend',
    'category' => 'module',
    'constraints' => [
        'depends' => [
            'typo3' => '10.0.0-10.99.99',
            'php' => '7.2.0-7.4.99'
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'DEFBU\\DefbuAuthenticator\\' => 'Classes/'
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Frank Buijze',
    'author_email' => 'info@defbu.nl',
    'author_company' => 'Defbu',
    'version' => '1.0.3',
];
