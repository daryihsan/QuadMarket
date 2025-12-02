<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman Laporan (SRS-12, 13, 14).
     * Route: seller.reports.index
     */
    public function index(Request $request)
    {
        // Pakai user login, kalau belum login fallback ke ID 1 (debug / dummy)
        $userId = Auth::check() ? Auth::id() : 1;

        $activeReportTab = $request->query('report_tab', 'rating');

        $categories = Category::all();

        // Query dasar: semua produk milik user ini
        $query = Product::where('user_id', $userId)->with('category');

        // ===================== RATING TAB =====================
        if ($activeReportTab === 'rating') {

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->query('category_id'));
            }

            if ($request->filled('rating_min')) {
                $query->where('rating', '>=', $request->query('rating_min'));
            }

            if ($request->filled('rating_max')) {
                $query->where('rating', '<=', $request->query('rating_max'));
            }

            // SRS-13: urut rating menurun
            $query->whereNotNull('rating')
                  ->orderByDesc('rating');

        // ===================== STOCK TAB ======================
        } elseif ($activeReportTab === 'stock') {

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->query('category_id'));
            }

            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->query('search') . '%');
            }

            // INI FILTER YANG KEMAREN KESKIP:
            // Urutan stok (Default / Terbanyak / Tersedikit)
            $sort = $request->query('sort', 'stock_desc');
            if ($sort === 'stock_asc') {
                $query->orderBy('stock', 'asc');   // stok tersedikit
            } else {
                $query->orderByDesc('stock');      // stok terbanyak (default)
            }

        // ================= LOW STOCK TAB =====================
        } elseif ($activeReportTab === 'low_stock') {

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->query('category_id'));
            }

            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->query('search') . '%');
            }

            // SRS-14: stok <= 2
            $query->where('stock', '<=', 2)
                  ->orderBy('category_id')
                  ->orderBy('name');
        }

        $reportData = $query->paginate(10);
        
        return view('seller.reports.reports', compact('activeReportTab', 'categories', 'reportData'));
    }

    /**
     * Generate dan download PDF untuk laporan.
     * Route: seller.reports.download
     */
    public function downloadPdf(Request $request)
    {
        // Jenis laporan: rating | stock | low_stock
        $type = $request->query('type', 'rating');

        $userId = Auth::check() ? Auth::id() : 1;
        $user   = Auth::user();

        // Nama user = awalan email (sebelum @)
        $processorName = $user ? explode('@', $user->email)[0] : 'system';
        $reportDate    = now()->format('d-m-Y');

        // Query dasar
        $query = Product::where('user_id', $userId)->with('category');

        // ===================== STOCK PDF =====================
        if ($type === 'stock') {

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->query('category_id'));
            }

            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->query('search') . '%');
            }

            // pakai filter sort yang sama kayak halaman web
            $sort = $request->query('sort', 'stock_desc');
            if ($sort === 'stock_asc') {
                $query->orderBy('stock', 'asc');
            } else {
                $query->orderByDesc('stock');
            }

            $view  = 'seller.reports.pdf_stock';
            $title = 'Laporan Daftar Produk Berdasarkan Stock';

        // ================= LOW STOCK PDF =====================
        } elseif ($type === 'low_stock') {

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->query('category_id'));
            }

            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->query('search') . '%');
            }

            $query->where('stock', '<=', 2)
                  ->orderBy('category_id')
                  ->orderBy('name');

            $view  = 'seller.reports.pdf_low_stock';
            $title = 'Laporan Daftar Produk Segera Dipesan';

        // ==================== RATING PDF =====================
        } else {
            // default: rating
            if ($request->filled('category_id')) {
                $query->where('category_id', $request->query('category_id'));
            }
            if ($request->filled('rating_min')) {
                $query->where('rating', '>=', $request->query('rating_min'));
            }
            if ($request->filled('rating_max')) {
                $query->where('rating', '<=', $request->query('rating_max'));
            }

            $query->whereNotNull('rating')
                  ->orderByDesc('rating');

            $view  = 'seller.reports.pdf_rating';
            $title = 'Laporan Daftar Produk Berdasarkan Rating';
            $type  = 'rating';
        }

        $products = $query->get();

        $pdf = Pdf::loadView($view, [
            'title'         => $title,
            'products'      => $products,
            'reportDate'    => $reportDate,
            'processorName' => $processorName,
        ])->setPaper('A4', 'portrait');

        $filename = 'laporan_' . $type . '_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }
}