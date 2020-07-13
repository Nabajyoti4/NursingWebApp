<?php

namespace App\Notifications\Reject;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NurseReject extends Notification
{
    use Queueable;
    public $booking, $nurse;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($booking, $nurse)
    {
        //
        $this->booking = $booking;
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
            ->greeting('Hello ' . $this->nurse->first()->name)
            ->subject('Booking Cancellation')
            ->line('Booking Id : ' . $this->booking->id)
            ->line('This is to inform you that your current booking has been cancelled at your request for leave');
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
