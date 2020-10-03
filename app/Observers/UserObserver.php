<?php

namespace App\Observers;

use App\Jobs\SendNewUserEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating(User $user)
    {
        request()->merge([
            'password' => Str::random(10)
        ]);

        $user->password = Hash::make(request()->password);
    }

    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        SendNewUserEmail::dispatch($user, request()->password);
    }

    public function deleting(User $user)
    {
        $user->residences()->detach();
    }
}
