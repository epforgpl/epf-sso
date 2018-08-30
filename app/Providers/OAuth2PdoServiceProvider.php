<?php

namespace App\Providers;

use App\Storage\OAuth2Pdo;
use Illuminate\Support\ServiceProvider;
use OAuth2\Storage\Pdo;

class OAuth2PdoServiceProvider extends ServiceProvider
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
        $this->app->singleton(Pdo::class, function ($app) {
            $db_config = config('database.connections')[config('database.default')];

            // create storage object
            return new OAuth2Pdo(
                // Connection array.
                [
                    'dsn' => $db_config['driver']
                        . ':dbname=' . $db_config['database']
                        . ';host=' . $db_config['host']
                        . ';port=' . $db_config['port']
                        . ';charset=utf8',
                    'username' => $db_config['username'],
                    'password' => $db_config['password']
                ],
                // Config array.
                [
                    'user_table' => 'sso_users' // Overwriting default name 'oauth_users'.
                ]);
        });
    }
}
