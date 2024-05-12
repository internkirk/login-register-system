<?php

namespace App\Services\Notification\Auth\Trait;

use App\Models\TwoFactor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait TwoFactorAuthenticable
{
    public function twoFactor()
    {
        return $this->hasOne(TwoFactor::class);
    }


    public function activateTwoFactor(Request $request)
    {

        $this->twoFactor()->delete();

        $result = TwoFactor::create([
            'second_password' => Hash::make($request->password),
            'user_id' => $this->id
        ]);

        $this->has_two_factor = true;

        // return response
        if (is_null($result)) {

            return false;
        }

        $this->save();
        return true;
    }


    public function deactivateTwoFactor()
    {
        $this->twoFactor()->delete();
        $this->has_two_factor = false;

        $this->save();
        return true;
    }



    public function isTwoFactorActive()
    {
        return $this->has_two_factor;
    }
}
