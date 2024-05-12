<?php

namespace App\Models;

use App\Models\User;
use App\Mail\magicLinkEmail;
use Illuminate\Database\Eloquent\Model;
use App\Services\Notification\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoginToken extends Model
{
    use HasFactory;


    const EXPIRE_TOKEN_TIME = 300;


    public $table = 'login_token';

    protected $fillable = [
        'token'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

  public function send()
  {
    $notification = new Notification;

    $notification->sendEmail($this->user , new magicLinkEmail($this , ['email' => $this->user->email]));
  }


  public function isExpired()
  {
      return $this->created_at->diffInSeconds() > self::EXPIRE_TOKEN_TIME;
  }



  public function scopeExpiredToken($query)
  {
       return $query->where('created_at' , '<' , now()->subSecond(self::EXPIRE_TOKEN_TIME));
  }

}
