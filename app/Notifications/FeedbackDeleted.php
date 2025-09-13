<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Event;

class FeedbackDeleted extends Notification implements ShouldQueue
{
    use Queueable;

    protected $event;

    public function __construct(Event $event)
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
            ->subject('Your Feedback Has Been Removed')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your feedback on the event "' . $this->event->title . '" has been removed by an administrator.')
            ->line('If you have any questions or concerns, please contact support.');
    }
}
