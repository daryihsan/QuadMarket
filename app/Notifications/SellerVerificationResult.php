<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

// Tambahkan implements ShouldQueue agar email dikirim di background (optional, tapi disarankan)
class SellerVerificationResult extends Notification implements ShouldQueue 
{
    use Queueable;

    // 1. DITAMBAHKAN: Properti untuk menyimpan status verifikasi
    protected $status; 

    /**
     * Create a new notification instance.
     * * @param string $status ('accepted' atau 'rejected')
     */
    public function __construct(string $status)
    {
        // 2. DIKOREKSI: Terima status dari PlatformController
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // 3. LOGIKA KUNCI: Membuat email berdasarkan status
        if ($this->status === 'accepted') {
            return (new MailMessage)
                        ->subject('🎉 Akun Penjual Anda Telah Diterima!')
                        ->greeting('Selamat, ' . $notifiable->nama_pic . '!')
                        ->line('Akun penjual **' . $notifiable->nama_toko . '** telah diverifikasi dan **diterima** oleh tim admin QuadMarket.')
                        ->line('Anda sekarang dapat login dan mulai menjual produk Anda.')
                        ->action('Masuk ke Dashboard', url('/login'))
                        ->line('Terima kasih!');

        } else {
            // Status: Rejected
            return (new MailMessage)
                        ->subject('❌ Pembaruan Status Akun Penjual Anda')
                        ->greeting('Mohon Maaf, ' . $notifiable->nama_pic . '!')
                        ->line('Akun penjual **' . $notifiable->nama_toko . '** telah **ditolak** oleh tim admin QuadMarket.')
                        ->line('Alasan penolakan mungkin karena data yang tidak valid. Mohon periksa kembali detail pendaftaran Anda.')
                        ->line('Silakan hubungi tim dukungan kami jika Anda merasa ini adalah kesalahan.');
        }
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}