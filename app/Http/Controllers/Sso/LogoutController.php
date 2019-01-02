<?php

namespace App\Http\Controllers\Sso;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OAuth2\HttpFoundationBridge\Request as BridgedRequest;
use OAuth2\Response as OAuthResponse;

/**
 * Logs the user out of SSO by both logging them out of Laravel auth mechanisms and deleting the access token in
 * SSO database.
 *
 * TODO: Ping all the controlled services to log the user out of them.
 *
 * TODO: A security review of this would be handy. I had to implement logout myself b/c it doesn't seem to be
 * clearly described in OpenID Connect spec, and it's not implemented in the libraries we use (bshaffer's server
 * and Jumbojett\OpenIDConnectClient).
 *
 * @package App\Http\Controllers\Sso
 */
class LogoutController extends OAuth2BaseController
{
    public function logout(Request $request)
    {
        $request->merge(['token_type_hint' => 'access_token', 'token' => $request->get('id_token_hint')]);
        $request->setMethod('POST');
        $response = $this->server->handleRevokeRequest(BridgedRequest::createFromRequest($request),new OAuthResponse());
        if ($response->getStatusCode() !== 200) {
              Log::error('Attempt to revoke access token [' . $request->get('token') . '] failed. ' . "\n"
                  . 'Status code: ' . $response->getStatusCode() . "\n"
                  . 'Status text: ' . $response->getStatusText() . "\n"
                  . 'Error description: ' . $response->getParameter('error_description'));
        }
        Auth::logout();
        return redirect()->intended($request->get('post_logout_redirect_uri'));
    }
}
