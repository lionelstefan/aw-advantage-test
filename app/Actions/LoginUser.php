<?php

namespace App\Actions;

use Lorisleiva\Actions\Action;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUser extends Action {
	public function middleware()
	{
		return ['guest'];
	}

	public function handle(LoginRequest $request)
	{
        $request->authenticate();

        $request->session()->regenerate();
	}

	public function response()
	{
		if (Auth::user())
		{
			return redirect(RouteServiceProvider::HOME);
		}
	}
}
