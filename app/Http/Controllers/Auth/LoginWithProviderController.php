<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginWithProviderController extends Controller
{
    public function redirectToProvider($driver)
    {
         return  Socialite::driver($driver)->redirect();
    }


    public function loginWithProvider($driver)
    {
        $user = Socialite::driver($driver)->stateless()->user();

       Auth::login($this->findOrCreateUser($user, $driver));

       return redirect()->intended();
    }


    protected function findOrCreateUser($user, $driver)
    {
         $providerUser = User::where([
            'email' => $user->getEmail()
          ])->first();

         if (!is_null($providerUser)) return $providerUser;


         return User::create([
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'provider' => $driver,
            'provider_id' => $user->getId(),
            'avatar' => $user->getAvatar(),
            'email_verified_at' => now()
         ]);

    }
}
