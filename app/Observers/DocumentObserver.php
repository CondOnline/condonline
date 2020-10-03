<?php

namespace App\Observers;

use App\Jobs\NewDocumentJob;
use App\Models\Document;

class DocumentObserver
{
    /**
     * Handle the document "created" event.
     *
     * @param  \App\Models\Document  $document
     * @return void
     */
    public function created(Document $document)
    {
        NewDocumentJob::dispatch($document);
    }
}
