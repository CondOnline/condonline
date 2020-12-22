<?php

namespace App\Observers;

use App\Models\Circular;
use App\Services\Circular\RemovedImagesService;
use App\Services\Circular\UploadBase64TextService;
use App\Traits\FileTrait;

class CircularObserver
{
    use FileTrait;

    /**
     * Handle the Circular "creating" event.
     *
     * @param  \App\Models\Circular  $circular
     * @return void
     */
    public function creating(Circular $circular)
    {
        $circular->text = (new UploadBase64TextService($circular->text))->replace();
    }

    /**
     * Handle the Circular "updating" event.
     *
     * @param  \App\Models\Circular  $circular
     * @return void
     */
    public function updating(Circular $circular)
    {
        $images = (new RemovedImagesService($circular->getOriginal()['text'], $circular->text))->images();

        foreach ($images as $image)
        {
            $this->removeFile($image, 'circular');
        }

        $circular->text = (new UploadBase64TextService($circular->text))->replace();
    }

    /**
     * Handle the Circular "deleting" event.
     *
     * @param  \App\Models\Circular  $circular
     * @return void
     */
    public function deleting(Circular $circular)
    {
        preg_match_all('/(?<=src=")([^"]+)/', $circular->text, $images);

        foreach ($images[0] as $image)
        {
            $this->removeFile($image, 'circular');
        }
    }

}
