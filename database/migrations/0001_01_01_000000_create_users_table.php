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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko');
            $table->text('deskripsi')->nullable();
            $table->string('nama_pic');
            $table->string('no_hp');
            $table->string('email_pic')->unique();

            $table->text('alamat_pic');
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->string('kelurahan');
            $table->string('kabupaten');
            $table->string('provinsi');

            $table->string('ktp')->unique();
            $table->string('foto_pic')->nullable();
            $table->string('file_ktp')->nullable();

            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};