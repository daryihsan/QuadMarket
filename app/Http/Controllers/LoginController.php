<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // halaman pilih login
    public function showPilih()
    {
        return view('auth.login.pilih');
    }

    // ================= USER LOGIN ===================

    public function showLogin()
    {
        return view('auth.login.login');
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'email_pic' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email_pic' => $request->email_pic,
            'password' => $request->password
        ])) {
            return redirect()->intended('/dashboard-user')->with('success','Login berhasil!');
        }

        return back()->withErrors(['email_pic' => 'Email atau password salah']);
    }


    // ================= ADMIN LOGIN ===================

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
            return redirect('/dashboard-admin')->with('success','Login admin berhasil!');
        }

        return back()->withErrors(['username' => 'Username atau password admin salah']);
    }
}
