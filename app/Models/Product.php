<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan ini jika Anda menggunakan factory

class Product extends Model
{
    // Tambahkan HasFactory jika Anda berencana menggunakannya
    use HasFactory; 

    /**
     * The attributes that are mass assignable.
     * Termasuk semua field yang diinputkan dari form.
     */
    protected $fillable = [
        'user_id', // Foreign key ke penjual
        'category_id', // Foreign key ke kategori
        'name',
        'description',
        'price',
        'stock',
        'min_order',
        'status', // Opsional, jika Anda set status default di database
        // Tambahkan path gambar jika Anda menyimpannya di database
        'image_path',
        // Tambahkan field lain jika ada (seperti kondisi, dll)
    ];

    /**
     * Definisikan relasi ke Kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    // Anda juga bisa menambahkan relasi ke User (Penjual) di sini jika perlu
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}