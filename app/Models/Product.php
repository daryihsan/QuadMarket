<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',        // FOREIGN KEY KE PENJUAL
        'category_id',      
        'nama_produk',
        'deskripsi_singkat',
        'harga',
        'stok',
        'rating',
        'total_ulasan',
        'image_path',
        'status',
        'condition',
        'min_order',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi BENAR ke seller
    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}