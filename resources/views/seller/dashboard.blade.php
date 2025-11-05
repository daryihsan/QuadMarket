@extends('layouts.app')

@section('content')
<div class="max-w-5xl w-full bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-xl font-bold mb-4">Toko Saya</h2>
    <div class="grid grid-cols-4 gap-4 mb-4">
        <div class="p-4 bg-gray-50 rounded-lg text-center shadow-sm">Status Pesanan</div>
        <div class="p-4 bg-gray-50 rounded-lg text-center shadow-sm">Saldo</div>
        <div class="p-4 bg-gray-50 rounded-lg text-center shadow-sm">Penilaian</div>
        <div class="p-4 bg-gray-50 rounded-lg text-center shadow-sm">Pengaturan</div>
    </div>

    <a href="{{ route('seller.product.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg mb-4">
        Tambah Produk Baru
    </a>

    <div class="grid grid-cols-3 gap-4">
        @foreach($products as $p)
        <div class="border rounded-lg p-4">
            <h3 class="font-semibold text-lg">{{ $p->name }}</h3>
            <p class="text-gray-500">Rp {{ number_format($p->price) }}</p>
            <p class="text-sm mt-2">Stok: {{ $p->stock }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
