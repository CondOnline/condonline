<?php


namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;


class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        if ($request->wantsJson())
            response()->json(['two_factor' => false]);

        if (Auth::user()->dweller)
            return redirect()->intended(route('user.index'));

        return redirect()->intended(route('admin.index'));
    }
}
