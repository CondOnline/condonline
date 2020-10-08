<?php

namespace App\Jobs;

use App\Models\document;
use App\Models\User;
use App\Notifications\NewDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class NewDocumentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var document
     */
    private $document;
    private $notifyEmail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(document $document, $notifyEmail)
    {
        //
        $this->document = $document;
        $this->notifyEmail = $notifyEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        User::whereDweller(1)->chunk(100, function ($users){
            $users->each(function ($user){
                NewDocumentUserJob::dispatch($user, $this->document, $this->notifyEmail);
            });
        });
    }
}
