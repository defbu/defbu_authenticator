<?php
declare(strict_types=1);
/**
 * Copyright DEFBU (c) 2020
 */
namespace DEFBU\DefbuAuthenticator\LoginProvider;

/**
 * Controller Abstract
 *
 * @author Frank Buijze - DEFBU <info@defbu.nl>
 *
 * All rights reserved
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