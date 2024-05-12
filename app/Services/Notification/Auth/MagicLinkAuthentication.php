<?php

namespace App\Services\Notification\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MagicLinkAuthentication
{

    const INVALID_TOKEN = 'invalid_token';
    const EXPIRED_TOKEN = 'expired_token';
    const EXPIRED_LINK = 'expired_link';


    public function __construct(public Request $request)
    {
    }

    public function requestLink()
    {
        $user = $this->getUser();

        return $user->createLoginToken();
    }


    public function verifyLink($link)
    {
        $user = User::where('email', $link->email)->first();

        if (is_null($user->magicToken)) {
            return self::EXPIRED_LINK;
        }

        if ($user->magicToken->isExpired()) {
            return self::EXPIRED_TOKEN;
        }

        if ($user->magicToken->token  == $link->token) {
            return Auth::login($user);
        }

        return self::INVALID_TOKEN;
    }


    protected function getUser()
    {
        return User::where('email', $this->request->email)->firstOrFail();
    }
}
