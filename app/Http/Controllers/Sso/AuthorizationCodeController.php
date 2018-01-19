<?php

namespace App\Http\Controllers\Sso;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OAuth2\HttpFoundationBridge\Request as BridgedRequest;
use OAuth2\HttpFoundationBridge\Response as BridgedResponse;

class AuthorizationCodeController extends OAuth2BaseController
{

    public function handleRequest(Request $request)
    {
        if (Auth::check()) {
            return $this->server->handleAuthorizeRequest(
                BridgedRequest::createFromRequest($request),
                new BridgedResponse(),
                true,
                Auth::user()->id);
        } else {
            // "epf_" prefix: don't risk that some library we use (e.g. Socialite) tries to store something
            // in the session under the same name.
            session(['epf_client_id' => $request->input('client_id')]);
            session(['epf_nonce' => $request->input('nonce')]);
            session(['epf_redirect_uri' => $request->input('redirect_uri')]);
            session(['epf_scope' => $request->input('scope')]);
            session(['epf_state' => $request->input('state')]);
            return view('login');
        }
    }
}
