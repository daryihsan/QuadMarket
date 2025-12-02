<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThankYouMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $productName;

    public function __construct(string $name, string $productName)
    {
        $this->name = $name;
        $this->productName = $productName;
    }

    public function build()
    {
        return $this->subject('🎉 Terima Kasih atas Ulasan Anda di QuadMarket!')
                    ->view('emails.thank_you_review');
    }
}