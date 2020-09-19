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
            file_put_contents('/home/alfa10/auth.txt',"Not active 100\n",FILE_APPEND);
            return 100;
        }
        else {
            $key = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('t3-authenticator-key');
            file_put_contents('/home/alfa10/auth.txt',$key."\n",FILE_APPEND);
            $secret = $user['tx_fwauthenticator_secret'];

            $authResult = $this->totpService->verifyKey($secret, $key);

            if ($authResult) {
                file_put_contents('/home/alfa10/auth.txt',"Positive result\n",FILE_APPEND);
                return 100;
            }
            else {
                file_put_contents('/home/alfa10/auth.txt',"Negative result 100\n",FILE_APPEND);
                return 0;
            }
        }
        return 0;
    }

}