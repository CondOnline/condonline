<?php

namespace App\Notifications;

use App\Models\document;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewDocument extends Notification
{
    use Queueable;

    /**
     * @var document
     */
    private $document;
    private $notifyEmail;

    /**
     * Create a new notification instance.
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
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if ($this->notifyEmail)
            return ['database', 'mail'];

        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject('Novo Documento - '.config('app.name'))
                                ->markdown('emails.newDocument', [
                                                                        'document' => $this->document,
                                                                        'user' => $notifiable
                                                                        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'document' => $this->document->id
        ];
    }
}
