<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAlterPasswordRequest;
use App\Http\Requests\UserPasswordRequest;
use App\Http\Requests\UserUpdatePhotoRequest;
use App\Models\User;
use App\Traits\FileTrait;
use App\Traits\UserAgente;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function logoutOtherDevices(UserPasswordRequest $request)
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

        if (config('session.driver') == 'database') {
            DB::table(config('session.table', 'sessions'))
                ->where('user_id', Auth::user()->getAuthIdentifier())
                ->where('id', '!=', request()->session()->getId())
                ->delete();
        }

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Dispositivos deslogados com sucesso!'
            ]
        );

        return redirect()->back()->with('toastr', $toastr);
    }
}
