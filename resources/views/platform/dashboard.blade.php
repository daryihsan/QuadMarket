<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .sidebar { width: 250px; background-color: #ffffff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); position: fixed; height: 100%; }
        .main-content { flex-grow: 1; padding: 30px; margin-left: 250px; }
        .nav-link { display: flex; align-items: center; padding: 12px 16px; border-radius: 8px; color: #6b7280; transition: all 0.2s; }
        .nav-link:hover { background-color: #e0f2fe; color: #1e40af; }
        .nav-link.active { background-color: #e5e7eb; color: #007bff; font-weight: 600; }
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
            <a href="{{ route('platform.dashboard') }}" class="nav-link active">
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

        <div class="absolute bottom-0 left-0 w-[250px] border-t p-4 bg-white">
            <a href="#" class="nav-link"><i class="fas fa-cog mr-3"></i> Pengaturan</a>
            <a href="#" class="nav-link"><i class="fas fa-question-circle mr-3"></i> Bantuan</a>
            <a href="#" class="nav-link"><i class="fas fa-sign-out-alt mr-3"></i> Keluar</a>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="main-content">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-blue-900">Dashboard Platform</h1>
                <p class="text-gray-600">Selamat Datang, Admin QuadMarket!</p>
            </div>
            <img src="{{ url('assets/images/logo.png') }}" class="h-20">
        </div>

        {{-- GRID 1 --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

            {{-- KANAN BESAR --}}
            <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
                <h2 class="text-lg font-bold text-blue-900 mb-6">Lokasi Penjual</h2>

                @php
                    $total = max($totalProvCount, 1);
                    $largest = $provinsiCounts->first();
                    $percentCircle = $largest ? round(($largest->total / $total) * 100) : 0;
                    $offset = 502.65 - (502.65 * $percentCircle / 100);
                @endphp

                <div class="flex items-center justify-between">
                    <div class="relative">
                        <svg class="w-48 h-48 transform -rotate-90">
                            <circle cx="96" cy="96" r="80" stroke="#E5E7EB" stroke-width="32" fill="none" />
                            <circle cx="96" cy="96" r="80" stroke="#EF4444" stroke-width="32"
                                fill="none"
                                stroke-dasharray="502.65"
                                stroke-dashoffset="{{ $offset }}"
                                stroke-linecap="round" />
                        </svg>

                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-4xl font-bold text-gray-800">{{ $totalSellerLocations }}</span>
                            <span class="text-sm text-gray-500">Lokasi</span>
                        </div>
                    </div>

                    {{-- LEGEND --}}
                    <div class="space-y-3">
                        @foreach($provinsiCounts as $i => $prov)
                            @php
                                $percent = round(($prov->total / $total) * 100);
                                $color = $i === 0 ? 'bg-blue-500' : ($i === 1 ? 'bg-red-500' : 'bg-gray-300');
                            @endphp

                            <div class="flex items-center space-x-3">
                                <span class="w-3 h-3 rounded-full {{ $color }}"></span>
                                <span class="text-gray-700">{{ $prov->propinsi }} ({{ $percent }}%)</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- STATUS PENJUAL --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-bold text-blue-900 mb-6">Status Penjual</h2>

                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600 mb-2">Total Penjual Aktif</p>
                        <p class="text-3xl font-bold text-blue-900">{{ $totalActive }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600 mb-2">Total Penjual Tidak Aktif</p>
                        <p class="text-3xl font-bold text-blue-900">{{ $totalInactive }}</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- GRID 2 --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-sm text-gray-600 mb-2">Total Pembeli</p>
                <p class="text-3xl font-bold text-blue-900">{{ number_format($totalBuyers) }}</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-sm text-gray-600 mb-2">Total Penjual Baru</p>
                <p class="text-3xl font-bold text-blue-900">+{{ $totalNewSellers }}</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-sm text-gray-600 mb-2">Total Produk</p>
                <p class="text-3xl font-bold text-blue-900">{{ number_format($totalProducts) }}</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-sm text-gray-600 mb-2">Total Transaksi</p>
                <p class="text-3xl font-bold text-blue-900">{{ number_format($totalTransactions) }}</p>
            </div>
        </div>

    </main>
</div>

</body>
</html>