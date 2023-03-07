<?php

namespace App\Actions;

use Lorisleiva\Actions\Action;

class PasswordResetView extends action
{
	public function middleware()
	{
		return ['guest'];
	}

	public function htmlResponse()
	{
        return view('auth.forgot-password');
	}
}
