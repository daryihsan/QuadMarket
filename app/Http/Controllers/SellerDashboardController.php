<?php

namespace App\Http\Controllers;

// app/Http/Controllers/SellerDashboardController.php

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Collection; // Import Collection untuk latestProducts

class SellerDashboardController extends Controller
{
    public function index()
    {
        // =========================================================================
        // DATA PLACEHOLDER LENGKAP UNTUK MENGHINDARI ERROR UNDEFINED VARIABLE
        // =========================================================================
        
        // Data Statistik
        $totalProducts = 1204;       // Pastikan ini bilangan bulat
        $salesThisMonth = "Rp 15.7M";
        $newOrders = 89;
        $averageRating = 4.8;
        
        // Data Grafik & Lokasi
        $salesByCategory = [
            ['Kategori' => 'Elektronik', 'Penjualan' => 120],
            ['Kategori' => 'Pakaian', 'Penjualan' => 80],
            ['Kategori' => 'Rumah', 'Penjualan' => 150],
            ['Kategori' => 'Kecantikan', 'Penjualan' => 90],
            ['Kategori' => 'Hobi', 'Penjualan' => 110],
        ];

        $locationData = [
            ['Lokasi' => 'Sumatra Selatan', 'Persentase' => 76],
            ['Lokasi' => 'Jawa Tengah', 'Persentase' => 18],
            ['Lokasi' => 'Lainnya', 'Persentase' => 6],
            'TotalOrders' => 389,
        ];
        
        // Data Produk Terbaru (Menggunakan Collection/Array of Objects untuk menghindari error di loop view)
        // Jika Anda belum punya Model Product, ganti dengan array biasa.
        // Jika Model Product sudah ada, lebih baik pakai Collection:
        
        $latestProducts = new Collection([
            // Membuat objek dummy yang meniru Model Product
            (object)['id' => 1, 'name' => 'Smartphone Canggih X1', 'price' => 4999000, 'stock' => 120, 'status' => 'Aktif', 'description' => 'Dummy Desc', 'image_path' => ''],
            (object)['id' => 2, 'name' => 'Smartphone Canggih X1', 'price' => 4999000, 'stock' => 120, 'status' => 'NonAktif', 'description' => 'Dummy Desc', 'image_path' => ''],
            (object)['id' => 3, 'name' => 'Smartphone Canggih X1', 'price' => 4999000, 'stock' => 120, 'status' => 'Aktif', 'description' => 'Dummy Desc', 'image_path' => ''],
            (object)['id' => 4, 'name' => 'Smartphone Canggih X1', 'price' => 4999000, 'stock' => 120, 'status' => 'Aktif', 'description' => 'Dummy Desc', 'image_path' => ''],
        ]);


        // =========================================================================
        // PENGIRIMAN DATA KE VIEW
        // =========================================================================
        
        return view('seller.dashboard', [
            'totalProducts' => $totalProducts,
            'salesThisMonth' => $salesThisMonth,
            'newOrders' => $newOrders,
            'averageRating' => $averageRating,
            'salesByCategory' => $salesByCategory,
            'locationData' => $locationData,
            'latestProducts' => $latestProducts,
        ]);
    }
    
    // ... method lain ...
}