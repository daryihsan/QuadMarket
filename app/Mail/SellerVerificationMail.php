<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellerVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $activationUrl;

    public function __construct($username, $activationUrl)
    {
        $this->username = $username;
        $this->activationUrl = $activationUrl;
    }

    public function build()
    {
        return $this->subject('Akun Anda Berhasil Diverifikasi')
                    ->view('emails.seller_verified');
    }
}
