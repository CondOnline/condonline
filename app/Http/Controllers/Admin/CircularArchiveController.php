<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CircularArchiveResquest;
use App\Models\Circular;
use App\Models\CircularArchive;
use App\Traits\FileTrait;
use Illuminate\Http\Request;

class CircularArchiveController extends Controller
{
    use FileTrait;

    public function store(Circular $circular, CircularArchiveResquest $resquest)
    {
        $data = $resquest->validated();

        $files = $this->fileUpload($data['archives'], 'circularArchive');

        $archives = array_map(function ($key, $value) use ($data){
            $archive = new CircularArchive();
            $archive->archive = $value;
            $archive->name = $data['archives'][$key]->getClientOriginalName();

            return $archive;

        }, array_keys($files), $files);

        $circular->archives()->saveMany($archives);

        $toastr = array(
            [
                'type' => 'success',
                'message' => 'Anexos adcionados com sucesso!'
            ]
        );

        return redirect()->route('admin.circulars.show', $circular)->with('toastr', $toastr);
    }

    public function destroy(CircularArchive $circularArchive)
    {
        $this->removeFile($circularArchive->archive, 'cirularArchive');

        $circularArchive->delete();

        $toastr = array(
            [
                'type' => 'info',
                'message' => 'Anexo removido com sucesso!'
            ]
        );

        return redirect()->back()->with('toastr', $toastr);

    }

}
