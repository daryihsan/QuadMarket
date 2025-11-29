<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellerRejectionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $username; // ini akan tersedia di view
    public $alasan;

    public function __construct(string $username, ?string $alasan = null)
    {
        $this->username = $username;
        $this->alasan = $alasan;
    }

    public function build()
    {
        return $this->subject('Pengajuan Toko Anda Ditolak')
                    ->view('emails.seller_rejected');
    }
}
