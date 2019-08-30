<?php

namespace App\Http\Controllers\Sso;

use App\Util\OAuthUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OAuth2\HttpFoundationBridge\Request as BridgedRequest;
use OAuth2\Response as OAuthResponse;

class AuthorizationCodeController extends OAuth2BaseController
{

    public function handleRequest(Request $request)
    {
        // The idea here is: we want to do OAuth flow, but ONLY AFTER user logs in via normal Laravel mechanisms
        // into SSO. So:
        // - if not logged in, store OAuth flow params in the session, but redirect to normal Laravel login forms;
        // - count on SSO server redirecting the user back here after login, using the params from the session to
        //   recreate proper OAuth flow URL;
        // - if logged in, proceed with normal OAuth flow; also, clear params from the session now because trying
        //   to use them the second time will result in exceptions - this may happen if user hits back button.
        if (Auth::check()) {
            // If the user is logged in.
            OAuthUtil::clearAuthorizationCodeRedirectParams();
            /** @var OAuthResponse $oauth_res */
            $oauth_res = $this->server->handleAuthorizeRequest(
                BridgedRequest::createFromRequest($request),
                new OAuthResponse(),
                true,
                Auth::id());
            return $this->convertOAuthResponseToSymfonyResponse($oauth_res);
        } else {
            // If the user is NOT logged in.
            OAuthUtil::storeAuthorizationCodeRedirectParams($request);
            return redirect()->action('Auth\LoginController@showLoginForm');
        }
    }
}
