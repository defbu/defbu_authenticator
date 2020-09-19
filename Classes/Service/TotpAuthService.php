<?php
namespace FraJaWeB\FwAuthenticator\Service;

class TotpAuthService extends \TYPO3\CMS\Core\Authentication\AbstractAuthenticationService
{
    /**
     *
     * @var \FraJaWeB\FwAuthenticator\Service\TotpService
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

        if (!$user['tx_fwauthenticator_active']) {
            return 100;
        }
        else {
            $key = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('t3-authenticator-key');
            echo $key;
            $secret = $user['tx_fwauthenticator_secret'];

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