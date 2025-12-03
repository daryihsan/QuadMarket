<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $currentCategory ?? 'Katalog Produk' }} - Katalog Pembeli QuadMarket</title> 
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif;
            background-color: #f6f7f8;
        }
        .product-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            cursor: pointer;
        }
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .quad-logo-color {
            color: #4c98e1;
        }
    </style>
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-sm sticky top-0 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('assets/quadmarket-logo.png') }}" 
                    alt="QuadMarket Logo" 
                    class="w-29 h-20 mr-0 ml-0">
            </div>
            <div class="hidden lg:flex flex-grow max-w-xl mx-8">
                <div class="relative w-full">
                    <input type="text" placeholder="Cari Produk..."
                        class="w-full border border-gray-300 rounded-full py-2 pl-5 pr-12 text-gray-700 focus:ring-blue-600 focus:border-blue-600">
                    <button class="absolute right-0 top-0 mt-2 mr-3 text-gray-500 hover:text-blue-600">
                        <span class="material-icons-outlined text-xl">search</span>
                    </button>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="#" class="text-gray-700 hover:text-blue-600">
                    <span class="material-icons-outlined text-2xl">notifications</span>
                </a>
                <a href="#" class="text-gray-700 hover:text-blue-600">
                    <span class="material-icons-outlined text-2xl">account_circle</span>
                </a>
            </div>
        </div>
    </header>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <p class="text-sm text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Home</a>
            / {{ $currentCategory ?? 'Semua Kategori' }}
        </p>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="w-full lg:w-72 bg-white p-6 rounded-lg shadow-lg flex-shrink-0">
                <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-3">Filter</h2>
                <form method="GET" action="{{ route('katalog') }}" class="space-y-6">
                    
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-3">Kategori</h3>
                        <div class="space-y-2 text-sm text-gray-600">
                            @php
                                $categories = \App\Models\Category::all();
                            @endphp
                            @foreach ($categories as $cat)
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="kategori" value="{{ $cat->id }}"
                                        {{ ($filters['kategori'] ?? null) == $cat->id ? 'checked' : '' }}
                                        class="form-radio text-blue-600 rounded">
                                    <span>{{ $cat->name }}</span>
                                </label>
                            @endforeach

                        </div>
                    </div>
                    <div class="pt-4 border-t border-gray-200">
                        <h3 class="font-semibold text-gray-700 mb-3">Lokasi</h3>
                        <div class="space-y-2 text-sm text-gray-600">
                            @php
                                $locations = ['Jakarta', 'Surabaya', 'Bandung', 'Semarang'];
                            @endphp
                            @foreach ($locations as $loc)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="lokasi" value="{{ $loc }}" 
                                        {{ ($filters['lokasi'] ?? '') === $loc ? 'checked' : '' }} 
                                        class="form-checkbox text-blue-600 rounded">
                                    <span>{{ $loc }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-200">
                        <h3 class="font-semibold text-gray-700 mb-3">Rentang Harga</h3>
                        <div class="flex space-x-2 text-xs">
                            <input type="number" name="harga_min" placeholder="Harga Minimum" 
                                value="{{ $filters['harga_min'] ?? 0 }}"
                                class="w-1/2 border border-gray-300 rounded-lg p-2 text-gray-700 text-center focus:ring-blue-600 focus:border-blue-600">
                            <input type="number" name="harga_max" placeholder="Harga Maksimum" 
                                value="{{ $filters['harga_max'] ?? 50000000 }}"
                                class="w-1/2 border border-gray-300 rounded-lg p-2 text-gray-700 text-center focus:ring-blue-600 focus:border-blue-600">
                        </div>
                    </div>
                    <div class="pt-4 border-t border-gray-200">
                        <h3 class="font-semibold text-gray-700 mb-3">Rating</h3>
                        <label class="flex items-center space-x-2 text-sm text-gray-600">
                            <input type="checkbox" name="rating" value="4" 
                                {{ ($filters['rating'] ?? '') == 4 ? 'checked' : '' }}
                                class="form-checkbox text-blue-600 rounded">
                            <span class="text-yellow-500"> ⭐ </span>
                            <span>4 ke atas</span>
                        </label>
                    </div>
                    <div class="pt-6 space-y-3">
                        <button type="submit"
                            class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition duration-150 shadow-md">
                                Terapkan Filter
                        </button>
                        <a href="{{ route('katalog') }}"
                            class="block w-full text-center bg-gray-200 text-gray-700 font-semibold py-3 rounded-lg hover:bg-gray-300 transition duration-150">
                            Reset Filter
                        </a>
                    </div>
                </form>
            </div>
            <div class="flex-grow">
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $currentCategory ?? 'Semua Produk' }}</h1>
                    <p class="text-gray-500 text-sm">Menampilkan {{ number_format($totalProducts, 0, ',', '.') }} produk</p>
                </div>
                {{-- Daftar Produk --}}
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
                    @foreach ($products as $product)
                        <a href="{{ route('product.detail', ['id' => $product->id]) }}" class="bg-white rounded-lg shadow hover:shadow-lg transition border border-gray-100 overflow-hidden product-card">
                            {{-- Gambar Produk --}}
                            @if ($product->image_path)
                                <img src="{{ $product->image_path }}" class="w-full h-40 object-cover" alt="{{ $product->name }}">
                            @else
                                <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-500">
                                    Tidak ada gambar
                                </div>
                            @endif
                            {{-- Konten --}}
                            <div class="p-3">
                                <p class="text-sm font-medium text-gray-800 truncate mb-1">
                                    {{ $product->name }}
                                </p>
                                <p class="text-xl font-bold text-gray-900 mb-1">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-500 mb-2">
                                    {{ $product->user->nama_toko ?? 'N/A' }} • {{ $product->user->kabupaten ?? 'N/A' }}
                                </p>
                                {{-- Rating --}}
                                <div class="flex items-center text-xs">
                                    <span class="font-semibold text-yellow-500 mr-1"> ⭐  {{ number_format($product->rating, 1) }}</span>
                                    <span class="text-gray-500">
                                        ({{ number_format($product->total_ulasan, 0, ',', '.') }})
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
                <div class="mt-8 flex justify-center lg:justify-end">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </main>
    <footer class="bg-white border-t border-gray-100 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center text-gray-600 text-sm">
            <p>© 2025 QuadMarket. Semua hak dilindungi.</p>
        </div>
    </footer>
</body>
</html>