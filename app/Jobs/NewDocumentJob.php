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
        $delay = 0;
        User::whereDweller(1)->chunk(100, function ($users) use (&$delay){
            $users->each(function ($user) use (&$delay){
                NewDocumentUserJob::dispatch($user, $this->document, $this->notifyEmail)->delay(now()->addSecond($delay));

                if ($this->notifyEmail)
                    $delay += 0.5;
            });
        });
    }
}
