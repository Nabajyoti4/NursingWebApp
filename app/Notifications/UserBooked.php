<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserBooked extends Notification
{
    use Queueable;

    public $booking, $patient;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($booking, $patient)
    {
        //
        $this->booking = $booking;
        $this->patient = $patient;
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
            ->greeting('Hello'. $this->patient->user->name)
            ->subject('Nurse Hiring Request Approved')
            ->line('Your nurse request for patient '.$this->patient->name.' has been approved')
            ->line('Further actions will be taken after the approval of nurse')
            ->line('Check your booking tab for more details on the booking status');
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
