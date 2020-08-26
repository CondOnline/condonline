<?php


namespace App\Traits;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{
    public function fileUpload($files, $disk)
    {
        $uploadedFiles = [];

        if(is_array($files)){
            foreach ($files as $file){
                $filePath = $file->store('', $disk);
                $uploadedFiles = $filePath;
            }
        }else{
            $filePath = $files->store('/', $disk);
            $uploadedFiles = $filePath;
        }

        return $uploadedFiles;
    }

    public function getFile($file, $disk)
    {
        $path = Storage::disk($disk)->path($file);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function removeFile($file, $disk)
    {
        Storage::disk($disk)->delete($file);
    }
}
