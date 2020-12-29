<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CircularArchive;
use App\Traits\FileTrait;
use Illuminate\Http\Request;

class CircularArchiveController extends Controller
{
    use FileTrait;

    public function show(CircularArchive $circularArchive)
    {
        $filename = tirarEspacos(tirarAcentos($circularArchive->name));

        $response = $this->getFile($circularArchive->archive, 'circularArchive', $filename);

        return $response;
    }
}
