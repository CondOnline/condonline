<?php

namespace App\Observers;

use App\Jobs\SendNewUserEmail;
use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the user "creating" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $password = Str::random(10);
        $user->dweller = ($user->dweller == 1)?true:false;
        $user->blocked = false;

        $user->password = bcrypt($password);

        SendNewUserEmail::dispatch($user, $password);
    }

}
