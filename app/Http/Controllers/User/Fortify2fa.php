<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;

class Fortify2fa extends Controller
{
    public function enable(Request $request, EnableTwoFactorAuthentication $enable)
    {
        $enable($request->user());

        return $request->wantsJson()
            ? new JsonResponse('', 200)
            : redirect()->route('user.show')->with('status', 'two-factor-authentication-enabled');
    }

    public function disable(Request $request, DisableTwoFactorAuthentication $disable)
    {
        $disable($request->user());

        return $request->wantsJson()
            ? new JsonResponse('', 200)
            : redirect()->route('user.show')->with('status', 'two-factor-authentication-disabled');
    }

    public function regenerateRecoveryCodes(Request $request, GenerateNewRecoveryCodes $generate)
    {
        $generate($request->user());

        return $request->wantsJson()
            ? new JsonResponse('', 200)
            : redirect()->route('user.show')->with('status', 'recovery-codes-generated');
    }
}
