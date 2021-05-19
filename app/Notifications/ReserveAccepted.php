<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReserveAccepted extends Notification
{
    use Queueable;

    public $doctor_id ;
    public $doctor_name ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($doctor_id, $doctor_name)
    {
        $this->doctor_id = $doctor_id;
        $this->doctor_name = $doctor_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
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
                    ->line('Your Reservation Accepted from '.$this->doctor_name)
                    ->action('OK ',  url('/read-notification/'.$this->id))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase()
    {
        return [
            'doctor_id' => $this->doctor_id,
            'doctor_name' => $this->doctor_name,
        ];
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
