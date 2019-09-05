<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Represents an SSO user logging in via FB, Google, etc.
 *
 * @package App\Models
 * @mixin Eloquent
 */
class SocialUser extends Model
{
    protected $table = 'sso_social_users';

    protected $fillable = ['user_id', 'provider_user_id', 'provider'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
