<?php

namespace App\Actions;

use Lorisleiva\Actions\Action;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterUserCreate extends Action
{
	public function middleware()
	{
		return ['guest'];
	}

	public function handle(Request $request)
	{
		$this->getValidatorInstance();
		if (!empty($this->validated()))
		{
			$user = User::create([
				'name' => $request->name,
				'email' => $request->email,
				'password' => Hash::make($request->password),
			]);

			event(new Registered($user));

			Auth::login($user);

		}
	}

	public function asController(Request $request)
	{
		$this->handle($request);
	}

	public function response()
	{
		if (Auth::user())
		{
			return redirect(RouteServiceProvider::HOME);
		}
	}

	public function rules()
	{
		return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
		];
	}
}
