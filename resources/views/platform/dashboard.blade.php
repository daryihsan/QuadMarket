<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg">
            <!-- Admin Profile -->
            <div class="p-6 border-b">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
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
                <a href="{{ route('platform.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 bg-gray-100 text-gray-800 rounded-lg mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="{{ route('platform.laporan') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Laporan</span>
                </a>
            </nav>

            <!-- Bottom Menu -->
            <div class="absolute bottom-0 w-64 border-t p-4">
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Pengaturan</span>
                </a>
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg mb-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        <main class="flex-1 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-blue-900">Dashboard Platform</h1>
                    <p class="text-gray-600">Selamat Datang, Admin QuadMarket!</p>
                </div>
                <img src="https://via.placeholder.com/120x40/00BFFF/FFFFFF?text=QuadMarket" alt="QuadMarket" class="h-10">
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Lokasi Penjual Card -->
                <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
                    <h2 class="text-lg font-bold text-blue-900 mb-6">Lokasi Penjual</h2>
                    <div class="flex items-center justify-between">
                        <!-- Donut Chart -->
                        <div class="relative">
                            <svg class="w-48 h-48 transform -rotate-90">
                                <circle cx="96" cy="96" r="80" stroke="#E5E7EB" stroke-width="32" fill="none" />
                                <circle cx="96" cy="96" r="80" stroke="#EF4444" stroke-width="32" fill="none" 
                                    stroke-dasharray="502.65" stroke-dashoffset="167.55" stroke-linecap="round" />
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span class="text-4xl font-bold text-gray-800">200</span>
                                <span class="text-sm text-gray-500">Lokasi</span>
                            </div>
                        </div>

                        <!-- Legend -->
                        <div class="space-y-3">
                            <div class="flex items-center space-x-3">
                                <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                <span class="text-gray-700">DKI Jakarta (78%)</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                <span class="text-gray-700">Jawa Tengah (17%)</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="w-3 h-3 bg-gray-300 rounded-full"></span>
                                <span class="text-gray-700">Lainnya (5%)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Penjual Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-bold text-blue-900 mb-6">Status Penjual</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-2">Total Penjual Aktif</p>
                            <p class="text-3xl font-bold text-blue-900">150</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-2">Total Penjual Tidak Aktif</p>
                            <p class="text-3xl font-bold text-blue-900">50</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Row Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-sm text-gray-600 mb-2">Total Pembeli</p>
                    <p class="text-3xl font-bold text-blue-900">5,123</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-sm text-gray-600 mb-2">Total Penjual Baru</p>
                    <p class="text-3xl font-bold text-blue-900">+5</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-sm text-gray-600 mb-2">Total Produk</p>
                    <p class="text-3xl font-bold text-blue-900">5,123</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-sm text-gray-600 mb-2">Total Transaksi</p>
                    <p class="text-3xl font-bold text-blue-900">4,123</p>
                </div>
            </div>

            <!-- Revenue Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-bold text-blue-900 mb-6">Omzet Platform</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-2">Total Omzet</p>
                        <p class="text-3xl font-bold text-blue-900">Rp2,123,456,789</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-2">Rata-Rata Omzet (per tahun)</p>
                        <p class="text-3xl font-bold text-blue-900">Rp175,000,000</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>