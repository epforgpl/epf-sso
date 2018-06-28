<?php

namespace App\Http\Controllers\Sso;

use Illuminate\Routing\Controller as BaseController;
use OAuth2\Response as OAuthResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class OAuth2BaseController extends BaseController
{
    protected $server;

    public function __construct(\OAuth2\Server $server)
    {
        $this->server = $server;
    }

    /**
     * Laravel uses the HttpFoundation library's implementation of HTTP requests & responses. However, the OAuth server
     * impl we use doesn't return them in the right form. The creator of the server provides a bridge implementation
     * at https://github.com/bshaffer/oauth2-server-httpfoundation-bridge but it breaks with Symfony 4 (bug
     * https://github.com/bshaffer/oauth2-server-httpfoundation-bridge/issues/31) Therefore, we do our own conversion
     * for the HTTP responses (using request conversion from the library still), which seems to work.
     *
     * @param OAuthResponse $in
     * @return SymfonyResponse
     */
    protected function convertOAuthResponseToSymfonyResponse(OAuthResponse $in) : SymfonyResponse
    {
        return new SymfonyResponse($in->getResponseBody(), $in->getStatusCode(), $in->getHttpHeaders());
    }
}
