<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /**
     * Menangani klik link aktivasi email.
     */
    public function verify($token, $email)
    {
        // 1. Cari pengguna berdasarkan email dan token
        $user = User::where('email', $email)
                        ->where('activation_token', $token)
                        ->first();

        if (!$user) {
            return redirect()->route('auth.login.pilih')
                ->with('error', 'Link aktivasi tidak valid atau sudah kedaluwarsa.');
        }

        if ($user->email_verified_at) {
            return redirect()->route('auth.login.pilih')
                ->with('info', 'Akun Anda sudah aktif. Silakan masuk.');
        }

        // 2. Verifikasi akun
        $user->email_verified_at = Carbon::now();
        $user->activation_token = null; 
        $user->save();
        
        // 3. (Opsional) Login otomatis
        Auth::login($user); 

        return redirect()->route('auth.login.login')
            ->with('success', 'Akun Anda berhasil diaktifkan! Selamat datang di QuadMarket.');
    }
}
