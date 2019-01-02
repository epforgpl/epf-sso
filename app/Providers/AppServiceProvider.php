<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('matches_current_password', function ($attribute, $value, $parameters, $validator) {
            if (!Auth::check()) {
                throw new \Exception('"matches_current_password" validation rule should only be used on forms '
                    . 'available to logged-in users.');
            }
            return Hash::check($value, Auth::user()->password);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
