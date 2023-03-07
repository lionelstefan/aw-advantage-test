<?php

namespace App\Actions;

use Lorisleiva\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Providers\RouteServiceProvider;

class VerifyEmailCreate extends Action
{
	public function middleware()
	{
		return ['auth', 'signed', 'throttle:6,1'];
	}

	public function response(Request $request)
	{
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
	}
}
