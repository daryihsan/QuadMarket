<?php

namespace App\Services;

use App\Models\User;
use App\Models\OTPVerification;
use Illuminate\Support\Facades\Mail;

class OTPService
{
    public function generateAndSend(User $user)
    {
        $otp = rand(100000, 999999);
        OTPVerification::create([
            'user_id' => $user->id,
            'otp_code' => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        // kirim email (sementara tampilkan di log)
        Mail::raw("Kode OTP Anda: $otp", function($message) use ($user) {
            $message->to($user->university_email)->subject('Kode OTP QuadMarket');
        });
    }
}
