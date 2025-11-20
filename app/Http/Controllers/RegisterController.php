<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

        $request->session()->put('registration_data', $validated);

        return redirect()->route('register.step2');
    }

    /**
     * STEP 2 – Menampilkan form alamat
     */
    public function showStep2(Request $request)
    {
        if (!$request->session()->has('registration_data')) {
            return redirect()->route('register.step1')
                             ->with('error', 'Silakan isi langkah 1 terlebih dahulu.');
        }

        return view('auth.register.step2');
    }

    /**
     * STEP 2 – Memproses data alamat
     */
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

    /**
     * STEP 3 – Menampilkan form password
     */
    public function showStep3(Request $request)
    {
        if (!$request->session()->has('registration_data')) {
            return redirect()->route('register.step1');
        }

        return view('auth.register.step3');
    }

    /**
     * STEP 3 – Memproses password & membuat akun
     */
    public function processStep3(Request $request)
    {
        $validated = $request->validate([
            'nik'      => 'required|string|max:20',
            'password' => 'required|min:6|confirmed',
        ]);

        $merged = array_merge(
            $request->session()->get('registration_data'),
            [
                'nik'      => $validated['nik'],
                'password' => bcrypt($validated['password']),
            ]
        );

        User::create([
            'nama_toko'  => $merged['nama_toko'],
            'deskripsi'  => $merged['deskripsi'],
            'nama_pic'   => $merged['nama_pic'],
            'no_hp'      => $merged['hp_pic'],
            'email'      => $merged['email_pic'],
            'alamat_pic' => $merged['alamat_pic'],
            'rt'         => $merged['rt'],
            'rw'         => $merged['rw'],
            'kelurahan'  => $merged['kelurahan'],
            'kabupaten'  => $merged['kabupaten'],
            'provinsi'   => $merged['provinsi'],
            'nik'        => $merged['nik'],
            'password'   => $merged['password'],
        ]);

        $request->session()->forget('registration_data');

        return redirect()->route('login')
                        ->with('success', 'Akun berhasil dibuat!');
    }
}
