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
class AuthenticatorController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     *
     * @var \FraJaWeB\FwAuthenticator\Domain\Repository\BeUserRepository
     */
    private $beUserRepository;

    public function indexAction() {
        $uid = $GLOBALS['BE_USER']->user["uid"];
        $beUser = $this->beUserRepository->findByUid($uid);
        if (isset($beUser)) {
            echo $beUser->getUid();
        }
    }

}