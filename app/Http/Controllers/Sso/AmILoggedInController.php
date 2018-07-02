<?php

namespace App\Http\Controllers\Sso;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class AmILoggedInController extends BaseController
{
    public function handleRequest()
    {
        return Auth::check() ? 'true' : 'false';
    }
}
