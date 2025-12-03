<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Seller extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'sellers';

    protected $fillable = [
        'nama_toko',
        'deskripsi_singkat',
        'nama_pic',
        'no_hp_pic',
        'email_pic',
        'alamat_pic',
        'rt',
        'rw',
        'nama_kelurahan',
        'kabupaten_kota',
        'propinsi',
        'no_ktp_pic',
        'file_ktp_path',
        'foto_pic_path',
        'password',
        'activation_token',
        'email_verified_at',
        'status_akun',
        'verification_date',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'verification_date' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }
}
