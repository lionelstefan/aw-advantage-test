<?php

namespace App\Actions;

use Lorisleiva\Actions\Action;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class NewPasswordCreate extends Action
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
        return $this->status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($this->status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($this->status)]);
	}

	public function handle(Request $request)
	{
		$this->getValidatorInstance();
		if (!empty($this->validated()))
		{
			$this->status = Password::reset(
				$request->only('email', 'password', 'password_confirmation', 'token'),
				function ($user) use ($request) {
					$user->forceFill([
						'password' => Hash::make($request->password),
						'remember_token' => Str::random(60),
					])->save();

					event(new PasswordReset($user));
				}
			);
		}
	}

	public function rules()
	{
		return [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
	}
}
