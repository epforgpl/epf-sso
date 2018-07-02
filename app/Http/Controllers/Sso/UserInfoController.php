<?php

namespace App\Http\Controllers\Sso;

use Illuminate\Http\Request;
use OAuth2\HttpFoundationBridge\Request as BridgedRequest;
use OAuth2\Response as OAuthResponse;

class UserInfoController extends OAuth2BaseController
{
    public function handleRequest(Request $request)
    {
        /** @var OAuthResponse $oauth_res */
        $oauth_res = $this->server->handleUserInfoRequest(
            BridgedRequest::createFromRequest($request), new OAuthResponse());
        return $this->convertOAuthResponseToSymfonyResponse($oauth_res);
    }
}
