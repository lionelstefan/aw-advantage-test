<?php

namespace App\Actions;

use Lorisleiva\Actions\Action;
use Illuminate\Support\Facades\Auth;

class RegisterUserView extends Action
{
	public function middleware()
	{
		return ['guest'];
	}

	public function htmlResponse()
	{
		return view('auth.register');
	}
}
