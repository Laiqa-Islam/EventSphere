<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class EventStatusNotification extends Notification
{
    use Queueable;

    public $event;
    public $status;
    public $message;

    public function __construct($event, $status, $message = null)
    {
        $this->event = $event;
        $this->status = $status;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database']; // stored in DB
    }

    public function toDatabase($notifiable)
    {
        return [
            'event_id' => $this->event->id,
            'title' => $this->event->title,
            'status' => $this->status,
            'message' => $this->message,
        ];
    }
}
