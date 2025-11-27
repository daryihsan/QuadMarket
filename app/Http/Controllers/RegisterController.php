<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str; // Tambahkan untuk membuat token

class RegisterController extends Controller
{
    // step 1
    public function showStep1()
    {
        return view('auth.register.step1');
    }

    // step 1 data input
    public function processStep1(Request $request)
    {
        $validated = $request->validate([
            'nama_toko'  => 'required|string|max:255',
            'deskripsi'  => 'nullable|string|max:500',
            'nama_pic'   => 'required|string|max:255',
            'hp_pic'     => 'required|string|max:15', 
            'email_pic'  => 'required|email|unique:users,email',
        ]);

        // Ganti 'hp_pic' dan 'email_pic' agar match dengan kolom di DB (no_hp dan email)
        $registrationData = [
            'nama_toko'  => $validated['nama_toko'],
            'deskripsi'  => $validated['deskripsi'],
            'nama_pic'   => $validated['nama_pic'],
            'no_hp'      => $validated['hp_pic'], // no_hp di DB
            'email'      => $validated['email_pic'], // email di DB
        ];

        $request->session()->put('registration_data', $registrationData);

        return redirect()->route('register.step2');
    }

    // step 2 form 
    public function showStep2(Request $request)
    {
        if (!$request->session()->has('registration_data')) {
            return redirect()->route('register.step1')
                             ->with('error', 'Silakan isi langkah 1 terlebih dahulu.');
        }

        return view('auth.register.step2');
    }

    // proses data
    public function processStep2(Request $request)
    {
        $validated = $request->validate([
            'alamat_pic' => 'required|string|max:255',
            'rt'         => 'required|string|max:10',
            'rw'         => 'required|string|max:10',
            'kelurahan'  => 'required|string|max:255',
            'kabupaten'  => 'required|string|max:255',
            'provinsi'   => 'required|string|max:255',
        ]);

        $merged = array_merge(
            $request->session()->get('registration_data'),
            $validated
        );

        $request->session()->put('registration_data', $merged);

        return redirect()->route('register.step3');
    }

    // step 3 pass
    public function showStep3(Request $request)
    {
        if (!$request->session()->has('registration_data')) {
            return redirect()->route('register.step1');
        }

        return view('auth.register.step3');
    }

    // step 3 proses & register
    public function processStep3(Request $request)
    {
        if (!$request->session()->has('registration_data')) {
            return redirect()->route('register.step1')
                             ->with('error', 'Sesi pendaftaran hilang. Silakan mulai kembali.');
        }

        $validated = $request->validate([
            'nik'          => ['required', 'string', 'digits:16', Rule::unique('users', 'nik')], 
            'password'     => 'required|min:8|confirmed',
            'foto_pic'     => 'required|image|max:5120', 
            'file_ktp'     => 'required|image|max:5120', // DIUBAH KEY FIELD DARI foto_ktp ke file_ktp
        ], [
            'nik.digits' => 'Nomor KTP harus terdiri dari 16 digit.',
            'nik.unique' => 'Nomor KTP ini sudah terdaftar.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'foto_pic.required' => 'Foto PIC wajib diunggah.',
            'file_ktp.required' => 'File KTP PIC wajib diunggah.', // Keterangan diubah
            'foto_pic.image' => 'File Foto PIC harus berupa gambar.',
            'file_ktp.image' => 'File KTP PIC harus berupa gambar.', // Keterangan diubah
            'foto_pic.max' => 'Ukuran file Foto PIC maksimal 5MB.',
            'file_ktp.max' => 'Ukuran file KTP PIC maksimal 5MB.', // Keterangan diubah
        ]);

        $registrationData = $request->session()->get('registration_data');

        // 1. Upload File
        $fotoPicPath = $request->file('foto_pic')->store('public/seller_docs/foto_pic');
        $fileKtpPath = $request->file('file_ktp')->store('public/seller_docs/file_ktp'); // DIUBAH KEY

        // 2. Buat Token Aktivasi
        $activationToken = Str::random(60); 
        
        // 3. Simpan ke database
        // Catatan: Semua key di array ini harus ada di properti $fillable Model User.
        $user = User::create([
            'nama_toko'     => $registrationData['nama_toko'],
            'deskripsi'     => $registrationData['deskripsi'] ?? null,
            'nama_pic'      => $registrationData['nama_pic'],
            'no_hp'         => $registrationData['no_hp'],
            'email'         => $registrationData['email'],
            'alamat_pic'    => $registrationData['alamat_pic'],
            'rt'            => $registrationData['rt'],
            'rw'            => $registrationData['rw'],
            'kelurahan'     => $registrationData['kelurahan'],
            'kabupaten'     => $registrationData['kabupaten'],
            'provinsi'      => $registrationData['provinsi'],
            'nik'           => $validated['nik'],
            'password'      => bcrypt($validated['password']),
            
            // SINKRONISASI DENGAN KOLOM MIGRASI
            'foto_pic'      => Storage::url($fotoPicPath), // Menggunakan Storage::url untuk path yang dapat diakses publik
            'file_ktp'      => Storage::url($fileKtpPath), // Menggunakan Storage::url untuk path yang dapat diakses publik

            // SET NILAI DEFAULT UNTUK KOLOM VERIFIKASI/STATUS
            'status_akun'       => 'pending', // Default pending
            'activation_token'  => $activationToken,
            'email_verified_at' => null, 
            'verification_date' => null,
            // 'role'            => 'seller', // Hapus jika 'role' tidak ada di migrasi
        ]);

        // 4. Bersihkan session
        $request->session()->forget('registration_data');
        
        // TODO: Kirim email verifikasi ke $user->email menggunakan $activationToken

        // 5. Arahkan ke halaman sukses
        return redirect()->route('register.success'); 
    }
    
    // Fungsi baru untuk menampilkan halaman sukses
    public function showSuccess()
    {
        return view('auth.register.success');
    }

    // TODO: Tambahkan fungsi untuk verifikasi email (handle route /verify/{token})
}