<?php

namespace App\Actions;

use Lorisleiva\Actions\Action;
use Illuminate\Http\Request;

class NewPasswordView extends action
{
	public function middleware()
	{
		return ['auth'];
	}

	public function htmlResponse(Request $request)
	{
        return view('auth.reset-password', ['request' => $request]);
	}
}
