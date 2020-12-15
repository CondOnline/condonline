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
                $filePath = $file->store('/', $disk);
                $uploadedFiles[] = $filePath;
            }
        }else{
            $filePath = $files->store('/', $disk);
            $uploadedFiles = $filePath;
        }

        return $uploadedFiles;
    }

    public function resizeFile($disk, $files, $w = null, $h = null)
    {
        if(is_array($files)){
            foreach ($files as $file){
                $img = Storage::disk($disk)->path($file);
                $img = Image::make($img)->orientate();
                $img->resize($w, $h, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->save(storage_path(Storage::disk($disk)->url($file)));
            }
        }else{
            $img = Storage::disk($disk)->path($files);
            $img = Image::make($img)->orientate();
            $img->resize($w, $h, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save();
        }
    }

    public function getFile($file, $disk, $filename = null)
    {
        $path = Storage::disk($disk)->path($file);
        $headers = [];

        if (!File::exists($path)) {
            abort(404);
        }

        if ($filename){
            $headers['Content-Disposition'] = 'inline;filename="'. $filename .'"';
        }

        $response = response()->file($path, $headers);

        return $response;
    }

    public function removeFile($file, $disk)
    {
        Storage::disk($disk)->delete($file);
    }

    public function base64File($base64, $disk)
    {
        $ext = explode('/', $base64);
        $ext = explode(';', $ext[1]);

        $name = md5(uniqid(rand(), true)) . '.' . $ext[0];
        $path = storage_path(Storage::disk($disk)->url($name));

        Image::make($base64)->orientate()->save($path);

        return $name;
    }
}
