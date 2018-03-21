<?php

namespace App\Util;

class OAuthUtil
{

    /**
     * Assemble and return a URI pointing to the controller for handling authorization code issuance.
     *
     * The URI params should have been stored in the session. If they are not, 'bad-request' is returned.
     *
     * @return string URI pointing to authorization code controller, or 'bad-request'.
     */
    public static function getAuthorizationCodeRedirect() : string
    {
        $client_id = session('epf_client_id');
        $nonce = session('epf_nonce');
        $client_redirect_uri = session('epf_redirect_uri');
        $scope = session('epf_scope');
        $state = session('epf_state');

        if (!$client_id || !$nonce || !$client_redirect_uri || !$scope || !$state) {
            return 'bad-request';
        }

        $server_redirect_uri = 'oauth/authorization';
        $server_redirect_uri .= '?state=' . $state;
        $server_redirect_uri .= '&client_id=' . $client_id;
        $server_redirect_uri .= '&nonce=' . $nonce;
        $server_redirect_uri .= '&redirect_uri=' . $client_redirect_uri;
        $server_redirect_uri .= '&scope=' . urlencode($scope);
        $server_redirect_uri .= '&response_type=code';
        // Uncomment to debug.
        // $server_redirect_uri .= '&XDEBUG_SESSION_START=this_is_irrelevant';
        return $server_redirect_uri;
    }
}
