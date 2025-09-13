<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationCancelled extends Notification implements ShouldQueue
{
    use Queueable;

    protected $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Event Registration Cancelled')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your registration for the event "' . $this->event->title . '" has been cancelled.')
            ->line('If this was a mistake, you can re-register if slots are available.');
    }
}
