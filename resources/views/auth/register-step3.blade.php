@extends('layouts.app')

@section('title', 'Register Step 3')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
    <img src="{{ asset('images/quadmarket-logo.png') }}" alt="Logo" class="w-48 mb-4">

    <div class="bg-white shadow-xl rounded-2xl w-full max-w-md p-8">
        <h2 class="text-left text-sm font-semibold mb-4">⬅ Sebelumnya</h2>

        <form method="POST" action="{{ route('register.step3.post') }}" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <div>
                <label class="block text-sm font-semibold">No. KTP PIC</label>
                <input name="no_ktp" class="w-full border rounded-md px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-semibold">Kata Sandi</label>
                <input type="password" name="password" class="w-full border rounded-md px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-semibold">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" class="w-full border rounded-md px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-semibold">Foto PIC</label>
                <input type="file" name="foto_pic" class="w-full border rounded-md px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-semibold">File Upload KTP PIC</label>
                <input type="file" name="ktp_pic" class="w-full border rounded-md px-3 py-2">
            </div>

            <button type="submit" class="w-full bg-sky-500 text-white font-semibold py-2 rounded-md mt-4">
                Kirim
            </button>
        </form>
    </div>
</div>
@endsection
