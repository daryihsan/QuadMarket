<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjual per Provinsi</title>
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
                <a href="<?php echo e(route('platform.dashboard')); ?>" class="flex items-center space-x-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg mb-2 transition-colors">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="<?php echo e(route('platform.laporan')); ?>" class="flex items-center space-x-3 px-4 py-3 bg-gray-100 text-gray-800 rounded-lg transition-colors">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="font-medium">Laporan</span>
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
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-blue-900">Dashboard Laporan</h1>
                </div>
                <img src="https://via.placeholder.com/120x40/00BFFF/FFFFFF?text=QuadMarket" alt="QuadMarket" class="h-10">
            </div>

            <!-- Tabs -->
            <div class="bg-white rounded-t-lg shadow">
                <div class="flex border-b">
                    <a href="<?php echo e(route('platform.laporan')); ?>" class="px-6 py-4 text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition-colors whitespace-nowrap">
                        Daftar Penjual
                    </a>
                    <a href="<?php echo e(route('platform.laporan.provinsi')); ?>" class="px-6 py-4 text-blue-900 font-semibold border-b-2 border-blue-900 whitespace-nowrap">
                        Penjual per Provinsi
                    </a>
                    <a href="<?php echo e(route('platform.laporan.produk')); ?>" class="px-6 py-4 text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition-colors whitespace-nowrap">
                        Produk Lengkap
                    </a>
                </div>
            </div>

            <!-- Filter and Export Section -->
            <div class="bg-white shadow px-6 py-4">
                <div class="flex justify-between items-start flex-wrap gap-4">
                    <div class="flex items-start space-x-3 flex-wrap gap-3">
                        <label class="text-gray-700 whitespace-nowrap pt-2">Filter berdasarkan Provinsi :</label>
                        <select class="border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 min-w-[180px]">
                            <option>Semua Provinsi</option>
                            <option>DKI Jakarta</option>
                            <option>Jawa Tengah</option>
                            <option>Jawa Barat</option>
                            <option>Jawa Timur</option>
                            <option>Bali</option>
                            <option>Sumatera Utara</option>
                        </select>
                    </div>
                    <button class="flex items-center space-x-2 bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600 transition-colors whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
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
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[180px]">Nama Penjual</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[150px]">ID Penjual</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[150px]">Provinsi</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[200px]">Email</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[150px]">Tanggal Bergabung</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-800 font-medium">Toko Sejahtera</td>
                                <td class="px-6 py-4 text-gray-600">ID-Penjual-001</td>
                                <td class="px-6 py-4 text-gray-600">DKI Jakarta</td>
                                <td class="px-6 py-4 text-gray-600">sejahtera@gmail.com</td>
                                <td class="px-6 py-4 text-gray-600">12 Jan 2022</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-800 font-medium">Toko Tembakang</td>
                                <td class="px-6 py-4 text-gray-600">ID-Penjual-002</td>
                                <td class="px-6 py-4 text-gray-600">Jawa Tengah</td>
                                <td class="px-6 py-4 text-gray-600">totem@gmail.com</td>
                                <td class="px-6 py-4 text-gray-600">12 Feb 2023</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-800 font-medium">Toko Makmur Jaya</td>
                                <td class="px-6 py-4 text-gray-600">ID-Penjual-003</td>
                                <td class="px-6 py-4 text-gray-600">Jawa Barat</td>
                                <td class="px-6 py-4 text-gray-600">makmurjaya@gmail.com</td>
                                <td class="px-6 py-4 text-gray-600">05 Mar 2023</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-800 font-medium">Warung Berkah</td>
                                <td class="px-6 py-4 text-gray-600">ID-Penjual-004</td>
                                <td class="px-6 py-4 text-gray-600">DKI Jakarta</td>
                                <td class="px-6 py-4 text-gray-600">berkah@gmail.com</td>
                                <td class="px-6 py-4 text-gray-600">18 Apr 2023</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-800 font-medium">Toko Sumber Rezeki</td>
                                <td class="px-6 py-4 text-gray-600">ID-Penjual-005</td>
                                <td class="px-6 py-4 text-gray-600">Jawa Timur</td>
                                <td class="px-6 py-4 text-gray-600">sumberrezeki@gmail.com</td>
                                <td class="px-6 py-4 text-gray-600">22 May 2023</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-800 font-medium">Kios Mentari</td>
                                <td class="px-6 py-4 text-gray-600">ID-Penjual-006</td>
                                <td class="px-6 py-4 text-gray-600">Bali</td>
                                <td class="px-6 py-4 text-gray-600">mentari@gmail.com</td>
                                <td class="px-6 py-4 text-gray-600">10 Jun 2023</td>
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
</html><?php /**PATH C:\laragon\www\QuadMarket\resources\views/platform/provinsi.blade.php ENDPATH**/ ?>