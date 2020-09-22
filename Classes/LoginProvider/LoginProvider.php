<?php
declare(strict_types=1);
namespace DEFBU\DefbuAuthenticator\LoginProvider;

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
use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Backend\Controller\LoginController;
use TYPO3\CMS\Backend\LoginProvider\UsernamePasswordLoginProvider;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Core\Core\Environment as Environment;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface as ViewInterface;

class LoginProvider extends UsernamePasswordLoginProvider {

    /**
     * Renders the login fields
     *
     * @param StandaloneView $view
     * @param PageRenderer $pageRenderer
     * @param LoginController $loginController
     */
    public function render(StandaloneView $view, PageRenderer $pageRenderer, LoginController $loginController)
    {
        parent::render($view, $pageRenderer, $loginController);
        $view->setTemplatePathAndFilename(
            GeneralUtility::getFileAbsFileName('EXT:defbu_authenticator/Resources/Private/Templates/LoginProvider.html')
        );
    }
}