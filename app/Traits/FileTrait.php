<?php


namespace App\Traits;

use Carbon\Carbon;
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
        $uploadedFiles = [];
        if(is_array($files)){
            foreach ($files as $file){
                $name = md5($file->getClientOriginalName().Carbon::now()).'.jpg';
                $img = Storage::get($file);
                $img = Image::make($img);
                $img->orientate();
                $img->resize($w, $h, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->stream();
                Storage::put('/'.$disk.'/'.$name, $img);
                $uploadedFiles[] = '/'.$disk.'/'.$name;
            }
        }else{
            $name = md5($files->getClientOriginalName().Carbon::now()).'.jpg';
            $img = Image::make($files);
            $img->orientate();
            $img->resize($w, $h, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->stream();
            Storage::put('/'.$disk.'/'.$name, $img);
            $uploadedFiles = '/'.$disk.'/'.$name;
        }

        return $uploadedFiles;
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

    private function image_orientate($source, $quality = 90, $destination = null)
    {
        if ($destination === null) {
            $destination = $source;
        }
        $info = getimagesize($source);
        if ($info['mime'] === 'image/jpeg') {
            $exif = exif_read_data($source);
            if (!empty($exif['Orientation']) && in_array($exif['Orientation'], [2, 3, 4, 5, 6, 7, 8])) {
                $image = imagecreatefromjpeg($source);
                if (in_array($exif['Orientation'], [3, 4])) {
                    $image = imagerotate($image, 180, 0);
                }
                if (in_array($exif['Orientation'], [5, 6])) {
                    $image = imagerotate($image, -90, 0);
                }
                if (in_array($exif['Orientation'], [7, 8])) {
                    $image = imagerotate($image, 90, 0);
                }
                if (in_array($exif['Orientation'], [2, 5, 7, 4])) {
                    imageflip($image, IMG_FLIP_HORIZONTAL);
                }
                imagejpeg($image, $destination, $quality);
            }
        }
        return true;
    }

}
