@extends('layouts.app')

@section('title', 'Register Step 1')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
    <img src="{{ asset('images/quadmarket-logo.png') }}" alt="Logo" class="w-48 mb-4">

    <div class="bg-white shadow-xl rounded-2xl w-full max-w-md p-8">
        <h2 class="text-center text-lg font-bold mb-2">Daftar</h2>
        <p class="text-center text-sm mb-6 text-gray-500">Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-pink-500 hover:underline">Login disini</a>
        </p>

        <form method="POST" action="{{ route('register.step1.post') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold">Nama Toko</label>
                <input name="nama_toko" class="w-full border rounded-md px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-semibold">Deskripsi Singkat</label>
                <input name="deskripsi" class="w-full border rounded-md px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-semibold">Nama PIC</label>
                <input name="nama_pic" class="w-full border rounded-md px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-semibold">No. Handphone PIC</label>
                <input name="no_hp" class="w-full border rounded-md px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-semibold">Email PIC</label>
                <input type="email" name="email" class="w-full border rounded-md px-3 py-2">
            </div>

            <button type="submit" class="w-full bg-black text-white font-semibold py-2 rounded-md mt-4">
                Selanjutnya
            </button>
        </form>
    </div>
</div>
@endsection
