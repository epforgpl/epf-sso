<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Custom UserProvider, passing to the hasher object the hash type indicated by the user record. This is needed to
 * handle differently new users, created by our new SSO project, and old users from mojepanstwo.pl.
 *
 * @package App\Auth
 */
class EpfUserProvider extends EloquentUserProvider
{

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $plain = $credentials['password'];

        return $this->hasher->check($plain, $user->getAuthPassword(), [ 'hash_type' => $user->hash_type ]);
    }
}
