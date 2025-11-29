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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            
            // Elemen Data Registrasi Penjual (toko)
            $table->string('nama_toko');
            $table->text('deskripsi_singkat')->nullable(); 
            $table->string('nama_pic');
            $table->string('no_hp_pic');
            $table->string('email_pic')->unique(); 
            
            // DITAMBAHKAN: Kolom Kunci Otentikasi
            $table->string('password'); // WAJIB untuk login
            $table->rememberToken()->nullable(); // WAJIB untuk otentikasi
            
            // Detail Alamat
            $table->string('alamat_pic');
            $table->string('rt', 5);
            $table->string('rw', 5);
            $table->string('nama_kelurahan');
            $table->string('kabupaten_kota');
            $table->string('propinsi');
            $table->string('no_ktp_pic', 20)->unique();
            $table->string('foto_pic_path');
            $table->string('file_ktp_path');
            
            // Kolom Verifikasi
            $table->string('activation_token')->nullable(); 
            $table->timestamp('email_verified_at')->nullable();
            
            // Status Akun
            $table->enum('status_akun', ['pending', 'active', 'rejected'])->default('pending');
            $table->dateTime('verification_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};