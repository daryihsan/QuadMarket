<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Status Penjual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .sidebar { width: 250px; background-color: #ffffff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); flex-shrink: 0; position: fixed; height: 100%; }
        .main-content { flex-grow: 1; padding: 30px; margin-left: 250px; }
        .nav-link { display: flex; align-items: center; padding: 12px 16px; border-radius: 8px; color: #6b7280; transition: all 0.2s; }
        .nav-link:hover { background-color: #e0f2fe; color: #1e40af; }
        .nav-link.active { background-color: #e5e7eb; color: #007bff; font-weight: 600; }
    </style>
</head>

<body>
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="p-6 border-b mb-4">
                <h3 class="font-bold text-lg text-gray-800">Admin Menu</h3>
            </div>
            <nav class="space-y-2">
                <a href="{{ route('platform.dashboard') }}" class="nav-link"><i class="fas fa-chart-line mr-3"></i> Dashboard</a>
                <a href="{{ route('platform.verifikasi.list') }}" class="nav-link"><i class="fas fa-check-circle mr-3"></i> Verifikasi Penjual</a>
                <a href="{{ route('platform.laporan') }}" class="nav-link active"><i class="fas fa-file-alt mr-3"></i> Laporan</a>
                <a href="{{ route('platform.categories.index') }}" class="nav-link"><i class="fas fa-tags mr-3"></i> Manajemen Kategori</a>
            </nav>
            
            <div class="absolute bottom-0 left-0 w-[250px] border-t p-4 bg-white">
                <a href="#" class="nav-link"><i class="fas fa-cog mr-3"></i> Pengaturan</a>
                <a href="#" class="nav-link"><i class="fas fa-question-circle mr-3"></i> Bantuan</a>
                <a href="#" class="nav-link"><i class="fas fa-sign-out-alt mr-3"></i> Keluar</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-blue-900">Dashboard Laporan</h1>
                    <p class="text-gray-600">Kelola dan pantau laporan penjual</p>
                </div>
                <img src="{{ url('assets/images/logo.png') }}" class="h-20">
            </div>

            <!-- Tabs -->
            <div class="bg-white rounded-t-lg shadow">
                <div class="flex border-b">
                    <a href="{{ route('platform.laporan') }}" class="px-6 py-4 text-blue-900 font-semibold border-b-2 border-blue-900">Daftar Penjual</a>
                    <a href="{{ route('platform.laporan.provinsi') }}" class="px-6 py-4 text-gray-600 hover:bg-gray-50">Penjual per Provinsi</a>
                    <a href="{{ route('platform.laporan.produk') }}" class="px-6 py-4 text-gray-600 hover:bg-gray-50">Produk Lengkap</a>
                </div>
            </div>

            <!-- Filter & Export -->
            <div class="bg-white shadow px-6 py-4">
                <form method="GET" class="flex justify-between items-start flex-wrap gap-4">

                    <div class="flex items-start space-x-3 flex-wrap gap-3">
                        <label class="text-gray-700 pt-2 whitespace-nowrap">Filter berdasarkan status :</label>

                        <select name="status" 
                                onchange="this.form.submit()" 
                                class="border border-gray-300 rounded px-4 py-2 focus:ring-blue-500 min-w-[160px]">
                            
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>

                    <button class="flex items-center space-x-2 bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600">
                        <i class="fas fa-download"></i>
                        <span>Unduh PDF</span>
                    </button>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white shadow rounded-b-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nama Penjual</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">ID Penjual</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Email</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tanggal Bergabung</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($sellers as $seller)
                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ $seller->nama_toko }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    ID-Penjual-{{ $seller->id }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $seller->email_pic }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($seller->status_akun == 'active')
                                        <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Aktif</span>
                                    @elseif($seller->status_akun == 'rejected')
                                        <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">Tidak Aktif</span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-700 rounded-full">Pending</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $seller->created_at->format('d M Y') }}
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-gray-500">Tidak ada data penjual</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-6 py-4 border-t">
                    {{ $sellers->onEachSide(1)->links() }}
                </div>
            </div>
        </main>

    </div>
</body>
</html>