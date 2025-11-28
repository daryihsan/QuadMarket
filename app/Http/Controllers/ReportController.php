<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
class ReportController extends Controller
{
    /**
     * Menampilkan halaman Laporan (SRS-12, 13, 14).
     * Route: seller.reports.reports.index
     */
    public function index(Request $request)
    {
        // LOGIKA DEBUGGING: Menggunakan ID 1 jika tidak ada user yang login
        $userId = Auth::check() ? Auth::id() : 1;

        $activeReportTab = $request->query('report_tab', 'rating');

        $categories = Category::all();
        // Query menggunakan ID debugging
        $query = Product::where('user_id', $userId)->with('category');

        // Logika Filter dan Sorting per Tab (Sama)
        if ($activeReportTab === 'rating') {
            if ($request->filled('category_id')) { $query->where('category_id', $request->query('category_id')); }
            if ($request->filled('rating_min')) { $query->where('rating', '>=', $request->query('rating_min')); }
            if ($request->filled('rating_max')) { $query->where('rating', '<=', $request->query('rating_max')); }
            $query->whereNotNull('rating')->orderByDesc('rating');

        } elseif ($activeReportTab === 'stock') {
            if ($request->filled('category_id')) { $query->where('category_id', $request->query('category_id')); }
            if ($request->filled('search')) { $query->where('name', 'like', '%' . $request->query('search') . '%'); }
            $query->orderByDesc('stock');

        } elseif ($activeReportTab === 'low_stock') {
            if ($request->filled('category_id')) { $query->where('category_id', $request->query('category_id')); }
            if ($request->filled('search')) { $query->where('name', 'like', '%' . $request->query('search') . '%'); }
            $query->where('stock', '<=', 2);
        }
        $reportData = $query->paginate(10);
        
        // **BARIS YANG DIPERBAIKI (sesuai nama file: reports.blade.php)**
        return view('seller.reports.reports', compact('activeReportTab', 'categories', 'reportData'));
    }

    /**
     * Fungsi placeholder untuk mengenerate PDF (Route: seller.reports.download).
     */
    public function downloadPdf(Request $request)
    {
        $reportType = $request->query('type');
        return back()->with('success', "Laporan {$reportType} berhasil di-generate sebagai PDF. (Perlu implementasi DomPDF)");
    }
}