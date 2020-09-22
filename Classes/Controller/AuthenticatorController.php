<?php
declare(strict_types=1);
namespace DEFBU\DefbuAuthenticator\Controller;

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
     * @var \DEFBU\DefbuAuthenticator\Domain\Repository\BeUserRepository
     * @Extbase\Inject
     */
    protected $beUserRepository;

    /**
     *
     * @var \DEFBU\DefbuAuthenticator\Service\TotpService
     */
    protected $totpService;

    /**
     *
     * @var TYPO3\CMS\Core\Localization\LanguageService
     */
    protected $languageService;

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

    public function __construct()
    {
        $this->totpService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstanceService('totp');
        $this->languageService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Localization\LanguageService');
    }

    public function indexAction() {


        $uid = $GLOBALS['BE_USER']->user["uid"];
        $beUser = $this->beUserRepository->findByUid($uid);
        if (isset($beUser)) {
            $this->view->assign('user',$beUser);
        }
    }

    public function activateAction() {
        $uid = $GLOBALS['BE_USER']->user["uid"];
        $beUser = $this->beUserRepository->findByUid($uid);
        if (isset($beUser)) {
            $beUser->setTxDefbuauthenticatorActive(true);
            $this->beUserRepository->update($beUser);
            $secret = $this->totpService->generateSecretKey();
            $beUser->setTxDefbuauthenticatorSecret($secret);
            $this->beUserRepository->update($beUser);

            $message = $this->languageService->sL('LLL:EXT:defbu_authenticator/Resources/Private/Language/locallang_mod.xlf:Activate.message');
            $this->addFlashMessage($message,'',\TYPO3\CMS\Core\Messaging\FlashMessage::WARNING);
            $this->view->assign('user',$beUser);
            if ($beUser->getTxDefbuauthenticatorActive()) {
                $base64 = $this->totpService->getQr($beUser->getUsername(),$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],$beUser->getTxDefbuauthenticatorSecret());
                $this->view->assign('qr',$base64);
            }
        }
        else {
            $this->redirect("index");
        }
    }

    public function deactivateAction() {
        $uid = $GLOBALS['BE_USER']->user["uid"];
        $beUser = $this->beUserRepository->findByUid($uid);
        if (isset($beUser)) {
            $beUser->setTxDefbuauthenticatorActive(false);
            $beUser->setTxDefbuauthenticatorSecret("");
            $this->beUserRepository->update($beUser);
            $message = $this->languageService->sL('LLL:EXT:defbu_authenticator/Resources/Private/Language/locallang_mod.xlf:Deactivate.message');
            $this->addFlashMessage($message,'',\TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
        }
        $this->redirect("index");
    }

}