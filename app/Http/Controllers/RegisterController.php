<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function showStep1()
    {
        return view('auth.register-step1');
    }

    public function processStep1(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required',
            'deskripsi' => 'required',
            'nama_pic' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
        ]);

        Session::put('register', $request->only('nama_toko', 'deskripsi', 'nama_pic', 'no_hp', 'email'));
        return redirect()->route('register.step2');
    }

    public function showStep2()
    {
        return view('auth.register-step2');
    }

    public function processStep2(Request $request)
    {
        $request->validate([
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
        ]);

        $step1 = Session::get('register');
        $data = array_merge($step1, $request->only('alamat', 'rt', 'rw', 'kelurahan', 'kota', 'provinsi'));
        Session::put('register', $data);

        return redirect()->route('register.step3');
    }

    public function showStep3()
    {
        return view('auth.register-step3');
    }

    public function processStep3(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required',
            'password' => 'required|min:8|confirmed',
            'foto_pic' => 'nullable|image',
            'ktp_pic' => 'nullable|image',
        ]);

        $data = Session::get('register');

        User::create([
            'first_name' => $data['nama_pic'],
            'last_name' => '',
            'address' => $data['alamat'],
            'university_email' => $data['email'],
            'password' => Hash::make($request->password),
        ]);

        Session::forget('register');
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
