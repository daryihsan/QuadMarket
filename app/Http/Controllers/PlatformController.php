<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use App\Mail\SellerVerificationMail;
use App\Mail\SellerRejectionMail;
use App\Models\Seller;
use App\Models\Product;

class PlatformController extends Controller
{
    // --- DASHBOARD ---
   public function dashboard()
{
    // Hitung jumlah provinsi yang memiliki penjual
    $totalSellerLocations = Seller::distinct('propinsi')->count('propinsi');

    // Hitung jumlah penjual per provinsi
    $provinsiCounts = Seller::select('propinsi')
        ->selectRaw('COUNT(*) as total')
        ->groupBy('propinsi')
        ->orderByDesc('total')
        ->get();

    // TOTAL penjual (untuk menghitung persen)
    $totalProvCount = max($provinsiCounts->sum('total'), 1);

    // Status akun
    $totalActive = Seller::where('status_akun', 'active')->count();
    $totalInactive = Seller::where('status_akun', 'rejected')->count();

    // Statistik lain
    $totalProducts = Product::count();
    $totalNewSellers = Seller::whereDate('created_at', '>=', now()->subDays(7))->count();

    // Dummy jika table buyers/transaksi belum dibuat
    $totalBuyers = 5123;
    $totalTransactions = 4123;

    return view('platform.dashboard', compact(
        'totalSellerLocations',
        'provinsiCounts',
        'totalProvCount',
        'totalActive',
        'totalInactive',
        'totalProducts',
        'totalNewSellers',
        'totalBuyers',
        'totalTransactions'
    ));
}

    // --- LIST VERIFIKASI ---
    public function verificationList()
    {
        $pending_sellers = User::where('status_akun', 'pending')
                                ->orderBy('created_at', 'asc')
                                ->get();

        return view('platform.verification_list', compact('pending_sellers'));
    }

    // --- DETAIL VERIFIKASI ---
    public function verificationDetail($id)
    {
        $seller = User::findOrFail($id);
        return view('platform.verification_detail', compact('seller'));
    }

    // --- PROSES VERIFIKASI (Approve / Reject) ---
    public function processVerification(Request $request, $id)
    {
        $seller = User::findOrFail($id);

        // Validasi Action
        $request->validate([
            'action' => 'required|in:approve,reject'
        ]);

        // Cegah re-verifikasi
        if ($seller->status_akun !== 'pending') {
            return redirect()->route('platform.verifikasi.list')
                ->with('info', 'Status akun sudah final dan tidak dapat diubah.');
        }

        // Jika DITERIMA
        if ($request->action === 'approve') {

            $seller->status_akun = 'active';
            $seller->verification_date = now();
            $seller->save();

            // Kirim EMAIL VERIFIKASI
            Mail::to($seller->email_pic)->send(new SellerVerificationMail(
                $seller->nama_toko,
                url('/login/login')
            ));

            return redirect()->route('platform.verifikasi.list')
                ->with('success', "Penjual {$seller->nama_toko} berhasil diaktifkan. Email sudah dikirim.");
        }

        // Jika DITOLAK
        if ($request->action === 'reject') {

            $seller->status_akun = 'rejected';
            $seller->verification_date = now();
            $seller->save();

            // Kirim EMAIL PENOLAKAN
            Mail::to($seller->email_pic)->send(new SellerRejectionMail(
                $seller->nama_toko,
                $request->alasan // tambahin
            ));

            return redirect()->route('platform.verifikasi.list')
                ->with('error', 'Penjual ditolak. Email penolakan sudah dikirim.');
        }
    }

    // --- HALAMAN LAPORAN ---
    public function reports()
    {
        return view('platform.reports');
    }

    // --- DOWNLOAD LAPORAN ---
    public function downloadReport($type)
    {
        return response()->json([
            'message' => 'Simulasi download PDF (implementasikan dengan library dompdf).'
        ]);
    }
}
