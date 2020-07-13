<?php

namespace App\Notifications\Takeover;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OldNurse extends Notification
{
    use Queueable;
    public  $nurse;

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
            ->greeting('Hello'. $this->nurse->user->name)
            ->subject('Booking Takeover')
            ->line('Your request for booking takeover has been processed')
            ->line('Check You Booking Tab for more Details');
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
