<?php

namespace App\Observers;

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
        $user->dweller = ($user->dweller == 1)?true:false;
        $user->blocked = false;

        $user->password = bcrypt(Str::random(10));
    }

}
