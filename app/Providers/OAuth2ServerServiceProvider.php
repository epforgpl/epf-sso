<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use OAuth2\OpenID\GrantType\AuthorizationCode;
use OAuth2\Server;
use OAuth2\Storage\Pdo;

class OAuth2ServerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Server::class, function ($app) {
            // configure the server for OpenID Connect
            $config['use_openid_connect'] = true;
            $config['issuer'] = 'http://epf-sso.local.org';

            $pd = $app->make(Pdo::class);
            $server = new Server($pd, $config);
            $server->addGrantType(new AuthorizationCode($server->getStorage('authorization_code')));

            return $server;
        });
    }
}
