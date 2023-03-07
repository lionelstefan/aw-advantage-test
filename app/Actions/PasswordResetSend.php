<?php

namespace App\Actions;

use Lorisleiva\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetSend extends Action
{
	private $status;
	public function middleware()
	{
		return ['guest'];
	}

	public function asController(Request $request)
	{
		$this->handle($request);
	}

	public function response(Request $request)
	{
        return $this->status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($this->status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($this->status)]);
	}

	public function handle(Request $request)
	{
		$this->getValidatorInstance();
		if (!empty($this->validated()))
		{
			$this->status = Password::sendResetLink(
				$request->only('email')
			);
		}
	}

	public function rules()
	{
		return [
            'email' => ['required', 'email'],
        ];
	}
}
