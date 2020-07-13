<?php

namespace App\Notifications\Takeover;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewNurse extends Notification
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
            ->subject('New Takeover Booking Allotted')
            ->line('New takeover booking has been allotted for you')
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
