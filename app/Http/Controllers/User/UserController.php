<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FileTrait;

class UserController extends Controller
{
    use FileTrait;

    public function photo()
    {
        $response = $this->getFile(Auth()->user()->photo, 'userPhoto');

        return $response;
    }
}
