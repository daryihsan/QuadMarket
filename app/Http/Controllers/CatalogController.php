<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Digunakan di metode index dan home
use App\Models\Category; // Digunakan di metode home

class CatalogController extends Controller
{
    // MENAMBAH FUNGSI HOME UNTUK BERANDA
    public function home()
    {
        // Mengambil 5 produk dengan total ulasan terbanyak (sedang tren) dan relasi user (untuk lokasi toko)
        $trendingProducts = Product::with('user')->orderByDesc('total_ulasan')->take(5)->get();
        // Mengambil semua kategori untuk menu navigasi
        $categories = Category::all();

        return view('home', compact('trendingProducts', 'categories'));
    }

    public function index(Request $request)
    {
        $category = $request->get('kategori');
        $location = $request->get('lokasi');
        $minPrice = $request->get('harga_min', 0);
        $maxPrice = $request->get('harga_max', 50000000);
        $rating = $request->get('rating');
        
        // Mencegah error jika user belum di-load (untuk mengambil nama toko/kabupaten)
        $query = Product::query()->with('user'); 

        if ($category) {
            $query->where('category', $category);
        }
        if ($location) {
            $query->where('location', $location);
        }
        $query->whereBetween('price', [$minPrice, $maxPrice]);
        if ($rating) {
            $query->where('rating', '>=', $rating);
        }
        
        $products = $query->paginate(12);
        
        // Memastikan query dasar sama persis sebelum pagination agar count akurat
        $totalProducts = Product::query();
        if ($category) { $totalProducts->where('category', $category); }
        if ($location) { $totalProducts->where('location', $location); }
        $totalProducts->whereBetween('price', [$minPrice, $maxPrice]);
        if ($rating) { $totalProducts->where('rating', '>=', $rating); }
        $totalProducts = $totalProducts->count();
        

        return view('katalog', [
            'products' => $products,
            'totalProducts' => $totalProducts,
            'currentCategory' => $category ?: 'Semua Produk',
            'filters' => $request->all(),
        ]);
    }
}