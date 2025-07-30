<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail; // Extends default Laravel notification
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends BaseVerifyEmail
{
    /**
     * Kirim email verifikasi dengan template kustom
     *
     * @param  mixed  $notifiable (biasanya User)
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Membuat URL verifikasi unik dengan token user
        $verificationUrl = $this->verificationUrl($notifiable);

        // Mengembalikan MailMessage dengan subject dan view kustom
        return (new MailMessage)
            ->subject('Verifikasi Email Anda') // Judul email
            ->markdown('emails.verify', [    // Blade template kustom untuk email
                'url' => $verificationUrl,   // Kirim URL verifikasi ke view
                'user' => $notifiable,        // Kirim data user (untuk nama dll)
            ]);
    }
}
