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
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface as ViewInterface;

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
    }

    public function indexAction() {
        $this->totpService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstanceService('tx_fwauthenticator_totp');


        $uid = $GLOBALS['BE_USER']->user["uid"];
        $beUser = $this->beUserRepository->findByUid($uid);
        if (isset($beUser)) {
            $this->view->assign('user',$beUser);
            if ($beUser->getFwAuthenticatorActive()) {
                $url = $this->totpService->getUrl($beuser->getUsername(),$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],$beUser->getFwAuthenticatorSecret());
                echo $url;
            }
        }
    }

    public function activateAction() {
        $this->totpService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstanceService('tx_fwauthenticator_totp');

        $uid = $GLOBALS['BE_USER']->user["uid"];
        $beUser = $this->beUserRepository->findByUid($uid);
        if (isset($beUser)) {
            $beUser->setFwAuthenticatorActive(true);
            $this->beUserRepository->update($beUser);
            $secret = $this->totpService->generateSecretKey();
            $this->beUserRepository->update($secret);
            $this->addFlashMessage('Link Google Authenticator before logging out!','Authenticator activated',\TYPO3\CMS\Core\Messaging\FlashMessage::WARNING);
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