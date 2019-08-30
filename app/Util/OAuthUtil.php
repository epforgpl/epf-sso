<?php

namespace App\Util;

use Illuminate\Http\Request;

class OAuthUtil
{

    /**
     * Put params needed for OAuth flow in the session.
     *
     * @param Request $request
     */
    public static function storeAuthorizationCodeRedirectParams(Request $request) : void
    {
        // "epf_" prefix: don't risk that some library we use (e.g. Socialite) tries to store something
        // in the session under the same name.
        session(['epf_client_id' => $request->input('client_id')]);
        session(['epf_nonce' => $request->input('nonce')]);
        session(['epf_redirect_uri' => $request->input('redirect_uri')]);
        session(['epf_scope' => $request->input('scope')]);
        session(['epf_state' => $request->input('state')]);
    }

    /**
     * Assemble and return a URI pointing to the controller for handling authorization code issuance.
     *
     * The URI params should have been stored in the session. If they are not, '/' is returned.
     *
     * @return string URI pointing to authorization code controller, or '/'.
     */
    public static function getAuthorizationCodeRedirect() : string
    {
        $client_id = session('epf_client_id');
        $nonce = session('epf_nonce');
        $client_redirect_uri = session('epf_redirect_uri');
        $scope = session('epf_scope');
        $state = session('epf_state');

        if (!$client_id || !$nonce || !$client_redirect_uri || !$scope || !$state) {
            return '/';
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

    /**
     * Removes the session params used to construct redirect URL when obtaining OAuth authorization code.
     * They should be removed when first used to do the OAuth flow lest they create a second redirect,
     * which will then fail. This could happen if user hits browser back button after an OAuth flow.
     */
    public static function clearAuthorizationCodeRedirectParams() : void
    {
        session(['epf_client_id' => null]);
        session(['epf_nonce' => null]);
        session(['epf_redirect_uri' => null]);
        session(['epf_scope' => null]);
        session(['epf_state' => null]);
    }
}
