<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationConfirmed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $event;

    public function __construct($event)
    {
        // Force it into a model with casts
        $this->event = $event instanceof \App\Models\Event
            ? $event
            : \App\Models\Event::find($event['id'] ?? $event);

    }


    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $date = $this->event->date instanceof \Carbon\Carbon
            ? $this->event->date
            : \Carbon\Carbon::parse($this->event->date);
        return (new MailMessage)
            ->subject('Event Registration Confirmed')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('You have successfully registered for the event: ' . $this->event->title)
            ->line('Event Date: ' . $date->format('d M Y') . ' at ' . $this->event->time)
            ->action('View Event', url('user/events/' . $this->event->id))
            ->line('We look forward to seeing you!');
    }
}
