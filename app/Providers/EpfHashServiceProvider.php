<?php

namespace App\Providers;

use App\Auth\EpfHasher;
use Illuminate\Support\ServiceProvider;

class EpfHashServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('epfhash', function () {
            return new EpfHasher();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['epfhash'];
    }
}