<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjual per Provinsi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        /* Menggunakan lebar sidebar 250px, fixed, dan box-shadow */
        .sidebar { width: 250px; background-color: #ffffff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); flex-shrink: 0; position: fixed; height: 100%; }
        /* Main Content bergeser sesuai lebar sidebar 250px */
        .main-content { flex-grow: 1; padding: 30px; margin-left: 250px; } 
        /* Gaya Nav Link */
        .nav-link { display: flex; align-items: center; padding: 12px 16px; border-radius: 8px; color: #6b7280; transition: all 0.2s; }
        /* Gaya Hover yang disesuaikan */
        .nav-link:hover { 
            background-color: #e0f2fe; /* blue-50 */
            color: #1e40af; /* blue-800 */
        }
        /* Gaya Active */
        .nav-link.active { background-color: #e5e7eb; color: #007bff; font-weight: 600; }
        .blue-gradient { background-image: linear-gradient(to right, #1E3A8A, #3B82F6); }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        
        <aside class="sidebar">
            <div class="p-6 border-b mb-4">
                <h3 class="font-bold text-lg text-gray-800">Admin Menu</h3>
            </div>
            <nav class="space-y-2">
                <a href="<?php echo e(route('platform.dashboard')); ?>" class="nav-link"><i class="fas fa-chart-line mr-3"></i> Dashboard</a>
                <a href="<?php echo e(route('platform.verifikasi.list')); ?>" class="nav-link"><i class="fas fa-check-circle mr-3"></i> Verifikasi Penjual</a>
                
                <a href="<?php echo e(route('platform.laporan')); ?>" class="nav-link active"><i class="fas fa-file-alt mr-3"></i> Laporan</a>
                <a href="<?php echo e(route('platform.categories.index')); ?>" class="nav-link"><i class="fas fa-tags mr-3"></i> Manajemen Kategori</a>
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

        <main class="main-content">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-blue-900">Dashboard Laporan</h1>
                </div>
                
                <img src="<?php echo e(url('assets/images/logo.png')); ?>" alt="QuadMarket" class="h-20" style="height: 5rem;"> 
            </div>

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
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/QuadMarketPPL/resources/views/platform/provinsi.blade.php ENDPATH**/ ?>