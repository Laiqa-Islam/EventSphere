<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserRoleChangedNotification extends Notification
{
    use Queueable;

    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Your Role Has Been Updated')
            ->line("Your account role has been changed to **{$this->role}**.")
            ->line('Please login to your account to see the new privileges.');
    }
}
