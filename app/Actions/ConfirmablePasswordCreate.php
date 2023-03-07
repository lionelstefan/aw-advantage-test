<?php

namespace App\Actions;

use Lorisleiva\Actions\Action;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ConfirmablePasswordCreate extends Action
{
	private $status;
	public function middleware()
	{
		return ['auth'];
	}

	public function asController(Request $request)
	{
		$this->handle($request);
	}

	public function response(Request $request)
	{
        return redirect()->intended(RouteServiceProvider::HOME);
	}

	public function handle(Request $request)
	{
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());
	}
}
