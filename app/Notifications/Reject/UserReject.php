<?php

namespace App\Notifications\Reject;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserReject extends Notification
{
    use Queueable;
    public $booking, $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($booking, $user)
    {
        //
        $this->booking = $booking;
        $this->user = $user;
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
            ->greeting('Hello ' . $this->user->first()->name)
            ->subject('Booking Cancellation')
            ->line('Booking Id : ' . $this->booking->id)
            ->line('This is to inform you that your current booking has been cancelled due unavoidable circumstances')
            ->line('We are very sorry for the inconvenience , we will contact you shortly regarding the issue');
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
