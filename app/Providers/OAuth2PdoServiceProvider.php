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
            // create storage object
            return new OAuth2Pdo(
                // Connection array.
                [
                    'dsn' => env('DB_CONNECTION', 'mysql')
                        . ':dbname=' . env('DB_DATABASE', 'epfsso')
                        . ';host=' . env('DB_HOST', 'localhost'),
                    'username' => env('DB_USERNAME', 'epfsso'),
                    'password' => env('DB_PASSWORD', 'epfsso')
                ],
                // Config array.
                [
                    'user_table' => 'users' // Overwriting default name 'oauth_users'.
                ]);
        });
    }
}