<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // pilih login
    public function showPilih()
    {
        return view('auth.login.pilih');
    }

    // login penjual
    public function showLogin()
    {
        return view('auth.login.login');
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'email_pic' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email_pic', $request->email_pic)
                    ->orWhere('nama_toko', $request->email_pic)
                    ->first();
        if ($user && Auth::attempt([
            'email_pic' => $user->email_pic,
            'password' => $request->password
        ])) {
            return redirect()->route('seller.dashboard');
        }
        return back()->withErrors(['email_pic' => 'Email/nama toko atau password salah']);
    }

    // login admin (pake seeders tp blm diset)
    public function showAdmin()
    {
        return view('auth.login.admin');
    }

    public function processAdmin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (
            $request->username === env('ADMIN_USER') &&
            $request->password === env('ADMIN_PASS')
        ) {
            session(['is_admin' => true]);
            return redirect()->route('platform.dashboard')->with('success','Login admin berhasil!');
        }

        return back()->withErrors(['username' => 'Username atau password admin salah']);
    }
}
