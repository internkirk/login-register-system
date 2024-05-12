<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Notification\Auth\MagicLinkAuthentication;
use Illuminate\Http\Request;

class MagicLinkController extends Controller
{

    public function __construct(public MagicLinkAuthentication $auth)
    {
    }


    public function showForm()
    {
        return view('auth.magic-link-form');
    }

    public function sendToken(Request $request)
    {
        $this->validateForm($request);

        $this->auth->requestLink()->send();

        return redirect()->back()->with('link sent successfully', true);
    }


    public function verifyToken(Request $request)
    {
        $response = $this->auth->verifyLink($request);

        if ($response == $this->auth::EXPIRED_LINK) {
            return redirect()->route('auth.show.magic.link.form')->with('expired_link', true);
        }

        if ($response == $this->auth::EXPIRED_TOKEN) {
            return redirect()->route('auth.show.magic.link.form')->with('expired_token', true);
        }

        if ($response == $this->auth::INVALID_TOKEN) {
            return redirect()->route('auth.show.magic.link.form')->with('invalid_token', true);
        }

        return redirect()->route('home');
    }


    protected function validateForm($request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email']
        ]);
    }
}
