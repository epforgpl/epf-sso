<?php

namespace App\Providers;

use App\Auth\EpfHasher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(EpfHasher $hasher)
    {
        Validator::extend('matches_current_password', function ($attr, $value, $params, $validator) use ($hasher) {
            if (!Auth::check()) {
                throw new \Exception('"matches_current_password" validation rule should only be used on forms '
                    . 'available to logged-in users.');
            }
            return $hasher->check($value, Auth::user()->password, ['hash_type' => Auth::user()->hash_type]);
        });

        Validator::extend('is_registered_user', function ($attr, $value, $params, $validator) {
            return (User::whereEmail($value)->first() !== null);
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
