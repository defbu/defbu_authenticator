<?php
declare(strict_types=1);
namespace DEFBU\DefbuAuthenticator\Service;

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
class TotpAuthService extends \TYPO3\CMS\Core\Authentication\AbstractAuthenticationService
{
    /**
     *
     * @var \DEFBU\DefbuAuthenticator\Service\TotpService
     */
    private $totpService = null;

    public function init() : bool {
        $available = false;
        $this->totpService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstanceService('totp');
        if (is_object($this->totpService)) {
            $available = true;
        }
        return $available;
    }

    public function authUser(array $user) {

        if (!$user['tx_defbuauthenticator_active']) {
            return 100;
        }
        else {
            $key = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('t3-defbuauthenticator-key');
            $secret = $user['tx_defbuauthenticator_secret'];

            $authResult = $this->totpService->verifyKey($secret, $key);

            if ($authResult) {
                return 100;
            }
            else {
                return 0;
            }
        }
        return 0;
    }

}