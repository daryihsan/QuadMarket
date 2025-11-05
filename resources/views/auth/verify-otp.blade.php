@extends('layouts.app')

@section('content')
<div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">
    <h2 class="text-2xl font-bold text-center mb-4">Registrasi</h2>
    <p class="text-center text-gray-600 mb-6">
        Kode OTP telah dikirim ke <span class="font-medium">{{ request('email') }}</span>
    </p>

    <form method="POST" action="{{ route('verify.otp') }}" class="flex flex-col items-center space-y-6">
        @csrf
        <div class="flex space-x-2">
            @for ($i = 0; $i < 6; $i++)
                <input maxlength="1" name="otp[]" class="w-10 h-10 text-center border rounded-md border-gray-300 text-lg" required>
            @endfor
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg">Sign Up</button>

        <p class="text-sm text-blue-600 hover:underline cursor-pointer">Kirim Ulang Kode (60s)</p>
    </form>
</div>
@endsection
