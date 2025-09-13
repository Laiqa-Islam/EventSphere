<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PasswordResetByAdminNotification extends Notification
{
    use Queueable;

    protected $newPassword;

    public function __construct($newPassword)
    {
        $this->newPassword = $newPassword;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Your Password Has Been Reset by Admin')
            ->line('Your password has been reset by the system administrator.')
            ->line("Your new password is: **{$this->newPassword}**")
            ->line('Please login and change this password as soon as possible.');
    }
}
