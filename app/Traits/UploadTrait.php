<?php


namespace App\Traits;


trait UploadTrait
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

        return$uploadedFiles;
    }

}
