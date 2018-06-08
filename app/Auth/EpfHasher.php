<?php

namespace App\Auth;

use Illuminate\Hashing\BcryptHasher;

/**
 * A custom hasher, using the default (bcrypt) for new users, created by our new SSO project, and using SHA1 for
 * old user created by mojepanstwo.pl.
 *
 * @package App\Auth
 */
class EpfHasher extends BcryptHasher
{

    /**
     * Check the given plain value against a hash.
     *
     * @param  string $value
     * @param  string $hashedValue
     * @param  array $options
     * @return bool
     * @throws \Exception If hash type is not recognized.
     */
    public function check($value, $hashedValue, array $options = [])
    {
        if (strlen($hashedValue) === 0) {
            return false;
        }

        $hash_type = $options['hash_type'];
        if ($hash_type === 'BCRYPT') {
            return password_verify($value, $hashedValue);
        } else if ($hash_type === 'SHA1') {
            // See https://github.com/epforgpl/_mojePanstwo-API-Server/blob/master/lib/Cake/Utility/Security.php
            // method hash(). Salt is provided.
            return sha1(env('MOJEPANSTWO_OLD_LOGIN_SALT') . $value) === $hashedValue;
        } else {
            throw new \Exception('Unrecognized hash type: [' . $hash_type . ']');
        }
    }
}
