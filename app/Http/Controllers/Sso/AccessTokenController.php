<?php

namespace App\Http\Controllers\Sso;

use Illuminate\Http\Request;
use OAuth2\HttpFoundationBridge\Request as BridgedRequest;
use OAuth2\Response as OAuthResponse;

class AccessTokenController extends OAuth2BaseController
{
    public function handleRequest(Request $request)
    {
        /** @var \OAuth2\Response $oauth_res */
        $oauth_res = $this->server->handleTokenRequest(BridgedRequest::createFromRequest($request),new OAuthResponse());
        return $this->convertOAuthResponseToSymfonyResponse($oauth_res);
    }
}
