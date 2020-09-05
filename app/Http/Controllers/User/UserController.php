<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FileTrait;

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
