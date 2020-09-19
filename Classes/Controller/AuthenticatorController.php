<?php
declare(strict_types=1);
/**
 * Copyright FraJa WeB - DEFBU (c) 2019
 */
namespace FraJaWeB\FwAuthenticator\Controller;

/**
 * Controller Abstract
 *
 * @author Frank Buijze - User Sense <frank@usersense.nl>
 *
 * All rights reserved
 */

use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Core\Core\Environment as Environment;
use TYPO3\CMS\Extbase\Mvw\View\ViewInterface as ViewInterface;

class AuthenticatorController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {


    /**
     * Backend Template Container
     *
     * @var string
     */
    protected $defaultViewObjectName = \TYPO3\CMS\Backend\View\BackendTemplateView::class;

    /**
     *
     * @var \FraJaWeB\FwAuthenticator\Domain\Repository\BeUserRepository
     * @Extbase\Inject
     */
    protected $beUserRepository;

    /**
     *
     * @var \FraJaWeB\FwAuthenticator\Service\TotpService
     * @Extbase\Inject
     */
    protected $totpService;

    /**
     * Set up the doc header properly here
     *
     * @param ViewInterface $view
     * @return void
     */
    protected function initializeView(ViewInterface $view)
    {
        /** @var BackendTemplateView $view */
        parent::initializeView($view);
        if ($this->actionMethodName == 'indexAction'
            || $this->actionMethodName == 'activateAction'
            || $this->actionMethodName == 'deactivateAction') {
            $this->generateMenu();
            $this->registerDocheaderButtons();
            $this->view->getModuleTemplate()->setFlashMessageQueue($this->controllerContext->getFlashMessageQueue());
        }
        if ($view instanceof BackendTemplateView) {
            $view->getModuleTemplate()->getPageRenderer()->loadRequireJsModule('TYPO3/CMS/Backend/Modal');
        }
    }

    public function indexAction() {
        $uid = $GLOBALS['BE_USER']->user["uid"];
        $beUser = $this->beUserRepository->findByUid($uid);
        if (isset($beUser)) {
            $this->view->assign('user',$beUser);
            $this->view->assign('site',$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename']);
            $this->view->assign('url',$_SERVER['HTTP_HOST']);
        }
    }

    public function activateAction() {
        $uid = $GLOBALS['BE_USER']->user["uid"];
        $beUser = $this->beUserRepository->findByUid($uid);
        if (isset($beUser)) {
            $beUser->setFwAuthenticatorActive(true);
            $this->beUserRepository->update($beUser);
        }
        $this->redirect("index");
    }

    public function deactivateAction() {
        $uid = $GLOBALS['BE_USER']->user["uid"];
        $beUser = $this->beUserRepository->findByUid($uid);
        if (isset($beUser)) {
            $beUser->setFwAuthenticatorActive(false);
            $beUser->setFwAuthenticatorSecret("");
            $this->beUserRepository->update($beUser);
        }
        $this->redirect("index");
    }

}