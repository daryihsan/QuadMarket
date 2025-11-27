<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuadMarket - {{ $product->name }}</title>

    {{-- FONT & TAILWIND, sama kayak home.blade --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- ICON --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <style>
        html, body {
            font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

    {{-- NAVBAR YANG SAMA DENGAN HOME --}}
    @include('layouts.header')

    {{-- BREADCRUMB --}}
    <div class="bg-white px-6 py-3 text-sm text-gray-600 border-b mt-2">
        <div class="max-w-7xl mx-auto">
            <a href="{{ url('/home') }}" class="hover:text-blue-600">Home</a> /
            <span class="hover:text-blue-600">Kategori</span> /
            <span class="text-gray-800">{{ $product->name }}</span>
        </div>
    </div>

    {{-- WRAPPER --}}
    <div class="max-w-7xl mx-auto px-4 lg:px-6 py-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 lg:p-8">

            @php
                // mapping: NAMA PRODUK -> NAMA FILE GAMBAR (sesuai isi folder kamu)
                $imageMapByName = [
                    'Headphone Gaming'   => 'headphone.png',
                    'Kursi Kayu Modern'  => 'kursi.png',
                    'Face Mist Laneige'  => 'facemist.png',
                    'Buku Algoritma'     => 'alpro.png',
                    'Kemeja Wanita'      => 'kemeja.png',
                ];

                // ambil file berdasarkan nama produk, fallback ke headphone.png kalau nggak ketemu
                $imageFile   = $imageMapByName[$product->name] ?? 'headphone.png';
                $imageUrl    = asset('assets/images/' . $imageFile);
                $fallbackUrl = asset('assets/images/headphone.png');
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10">

                {{-- ================= LEFT: GAMBAR & TAB ================= --}}
                <div>
                    {{-- MAIN IMAGE --}}
                    <div class="bg-white border rounded-2xl p-4 mb-4">
                        <img id="mainProductImage"
                             src="{{ $imageUrl }}"
                             alt="{{ $product->name }}"
                             class="w-full rounded-xl object-cover max-h-[420px]"
                             onerror="this.src='{{ $fallbackUrl }}'">
                    </div>

                    {{-- THUMBNAILS --}}
                    <div class="grid grid-cols-5 gap-2 mb-6">
                        @for ($i = 0; $i < 5; $i++)
                            <img src="{{ $imageUrl }}"
                                 class="w-full h-20 object-cover rounded-xl border cursor-pointer hover:border-blue-500 hover:shadow-md transition-all"
                                 onclick="changeMainImage('{{ $imageUrl }}')"
                                 onerror="this.src='{{ $fallbackUrl }}'">
                        @endfor
                    </div>

                    {{-- TABS --}}
                    <div class="border-b">
                        <div class="flex space-x-8">
                            <button id="tabDeskripsi"
                                    class="py-2 text-gray-800 font-semibold border-b-4 border-blue-600">
                                Deskripsi Produk
                            </button>
                            <button id="tabUlasan"
                                    class="py-2 text-gray-600 font-semibold border-b-4 border-transparent">
                                Ulasan Pembeli
                            </button>
                        </div>
                    </div>

                    {{-- TAB: DESKRIPSI --}}
                    <div id="contentDeskripsi" class="mt-6">
                        <h3 class="font-bold text-lg mb-3">Spesifikasi</h3>
                        <p class="text-sm text-gray-700 leading-relaxed">
                            {{ $product->description ?? 'Produk ini belum memiliki deskripsi.' }}
                        </p>

                        <div class="mt-8">
                            <h3 class="font-bold text-lg mb-4">Ulasan & Penilaian Pembeli</h3>
                            <div class="flex flex-col md:flex-row items-start md:items-center md:space-x-8 space-y-4 md:space-y-0">
                                <div class="text-center">
                                    <div class="text-5xl font-bold text-gray-800">4.6</div>
                                    <div class="text-gray-600">/ 5.0</div>
                                    <div class="flex justify-center mt-2 text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <div class="text-sm text-gray-600 mt-1">dari 153 ulasan</div>
                                </div>
                                <div class="flex-1 w-full">
                                    @foreach ([5 => 147, 4 => 4, 3 => 2, 2 => 0, 1 => 0] as $star => $count)
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="text-xs w-4 text-gray-700">{{ $star }}</span>
                                            <div class="flex-1 bg-gray-200 rounded-full h-2 overflow-hidden">
                                                <div class="bg-yellow-400 h-2 rounded-full"
                                                     style="width: {{ [5=>96,4=>80,3=>40,2=>10,1=>5][$star] ?? 20 }}%"></div>
                                            </div>
                                            <span class="text-xs w-10 text-right text-gray-700">{{ $count }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="border-2 border-blue-600 text-blue-600 px-6 py-2 rounded-lg hover:bg-blue-50 text-sm font-medium">
                                    <i class="fas fa-edit mr-2"></i>Beri Ulasan
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- TAB: ULASAN --}}
                    <div id="contentUlasan" class="mt-6 hidden">
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
                            <div>
                                <h3 class="font-bold text-lg">Ulasan Pembeli</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-3xl font-bold mr-2">4.6</span>
                                    <span class="text-gray-600">/ 5.0</span>
                                    <div class="flex text-yellow-400 ml-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="text-sm text-gray-600 ml-2">(153 ulasan)</span>
                                </div>
                            </div>
                            <button class="mt-4 md:mt-0 border-2 border-blue-600 text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 text-sm font-medium">
                                <i class="fas fa-edit mr-2"></i>Beri Ulasan
                            </button>
                        </div>

                        <div class="space-y-6">
                            <div class="border-t pt-4">
                                <div class="flex items-start space-x-3">
                                    <img src="https://ui-avatars.com/api/?name=James+A&background=4a90e2&color=fff&size=40"
                                         class="w-10 h-10 rounded-full object-cover">
                                    <div>
                                        <div class="font-semibold">James A.</div>
                                        <div class="flex text-yellow-400 text-sm mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <p class="text-sm text-gray-700">
                                            Sangat puas dengan produk ini. Performa oke, kualitas mantap, dan pengemasan aman. Recommended!
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t pt-4">
                                <div class="flex items-start space-x-3">
                                    <img src="https://ui-avatars.com/api/?name=Michelle&background=e27a90&color=fff&size=40"
                                         class="w-10 h-10 rounded-full object-cover">
                                    <div>
                                        <div class="font-semibold">Michelle</div>
                                        <div class="flex text-yellow-400 text-sm mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <p class="text-sm text-gray-700">
                                            Barang datang dalam kondisi sangat baik dan masih segel. Nyaman dipakai untuk kerja maupun hiburan. Worth it!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ================= RIGHT: INFO PRODUK ================= --}}
                <div class="flex flex-col justify-start">
                    <h1 class="text-2xl sm:text-3xl font-bold text-blue-900 mb-3">
                        {{ $product->name }}
                    </h1>

                    <div class="flex items-center mb-3">
                        <div class="flex text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="font-semibold mr-1 text-sm">4.6</span>
                        <span class="text-sm text-blue-600 cursor-pointer hover:underline">(153 Ulasan)</span>
                    </div>

                    <div class="text-3xl sm:text-4xl font-extrabold text-blue-900 mb-4">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    <div class="text-sm text-gray-600 mb-6">
                        Stok: {{ $product->stock }}
                    </div>

                    {{-- JUMLAH --}}
                    <div class="mb-6">
                        <label class="text-sm font-semibold mb-2 block">Jumlah:</label>
                        <div class="inline-flex items-center border rounded-lg overflow-hidden">
                            <button id="decreaseBtn" class="px-4 py-2 text-lg hover:bg-gray-100">-</button>
                            <input id="quantityInput"
                                   type="text"
                                   value="1"
                                   class="px-4 py-2 w-16 text-center text-sm border-x focus:outline-none">
                            <button id="increaseBtn" class="px-4 py-2 text-lg hover:bg-gray-100">+</button>
                        </div>
                    </div>

                    {{-- INFO TOKO (dummy dulu) --}}
                    <div class="border rounded-xl p-4 mb-4 flex items-start justify-between hover:shadow-md transition-all">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold">
                                TO
                            </div>
                            <div>
                                <h3 class="font-semibold text-base">Nama Toko</h3>
                                <p class="text-sm text-gray-600 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-1 text-gray-500"></i> Kota
                                </p>
                                <p class="text-xs text-gray-500 mt-1 flex items-center">
                                    <i class="far fa-calendar mr-1"></i> Bergabung sejak 2025
                                </p>
                            </div>
                        </div>
                        <button class="hidden sm:inline-flex bg-blue-900 text-white px-4 py-2 rounded-lg text-xs font-medium hover:bg-blue-800">
                            <i class="far fa-comment mr-2"></i>Chat Penjual
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('layouts.footer')

    {{-- SCRIPT TAB & QUANTITY --}}
    <script>
        function changeMainImage(imageUrl) {
            const mainImg = document.getElementById('mainProductImage');
            if (mainImg) mainImg.src = imageUrl;
        }

        const tabDeskripsi = document.getElementById('tabDeskripsi');
        const tabUlasan = document.getElementById('tabUlasan');
        const contentDeskripsi = document.getElementById('contentDeskripsi');
        const contentUlasan = document.getElementById('contentUlasan');

        tabDeskripsi.addEventListener('click', () => {
            tabDeskripsi.classList.add('border-blue-600', 'text-gray-900');
            tabUlasan.classList.remove('border-blue-600', 'text-gray-900');
            tabUlasan.classList.add('text-gray-600');
            contentDeskripsi.classList.remove('hidden');
            contentUlasan.classList.add('hidden');
        });

        tabUlasan.addEventListener('click', () => {
            tabUlasan.classList.add('border-blue-600', 'text-gray-900');
            tabDeskripsi.classList.remove('border-blue-600', 'text-gray-900');
            tabDeskripsi.classList.add('text-gray-600');
            contentUlasan.classList.remove('hidden');
            contentDeskripsi.classList.add('hidden');
        });

        const decreaseBtn = document.getElementById('decreaseBtn');
        const increaseBtn = document.getElementById('increaseBtn');
        const quantityInput = document.getElementById('quantityInput');
        const MAX_STOCK = {{ $product->stock ?? 1 }};

        decreaseBtn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            if (value > 1) quantityInput.value = value - 1;
        });

        increaseBtn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            if (value < MAX_STOCK) quantityInput.value = value + 1;
        });

        quantityInput.addEventListener('input', (e) => {
            let value = parseInt(e.target.value);
            if (isNaN(value) || value < 1) e.target.value = 1;
            else if (value > MAX_STOCK) e.target.value = MAX_STOCK;
        });
    </script>
</body>
</html>