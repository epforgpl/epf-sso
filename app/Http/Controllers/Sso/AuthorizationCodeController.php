<?php

namespace App\Http\Controllers\Sso;

use App\Util\Symfony4Fix\BridgedResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OAuth2\HttpFoundationBridge\Request as BridgedRequest;

class AuthorizationCodeController extends OAuth2BaseController
{

    public function handleRequest(Request $request)
    {
        if (Auth::check()) {
            // If the user is logged in.
            return $this->server->handleAuthorizeRequest(
                BridgedRequest::createFromRequest($request),
                new BridgedResponse(),
                true,
                Auth::user()->id);
        } else {
            // If the user is NOT logged in.

            // "epf_" prefix: don't risk that some library we use (e.g. Socialite) tries to store something
            // in the session under the same name.
            session(['epf_client_id' => $request->input('client_id')]);
            session(['epf_nonce' => $request->input('nonce')]);
            session(['epf_redirect_uri' => $request->input('redirect_uri')]);
            session(['epf_scope' => $request->input('scope')]);
            session(['epf_state' => $request->input('state')]);
            return redirect()->action('Auth\LoginController@showLoginForm');
        }
    }
}
