<?php


namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
                $img = Storage::get($file);
                $img = Image::make($img)->setFileInfoFromPath($file);
                $img->orientate();
                $img->resize($w, $h, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->stream();
                Storage::put($file, $img);
            }
        }else{
            $img = Storage::get($files);
            $img = Image::make($img)->setFileInfoFromPath($files);
            $img->orientate();
            $img->resize($w, $h, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->stream();
            Storage::put($files, $img);
        }
    }

    public function getFile($file, $disk, $filename = null)
    {
        if (!Storage::exists($file))
            abort(404);

        $file = Storage::response($file, $filename);

        return $file;
    }

    public function removeFile($file, $disk)
    {
        Storage::delete($file);
    }

    public function base64File($base64, $disk)
    {
        $ext = explode('/', $base64);
        $ext = explode(';', $ext[1]);

        $name = md5(uniqid(rand(), true)) . '.' . $ext[0];
        $path = $disk.'/'.$name;

        $img = Image::make($base64)->orientate()->stream();
        Storage::put($path, $img);

        return $path;
    }

}
