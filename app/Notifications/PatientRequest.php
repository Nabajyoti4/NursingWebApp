<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PatientRequest extends Notification
{
    use Queueable;

    public $patient;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($patient)
    {
        //
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
            ->greeting('Hello Admin')
            ->subject('New Patient request')
            ->line('New request Nurse Hire')
            ->line('Request from '. $this->patient->user->name)
            ->action('Notification Action', url(route('admin.patient.show', $this->patient->id)))
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
