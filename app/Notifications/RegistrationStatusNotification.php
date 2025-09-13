<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class RegistrationStatusNotification extends Notification
{
    use Queueable;

    public $event;
    public $status;

    public function __construct($event, $status)
    {
        $this->event = $event;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database']; // store in DB, no mail
    }

    public function toDatabase($notifiable)
    {
        return [
            'event_id'   => $this->event->id,
            'title'=> $this->event->title,
            'status'     => $this->status,
            'message'    => "Your registration for '{$this->event->title}' has been {$this->status}.",
        ];
    }
}
