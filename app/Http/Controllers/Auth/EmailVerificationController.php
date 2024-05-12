<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class EmailVerificationController extends Controller
{
   /**
    * Send a new email verification notification.
    */

   // public function store(Request $request): RedirectResponse
   // {
   //     if ($request->user()->hasVerifiedEmail()) {
   //         return redirect()->intended(RouteServiceProvider::HOME);
   //     }

   //     $request->user()->sendEmailVerificationNotification();

   //     return back()->with('status', 'verification-link-sent');
   // }



   public function send()
   {
      Auth::user()->sendEmailVerificationNotification();

      return back()->with('email.sent', 'email veification successfully sent');
   }



   public function verify(Request $request)
   {

      // check the user that is logged in can verify email
      if ($request->user()->email !== $request->query('email')) {
         abort(403);
      }


      // check signature is valid
      if (!URL::hasValidSignature($request)) {
         return redirect(route('home'))->with('your email link has been edited', true);
      }

      // check email in verified
      if ($request->user()->hasVerifiedEmail()) {
         return redirect(route('home'))->with('your email has been verified', true);
      }

      // email verify
      $request->user()->markEmailAsVerified();

      session()->forget("verifyEmail");

      // redirect
      return redirect(route('home'))->with('your email successfully verified', true);
   }
}
