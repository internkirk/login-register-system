<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Rules\Recaptcha;
use App\Services\Notification\Auth\TwoFactorAuthentication;

use Illuminate\Support\Facades\RateLimiter;

use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request, TwoFactorAuthentication $twoFactor)
    {

        $this->validateRequest($request);

        $this->ensureIsNotRateLimited($request);

        $result = Auth::validate($request->only('email', 'password'));

        
        if ($result) {
            
            RateLimiter::clear($this->throttleKey($request));
            
            if ($this->getUser($request)->isTwoFactorActive()) {
                
                return redirect()->route('auth.two.factor.login.form',['email' => $request->email]);
                
            }

            return $this->successfullLogin($request);
        }

        RateLimiter::hit($this->throttleKey($request));

        return $this->failedLogin();
    }


    protected function getUser($request)
    {
        return User::where('email' , $request->email )->firstOrFail();
    }


    protected function failedLogin()
    {
        return back()->with('wrong credentials', true);
    }

    protected function successfullLogin(Request $request)
    {
        $request->session()->regenerate();

        Auth::login($this->getUser($request));

        return redirect()->intended();
    }

    protected function validateRequest(Request $request)
    {
        $request->validate(
            [
                'email' => ['required','email','exists:users,email'],
                'password' => ['required','min:8'],
                'g-recaptcha-response' => ['required',new Recaptcha]
            ],
            [
                'g-recaptcha-response.required' => __('validation.recaptcha'),
            ]
        );
    }


    protected function ensureIsNotRateLimited(Request $request): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 6)) {

            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower($request->email) . '|' . $request->ip());
    }



    /**
     * Destroy an authenticated session.
     */
    public function logout(): RedirectResponse
    {

        session()->invalidate();

        Auth::logout();

        session()->regenerateToken();

        return redirect(route('auth.login.form'));
    }
}
