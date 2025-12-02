<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produk Lengkap</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg fixed h-full">
            <!-- Admin Profile -->
            <div class="p-6 border-b">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Admin</h3>
                        <p class="text-xs text-gray-500">Admin QuadMarket</p>
                    </div>
                </div>
            </div>

            <!-- Menu -->
            <nav class="p-4">
                <a href="{{ route('platform.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg mb-2 transition-colors">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('platform.laporan') }}" class="flex items-center space-x-3 px-4 py-3 bg-gray-100 text-gray-800 rounded-lg transition-colors">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="font-medium">Laporan</span>
                </a>
                <a href="{{ route('platform.verifikasi.list') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Verifikasi Penjual</span>
                </a>
            </nav>

            <!-- Bottom Menu -->
            <div class="absolute bottom-0 w-64 border-t p-4 bg-white">
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg mb-2 transition-colors">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Pengaturan</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Bantuan</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Keluar</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-blue-900">Dashboard Laporan</h1>
                </div>
                <img src="{{ url('assets/images/logo.png') }}" alt="QuadMarket" class="h-20">
            </div>

            <!-- Tabs -->
            <div class="bg-white rounded-t-lg shadow">
                <div class="flex border-b">
                    <a href="{{ route('platform.dashboard') }}" class="px-6 py-4 text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition-colors whitespace-nowrap">
                        Daftar Penjual
                    </a>
                    <a href="{{ route('platform.laporan.provinsi') }}" class="px-6 py-4 text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition-colors whitespace-nowrap">
                        Penjual per Provinsi
                    </a>
                    <a href="{{ route('platform.laporan.produk') }}" class="px-6 py-4 text-blue-900 font-semibold border-b-2 border-blue-900 whitespace-nowrap">
                        Produk Lengkap
                    </a>
                </div>
            </div>

            <!-- Filter and Export Section -->
            <div class="bg-white shadow px-6 py-4">
                <div class="grid grid-cols-[1fr_auto] items-center gap-4">

                    <!-- Filter kiri -->
                    <div class="flex items-center flex-wrap gap-3">
                        <label class="text-gray-700 whitespace-nowrap pt-1">Filter berdasarkan :</label>

                        <select class="border border-gray-300 rounded px-4 py-2 min-w-[150px]">
                            <option>Semua Kategori</option>
                            <option>Pakaian</option>
                            <option>Makanan</option>
                            <option>Elektronik</option>
                            <option>Kesehatan</option>
                            <option>Olahraga</option>
                        </select>

                        <select class="border border-gray-300 rounded px-4 py-2 min-w-[150px]">
                            <option>Semua Rating</option>
                            <option>5 Bintang</option>
                            <option>4 Bintang</option>
                            <option>3 Bintang</option>
                            <option>2 Bintang</option>
                            <option>1 Bintang</option>
                        </select>

                        <select class="border border-gray-300 rounded px-4 py-2 min-w-[150px]">
                            <option>Semua Harga</option>
                            <option>< Rp 50.000</option>
                            <option>Rp 50.000 - Rp 100.000</option>
                            <option>Rp 100.000 - Rp 500.000</option>
                            <option>> Rp 500.000</option>
                        </select>
                    </div>

                    <!-- Tombol kanan -->
                    <button class="flex items-center space-x-2 bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600 transition-colors whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Unduh PDF</span>
                    </button>

                </div>
            </div>

            <!-- Table -->
            <div class="bg-white shadow rounded-b-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 w-12">
                                    <input type="checkbox" class="w-4 h-4 rounded border-gray-300 cursor-pointer">
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[250px]">Produk</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[120px]">Kategori</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[130px]">Harga</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[80px]">Stok</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[100px]">Rating</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[150px]">Penjual</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-center">
                                    <input type="checkbox" class="w-4 h-4 rounded border-gray-300 cursor-pointer">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded flex-shrink-0 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">Sepatu Sneakers</p>
                                            <p class="text-sm text-gray-500">Kasual</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Pakaian</td>
                                <td class="px-6 py-4 text-gray-800 font-medium">Rp 230,000</td>
                                <td class="px-6 py-4 text-gray-600">30</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-1">
                                        <span class="text-yellow-400 text-lg">★★★★★</span>
                                        <span class="text-gray-600 text-sm font-medium">4.6</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Toko Sejahtera</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-center">
                                    <input type="checkbox" class="w-4 h-4 rounded border-gray-300 cursor-pointer">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-16 h-16 bg-gradient-to-br from-amber-100 to-amber-200 rounded flex-shrink-0 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">Kopi Robusta Gayo</p>
                                            <p class="text-sm text-gray-500">250gr</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Makanan</td>
                                <td class="px-6 py-4 text-gray-800 font-medium">Rp 80,000</td>
                                <td class="px-6 py-4 text-gray-600">8</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-1">
                                        <span class="text-yellow-400 text-lg">★★★★★</span>
                                        <span class="text-gray-600 text-sm font-medium">5.0</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Toko Tembakang</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-center">
                                    <input type="checkbox" class="w-4 h-4 rounded border-gray-300 cursor-pointer">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-200 rounded flex-shrink-0 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">Laptop Gaming ROG</p>
                                            <p class="text-sm text-gray-500">15.6 inch</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Elektronik</td>
                                <td class="px-6 py-4 text-gray-800 font-medium">Rp 15,500,000</td>
                                <td class="px-6 py-4 text-gray-600">5</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-1">
                                        <span class="text-yellow-400 text-lg">★★★★★</span>
                                        <span class="text-gray-600 text-sm font-medium">4.8</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Toko Makmur Jaya</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-center">
                                    <input type="checkbox" class="w-4 h-4 rounded border-gray-300 cursor-pointer">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-200 rounded flex-shrink-0 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">Vitamin C 1000mg</p>
                                            <p class="text-sm text-gray-500">60 Tablet</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Kesehatan</td>
                                <td class="px-6 py-4 text-gray-800 font-medium">Rp 125,000</td>
                                <td class="px-6 py-4 text-gray-600">50</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-1">
                                        <span class="text-yellow-400 text-lg">★★★★☆</span>
                                        <span class="text-gray-600 text-sm font-medium">4.3</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Warung Berkah</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-center">
                                    <input type="checkbox" class="w-4 h-4 rounded border-gray-300 cursor-pointer">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-16 h-16 bg-gradient-to-br from-red-100 to-red-200 rounded flex-shrink-0 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">Matras Yoga Premium</p>
                                            <p class="text-sm text-gray-500">180 x 60 cm</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Olahraga</td>
                                <td class="px-6 py-4 text-gray-800 font-medium">Rp 350,000</td>
                                <td class="px-6 py-4 text-gray-600">15</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-1">
                                        <span class="text-yellow-400 text-lg">★★★★★</span>
                                        <span class="text-gray-600 text-sm font-medium">4.9</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Kios Mentari</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-6 py-4 border-t flex items-center justify-between flex-wrap gap-4">
                    <div class="text-sm text-gray-600">
                        Menampilkan <span class="font-semibold">1</span> sampai <span class="font-semibold">6</span> dari <span class="font-semibold">97</span> hasil
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="p-2 rounded hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button class="px-3 py-1 rounded bg-blue-500 text-white font-medium transition-colors">1</button>
                        <button class="px-3 py-1 rounded hover:bg-gray-100 text-gray-700 transition-colors">2</button>
                        <span class="text-gray-600">...</span>
                        <button class="px-3 py-1 rounded hover:bg-gray-100 text-gray-700 transition-colors">10</button>
                        <button class="p-2 rounded hover:bg-gray-100 transition-colors">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>