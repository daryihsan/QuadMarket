<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail; 

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
        
        // SINKRONISASI KOLOM UPLOAD/PATH SESUAI MIGRASI
        'foto_pic', 
        'file_ktp',
        
        'password',
        
        // SINKRONISASI KOLOM STATUS & VERIFIKASI
        'activation_token', 
        'email_verified_at',
        'status_akun', // DITAMBAHKAN
        'verification_date', // DITAMBAHKAN
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', 
            'password' => 'hashed',
        ];
    }
}