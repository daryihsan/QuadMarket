@extends('layouts.app')

@section('content')
<div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">
    <h2 class="text-2xl font-bold text-center mb-6">Log In</h2>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <input name="university_email" placeholder="Email Universitas" type="email" class="form-input w-full rounded-lg border-gray-300" required>
        <input name="password" placeholder="Kata Sandi" type="password" class="form-input w-full rounded-lg border-gray-300" required>
        <div class="flex justify-between items-center text-sm">
            <label class="flex items-center space-x-1">
                <input type="checkbox" class="rounded border-gray-300">
                <span>Ingat Saya</span>
            </label>
            <a href="#" class="text-blue-600 hover:underline">Lupa Sandi?</a>
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg">Log In</button>
    </form>

    <p class="text-center text-sm mt-4 text-gray-600">
        Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-semibold">Daftar Sekarang</a>
    </p>
</div>
@endsection
