<?php

namespace App\Http\Controllers\Sso;

use App\Util\Symfony4Fix\BridgedResponse;
use Illuminate\Http\Request;
use OAuth2\HttpFoundationBridge\Request as BridgedRequest;

class UserInfoController extends OAuth2BaseController
{
    public function handleRequest(Request $request)
    {
        return $this->server->handleUserInfoRequest(BridgedRequest::createFromRequest($request), new BridgedResponse());
    }
}
