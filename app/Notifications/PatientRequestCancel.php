<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PatientRequestCancel extends Notification
{
    use Queueable;

    public $reason, $patient;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request, $patient)
    {
        //
        $this->reason = $request;
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
            ->greeting('Hello' . $this->patient->user->name)
            ->subject('Rejection of  Request For Nurse Care ')
            ->line('Rejection of  Request For Nurse Care ')
            ->line('we are sorry to inform you that we have to cancel your
              request for nurse care due to the following reasons')
            ->line('Rejection due to : '. $this->reason->reason)
            ->line('Patient name : '.$this->patient->name)
            ->action('Notification Action', url(route('users.index')))
            ->line('You can contact the SEWA services for More info');
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
