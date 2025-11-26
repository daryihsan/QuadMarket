// database/migrations/xxxx_xx_xx_create_sellers_table.php (Nama file akan mengikuti timestamp)
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
            
            // Elemen Data Registrasi Penjual (toko) [cite: 30, 32-45]
            $table->string('nama_toko'); // 1. Nama toko [cite: 32]
            $table->text('deskripsi_singkat'); // 2. Deskripsi singkat [cite: 33]
            $table->string('nama_pic'); // 3. Nama PIC [cite: 34]
            $table->string('no_hp_pic'); // 4. No Handphone PIC [cite: 35]
            $table->string('email_pic')->unique(); // 5. email PIC [cite: 36]
            $table->string('alamat_pic'); // 6. Alamat (nama jalan) PIC [cite: 37]
            $table->string('rt', 5); // 7. RT [cite: 38]
            $table->string('rw', 5); // 8. RW [cite: 39]
            $table->string('nama_kelurahan'); // 9. Nama kelurahan [cite: 40]
            $table->string('kabupaten_kota'); // 10. Kabupaten/Kota [cite: 41]
            $table->string('propinsi'); // 11. Propinsi [cite: 42]
            $table->string('no_ktp_pic', 20)->unique(); // 12. No. KTP PIC [cite: 43]
            $table->string('foto_pic_path'); // 13. Foto PIC (path) [cite: 44]
            $table->string('file_ktp_path'); // 14. File upload KTP PIC (path) [cite: 45]

            // Status Akun untuk Verifikasi [cite: 13]
            $table->enum('status_akun', ['pending', 'active', 'rejected'])->default('pending');
            $table->dateTime('verification_date')->nullable(); // Mencatat tanggal dan waktunya verifikasi [cite: 15]

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