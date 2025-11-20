<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
