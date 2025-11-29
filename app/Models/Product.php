<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',        // Foreign key ke penjual
        'category_id',    // Foreign key ke kategori
        'name',
        'description',
        'price',
        'stock',
        'condition',
        'min_order',
        'status',         // Opsional
        'image_path',     // Path gambar
        'rating',
        'total_ulasan'
        // Tambahkan field lain jika ada
    ];

    /**
     * Relasi ke kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke user (penjual)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
