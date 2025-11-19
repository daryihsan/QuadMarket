@extends('layouts.app')

@section('title', 'Register Step 2')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
    <img src="{{ asset('images/quadmarket-logo.png') }}" alt="Logo" class="w-48 mb-4">

    <div class="bg-white shadow-xl rounded-2xl w-full max-w-md p-8">
        <h2 class="text-left text-sm font-semibold mb-4">⬅ Sebelumnya</h2>

        <form method="POST" action="{{ route('register.step2.post') }}" class="space-y-3">
            @csrf
            <div>
                <label class="block text-sm font-semibold">Alamat PIC Singkat</label>
                <input name="alamat" class="w-full border rounded-md px-3 py-2">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-semibold">RT</label>
                    <input name="rt" class="w-full border rounded-md px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold">RW</label>
                    <input name="rw" class="w-full border rounded-md px-3 py-2">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold">Nama Kelurahan</label>
                <input name="kelurahan" class="w-full border rounded-md px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-semibold">Kabupaten/Kota</label>
                <select name="kota" class="w-full border rounded-md px-3 py-2">
                    <option value="">Pilih...</option>
                    <option>Semarang</option>
                    <option>Salatiga</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold">Provinsi</label>
                <select name="provinsi" class="w-full border rounded-md px-3 py-2">
                    <option value="">Pilih...</option>
                    <option>Jawa Tengah</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-black text-white font-semibold py-2 rounded-md mt-4">
                Selanjutnya
            </button>
        </form>
    </div>
</div>
@endsection
