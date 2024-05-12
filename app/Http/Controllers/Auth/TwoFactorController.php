<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\Notification\Auth\TwoFactorAuthentication;

class TwoFactorController extends Controller
{


    public function __construct(public TwoFactorAuthentication $twoFactor)
    {
        return $this->middleware('auth')->except(['validatePassword', 'showLoginForm']);
    }

    public function showForm()
    {
        return view('auth.two-factor-form');
    }


    public function showLoginForm($email)
    {
        return view('auth.two-factor-login-form', compact('email'));
    }

    public function activate(Request $request)
    {

        // validate request
        $this->validateRequest($request);

        // store password
        // activate two factor authentication
        $result = $this->twoFactor->activeTwoFactorFor(Auth::user());



        // return proper response
        if ($result == $this->twoFactor::TWO_FACTOR_ACTIVATED)
            return back()->with('two factor authentication activated', true);

        if ($result == $this->twoFactor::TWO_FACTOR_NOT_ACTIVATED)
            return back()->with('two factor authentication failed', true);
    }


    public function deactivate()
    {
        $result = $this->twoFactor->deactivateTwoFactor(Auth::user());

        if ($result == $this->twoFactor::TWO_FACTOR_DEACTIVATED)
            return back()->with('two factor authentication deactivated', true);
    }


    protected function validateRequest($request)
    {
        $request->validate([
            'password' => ['required', 'min:8', 'max:255']
        ]);
    }


    public function validatePassword(Request $request)
    {
        $this->validateRequest($request);

        $result = Hash::check($request->password, $this->getUser($request)->twoFactor->second_password);

        if ($result)
            return  $this->login($request);

        return back()->with('two factor code is wrong', true);
    }

    protected function login($request)
    {
        $request->session()->regenerate();
        Auth::login($this->getUser($request));
        return redirect()->route('home');
    }


    protected function getUser($request)
    {
        return User::where('email', $request->email)->firstOrFail();
    }
}
