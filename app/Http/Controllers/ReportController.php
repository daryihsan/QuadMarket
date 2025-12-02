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
        $userId = Auth::check() ? Auth::id() : 1;

        $activeReportTab = $request->query('report_tab', 'rating');

        $categories = Category::all();

        $query = Product::where('user_id', $userId)->with('category');

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

            $query->whereNotNull('rating')
                  ->orderByDesc('rating'); 

        } elseif ($activeReportTab === 'stock') {

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->query('category_id'));
            }

            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->query('search') . '%');
            }

            $query->orderByDesc('stock'); 

        } elseif ($activeReportTab === 'low_stock') {

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->query('category_id'));
            }

            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->query('search') . '%');
            }

            $query->where('stock', '<=', 2); 
        }

        $reportData = $query->paginate(10);
        
        return view('seller.reports.reports', compact('activeReportTab', 'categories', 'reportData'));
    }

    public function downloadPdf(Request $request)
    {
        $type = $request->query('type', 'rating');

        $userId = Auth::check() ? Auth::id() : 1;
        $user   = Auth::user();

        $processorName = $user ? explode('@', $user->email)[0] : 'system';
        $reportDate    = now()->format('d-m-Y');

        $query = Product::where('user_id', $userId)->with('category');

        if ($type === 'stock') {
            if ($request->filled('category_id')) {
                $query->where('category_id', $request->query('category_id'));
            }
            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->query('search') . '%');
            }

            $query->orderByDesc('stock');

            $view  = 'seller.reports.pdf_stock';
            $title = 'Laporan Daftar Produk Berdasarkan Stock';

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

        } else {
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

            $type = 'rating';
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