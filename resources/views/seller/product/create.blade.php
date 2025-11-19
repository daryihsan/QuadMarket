@extends('layouts.app')

@section('content')
<div class="max-w-2xl bg-white shadow-lg rounded-xl p-8">
    <h2 class="text-2xl font-bold mb-4">Tambah Produk Standar</h2>

    <form method="POST" action="{{ route('seller.product.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block font-semibold mb-1">Tambah Foto Produk</label>
            <input type="file" name="photo" class="form-input w-full border-gray-300">
        </div>

        <div>
            <label class="block font-semibold mb-1">Nama Produk *</label>
            <input type="text" name="name" class="form-input w-full border-gray-300" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Deskripsi Produk</label>
            <textarea name="description" class="form-input w-full border-gray-300"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Harga *</label>
                <input type="number" name="price" class="form-input w-full border-gray-300" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Stok *</label>
                <input type="number" name="stock" class="form-input w-full border-gray-300" required>
            </div>
        </div>

        <div class="flex justify-end">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection
