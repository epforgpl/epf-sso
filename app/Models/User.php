<?php

namespace App\Models;

use App\Auth\ResetPasswordNotification;
use Eloquent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Represents an SSO user.
 *
 * @package App\Models
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'sso_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPasswordNotification($token));
    }
}
