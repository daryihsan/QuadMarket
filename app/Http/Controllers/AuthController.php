<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\OTPVerification;
use App\Services\OTPService;

class AuthController extends Controller
{
    // --- REGISTRASI ---
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'university_email' => 'required|email|ends_with:students.undip.ac.id|unique:users,university_email',
            'password' => ['required','min:8','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*?&]/'],
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'university_email' => $validated['university_email'],
            'password' => Hash::make($validated['password']),
            'role' => 'seller',
            'is_verified' => false,
        ]);

        app(OTPService::class)->generateAndSend($user);

        return redirect()->route('verify.otp', ['email' => $user->university_email]);
    }

    // --- VERIFIKASI OTP ---
    public function showVerifyOtp() {
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $otp = OTPVerification::where('otp_code',$request->otp)
            ->where('is_used',false)
            ->where('expires_at','>',now())
            ->first();

        if (!$otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau kedaluwarsa']);
        }

        $otp->update(['is_used' => true]);
        $otp->user->update(['is_verified' => true]);
        
        Auth::login($otp->user);

        return redirect()->route('seller.dashboard');
    }

    // --- LOGIN ---
    public function showLogin() {
        if (Auth::check()) {
            return redirect()->route('seller.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'university_email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Coba login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // 3. Cek status verifikasi
            if (!$user->is_verified) {
                Auth::logout();
                return redirect()->route('verify.otp', ['email' => $user->university_email])
                                 ->withErrors(['university_email' => 'Akun belum diverifikasi.']);
            }
            
            // 4. Regenerasi session untuk keamanan
            $request->session()->regenerate();
            return redirect()->route('seller.dashboard');
        }
        
        return back()->withErrors(['university_email' => 'Email atau kata sandi salah.'])->onlyInput('university_email');
    }

    // --- LOGOUT ---
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}