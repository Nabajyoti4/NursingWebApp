<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NurseJoinRequest extends Notification
{
    use Queueable;

    public $nurse;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($nurse)
    {
        //
        $this->nurse = $nurse;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hello Admin')
                    ->subject('New Request For Nurse Job')
                    ->line('New request For Nurse Job approval')
                    ->line('Request from '. $this->nurse->name)
                    ->action('Notification Action', url(route('nursejoin.index')))
                    ->line('Visit The Link For approval');
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
            //
        ];
    }
}
