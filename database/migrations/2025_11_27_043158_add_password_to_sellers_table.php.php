<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sellers', function (Blueprint $table) {
            // Kolom password (Wajib untuk login)
            $table->string('password')->after('email_pic'); 
            
            // Kolom yang terkait dengan otentikasi (sebaiknya ditambahkan juga)
            $table->rememberToken()->nullable();
            $table->timestamp('email_verified_at')->nullable()->after('activation_token'); // Jika belum ada
        });
    }

    public function down(): void
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn(['password', 'remember_token', 'email_verified_at']);
        });
    }
};