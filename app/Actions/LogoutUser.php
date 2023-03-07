<?php

namespace App\Actions;

use Lorisleiva\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogoutUser extends Action
{
    public function middleware()
    {
        return ['auth'];
    }

    public function handle(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }

	public function response()
	{
		return redirect('/');
	}
}
