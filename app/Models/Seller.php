<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seller extends Model
{
    use HasFactory;
    
    // Sesuaikan dengan nama tabel jika tidak menggunakan konvensi Laravel (misalnya 'penjual')
    protected $table = 'sellers'; 

    protected $fillable = [
        'nama_toko',
        'deskripsi_singkat',
        'nama_pic',
        'no_hp_pic',
        'email_pic',
        'alamat_pic', // Alamat jalan
        'rt',
        'rw',
        'nama_kelurahan',
        'kabupaten_kota',
        'provinsi',
        'no_ktp_pic',
        'file_ktp_path',
        'foto_pic_path',
        'status_akun', // pending, active, rejected
        'verification_date',
    ];

    protected $casts = [
        'verification_date' => 'datetime',
    ];
}
