<?php

namespace App\Http\Controllers\Sso;

use Illuminate\Http\Request;
use OAuth2\HttpFoundationBridge\Request as BridgedRequest;
use OAuth2\HttpFoundationBridge\Response as BridgedResponse;

class UserInfoController extends OAuth2BaseController
{
    public function handleRequest(Request $request)
    {
        return $this->server->handleUserInfoRequest(BridgedRequest::createFromRequest($request), new BridgedResponse());
    }
}
