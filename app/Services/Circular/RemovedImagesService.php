<?php


namespace App\Services\Circular;


class RemovedImagesService
{

    private $textOld;
    private $textNew;

    public function __construct($textOld, $textNew)
    {
        $this->textOld = $textOld;
        $this->textNew = $textNew;
    }

    public function images()
    {
        preg_match_all('/(?<=src=")([^"]+)/', $this->textOld, $imagesOld);
        $imagesOldName = array_map(function ($image) {
            $imageName = explode("/", $image);
            return 'circular/'.end($imageName);
        }, $imagesOld[0]);

        preg_match_all('/(?<=src=")([^"]+)/', $this->textNew, $imagesNew);
        $imagesNewName = array_map(function ($image) {
            $imageName = explode("/", $image);
            return 'circular/'.end($imageName);
        }, $imagesNew[0]);

        return array_diff($imagesOldName, $imagesNewName);
    }

}
