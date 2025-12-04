<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;  
use App\Models\Category; 

class CatalogController extends Controller
{
    public function home()
    {
        $trendingProducts = Product::with('user')->orderByDesc('total_ulasan')->take(5)->get();
        $categories = Category::all();

        return view('home', compact('trendingProducts', 'categories'));
    }

    public function index(Request $request)
    {
        $category  = $request->get('kategori');
        $location  = $request->get('lokasi');
        $minPrice  = $request->get('harga_min', 0);
        $maxPrice  = $request->get('harga_max', 50000000);
        $rating    = $request->get('rating');
        
        // query produk + relasi user & category
        $query = Product::query()->with(['user', 'category']); 

        // ==== FILTER KATEGORI (pakai relasi category.name) ====
        if ($category) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        }

        // filter lokasi (kalau memang ada kolom location di tabel products)
        if ($location) {
            $query->where('location', $location);
        }

        // filter harga
        $query->whereBetween('price', [$minPrice, $maxPrice]);

        // filter rating
        if ($rating) {
            $query->where('rating', '>=', $rating);
        }
        
        $products = $query->paginate(12);
        
        $totalProductsQuery = Product::query();

        if ($category) {
            $totalProductsQuery->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        }

        if ($location) {
            $totalProductsQuery->where('location', $location);
        }

        $totalProductsQuery->whereBetween('price', [$minPrice, $maxPrice]);

        if ($rating) {
            $totalProductsQuery->where('rating', '>=', $rating);
        }

        $totalProducts = $totalProductsQuery->count();
        
        return view('katalog', [
            'products'        => $products,
            'totalProducts'   => $totalProducts,
            'currentCategory' => $category ?: 'Semua Produk',
            'filters'         => $request->all(),
        ]);
    }
}