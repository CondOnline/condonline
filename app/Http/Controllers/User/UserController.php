<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAlterPasswordRequest;
use App\Http\Requests\UserUpdatePhotoRequest;
use App\Models\User;
use App\Traits\FileTrait;
use App\Traits\UserAgente;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;

class UserController extends Controller
{
    use FileTrait;
    use UserAgente;

    public function show()
    {
        $user = User::whereId(Auth()->user()->id)->with('residences')->first();
        $sessions = collect(
            DB::table(config('session.table', 'sessions'))
                ->where('user_id', Auth::user()->getAuthIdentifier())
                ->orderBy('last_activity', 'desc')
                ->get()
        )->map(function ($session) {
            return (object) [
                'agent' => $this->createAgent($session),
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === request()->session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });

        return view('user.myUser.show', [
            'user' => $user,
            'sessions' => $sessions
        ]);
    }

    public function alterPassword(UserAlterPasswordRequest $request)
    {
        $data = $request->validated();
        $user = Auth()->user();
        if (!Hash::check($data['old_password'], $user->password))
            return redirect()->route('user.show');

        $user->update([
            'password' => Hash::make($data['password'])
        ]);

        session()->forget('first_login');

        $toastr = array(
            [
                'type' => 'success',
                'message' => 'Senha alterada com sucesso!'
            ]
        );

        return redirect()->route('user.show')->with('toastr', $toastr);
    }

    public function photo()
    {
        $response = $this->getFile(Auth()->user()->photo, 'userPhoto');

        return $response;
    }

    public function updatePhoto(UserUpdatePhotoRequest $request)
    {
        $user = Auth()->user();

        if (!$request->hasFile('photo'))
            return redirect()->route('user.show');

        if ($user->photo)
            $this->removeFile($user->photo, 'userPhoto');

        $photo = $this->fileUpload($request->photo, 'userPhoto');
        $this->resizeFile('userPhoto', $photo, '300', '300');

        $user->update([
            'photo' => $photo
        ]);

        $toastr = array(
            [
                'type' => 'success',
                'message' => 'Foto alterada com sucesso!'
            ]
        );

        return redirect()->route('user.show')->with('toastr', $toastr);
    }

    public function removePhoto()
    {
        $user = Auth()->user();

        $this->removeFile($user->photo, 'userPhoto');

        $user->update([
            'photo' => NULL
        ]);

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Foto apagada com sucesso!'
            ]
        );

        return redirect()->back()->with('toastr', $toastr);
    }

    public function logoutOtherDevices(Request $request)
    {
        $password = $request->password;

        if (! Hash::check($password, Auth::user()->password)) {
            $toastr = array(
                [
                    'type' => 'error',
                    'message' => 'Senha Incorreta!'
                ]
            );

            return redirect()->back()->with('toastr', $toastr);
        }

        Auth::logoutOtherDevices($password);

        if (config('session.driver') !== 'database') {
            return;
        }

        DB::table(config('session.table', 'sessions'))
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', '!=', request()->session()->getId())
            ->delete();

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Dispositivos deslogados com sucesso!'
            ]
        );

        return redirect()->back()->with('toastr', $toastr);
    }

    public function enable2fa(EnableTwoFactorAuthentication $enable)
    {
        $user = Auth::user();
        if ($user->two_factor_secret)
            return redirect()->route('user.show','#2fa');

        $enable($user);

        return redirect()->route('user.show','#2fa')->with('enabled2fa', true);
    }

    public function disable2fa(DisableTwoFactorAuthentication $disable)
    {
        $user = Auth::user();

        $disable($user);

        return redirect()->route('user.show','#2fa');
    }

    public function regenerateCodes2fa(GenerateNewRecoveryCodes $generate)
    {
        $user = Auth::user();
        if (!$user->two_factor_secret)
            return redirect()->route('user.show','#2fa');

        $generate($user);

        return redirect()->route('user.show','#2fa')->with('regenerate2fa', true);
    }
}
