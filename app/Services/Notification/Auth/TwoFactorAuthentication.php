<?php

namespace App\Services\Notification\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class TwoFactorAuthentication
{
    const TWO_FACTOR_ACTIVATED = 'two.factor.activated';
    const TWO_FACTOR_NOT_ACTIVATED = 'two.factor.activate.failed';
    const TWO_FACTOR_DEACTIVATED = 'two.factor.deactivate';


    public function __construct(public Request $request)
    {
    }



    public function getUser($user)
    {
        return User::where('email', $user->email)->firstOrFail();
    }


    public function activeTwoFactorFor(User $user)
    {
        $result = $user->activateTwoFactor($this->request);

        if ($result) {
            return self::TWO_FACTOR_ACTIVATED;
        }

        return self::TWO_FACTOR_NOT_ACTIVATED;
    }

    public function deactivateTwoFactor(User $user)
    {

        $result = $user->deactivateTwoFactor();

        if ($result) {
            return self::TWO_FACTOR_DEACTIVATED;
        }
    }

}
