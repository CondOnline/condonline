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

    /**
     * Handle the document "updated" event.
     *
     * @param  \App\Models\Document  $document
     * @return void
     */
    public function updated(Document $document)
    {
        //
    }

    /**
     * Handle the document "deleted" event.
     *
     * @param  \App\Models\Document  $document
     * @return void
     */
    public function deleted(Document $document)
    {
        //
    }

    /**
     * Handle the document "restored" event.
     *
     * @param  \App\Models\Document  $document
     * @return void
     */
    public function restored(Document $document)
    {
        //
    }

    /**
     * Handle the document "force deleted" event.
     *
     * @param  \App\Models\Document  $document
     * @return void
     */
    public function forceDeleted(Document $document)
    {
        //
    }
}
