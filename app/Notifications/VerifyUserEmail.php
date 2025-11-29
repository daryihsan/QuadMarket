<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyUserEmail extends Notification implements ShouldQueue
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        // Buat URL aktivasi
        $verificationUrl = url(route('verification.verify', [
            'token' => $notifiable->activation_token,
            'email' => $notifiable->email,
        ]));

        return (new MailMessage)
                    ->subject('Aktivasi Akun QuadMarket Anda')
                    ->greeting('Halo, ' . $notifiable->name . '!')
                    ->line('Akun Anda telah berhasil terdaftar. Silakan klik tombol di bawah untuk mengaktifkan akun Anda.')
                    ->action('Aktivasi Akun', $verificationUrl)
                    ->line('Jika Anda tidak merasa mendaftar di QuadMarket, abaikan email ini.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}