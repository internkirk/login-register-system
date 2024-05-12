<?php

namespace App\Services\Notification\Auth\Trait;

use App\Mail\magicLinkEmail;
use App\Models\LoginToken;
use Illuminate\Support\Str;
use App\Services\Notification\Notification;

trait MagicAuthenticable
{


  public function magicToken()
  {
    return $this->hasOne(LoginToken::class);
  }


  public function createLoginToken()
  {
    $this->magicToken()->delete();

    return $this->magicToken()->create([
      'token' => Str::random(60),
      'user_id' => $this->id
    ]);
  }

}
