<?php

namespace App\Notifications;

use App\Models\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class EventAnnouncement extends Notification implements ShouldQueue
{
    use Queueable;

    protected $announcement;

    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    public function via($notifiable)
    {
        return ['database']; // or ['mail', 'database'] if you want emails too
    }

    public function toDatabase($notifiable)
    {
        return [
            'title'   => $this->announcement->title,
            'message' => $this->announcement->message,
            'event_id'=> $this->announcement->event_id,
            'sent_at' => $this->announcement->sent_at,
        ];
    }
}
