<?php

namespace App\Http\Controllers\Sso ;

use SimpleJWT\Keys\KeySet;
use SimpleJWT\Keys\RSAKey;

class JwksController extends OAuth2BaseController
{

    public function getJwks()
    {
        $set = new KeySet();
        $key = $this->server->getStorage('public_key')->getPublicKey();
        $set->add(new RSAKey($key, 'pem'));
        return $set->toJWKS();
    }
}
