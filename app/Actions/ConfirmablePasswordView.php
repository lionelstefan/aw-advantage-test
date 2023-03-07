<?php

namespace App\Actions;

use Lorisleiva\Actions\Action;
use Illuminate\Http\Request;

class ConfirmablePasswordView extends action
{
	public function middleware()
	{
		return ['auth'];
	}

	public function htmlResponse(Request $request)
	{
        return view('auth.confirm-password');
	}
}
