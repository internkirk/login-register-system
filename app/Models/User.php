<?php

namespace App\Models;

use App\Mail\emailVerification;
use App\Mail\passwordReset;
use App\Services\Notification\Auth\Trait\MagicAuthenticable;
use App\Services\Notification\Auth\Trait\TwoFactorAuthenticable;
use App\Services\Notification\Notification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , MagicAuthenticable , TwoFactorAuthenticable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'provider',
        'provider_id',
        'avatar',
        'email_verified_at',
        'has_two_factor'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];




    public function sendEmailVerificationNotification()
    {
        $notification = new Notification;

        $notification->sendEmail($this, new emailVerification($this));
    }


    public function sendPasswordResetNotification($token)
    {
        $notification = new Notification;

        $notification->sendEmail($this, new passwordReset($this, $token));
    }
}
