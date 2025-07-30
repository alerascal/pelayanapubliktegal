<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends Notification
{
    public $token;
    public $user;

    public function __construct($token, $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]));

        return (new MailMessage)
            ->subject('Reset Password Anda')
            ->view('emails.reset-password', [
                'user' => $this->user,
                'url' => $url,
                'actionText' => 'Reset Password',
                'introLines' => [
                    'Kami menerima permintaan untuk mereset password Anda.'
                ],
                'outroLines' => [
                    'Link ini akan kadaluarsa dalam 60 menit.',
                    'Jika Anda tidak meminta reset, abaikan email ini.'
                ],
            ]);
    }
}
