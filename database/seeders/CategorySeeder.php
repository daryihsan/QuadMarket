<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category; // Pastikan model Category diimport

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'Elektronik', 'slug' => 'elektronik'],
            ['id' => 2, 'name' => 'Pakaian', 'slug' => 'pakaian'],
            ['id' => 3, 'name' => 'Rumah Tangga', 'slug' => 'rumah-tangga'],
            ['id' => 4, 'name' => 'Buku', 'slug' => 'buku'],
        ];

        // Pastikan Anda menggunakan Model Category yang benar atau DB facade.
        // Jika model Category memiliki timestamps dan slug, pastikan diabaikan atau disetel.
        
        DB::table('categories')->insertOrIgnore($categories);
        
        // Catatan: Jika Anda menggunakan auto-incrementing IDs, hapus kolom 'id'
        // dan gunakan insert normal:
        // DB::table('categories')->insertOrIgnore([
        //     ['name' => 'Elektronik', 'slug' => 'elektronik'],
        //     // ... dst
        // ]);
    }
}