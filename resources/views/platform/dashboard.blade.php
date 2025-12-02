<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .sidebar { width: 250px; background-color: #ffffff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); flex-shrink: 0; position: fixed; height: 100%;} /* Ditambahkan fixed dan height:100% */
        .main-content { flex-grow: 1; padding: 30px; margin-left: 250px; } /* Ditambahkan margin-left */
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
        {{-- SIDEBAR --}}
        <aside class="sidebar">
            <div class="p-6 border-b mb-4">
                <h3 class="font-bold text-lg text-gray-800">Admin Menu</h3>
            </div>
            <nav class="space-y-2">
                {{-- Dashboard diatur sebagai ACTIVE --}}
                <a href="{{ route('platform.dashboard') }}" class="nav-link active"><i class="fas fa-chart-line mr-3"></i> Dashboard</a>
                <a href="{{ route('platform.verifikasi.list') }}" class="nav-link"><i class="fas fa-check-circle mr-3"></i> Verifikasi Penjual</a>
                <a href="{{ route('platform.laporan') }}" class="nav-link"><i class="fas fa-file-alt mr-3"></i> Laporan</a>
                <a href="{{ route('platform.categories.index') }}" class="nav-link"><i class="fas fa-tags mr-3"></i> Manajemen Kategori</a>
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
                    <h1 class="text-2xl font-bold text-blue-900">Dashboard Platform</h1>
                    <p class="text-gray-600">Selamat Datang, Admin QuadMarket!</p>
                </div>
                <img src="{{ url('assets/images/logo.png') }}" alt="QuadMarket" class="h-20">
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
                    <h2 class="text-lg font-bold text-blue-900 mb-6">Lokasi Penjual</h2>
                    <div class="flex items-center justify-between">
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

        </main>
    </div>
</body>
</html>