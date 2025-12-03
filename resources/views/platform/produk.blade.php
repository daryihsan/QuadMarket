<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produk Lengkap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .sidebar { width: 250px; background-color: #ffffff; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.05); position: fixed; height: 100%; }
        .main-content { flex-grow: 1; padding: 30px; margin-left: 250px; }
        .nav-link { display: flex; align-items: center; padding: 12px 16px; border-radius: 8px; color: #6b7280; transition: all 0.2s; }
        .nav-link:hover { background-color: #e0f2fe; color: #1e40af; }
        .nav-link.active { background-color: #e5e7eb; color: #007bff; font-weight: 600; }
    </style>
</head>

<body>
<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="p-6 border-b mb-4">
            <h3 class="font-bold text-lg text-gray-800">Admin Menu</h3>
        </div>

        <nav class="space-y-2">
            <a href="{{ route('platform.dashboard') }}" class="nav-link">
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

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-blue-900">Dashboard Laporan</h1>
                <p class="text-gray-600">Kelola dan pantau laporan produk</p>
            </div>
            <img src="{{ url('assets/images/logo.png') }}" class="h-20">
        </div>

        <!-- TABS -->
        <div class="bg-white rounded-t-lg shadow">
            <div class="flex border-b">
                <a href="{{ route('platform.laporan') }}" class="px-6 py-4 text-gray-600 hover:bg-gray-50">
                    Daftar Penjual
                </a>

                <a href="{{ route('platform.laporan.provinsi') }}" class="px-6 py-4 text-gray-600 hover:bg-gray-50">
                    Penjual per Provinsi
                </a>

                <a href="{{ route('platform.laporan.produk') }}" class="px-6 py-4 text-blue-900 font-semibold border-b-2 border-blue-900">
                    Produk Lengkap
                </a>
            </div>
        </div>

        <!-- FILTER -->
        <div class="bg-white shadow px-6 py-4">
            <form method="GET" class="flex justify-between items-center flex-wrap gap-4">

                <!-- FILTER LEFT -->
                <div class="flex flex-wrap items-center gap-3">
                    <label class="text-gray-700 pt-1 text-sm">Filter berdasarkan :</label>

                    <select name="kategori" onchange="this.form.submit()" class="border rounded px-3 py-2 text-sm">
                        <option value="all">Semua Kategori</option>
                        <option value="Pakaian">Pakaian</option>
                        <option value="Makanan">Makanan</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Kesehatan">Kesehatan</option>
                        <option value="Olahraga">Olahraga</option>
                    </select>

                    <select name="rating" onchange="this.form.submit()" class="border rounded px-3 py-2 text-sm">
                        <option value="all">Semua Rating</option>
                        <option value="5">5 Bintang</option>
                        <option value="4">4 Bintang</option>
                        <option value="3">3 Bintang</option>
                        <option value="2">2 Bintang</option>
                        <option value="1">1 Bintang</option>
                    </select>

                    <select name="harga" onchange="this.form.submit()" class="border rounded px-3 py-2 text-sm">
                        <option value="all">Semua Harga</option>
                        <option value="<50000">< Rp 50.000</option>
                        <option value="50-100">Rp 50.000 - Rp 100.000</option>
                        <option value="100-500">Rp 100.000 - Rp 500.000</option>
                        <option value=">500">> Rp 500.000</option>
                    </select>
                </div>

                <!-- BUTTON RIGHT -->
                <button class="flex items-center space-x-2 bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600">
                    <i class="fas fa-download"></i>
                    <span>Unduh PDF</span>
                </button>
            </form>
        </div>

        <!-- TABLE -->
        <div class="bg-white shadow rounded-b-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700 w-12">
                            <input type="checkbox" class="w-4 h-4">
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Produk</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Kategori</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Harga</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Stok</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Rating</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Penjual</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50 transition-colors">

                            <td class="px-6 py-4 text-center">
                                <input type="checkbox" class="w-4 h-4">
                            </td>

                            <td class="px-6 py-4 text-gray-800 font-medium">
                                {{ $product->name }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $product->category->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $product->stock }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ $product->rating }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ $product->user->name ?? 'Penjual Tidak Ditemukan' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-500">
                                Tidak ada produk ditemukan.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-white px-6 py-4 border-t">
                {{ $products->links() }}
            </div>
        </div>

    </main>
</div>

</body>
</html>
