<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('price');
            $table->string('category');
            $table->string('location');
            $table->string('store_name');
            $table->decimal('rating', 2, 1); // Contoh: 4.9
            $table->integer('reviews_count'); // Jumlah ulasan
            $table->string('image')->nullable(); // URL gambar produk
            $table->decimal('price',12,2);
            $table->integer('stock');
            $table->integer('min_order')->default(1);
            $table->string('condition')->nullable(); // Ditambahkan: Kondisi barang ('baru'/'bekas')
            $table->string('image_path')->nullable(); // Ditambahkan: URL/Path Foto Produk
            $table->float('rating', 2, 1)->default(0.0); // Ditambahkan: Rating rata-rata (misal: 4.5)
            $table->integer('total_ulasan')->default(0); // Ditambahkan: Jumlah total ulasan
            $table->boolean('is_dangerous')->default(false);
            $table->boolean('is_preorder')->default(false);
            $table->decimal('shipping_cost',12,2)->default(0);
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};