<?php

namespace App\Http\Controllers\Sso;

use Illuminate\Routing\Controller as BaseController;

class OAuth2BaseController extends BaseController
{
    protected $server;

    public function __construct(\OAuth2\Server $server)
    {
        $this->server = $server;
    }
}
