<?php
namespace FraJaWeB\FwAuthenticator\Service;

class TotpAuthService extends \TYPO3\CMS\Core\Authenticatn\AbstractAuthenticationService
{
    /**
     *
     * @var \FraJaWeB\FwAuthenticator\Service\TotpService
     */
    private $totpService = null;

    public function init() {
        $available = false;
        $this->totpService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstanceService('totp');
        if (is_object($this->totpService)) {
            $available = true;
        }
        if ($available) {
            die('ja');
        }
        else {
            die('nee');
        }
        return $available;
    }

    public function authUser($user) {
        return -1;
    }

}