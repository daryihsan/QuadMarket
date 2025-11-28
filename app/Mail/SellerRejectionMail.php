<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellerRejectionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nama_toko;

    public function __construct($nama_toko)
    {
        $this->nama_toko = $nama_toko;
    }

    public function build()
    {
        return $this->subject('Pengajuan Toko Anda Ditolak')
                    ->view('emails.seller_rejected');
    }
}
