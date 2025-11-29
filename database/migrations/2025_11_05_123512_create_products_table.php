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

            // Relasi
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            // Data produk
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->integer('stock');
            $table->integer('min_order')->default(1);
            $table->string('condition')->nullable(); // baru / bekas
            $table->string('image_path')->nullable();

            // Rating & ulasan
            $table->decimal('rating', 2, 1)->default(0.0);
            $table->integer('total_ulasan')->default(0);

            // Data tambahan
            $table->boolean('is_dangerous')->default(false);
            $table->boolean('is_preorder')->default(false);
            $table->decimal('shipping_cost', 12, 2)->default(0);
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
