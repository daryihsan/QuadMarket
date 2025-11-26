<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'category', 'location',
        'store_name', 'rating', 'reviews_count', 'image'
    ];
}
