<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter dari query string
        $status = $request->get('status', 'all');

        // Query data seller
        $query = Seller::query();

        if ($status !== 'all') {
            $query->where('status_akun', $status);
        }

        $sellers = $query->paginate(10);

        return view('platform.laporan', compact('sellers', 'status'));
    }

    public function provinsi(Request $request)
{
    // ambil daftar provinsi unik dari database
    $provinsiList = Seller::select('propinsi')->distinct()->pluck('propinsi');

    // ambil provinsi yang difilter (jika ada)
    $provinsi = $request->get('provinsi', 'all');

    // query seller
    $query = Seller::query();

    if ($provinsi !== 'all') {
        $query->where('propinsi', $provinsi);
    }

    $sellers = $query->paginate(10);

    return view('platform.provinsi', compact('sellers', 'provinsiList', 'provinsi'));
}

public function produk(Request $request)
{
    $kategori = $request->get('kategori', 'all');
    $rating = $request->get('rating', 'all');
    $harga = $request->get('harga', 'all');

    $query = \App\Models\Product::with('seller');

    // filter kategori
    if ($kategori !== 'all') {
        $query->where('kategori', $kategori);
    }

    // filter rating
    if ($rating !== 'all') {
        $query->where('rating', '>=', $rating);
    }

    // filter harga
    if ($harga == '<50000') {
        $query->where('harga', '<', 50000);
    } elseif ($harga == '50-100') {
        $query->whereBetween('harga', [50000, 100000]);
    } elseif ($harga == '100-500') {
        $query->whereBetween('harga', [100000, 500000]);
    } elseif ($harga == '>500') {
        $query->where('harga', '>', 500000);
    }

    $products = $query->paginate(10);

    return view('platform.produk', compact('products', 'kategori', 'rating', 'harga'));
}


}