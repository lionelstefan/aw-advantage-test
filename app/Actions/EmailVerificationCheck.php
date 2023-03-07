<?php

namespace App\Actions;

use Lorisleiva\Actions\Action;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class EmailVerificationCheck extends action
{
	public function middleware()
	{
		return ['auth'];
	}

	public function response(Request $request)
	{
		if ($request->user()->hasVerifiedEmail())
		{
			return redirect()->intended(RouteServiceProvider::HOME);
		}
	}

	public function htmlResponse(Request $request)
	{
		if (!$request->user()->hasVerifiedEmail())
		{
			return view('auth.verify-email');
		}
	}
}
