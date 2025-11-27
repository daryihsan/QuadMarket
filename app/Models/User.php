<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// DITAMBAHKAN: Import kontrak untuk verifikasi email
use Illuminate\Contracts\Auth\MustVerifyEmail; 

// DITAMBAHKAN: Implementasi kontrak MustVerifyEmail
class User extends Authenticatable implements MustVerifyEmail 
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama_toko',
        'deskripsi',
        'nama_pic',
        'no_hp',
        'email',
        'alamat_pic',
        'rt',
        'rw',
        'kelurahan',
        'kabupaten',
        'provinsi',
        'nik',
        'foto_pic',
        'file_ktp',
        'password',
        
        // DITAMBAHKAN: Field yang diperlukan untuk pendaftaran dan verifikasi
        'foto_pic_path', // Untuk path file yang diunggah
        'file_ktp_path', // Untuk path file KTP yang diunggah
        // 'role',          // Karena digunakan di RegisterController untuk mass assignment
        'activation_token', // Untuk token verifikasi yang dikirim via email
        'email_verified_at', // Timestamp standar Laravel setelah verifikasi berhasil
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            // DITAMBAHKAN: Agar kolom email_verified_at diperlakukan sebagai datetime
            'email_verified_at' => 'datetime', 
            'password' => 'hashed',
        ];
    }
}