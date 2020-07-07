<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AttendanceMark extends Notification
{
    use Queueable;

    public $attendance;
    public $nurse;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($attendance, $nurse)
    {
        $this->attendance = $attendance;
        $this->nurse = $nurse;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mark = $this->attendance->present;
        if ($mark == 1)
        {
            $mark = 'Present';
        }elseif ($mark == 2){
            $mark = 'Absent';
        }else{
            $mark = 'Pending';
        }
        return (new MailMessage)
            ->greeting('Hello Admin')
            ->subject('Nurse Attendance')
            ->line('Attendance for Employee ID : ' . $this->nurse->employee_id)
            ->line('Name : ' . $this->nurse->user->name)
            ->line('Attendance Mark as : ' . $mark );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
