<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserSuspendedNotification extends Notification
{
    use Queueable;

    protected $isSuspended;

    public function __construct($isSuspended)
    {
        $this->isSuspended = $isSuspended;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        if ($this->isSuspended) {
            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject('Your Account Has Been Suspended')
                ->line('Your account has been suspended by the admin.')
                ->line('Please contact support for more details.');
        } else {
            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject('Your Account Has Been Reactivated')
                ->line('Good news! Your account has been unsuspended and is now active again.');
        }
    }
}
