<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda QuadMarket</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        html, body {
            font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif;
        }
        .category-card, .product-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            cursor: pointer;
        }
        .category-card:hover, .product-card:hover {
            transform: translateY(-5px); /* Efek 'angkat' saat hover */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* Bayangan yang lebih jelas */
        }

        /* Styling Hero Section untuk Latar Belakang */
        .hero-section {
            min-height: 400px; /* Menyesuaikan tinggi dengan desain */
            background-color: #e6f1f8; /* Warna latar belakang umum */
            /* GANTI path gambar hero-bg.png dengan path gambar produk background Anda */
            background-image: url('assets/images/hero.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Untuk memastikan input search di hero tidak ada border saat fokus */
        .hero-search-input:focus {
            outline: none;
            box-shadow: none;
            border-color: transparent;
        }
    </style>
</head>
<body class="bg-gray-50">

    @include('layouts.header')

    <section class="hero-section text-center pt-20 pb-28 flex flex-col items-center justify-center">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-4">
                Temukan Jutaan Produk Terbaik
            </h1>
            <p class="text-lg text-gray-600 mb-10">
                Jelajahi berbagai kategori dan temukan barang impian Anda dengan harga terbaik
            </p>

            <div class="max-w-xl mx-auto">
                <div class="relative flex items-center bg-white p-2 rounded-xl shadow-lg">
                    <input type="text" placeholder="Cari Produk..." class="hero-search-input flex-grow pl-4 pr-4 py-3 border-none rounded-xl text-gray-700">
                    <button class="bg-blue-600 text-white font-semibold py-3 px-8 rounded-xl hover:bg-blue-700 transition duration-150 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span class="hidden sm:inline">Cari Sekarang</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 z-10 relative">
        <div class="grid grid-cols-3 sm:grid-cols-7 gap-4 sm:gap-6 bg-white p-4 sm:p-8 rounded-2xl shadow-xl">
            <a href="#" class="category-card flex flex-col items-center text-center p-2 sm:p-3 hover:shadow-xl rounded-lg">
                <img src="assets/images/elektronik.png" alt="Elektronik" class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg mb-2">
                <span class="text-xs sm:text-sm font-medium text-gray-700">Elektronik</span>
            </a>
            <a href="#" class="category-card flex flex-col items-center text-center p-2 sm:p-3 hover:shadow-xl rounded-lg">
                <img src="assets/images/fashion_wanita.png" alt="Fashion Wanita" class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg mb-2">
                <span class="text-xs sm:text-sm font-medium text-gray-700">Fashion Wanita</span>
            </a>
            <a href="#" class="category-card flex flex-col items-center text-center p-2 sm:p-3 hover:shadow-xl rounded-lg">
                <img src="assets/images/fashion_pria.png" alt="Fashion Pria" class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg mb-2">
                <span class="text-xs sm:text-sm font-medium text-gray-700">Fashion Pria</span>
            </a>
            <a href="#" class="category-card flex flex-col items-center text-center p-2 sm:p-3 hover:shadow-xl rounded-lg">
                <img src="assets/images/buku.png" alt="Buku" class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg mb-2">
                <span class="text-xs sm:text-sm font-medium text-gray-700">Buku</span>
            </a>
            <a href="#" class="category-card flex flex-col items-center text-center p-2 sm:p-3 hover:shadow-xl rounded-lg">
                <img src="assets/images/skincare.png" alt="Skincare" class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg mb-2">
                <span class="text-xs sm:text-sm font-medium text-gray-700">Skincare</span>
            </a>
            <a href="#" class="category-card flex flex-col items-center text-center p-2 sm:p-3 hover:shadow-xl rounded-lg">
                <img src="assets/images/furniture.png" alt="Furniture" class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg mb-2">
                <span class="text-xs sm:text-sm font-medium text-gray-700">Furniture</span>
            </a>
            <a href="#" class="category-card flex flex-col items-center text-center p-2 sm:p-3 hover:shadow-xl rounded-lg">
                <img src="assets/images/kategori-lainnya.jpg" alt="Lainnya" class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg mb-2">
                <span class="text-xs sm:text-sm font-medium text-gray-700">Lainnya</span>
            </a>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-16">
    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6">Produk yang Sedang Tren</h2>
        
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 lg:gap-6">
        
        {{-- Headphone Gaming -> misal produk id 1 --}}
        <a href="{{ route('products.show', 1) }}" class="product-card block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl">
            <img src="assets/images/headphone.png" alt="Headphone Gaming" class="w-full h-40 object-cover">
            <div class="p-4">
                <p class="text-sm font-medium text-gray-800 truncate mb-1">Headphone Gaming</p>
                <div class="flex items-center mb-2 text-xs">
                    <span class="font-semibold text-yellow-500 mr-1">⭐ 4.7</span>
                    <span class="text-gray-500">(92)</span>
                </div>
                <p class="text-lg font-bold text-gray-900">230.000</p>
            </div>
        </a>

        {{-- Kursi Kayu Modern -> misal produk id 2 --}}
        <a href="{{ route('products.show', 2) }}" class="product-card block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl">
            <img src="assets/images/kursi.png" alt="Kursi Kayu Modern" class="w-full h-40 object-cover">
            <div class="p-4">
                <p class="text-sm font-medium text-gray-800 truncate mb-1">Kursi Kayu Modern</p>
                <div class="flex items-center mb-2 text-xs">
                    <span class="font-semibold text-yellow-500 mr-1">⭐ 4.2</span>
                    <span class="text-gray-500">(180)</span>
                </div>
                <p class="text-lg font-bold text-gray-900">300.000</p>
            </div>
        </a>

        {{-- Face Mist Laneige -> produk id 3 --}}
        <a href="{{ route('products.show', 3) }}" class="product-card block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl">
            <img src="assets/images/facemist.png" alt="Face Mist Laneige" class="w-full h-40 object-cover">
            <div class="p-4">
                <p class="text-sm font-medium text-gray-800 truncate mb-1">Face Mist Laneige</p>
                <div class="flex items-center mb-2 text-xs">
                    <span class="font-semibold text-yellow-500 mr-1">⭐ 4.9</span>
                    <span class="text-gray-500">(296)</span>
                </div>
                <p class="text-lg font-bold text-gray-900">286.000</p>
            </div>
        </a>

        {{-- Buku Algoritma -> produk id 4 --}}
        <a href="{{ route('products.show', 4) }}" class="product-card block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl">
            <img src="assets/images/alpro.png" alt="Buku Algoritma" class="w-full h-40 object-cover">
            <div class="p-4">
                <p class="text-sm font-medium text-gray-800 truncate mb-1">Buku Algoritma</p>
                <div class="flex items-center mb-2 text-xs">
                    <span class="font-semibold text-yellow-500 mr-1">⭐ 4.5</span>
                    <span class="text-gray-500">(60)</span>
                </div>
                <p class="text-lg font-bold text-gray-900">66.000</p>
            </div>
        </a>

        {{-- Kemeja Wanita -> produk id 5 --}}
        <a href="{{ route('products.show', 5) }}" class="product-card block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl">
            <img src="assets/images/kemeja.png" alt="Kemeja Wanita" class="w-full h-40 object-cover">
            <div class="p-4">
                <p class="text-sm font-medium text-gray-800 truncate mb-1">Kemeja Wanita</p>
                <div class="flex items-center mb-2 text-xs">
                    <span class="font-semibold text-yellow-500 mr-1">⭐ 5.0</span>
                    <span class="text-gray-500">(220)</span>
                </div>
                <p class="text-lg font-bold text-gray-900">230.000</p>
            </div>
        </a>
    </div>
</section>


    @include('layouts.footer')

</body>
</html>