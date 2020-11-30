<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Traits\FileTrait;
use Illuminate\Http\Request;

class CircularController extends Controller
{
    use FileTrait;

    public function fileGet($file)
    {
        $response = $this->getFile($file, 'circular');

        return $response;
    }
}
