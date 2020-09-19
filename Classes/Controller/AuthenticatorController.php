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

class AuthenticatorController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {



    /**
     *
     * @var \FraJaWeB\FwAuthenticator\Domain\Repository\BeUserRepository
     * @Extbase\Inject
     */
    private $beUserRepository;

    public function indexAction() {
        $uid = $GLOBALS['BE_USER']->user["uid"];
        $beUser = $this->beUserRepository->findByUid($uid);
        if (isset($beUser)) {
            echo $beUser->getUid();
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