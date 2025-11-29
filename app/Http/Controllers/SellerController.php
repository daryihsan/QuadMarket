<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Category; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    /**
     * Menampilkan Dashboard Penjual dan mengurus semua logika navigasi.
     * Route: seller.dashboard
     */
    public function dashboard(Request $request)
    {
        // LOGIKA DEBUGGING: Menggunakan ID 1 jika tidak ada user yang login
        $userId = Auth::check() ? Auth::id() : 1; 
        
        $activeTab = $request->query('tab', 'overview');

        // --- 1. Data Dashboard Dinamis ---
        // Mengambil data dari database dengan user ID yang fleksibel
        $totalProducts = Product::where('user_id', $userId)->count();
        $averageRating = Product::where('user_id', $userId)->avg('rating');
        
        // Data simulasi (tetap diperlukan untuk data non-produk seperti penjualan, lokasi)
        $salesThisMonth = "Rp 15.7M"; 
        $newOrders = 89;
        $salesByCategory = [
            ['Kategori' => 'Elektronik', 'Penjualan' => 1201],
            ['Kategori' => 'Pakaian', 'Penjualan' => 801],
            ['Kategori' => 'Rumah', 'Penjualan' => 1501],
            ['Kategori' => 'Kecantikan', 'Penjualan' => 901],
            ['Kategori' => 'Hobi', 'Penjualan' => 110],
        ];
        $locationData = [
             'TotalOrders' => 389,
             0 => ['Lokasi' => 'Sumatra Selatan', 'Persentase' => 76],
             1 => ['Lokasi' => 'Jawa Tengah', 'Persentase' => 18],
             2 => ['Lokasi' => 'Lainnya', 'Persentase' => 6],
        ];

        $latestProducts = Product::where('user_id', $userId)
                                ->with('category')
                                ->orderByDesc('created_at')
                                ->take(4)
                                ->get();


        // --- 2. Data Kategori ---
        $allCategories = Category::all();

        // --- 3. Data Produk Saya Dinamis ---
        $productStats = $this->getProductStatistics($userId);

        $products = Product::where('user_id', $userId)->with('category')->latest()->paginate(10); 
        
        // --- 4. Logika Fetch Data untuk Mode Edit Produk ---
        $editProduct = null;
        if ($activeTab === 'addProduct' && $request->query('mode') === 'edit') {
            $productId = $request->query('id'); 
            $editProduct = Product::where('user_id', $userId)
                                        ->where('id', $productId)
                                        ->first();
            // Jika tidak ditemukan (misal ID produk salah), editProduct tetap null
        }
        
        $data = [
            'totalProducts' => $totalProducts, 
            'salesThisMonth' => $salesThisMonth, 
            'newOrders' => $newOrders, 
            'averageRating' => round($averageRating ?? 0, 1),
            'salesByCategory' => $salesByCategory, 
            'locationData' => $locationData, 
            'latestProducts' => $latestProducts,
            'productStats' => $productStats, 
            'products' => $products, 
            'allCategories' => $allCategories,
            'editProduct' => $editProduct,
        ];
        
        return view('seller.dashboard', compact('activeTab', 'data'));
    }
    
    /**
     * Helper: Menghitung statistik ringkasan produk.
     */
    private function getProductStatistics($userId)
    {
        $total = Product::where('user_id', $userId)->count();
        $aktif = Product::where('user_id', $userId)->where('status', 'Aktif')->count();
        $habis = Product::where('user_id', $userId)->where('stock', 0)->count();
        $tidakAktif = Product::where('user_id', $userId)->where('status', 'NonAktif')->count();

        return [
            'total_produk' => $total,
            'produk_aktif' => $aktif,
            'stok_habis'   => $habis,
            'tidak_aktif'  => $tidakAktif,
        ];
    }


    /**
     * Menyimpan produk baru.
     * Route: seller.products.store
     */
    public function storeProduct(Request $request)
    {
        // Tetapkan user ID secara manual untuk Debugging
        $userId = Auth::check() ? Auth::id() : 1; 

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0', 
            'category_id' => 'required|exists:categories,id',
            'min_order' => 'required|integer|min:1',
            'condition' => 'required|string|in:baru,bekas', 
            'foto_produk' => 'nullable|image|max:5120', 
        ]);

        $productData = $validated;
        $productData['user_id'] = $userId; 
        $productData['status'] = $validated['stock'] > 0 ? 'Aktif' : 'NonAktif'; 
        $productData['rating'] = 0;
        $productData['total_ulasan'] = 0;
        
        if ($request->hasFile('foto_produk')) {
            $fotoPath = $request->file('foto_produk')->store('public/product_images'); 
            $productData['image_path'] = Storage::url($fotoPath);
        } else {
             $productData['image_path'] = null;
        }

        unset($productData['foto_produk']); 

        Product::create($productData); 

        return Redirect::route('seller.dashboard', ['tab' => 'products'])->with('success', 'Produk berhasil ditambahkan dan gambar berhasil diunggah!');
    }
    
    /**
     * Memperbarui produk.
     * Route: seller.products.update
     */
    public function updateProduct(Request $request, Product $product)
    {
        $userId = Auth::check() ? Auth::id() : 1;
        if ($product->user_id !== $userId) {
            return Redirect::back()->with('error', 'Anda tidak berhak mengedit produk ini.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'min_order' => 'required|integer|min:1',
            'condition' => 'required|string|in:baru,bekas',
            'foto_produk' => 'nullable|image|max:5120',
        ]);

        $productData = $validated;
        $productData['status'] = $validated['stock'] > 0 ? 'Aktif' : 'NonAktif';
        
        if ($request->hasFile('foto_produk')) {
            if ($product->image_path) {
                $path = str_replace(config('app.url') . '/storage', 'public', $product->image_path);
                Storage::delete($path);
            }
            $fotoPath = $request->file('foto_produk')->store('public/product_images');
            $productData['image_path'] = Storage::url($fotoPath);
        }

        unset($productData['foto_produk']); 
        
        $product->update($productData);

        return Redirect::route('seller.dashboard', ['tab' => 'products'])->with('success', 'Produk berhasil diperbarui!');
    }
    
    /**
     * Menghapus produk.
     * Route: seller.products.delete
     */
    public function deleteProduct(Product $product)
    {
        $userId = Auth::check() ? Auth::id() : 1;
        if ($product->user_id !== $userId) {
            return Redirect::back()->with('error', 'Anda tidak berhak menghapus produk ini.');
        }
        
        if ($product->image_path) {
            $path = str_replace(config('app.url') . '/storage', 'public', $product->image_path);
            Storage::delete($path);
        }

        $product->delete();
        
        return Redirect::route('seller.dashboard', ['tab' => 'products'])->with('success', 'Produk berhasil dihapus.');
    }
}