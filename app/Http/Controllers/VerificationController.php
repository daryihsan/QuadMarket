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
            // Jika token tidak valid atau pengguna tidak ditemukan
            return redirect('/login')->with('error', 'Link aktivasi tidak valid atau sudah kedaluwarsa.');
        }

        if ($user->email_verified_at) {
            // Jika akun sudah pernah diverifikasi
            return redirect('/login')->with('info', 'Akun Anda sudah aktif. Silakan masuk.');
        }

        // 2. Verifikasi akun
        $user->email_verified_at = Carbon::now();
        $user->activation_token = null; // Hapus token setelah digunakan
        $user->save();
        
        // 3. Opsional: Langsung loginkan user setelah verifikasi
        Auth::login($user); 

        return redirect('/home')->with('success', 'Akun Anda berhasil diaktifkan! Selamat datang di QuadMarket.');
    }
}