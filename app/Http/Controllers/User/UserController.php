<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAlterPasswordRequest;
use App\Models\User;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use FileTrait;

    public function show()
    {
        $user = User::whereId(Auth()->user()->id)->with('residences')->first();

        return view('dweller.myUser.show', [
            'user' => $user
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

        return redirect()->route('user.show');
    }

    public function photo()
    {
        $response = $this->getFile(Auth()->user()->photo, 'userPhoto');

        return $response;
    }

    public function removePhoto()
    {
        $user = Auth()->user();

        $this->removeFile($user->photo, 'userPhoto');

        $user->update([
            'photo' => NULL
        ]);

        return redirect()->back();
    }
}
