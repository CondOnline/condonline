<?php


namespace App\Traits;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;

trait FileTrait
{
    public function fileUpload($files, $disk)
    {
        $uploadedFiles = [];

        if(is_array($files)){
            foreach ($files as $file){
                $filePath = $file->store('/'.$disk);
                $uploadedFiles[] = $filePath;
            }
        }else{
            $filePath = $files->store('/'.$disk);
            $uploadedFiles = $filePath;
        }

        return $uploadedFiles;
    }

    public function resizeFile($disk, $files, $w = null, $h = null)
    {
        if(is_array($files)){
            foreach ($files as $file){
                $img = Storage::path($file);
                $img = Image::make($img)->orientate();
                $img->resize($w, $h, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->stream();
                Storage::put($file, $img);
            }
        }else{
            $img = Storage::get($files);
            $img = Image::make($img)->orientate();
            $img->resize($w, $h, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->stream();
            Storage::put($files, $img);
        }
    }

    public function getFile($file, $disk, $filename = null)
    {
        $path = Storage::response($file, $filename);

        return $path;
    }

    public function removeFile($file, $disk)
    {
        Storage::delete($file);
    }
}
