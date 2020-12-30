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

class NewDocumentUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;
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
    public function __construct(User $user, document $document, $notifyEmail)
    {
        //
        $this->user = $user;
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
        $this->user->notify(new NewDocument($this->document, $this->notifyEmail));
    }
}
