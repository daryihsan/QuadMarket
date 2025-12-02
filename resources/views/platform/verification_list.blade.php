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
        /* Memastikan Sidebar fixed dan lebar 250px */
        .sidebar { width: 250px; background-color: #ffffff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); flex-shrink: 0; position: fixed; height: 100%; }
        /* Main Content bergeser dan memiliki padding */
        .main-content { flex-grow: 1; padding: 30px; margin-left: 250px; }
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
                <a href="{{ route('platform.dashboard') }}" class="nav-link"><i class="fas fa-chart-line mr-3"></i> Dashboard</a>
                {{-- Verifikasi Penjual diatur sebagai ACTIVE --}}
                <a href="{{ route('platform.verifikasi.list') }}" class="nav-link active"><i class="fas fa-check-circle mr-3"></i> Verifikasi Penjual</a>
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
                <h1 class="text-2xl font-bold text-blue-900">Antrian Verifikasi Penjual</h1>
                {{-- Tambahkan logo di header untuk konsistensi, jika ada --}}
                <img src="{{ url('assets/images/logo.png') }}" alt="QuadMarket" class="h-20" style="height: 5rem;">
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Penjual Menunggu Verifikasi </h2>
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Toko </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PIC </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email PIC </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi Propinsi </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($pending_sellers as $seller)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $seller->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $seller->nama_toko }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $seller->nama_pic }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $seller->email_pic }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $seller->propinsi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('platform.verifikasi.detail', $seller->id) }}" class="text-indigo-600 hover:text-indigo-900">Lihat Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada penjual yang menunggu verifikasi saat ini.</td>
                            </tr>
                            @endforelse
                            </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>