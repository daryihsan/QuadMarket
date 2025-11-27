<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Category; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
// Catatan: Asumsi ID user yang sedang login adalah 1 untuk simulasi.
define('DUMMY_SELLER_ID', 1);

class SellerController extends Controller
{
    /**
     * Menampilkan Dashboard Penjual dan mengurus semua logika navigasi.
     */
    public function dashboard(Request $request)
    {
        // --- 1. Data Statistik & Dashboard ---
        $totalProducts = 1204;
        $salesThisMonth = "Rp 15.7M";
        $newOrders = 89;
        $averageRating = 4.8;
        $salesByCategory = [
            ['Kategori' => 'Elektronik', 'Penjualan' => 1201],
            ['Kategori' => 'Pakaian', 'Penjualan' => 801],
            ['Kategori' => 'Rumah', 'Penjualan' => 1501],
            ['Kategori' => 'Kecantikan', 'Penjualan' => 901],
            ['Kategori' => 'Hobi', 'Penjualan' => 110],
        ];
        $locationData = [
            ['Lokasi' => 'Sumatra Selatan', 'Persentase' => 76],
            ['Lokasi' => 'Jawa Tengah', 'Persentase' => 18],
            ['Lokasi' => 'Lainnya', 'Persentase' => 6],
            'TotalOrders' => 389,
        ];
        $latestProducts = new Collection([
            (object) ['id' => 1, 'name' => 'Smartphone Canggih X1', 'price' => 4999000, 'stock' => 120, 'status' => 'Aktif', 'image_path' => ''],
            (object) ['id' => 2, 'name' => 'Smartphone Canggih X1', 'price' => 49999000, 'stock' => 120, 'status' => 'NonAktif', 'image_path' => ''],
            (object) ['id' => 3, 'name' => 'Smartphone Canggih X1', 'price' => 4999000, 'stock' => 120, 'status' => 'Aktif', 'image_path' => ''],
            (object) ['id' => 4, 'name' => 'Smartphone Canggih X1', 'price' => 4999000, 'stock' => 120, 'status' => 'Aktif', 'image_path' => ''],
        ]);

        // --- 2. Data Kategori (Diambil sekali & diisi dummy jika kosong) ---
        $allCategories = Category::all();
        if ($allCategories->isEmpty()) {
            $allCategories = new Collection([
                (object)['id' => 1, 'name' => 'Elektronik'],
                (object)['id' => 2, 'name' => 'Pakaian'],
                (object)['id' => 3, 'name' => 'Rumah Tangga'],
                (object)['id' => 4, 'name' => 'Buku'],
            ]);
        }

        // --- 3. Data Produk Saya ---
        $productStats = [
            'total_produk' => 1204,
            'produk_aktif' => 1029,
            'stok_habis' => 167,
            'tidak_aktif' => 8,
        ];
        // Menggunakan paginate() untuk mensimulasikan tabel produk yang sebenarnya
        $products = Product::where('user_id', DUMMY_SELLER_ID)->latest()->paginate(10); 
        
        // --- 4. Render View ---
        return view('seller.dashboard', compact(
            'totalProducts', 'salesThisMonth', 'newOrders', 'averageRating',
            'salesByCategory', 'locationData', 'latestProducts',
            'productStats', 'products', 'allCategories' 
        ));
    }

    /**
     * Menyimpan produk baru.
     */
    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:1',
        'category_id' => 'required|exists:categories,id',
        'min_order' => 'required|integer|min:1',
        'kondisi' => 'required|string|in:baru,bekas',
        
        // Validasi untuk file upload (menggunakan name input file yang sebenarnya)
        'foto_produk_files' => 'nullable|array|max:5',
        'foto_produk_files.*' => 'image|max:5120', // Maks 5MB per file
        
        // Hapus image_path dari validasi form karena kita akan membuatnya dari file upload
        // 'image_path' => 'nullable|string|max:2048', 
    ]);

    $data = $validated;
    $data['user_id'] = DUMMY_SELLER_ID; 
    
    // Hapus field non-database
    unset($data['kondisi']); 
    
    // --- LOGIKA UPLOAD DAN PATH GAMBAR BARU ---
    $mainImagePath = null;
    
    // Cek apakah ada file yang diupload
    if ($request->hasFile('foto_produk_files')) {
        $files = $request->file('foto_produk_files');
        
        // Ambil file pertama sebagai foto utama
        $mainFile = $files[0];

        // Simpan file. Laravel akan mengurus nama file unik. 
        // Ini menyimpan di 'storage/app/public/products'
        $path = $mainFile->store('products', 'public'); 
        /** @var \Illuminate\Filesystem\FilesystemManager $storage */

        $storage = Storage::disk('public');
        $mainImagePath = $storage->url($path);
    }
    
    // Masukkan path URL ke dalam data produk
    $data['image_path'] = $mainImagePath;

    Product::create($data); 

    return Redirect::route('seller.dashboard', ['tab' => 'products'])->with('success', 'Produk berhasil ditambahkan!');
}
    
    /**
     * Memperbarui produk.
     */
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'min_order' => 'required|integer|min:1',
            'kondisi' => 'required|string|in:baru,bekas',
            'image_path' => 'nullable|string|max:2048',
        ]);

        $data = $validated;
        unset($data['kondisi']); 
        
        $product->update($data);

        return Redirect::route('seller.dashboard', ['tab' => 'products'])->with('success', 'Produk berhasil diperbarui!');
    }
    
    /**
     * Menghapus produk.
     */
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return Redirect::route('seller.dashboard', ['tab' => 'products'])->with('success', 'Produk berhasil dihapus.');
    }
}