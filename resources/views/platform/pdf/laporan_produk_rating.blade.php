<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produk Lengkap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .sidebar { width: 250px; background-color: #ffffff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); flex-shrink: 0; }
        .main-content { flex-grow: 1; padding: 30px; margin-left: 250px; }
        .nav-link { display: flex; align-items: center; padding: 12px 16px; border-radius: 8px; color: #6b7280; transition: all 0.2s; }
        .nav-link:hover { background-color: #f3f4f6; color: #1f2937; }
        .nav-link.active { background-color: #e5e7eb; color: #007bff; font-weight: 600; }
    </style>
</head>
<body>
<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="sidebar fixed h-full">
        <div class="p-6 border-b mb-4">
            <h3 class="font-bold text-lg text-gray-800">Admin Menu</h3>
        </div>
        <nav class="space-y-2">
            <a href="{{ route('platform.dashboard') }}" class="nav-link">
                <i class="fas fa-chart-line mr-3"></i> Dashboard
            </a>
            <a href="{{ route('platform.verifikasi.list') }}" class="nav-link">
                <i class="fas fa-check-circle mr-3"></i> Verifikasi Penjual
            </a>
            <a href="{{ route('platform.laporan') }}" class="nav-link">
                <i class="fas fa-file-alt mr-3"></i> Laporan
            </a>
            <a href="{{ route('platform.categories.index') }}" class="nav-link">
                <i class="fas fa-tags mr-3"></i> Manajemen Kategori
            </a>
        </nav>
        <div class="absolute bottom-0 w-full pr-4 border-t p-4 bg-white">
            <a href="#" class="nav-link">
                <i class="fas fa-cog mr-3"></i>
                <span>Pengaturan</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-question-circle mr-3"></i>
                <span>Bantuan</span>
            </a>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="main-content">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-blue-900">Dashboard Laporan</h1>
                <p class="text-sm text-gray-500 mt-1">Laporan produk lengkap dari seluruh penjual.</p>
            </div>
            <img src="{{ url('assets/images/logo.png') }}" alt="QuadMarket" class="h-20">
        </div>

        {{-- TAB --}}
        <div class="bg-white rounded-t-lg shadow">
            <div class="flex border-b">
                <a href="{{ route('platform.laporan') }}"
                   class="px-6 py-4 text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition-colors whitespace-nowrap">
                    Daftar Penjual
                </a>
                <a href="{{ route('platform.laporan.provinsi') }}"
                   class="px-6 py-4 text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition-colors whitespace-nowrap">
                    Penjual per Provinsi
                </a>
                <a href="{{ route('platform.laporan.produk') }}"
                   class="px-6 py-4 text-blue-900 font-semibold border-b-2 border-blue-900 whitespace-nowrap hover:bg-gray-50 transition-colors">
                    Produk Lengkap
                </a>
            </div>
        </div>

        {{-- FILTER + BUTTON --}}
        <div class="bg-white shadow px-6 py-4">
            <div class="flex justify-between items-start flex-wrap gap-4">
                <form method="GET" action="{{ route('platform.laporan.produk') }}"
                      class="flex items-start space-x-3 flex-wrap gap-3">
                    <label class="text-gray-700 whitespace-nowrap pt-2">Filter berdasarkan :</label>

                    {{-- KATEGORI --}}
                    <select name="kategori"
                            class="border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 min-w-[160px]">
                        <option value="Semua Kategori" {{ $kategoriFilter === 'Semua Kategori' ? 'selected' : '' }}>
                            Semua Kategori
                        </option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ $kategoriFilter === $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>

                    {{-- RATING (UI only) --}}
                    <select name="rating"
                            class="border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 min-w-[140px]">
                        <option {{ $ratingFilter === 'Semua Rating' ? 'selected' : '' }}>Semua Rating</option>
                        <option {{ $ratingFilter === '4+' ? 'selected' : '' }}>4+ ★</option>
                        <option {{ $ratingFilter === '3+' ? 'selected' : '' }}>3+ ★</option>
                    </select>

                    {{-- HARGA (UI only) --}}
                    <select name="harga"
                            class="border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 min-w-[140px]">
                        <option {{ $hargaFilter === 'Semua Harga' ? 'selected' : '' }}>Semua Harga</option>
                        <option value="termurah" {{ $hargaFilter === 'termurah' ? 'selected' : '' }}>Termurah</option>
                        <option value="termahal" {{ $hargaFilter === 'termahal' ? 'selected' : '' }}>Termahal</option>
                    </select>
                </form>

                {{-- TOMBOL DOWNLOAD PDF --}}
                <a href="{{ route('platform.laporan.download', ['type' => 'produk']) }}"
                    class="flex items-center space-x-2 bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600 transition">
                    <i class="fas fa-download text-white"></i>
                    <span>Unduh PDF</span>
                </a>

            </div>
        </div>

        {{-- TABEL PRODUK --}}
        <div class="bg-white shadow rounded-b-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Produk</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Kategori</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Harga</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Stok</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Rating</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Penjual</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-800 font-medium">
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $product->category->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-gray-800">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $product->stock }}
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ number_format($product->rating ?? 0, 1) }}
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $product->user->nama_toko ?? ($product->user->name ?? '-') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data produk.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-white px-6 py-4 border-t flex items-center justify-between flex-wrap gap-4">
                <div class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold">{{ $products->count() }}</span> produk
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>