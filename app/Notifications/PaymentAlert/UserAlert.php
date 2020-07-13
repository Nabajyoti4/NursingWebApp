<?php

namespace App\Notifications\PaymentAlert;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserAlert extends Notification
{
    use Queueable;

    public $book, $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($book, $user)
    {
        //
        $this->book = $book;
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
    {    if($this->book->remaining_days == 1){
        return (new MailMessage)
            ->greeting('Hello' . $this->user->first()->name)
            ->subject('Payment Due Alert')
            ->line('This is inform that booking id : ' . $this->book->id)
            ->line('Has a due payment of : ' . $this->book->due_payment . ' left')
            ->line('And its going to be completed tomorrow')
            ->line('Please complete if any due payment left')
            ->line('If your are happy with our service , you can extend the booking by contacting the admin')
            ->line('Thank you');
    }elseif ($this->book->remaining_days == 0){
        return (new MailMessage)
            ->greeting('Hello' . $this->user->first()->name)
            ->subject('Booking Complete')
            ->line('This is inform that booking id : ' . $this->book->id)
            ->line('Has a due payment of : ' . $this->book->due_payment . ' left')
            ->line('Is completed today')
            ->line('Please complete if any due payment left')
            ->line('We are happy to serve your family')
            ->line('Thank you');
    }
    else {
        return (new MailMessage)
            ->greeting('Hello' . $this->user->first()->name)
            ->subject('Payment Due Reminder')
            ->line('This is to inform that your booking id : ' . $this->book->id)
            ->line('Has a due payment of : ' . $this->book->due_payment . ' left')
            ->line('Please process your due payment before completion of the current booking')
            ->line('Check You Booking Tab for more Details');
    }
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
