<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\OTPVerification;
use App\Services\OTPService;

class AuthController extends Controller
{
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
        ]);

        app(OTPService::class)->generateAndSend($user);

        return redirect()->route('verify.otp', ['email' => $user->university_email]);
    }

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
        auth()->login($otp->user);
        return redirect()->route('seller.dashboard');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'university_email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {
            return redirect()->route('seller.dashboard');
        }
        return back()->withErrors(['university_email' => 'Email atau kata sandi salah.']);
    }

    public function logout() {
        auth()->logout();
        return redirect()->route('login');
    }
}
