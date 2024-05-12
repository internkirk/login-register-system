<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function showResetPasswordForm(): View
    {
        return view('auth.password-forget-form');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sendResetPasswordLink(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email','exists:users,email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('reset link sent successfully' , true);
        }


        return back()->with('reset link sent before' , true);
    }


    public function resetPasswordForm(Request $request)
    {
        return view('auth.password-reset-form', compact('request'));
    }


    public function resetPassword(Request $request)
    {

        $this->validateResetPassword($request);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
            }
        );

 

        if ($status == Password::PASSWORD_RESET) 
            return redirect()->route('auth.login.form')->with('password reset successfully', true);


        if ($status == Password::INVALID_TOKEN)
              return redirect()->back()->with('token is invalid', true);

        
              return back()->with('there is a problem', true);
        
    }




    protected function validateResetPassword(Request $request)
    {

        $request->validate([
            'email' => ['required','email','exists:users,email'],
            'password' => ['required','min:8' , 'max:60', 'confirmed'],
            'token' => ['required']
        ]);

    }
}
