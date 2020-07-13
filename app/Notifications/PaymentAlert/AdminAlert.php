<?php

namespace App\Notifications\PaymentAlert;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminAlert extends Notification
{
    use Queueable;

    public $book, $admin;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($book, $admin)
    {
        //
        $this->book = $book;
        $this->admin = $admin;
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
        if($this->book->remaining_days == 1){
            return (new MailMessage)
                ->greeting('Hello Admin')
                ->subject('Payment Due Alert')
                ->line('This is inform that booking id : ' . $this->book->id)
                ->line('Has a due payment of : ' . $this->book->due_payment . ' left')
                ->line('And its going to be completed tomorrow')
                ->line('Check the Booking Tab for more Details');
        }elseif ($this->book->remaining_days == 0){
            return (new MailMessage)
                ->greeting('Hello Admin')
                ->subject('Booking Complete')
                ->line('This is inform that booking id : ' . $this->book->id)
                ->line('Has a due payment of : ' . $this->book->due_payment . ' left')
                ->line('Is completed today')
                ->line('Thank you');
        }else{
            return (new MailMessage)
                ->greeting('Hello Admin')
                ->subject('Payment Due Alert')
                ->line('This is inform that booking id : ' . $this->book->id)
                ->line('Has a due payment of : ' . $this->book->due_payment . ' left')
                ->line('Check the Booking Tab for more Details');
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
