<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WaitlistPromotion extends Notification implements ShouldQueue
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
            ->subject('You’re Off the Waitlist!')
            ->greeting('Good news ' . $notifiable->name . '!')
            ->line('A spot has opened up for the event: ' . $this->event->title)
            ->line('You are now confirmed to attend!')
            ->action('View Event', url('/events/' . $this->event->id))
            ->line('See you there!');
    }
}
