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
        return -1;
    }

}