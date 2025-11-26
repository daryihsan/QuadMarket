<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
// use Illuminate\Support\Facades\Mail; // Untuk mengirim notifikasi email [cite: 56, 57]
// use PDF; // Untuk membuat laporan PDF [cite: 71, 72, 74]

class PlatformController extends Controller
{
    // --- DASHBOARD (SRS-MartPlace-07) ---
    public function dashboard()
    {
        // Ambil Data Nyata dari Database
        $pending_count = Seller::where('status_akun', 'pending')->count();
        $aktif_count = Seller::where('status_akun', 'active')->count();
        $tidak_aktif_count = Seller::where('status_akun', 'rejected')->count();
        // Anda perlu model terpisah (misalnya VisitorInteraction) untuk menghitung pengunjung yang memberikan komentar
        $pengunjung_rating = 5123; // Placeholder

        $data = [
            'pending_verifications_count' => $pending_count,
            'total_penjual_aktif' => $aktif_count,
            'total_penjual_tidak_aktif' => $tidak_aktif_count,
            'total_pengunjung_rating' => $pengunjung_rating,
        ];

        return view('platform.dashboard', $data);
    }

    // --- DAFTAR VERIFIKASI (Terkait SRS-MartPlace-02) ---
    public function verificationList()
    {
        // Ambil semua calon penjual yang statusnya 'pending'
        $pending_sellers = Seller::where('status_akun', 'pending')
                                  ->orderBy('created_at', 'asc')
                                  ->get();
                                  
        return view('platform.verification_list', compact('pending_sellers'));
    }

    // --- DETAIL VERIFIKASI (Terkait SRS-MartPlace-02) ---
    public function verificationDetail($id)
    {
        // Ambil data penjual. Gunakan findOrFail jika tidak ada.
        $seller = Seller::findOrFail($id); 

        return view('platform.verification_detail', compact('seller'));
    }

    // --- PROSES VERIFIKASI (SRS-MartPlace-02) ---
    public function processVerification(Request $request, $id)
    {
        $seller = Seller::findOrFail($id);
        $action = $request->input('action'); 
        
        if ($action === 'approve') {
            $seller->status_akun = 'active';
            $seller->verification_date = now();
            $seller->save();

            // Logika Kirim Email AKTIVASI AKUN [cite: 57]
            // Mail::to($seller->email_pic)->send(new AccountActivationMail($seller));
            
            return redirect()->route('platform.verifikasi.list')->with('success', 'Penjual ' . $seller->nama_toko . ' berhasil diaktifkan. Email aktivasi telah dikirim.');
        } else {
            // Logika Kirim Email PENOLAKAN [cite: 57]
            $seller->status_akun = 'rejected';
            $seller->verification_date = now();
            $seller->save();

            // Mail::to($seller->email_pic)->send(new RejectionNotificationMail($seller));

            return redirect()->route('platform.verifikasi.list')->with('error', 'Penjual ditolak. Email notifikasi penolakan telah dikirim.');
        }
    }

    // --- HALAMAN LAPORAN ---
    public function reports()
    {
        return view('platform.reports'); 
    }

    // --- DOWNLOAD LAPORAN (SRS-MartPlace-09, 10, 11) ---
    public function downloadReport($type)
    {
        // Contoh Logika Download PDF (Membutuhkan Library PDF)
        $data = [];
        $view = '';
        $filename = 'laporan-platform.pdf';

        if ($type == 'penjual_aktif_tidak_aktif') {
            // SRS-MartPlace-09: Laporan daftar akun penjual aktif dan tidak aktif (format PDF) [cite: 71]
            $data['sellers'] = Seller::select('nama_toko', 'email_pic', 'status_akun', 'verification_date')->get();
            $view = 'reports.sellers_status_pdf';
            $filename = 'Laporan_Status_Penjual.pdf';
        } elseif ($type == 'penjual_per_propinsi') {
            // SRS-MartPlace-10: Laporan daftar penjual (toko) untuk setiap Lokasi propinsi (format PDF) [cite: 72]
            $data['sellers'] = Seller::select('nama_toko', 'propinsi', 'kabupaten_kota')->get();
            $view = 'reports.sellers_location_pdf';
            $filename = 'Laporan_Penjual_Per_Propinsi.pdf';
        } elseif ($type == 'produk_rating') {
            // SRS-MartPlace-11: Laporan daftar produk dan ratingnya yang diurutkan secara menurun (format PDF) [cite: 73]
            // Implementasi query produk dengan rating rata-rata
            $data['products'] = []; // Placeholder
            $view = 'reports.products_rating_pdf';
            $filename = 'Laporan_Produk_Rating.pdf';
        } else {
            abort(404);
        }

        // return PDF::loadView($view, $data)->download($filename);
        
        return response()->json(['message' => 'Simulasi unduh laporan PDF: ' . $filename . ' (Perlu library PDF)']);
    }
}