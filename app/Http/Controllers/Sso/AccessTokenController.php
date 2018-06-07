<?php

namespace App\Http\Controllers\Sso;

use App\Util\Symfony4Fix\BridgedResponse;
use Illuminate\Http\Request;
use OAuth2\HttpFoundationBridge\Request as BridgedRequest;

class AccessTokenController extends OAuth2BaseController
{
    public function handleRequest(Request $request)
    {
        return $this->server->handleTokenRequest(BridgedRequest::createFromRequest($request), new BridgedResponse());
    }
}
