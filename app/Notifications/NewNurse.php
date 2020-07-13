<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewNurse extends Notification
{
    use Queueable;

    public $nurse ;
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
            ->subject('Nurse Request Approved')
            ->line('We are happy to inform you that your request for nursing service has been approved')
            ->line('Your New Employee id is : ' . $this->nurse->employee_id)
            ->line('Contact admin for further information')
            ->line('We are happy to work with you, Regards AarogyaHomeCare Services');
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
