<?php
namespace App\Services\Notification\Providers;

use App\Models\User;
use App\Services\Notification\Contracts\Provider;

class SmsProvider implements Provider
{

    public function __construct(private User $user, private String $text)
    {
    }

    public function send() {
        echo __METHOD__;
    }
}