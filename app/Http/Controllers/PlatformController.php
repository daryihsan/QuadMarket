<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use App\Mail\SellerVerificationMail;
use App\Mail\SellerRejectionMail;

class PlatformController extends Controller
{
    // --- DASHBOARD ---
    public function dashboard()
    {
        $pending_count = User::where('status_akun', 'pending')->count();
        $aktif_count = User::where('status_akun', 'active')->count();
        $tidak_aktif_count = User::where('status_akun', 'rejected')->count();

        $data = [
            'pending_verifications_count' => $pending_count,
            'total_penjual_aktif' => $aktif_count,
            'total_penjual_tidak_aktif' => $tidak_aktif_count,
            'total_pengunjung_rating' => 5123,
        ];

        return view('platform.dashboard', $data);
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
                $seller->nama_toko
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
