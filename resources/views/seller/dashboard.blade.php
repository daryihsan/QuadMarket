@php
// Ambil variabel dari Controller. Jika null, berikan nilai default yang aman.
$activeTab = request()->query('tab', 'overview');

// Data dari SellerDashboardController
$totalProducts = $totalProducts ?? 0;
$salesThisMonth = $salesThisMonth ?? 'Rp 0';
$newOrders = $newOrders ?? 0;
$averageRating = $averageRating ?? 0;
$salesByCategory = $salesByCategory ?? [];
$locationData = $locationData ?? ['TotalOrders' => 0, 0 => ['Lokasi' => 'N/A', 'Persentase' => 0], 1 => ['Lokasi' => 'N/A', 'Persentase' => 0], 2 => ['Lokasi' => 'N/A', 'Persentase' => 0]];
$latestProducts = $latestProducts ?? collect([]);

// Data Produk Saya (dari Controller)
$productStats = $productStats ?? [
    'total_produk' => 0, 'produk_aktif' => 0, 'stok_habis' => 0, 'tidak_aktif' => 0
];
$products = $products ?? collect([]);
$allCategories = $allCategories ?? collect([]);

$summaryData = [
    (object)['title' => 'Total Produk', 'value' => $totalProducts, 'class' => 'text-blue-600'],
    (object)['title' => 'Penjualan Bulan Ini', 'value' => $salesThisMonth, 'class' => 'text-green-600'],
    (object)['title' => 'Pesanan Baru', 'value' => $newOrders, 'class' => 'text-yellow-600'],
    (object)['title' => 'Rating Rata-Rata', 'value' => $averageRating, 'class' => 'text-red-500'],
];

// Logika Edit Mode di Blade
$editMode = request()->query('mode') === 'edit' && $activeTab === 'addProduct';
$editProductData = [];

if ($editMode) {
    // Ambil data dari query string untuk mode edit
    $editProductData = [
        'id' => request()->query('id'),
        'name' => urldecode(request()->query('name')),
        'price' => request()->query('price'),
        'stock' => request()->query('stock'),
        'category_id' => request()->query('category_id'),
        'description' => urldecode(request()->query('description')),
        'image_path' => urldecode(request()->query('image_path')),
    ];
}
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjual | QuadMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --background-color: #f8f9fa;
            --card-background: #ffffff;
            --text-color: #212529;
            --border-color: #e9ecef;
            --active-status: #28a745;
            --inactive-status: #dc3545;
        }

        /* Menggunakan style dasar dari Quad.pdf */
        body { background-color: var(--background-color); color: var(--text-color); }
        .dashboard-container { display: flex; min-height: 100vh; }
        .sidebar { 
            width: 250px; background-color: var(--card-background); 
            padding: 20px; flex-direction: column; justify-content: space-between; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); flex-shrink: 0;
        }
        .main-content { 
            flex-grow: 1; 
            padding: 30px; 
            overflow-y: auto; 
        }
        .card { 
            background-color: var(--card-background); 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); 
        }
        
        /* Gaya Khusus Form */
        .form-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .action-footer {
            /* PENGATURAN UNTUK FOOTER STICKY */
            position: fixed; 
            bottom: 0;
            right: 0;
            left: 250px; /* Lebar Sidebar */
            padding: 15px 30px;
            background-color: var(--card-background);
            z-index: 50;
            border-top: 1px solid var(--border-color);
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }
        
        /* Gaya Sidebar dan Umum */
        .summary-card .card-title { display: block; font-size: 0.9em; color: var(--secondary-color); margin-bottom: 5px; }
        .summary-card .card-value { font-size: 2em; font-weight: 700; color: var(--text-color); }
        .status-badge { padding: 5px 10px; border-radius: 20px; font-size: 0.75em; font-weight: 700; display: inline-block; }
        .status-active { background-color: #d4edda; color: var(--active-status); }
        .status-inactive { background-color: #f8d7da; color: var(--inactive-status); }
        .nav-link.active { background-color: var(--background-color); color: var(--primary-color); font-weight: 500; }
        .logo-section { display: flex; align-items: center; padding-bottom: 30px; border-bottom: 1px solid var(--border-color); }
        .logo-icon { width: 30px; height: 30px; background-color: var(--primary-color); color: white; display: flex; align-items: center; justify-content: center; border-radius: 5px; font-weight: bold; margin-right: 10px; }
    </style>
</head>

<body>
    <div class="dashboard-container">
        {{-- SIDEBAR --}}
        <aside class="sidebar">
            <div class="logo-section mb-10">
                <div class="logo-icon">T</div>
                <div class="logo-text">
                    <strong class="text-lg">Totem</strong>
                    <span class="block text-xs text-gray-500">Semarang</span>
                </div>
            </div>

            <nav class="main-nav flex-grow">
                <ul>
                    <li class="mb-1 @if($activeTab === 'overview') active @endif">
                        <a href="{{ route('seller.dashboard', ['tab' => 'overview']) }}" class="nav-link flex items-center p-2 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                            <i class="fas fa-chart-line mr-3 text-lg"></i> Dashboard
                        </a>
                    </li>
                    <li class="mb-1 @if($activeTab === 'products' || $activeTab === 'addProduct') active @endif">
                        <a href="{{ route('seller.dashboard', ['tab' => 'products']) }}" class="nav-link flex items-center p-2 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                            <i class="fas fa-box-open mr-3 text-lg"></i> Produk
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="nav-link flex items-center p-2 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                            <i class="fas fa-shopping-cart mr-3 text-lg"></i> Pesanan
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="nav-link flex items-center p-2 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                            <i class="fas fa-users mr-3 text-lg"></i> Pelanggan
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="nav-link flex items-center p-2 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                            <i class="fas fa-file-alt mr-3 text-lg"></i> Laporan
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="settings-nav pt-4 border-t" style="border-color: var(--border-color);">
                <ul>
                    <li class="mb-1">
                        <a href="#" class="nav-link flex items-center p-2 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                            <i class="fas fa-cog mr-3 text-lg"></i> Pengaturan
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="#" class="nav-link flex items-center p-2 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                            <i class="fas fa-question-circle mr-3 text-lg"></i> Bantuan
                        </a>
                    </li>
                    <li class="mt-4">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left nav-link flex items-center p-2 rounded-lg hover:bg-red-50 text-red-600 transition">
                                <i class="fas fa-sign-out-alt mr-3 text-lg"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="main-content">
            <header class="header">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        @if ($activeTab === 'overview')
                            Dashboard Toko
                        @elseif ($activeTab === 'products')
                            Produk Saya
                        @elseif ($activeTab === 'addProduct')
                            @if ($editMode) Edit Produk @else Tambah Produk Baru @endif
                        @endif
                    </h1>
                    <p class="text-sm text-gray-500">
                        @if ($activeTab === 'overview')
                            Selamat Datang, Totem! Ini ringkasan performa tokomu.
                        @elseif ($activeTab === 'products')
                            Kelola semua produk yang Anda jual.
                        @elseif ($activeTab === 'addProduct')
                            @if ($editMode) Perbarui detail produk @else Lengkapi informasi produk yang akan dijual. @endif
                        @endif
                    </p>
                </div>
                <div class="text-2xl font-bold text-blue-500">QuadMarket</div>
            </header>
            
            {{-- ALERT MESSAGES --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">Terdapat kesalahan pada input form:</span>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {{-- 1. OVERVIEW SECTION (DASHBOARD) --}}
            <section id="overview-content" @if($activeTab !== 'overview') style="display: none;" @endif>
                <div class="grid grid-cols-4 gap-4 mb-8">
                    @foreach ($summaryData as $item)
                        <div class="card summary-card border border-gray-200">
                            <span class="card-title">{{ $item->title }}</span>
                            <strong class="card-value {{ $item->class }}">{{ $item->value }}</strong>
                        </div>
                    @endforeach
                </div>
                
                <div class="grid grid-cols-3 gap-8 mb-8">
                    <div class="card col-span-2">
                        <h3 class="text-xl font-semibold mb-4">Penjualan Berdasarkan Kategori</h3>
                        <div class="h-60">
                            <canvas id="salesBarChart"></canvas>
                        </div>
                    </div>
                    <div class="card">
                        <h3 class="text-xl font-semibold mb-4">Lokasi Pembeli</h3>
                        <div class="flex items-center justify-between">
                            <div class="relative w-36 h-36">
                                <canvas id="locationDoughnutChart"></canvas>
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <span class="text-2xl font-bold text-gray-800">{{ $locationData['TotalOrders'] ?? 0 }}</span>
                                    <span class="text-xs text-gray-500">Pesanan</span>
                                </div>
                            </div>
                            <ul class="legend text-sm space-y-2">
                                @php
                                    $chartColors = ['#dc3545', '#007bff', '#ccc']; 
                                @endphp
                                @foreach ($locationData as $key => $item)
                                    @if (is_numeric($key) && isset($item['Lokasi']))
                                        <li>
                                            <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color: {{ $chartColors[$key] }}"></span>
                                            {{ $item['Lokasi'] }} ({{ $item['Persentase'] }}%)
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="recent-products-section">
                    <h2 class="text-xl font-semibold mb-4">Daftar Produk Terbaru</h2>
                    <div class="table-responsive card p-0">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PRODUK</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KATEGORI</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">HARGA</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STOK</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                                </tr>
                            </thead>
                            <tbody id="latestProductTableBody" class="bg-white divide-y divide-gray-200">
                                {{-- Rendered by JS, using data from $latestProducts --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>


            {{-- 2. PRODUCTS SECTION (PRODUK SAYA - TABEL) --}}
            <section id="products-content" @if($activeTab !== 'products') style="display: none;" @endif>
                <div class="product-toolbar flex justify-between items-center mb-4">
                    <input type="text" placeholder="Cari Produk" class="p-2 border border-gray-300 rounded-lg w-1/3" oninput="filterProducts(this.value)">
                    <a href="{{ route('seller.dashboard', ['tab' => 'addProduct']) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg flex items-center transition">
                        <i class="fas fa-plus mr-2"></i> Tambah Produk
                    </a>
                </div>
                
                <div class="grid grid-cols-4 gap-4 mb-8">
                    @foreach ($productStats as $key => $value)
                        <div class="card summary-card border border-gray-200">
                            <span class="card-title">{{ str_replace('_', ' ', strtoupper($key)) }}</span>
                            <strong class="card-value">{{ number_format($value) }}</strong>
                        </div>
                    @endforeach
                </div>

                <div class="card p-0">
                    <div class="product-table-wrapper overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PRODUK</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KATEGORI</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">HARGA</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STOK</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">AKSI</th>
                                </tr>
                            </thead>
                            <tbody id="productTableBody" class="bg-white divide-y divide-gray-200">
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                            <img src="{{ Str::startsWith($product->image_path, '/') ? $product->image_path : Storage::url($product->image_path) }}"
                                                onerror="this.onerror=null;this.src='https://via.placeholder.com/40';"
                                                alt="{{ $product->name }}" class="w-10 h-10 object-cover rounded-md mr-3 bg-gray-100">
                                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $product->category->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $product->stock }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $status = $product->status ?? ($product->stock > 0 ? 'Aktif' : 'NonAktif'); 
                                                $statusClass = $status === 'Aktif' ? 'status-active' : 'status-inactive';
                                            @endphp
                                            <span class="status-badge {{ $statusClass }}">
                                                {{ $status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="editProduct({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, {{ $product->stock }}, '{{ $product->category_id }}', '{{ $product->image_path ?? '' }}', '{{ $product->description ?? '' }}')"
                                                class="text-blue-600 hover:text-blue-900 transition mr-2">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button onclick="deleteProductAction({{ $product->id }})"
                                                class="text-red-600 hover:text-red-900 transition">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada produk ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-footer flex justify-between items-center p-4 border-t border-gray-200">
                        {{ $products->appends(request()->except('page'))->links() }} 
                    </div>
                </div>
            </section>


            {{-- 3. ADD/EDIT PRODUCT SECTION (FORM) --}}
            <section id="add-product-content" @if($activeTab !== 'addProduct') style="display: none;" @endif>
                <div class="w-full max-w-4xl mx-auto"> 
                    
                    {{-- Navigasi Kembali --}}
                    <a href="{{ route('seller.dashboard', ['tab' => 'products']) }}" class="flex items-center text-gray-600 hover:text-blue-600 mb-6 transition duration-150">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Produk
                    </a>
                    
                    <form id="add-product-form" 
                          action="{{ $editMode ? route('seller.products.update', $editProductData['id']) : route('seller.products.store') }}" 
                          method="POST"
                          enctype="multipart/form-data"> 
                        @csrf
                        {{-- Method Spoofing untuk Edit --}}
                        @if ($editMode)
                           @method('PUT')
                        @endif
                        
                        {{-- Foto Produk Card --}}
                        <div class="card mb-6">
                            <h2 class="text-xl font-semibold mb-4 border-b pb-3 border-gray-200">Foto Produk</h2>
                            <div class="photo-upload-area border-2 border-dashed border-gray-300 rounded-lg p-12 text-center text-gray-500 cursor-pointer hover:border-blue-500 transition-colors">
                                <i class="fas fa-cloud-upload-alt text-3xl mb-2"></i>
                                <div class="upload-text font-medium">Klik untuk mengunggah atau seret dan lepas</div>
                                <small class="block mt-2">Format: JPG, PNG. Maksimal 5 foto. Foto pertama akan menjadi foto utama.</small>
                                
                                <input type="file" multiple accept=".jpg,.jpeg,.png" style="display: none;" name="foto_produk_files[]">
                                
                            </div>
                            @if ($editMode && $editProductData['image_path'])
                                <input type="hidden" id="product-image_path-input" name="image_path" value="{{ $editProductData['image_path'] }}">
                            @endif
                        </div>

                        {{-- Informasi Produk Card --}}
                        <div class="card mb-6">
                            <h2 class="text-xl font-semibold mb-4 border-b pb-3 border-gray-200">Informasi Produk</h2>
                            <div class="space-y-4">
                                
                                {{-- 1. NAMA PRODUK --}}
                                <div>
                                    <label for="product-name-input" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                                    <input type="text" id="product-name-input" name="name" required class="form-input" 
                                           placeholder="Contoh: Buku Panduan Skripsi" 
                                           value="{{ $editMode ? $editProductData['name'] : '' }}">
                                </div>
                                
                                {{-- 2. DESKRIPSI --}}
                                <div>
                                    <label for="product-description-input" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                    <textarea id="product-description-input" name="description" rows="4" class="form-input" 
                                              placeholder="Jelaskan produk Anda secara detail...">{{ $editMode ? $editProductData['description'] : '' }}</textarea>
                                </div>
                                
                                {{-- 3. KONDISI dan MINIMAL PEMESANAN (DUA KOLOM) --}}
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="product-kondisi" class="block text-sm font-medium text-gray-700">Kondisi</label>
                                         <select id="product-kondisi" name="kondisi" class="form-input">
                                            <option value="" @if(!$editMode || ($editMode && ($editProductData['kondisi'] ?? '') === '')) selected @endif>Pilih kondisi barang</option>
                                            <option value="baru" @if($editMode && ($editProductData['kondisi'] ?? '') === 'baru') selected @endif>Baru</option>
                                            <option value="bekas" @if($editMode && ($editProductData['kondisi'] ?? '') === 'bekas') selected @endif>Bekas</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="product-min_order" class="block text-sm font-medium text-gray-700">Minimal Pemesanan</label>
                                        <input type="number" id="product-min_order" name="min_order" 
                                               value="{{ $editMode ? ($editProductData['min_order'] ?? 1) : 1 }}" min="1" class="form-input">
                                    </div>
                                </div>

                                {{-- 4. KATEGORI (POSISI AKHIR, JAUH DARI DESKRIPSI) --}}
                                <div>
                                    <label for="product-category-input" class="block text-sm font-medium text-gray-700">Kategori</label>
                                    <select id="product-category-input" name="category_id" required class="form-input">
                                        <option value="">Pilih salah satu</option>
                                        @foreach ($allCategories as $category)
                                            <option value="{{ $category->id }}"
                                                    @if($editMode && $editProductData['category_id'] == $category->id) selected @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Harga & Stok Card --}}
                        <div class="card mb-6">
                            <h2 class="text-xl font-semibold mb-4 border-b pb-3 border-gray-200">Harga & Stok</h2>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="product-price-input" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                                    <input type="number" id="product-price-input" name="price" required min="0" class="form-input" 
                                           placeholder="0" value="{{ $editMode ? $editProductData['price'] : '' }}">
                                </div>
                                <div>
                                    <label for="product-stock-input" class="block text-sm font-medium text-gray-700">Stok Barang</label>
                                    <input type="number" id="product-stock-input" name="stock" required min="0" class="form-input" 
                                           placeholder="0" value="{{ $editMode ? $editProductData['stock'] : '' }}">
                                </div>
                            </div>
                        </div>

                        {{-- Varian Produk Card --}}
                        <div class="card mb-6">
                            <div class="flex justify-between items-center mb-2 border-b pb-3 border-gray-200">
                                <h2 class="text-xl font-semibold">Varian Produk</h2>
                                <button type="button" class="bg-blue-500 text-white px-3 py-1.5 rounded-lg text-sm hover:bg-blue-600 transition">
                                    <i class="fas fa-plus mr-1"></i> Tambah Varian
                                </button>
                            </div>
                            <p class="text-sm text-gray-500 mb-4">(Opsional)</p>
                            <div class="text-sm text-gray-500">
                                Belum ada varian. Klik Tambah Varian untuk menambahkan varian seperti ukuran, warna, dll.
                            </div>
                        </div>
                        
                        {{-- Placeholder untuk sticky footer --}}
                        <div style="height: 100px;"></div>
                        
                        {{-- Sticky Footer/Action Bar --}}
                        <div class="action-footer">
                            <a href="{{ route('seller.dashboard', ['tab' => 'products']) }}" class="cancel-btn px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-200 transition">Batal</a>
                            <button type="submit" class="save-btn px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                                {{ $editMode ? 'Simpan Perubahan' : 'Simpan Produk' }}
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
    
    {{-- DELETE FORM HIDDEN --}}
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            renderSalesBarChart();
            renderLocationDoughnutChart();
            renderLatestProductTable();
            handleEditMode();
            
            // START SCRIPT UPLOAD SIMULASI
            const uploadArea = document.querySelector('.photo-upload-area');
            const fileInput = uploadArea ? uploadArea.querySelector('input[name="foto_produk_files[]"]') : null;

            if (uploadArea && fileInput) {
                // 1. Tambahkan class 'upload-text' ke elemen yang menampilkan teks
                const statusElement = uploadArea.querySelector('.font-medium');
                if (statusElement) statusElement.classList.add('upload-text');

                // 2. Klik area upload
                uploadArea.addEventListener('click', (e) => {
                    if (e.target !== fileInput) {
                         fileInput.click();
                    }
                });
                
                // 3. Mencegah default drag/drop behavior
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                // 4. Handle highlight
                ['dragenter', 'dragover'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, () => {
                        uploadArea.style.borderColor = '#007bff';
                    }, false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, () => {
                        uploadArea.style.borderColor = '#e9ecef';
                    }, false);
                });
                
                // 5. Handle file drop/change
                fileInput.addEventListener('change', (e) => handleFiles(e.target.files));
                uploadArea.addEventListener('drop', (e) => {
                    const dt = e.dataTransfer;
                    const files = dt.files;
                    handleFiles(files);
                });

                function handleFiles(files) {
                    const statusTextElement = uploadArea.querySelector('.upload-text');
                    if (files.length > 0) {
                        statusTextElement.innerHTML = `<span style="color: green; font-weight: bold;">${files.length} file dipilih!</span>`;
                        uploadArea.style.borderColor = 'green';
                    } else {
                        statusTextElement.innerHTML = `Klik untuk mengunggah atau seret dan lepas`;
                        uploadArea.style.borderColor = '#e9ecef';
                    }
                }
            }
            // END SCRIPT UPLOAD SIMULASI
        });
        
        function handleEditMode() {
            const urlParams = new URLSearchParams(window.location.search);
            const form = document.getElementById('add-product-form');

            if (urlParams.get('tab') === 'addProduct' && urlParams.get('mode') === 'edit') {
                const id = urlParams.get('id');
                
                // 1. Update Form Data
                document.getElementById('product-id-input').value = id;
                document.getElementById('product-name-input').value = decodeURIComponent(urlParams.get('name') || '');
                document.getElementById('product-price-input').value = urlParams.get('price') || 0;
                document.getElementById('product-stock-input').value = urlParams.get('stock') || 0;
                document.getElementById('product-category-input').value = urlParams.get('category_id') || '';
                document.getElementById('product-description-input').value = decodeURIComponent(urlParams.get('description') || '');
                document.getElementById('product-image_path-input').value = decodeURIComponent(urlParams.get('image_path') || '');
                
                // 2. Update Form Action URL
                form.action = `/seller/products/${id}/update`;
                document.querySelector('input[name="_method"]').value = 'PUT';
                
                // 3. Update Text/Tampilan
                document.querySelector('.save-btn').textContent = 'Simpan Perubahan';
            } else {
                 // Pastikan untuk mode Add, action URL dan method benar
                form.action = "{{ route('seller.products.store') }}";
                document.querySelector('input[name="_method"]').value = 'POST';
                document.querySelector('.save-btn').textContent = 'Simpan Produk';
            }
        }
        
        function editProduct(id, name, price, stock, category_id, image_path, description) {
            // Encode URI Components untuk string
            const encodedName = encodeURIComponent(name);
            const encodedDescription = encodeURIComponent(description);
            const encodedImagePath = encodeURIComponent(image_path);

            // Ganti tampilan ke form Tambah Produk dengan parameter mode=edit
            window.location.href = "{{ route('seller.dashboard', ['tab' => 'addProduct']) }}" + 
                                   `&mode=edit&id=${id}&name=${encodedName}&price=${price}&stock=${stock}&category_id=${category_id}&image_path=${encodedImagePath}&description=${encodedDescription}`;
        }

        function deleteProductAction(id) {
            const routeUrl = `/seller/products/${id}`;
            if (confirm('Yakin ingin menghapus Produk ID: ' + id + '?')) {
                const form = document.getElementById('delete-form');
                form.action = routeUrl;
                form.submit();
            }
        }
        
        

        // =========================================================
        // LOGIKA CHART & DATA DISPLAY
        // =========================================================
        
        function renderSalesBarChart() {
            const data = @json($salesByCategory);
            if (data.length === 0) return;
            const labels = data.map(item => item.Kategori);
            const values = data.map(item => item.Penjualan);

            const ctx = document.getElementById('salesBarChart');
            if (!ctx) return;

            new Chart(ctx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: '#007bff', 
                        borderRadius: 5,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true }
                    },
                    scales: {
                        y: { beginAtZero: true, display: false, grid: { display: false } },
                        x: { ticks: { font: { size: 10 } } }
                    },
                    layout: { padding: { top: 0 } }
                }
            });
        }

        function renderLocationDoughnutChart() {
            const data = @json($locationData);
            const distributions = [
                { wilayah: 'Sumatra Selatan', persentase: (data[0].Persentase ?? 0) / 100, warna: '#dc3545' },
                { wilayah: 'Jawa Tengah', persentase: (data[1].Persentase ?? 0) / 100, warna: '#007bff' },
                { wilayah: 'Lainnya', persentase: (data[2].Persentase ?? 0) / 100, warna: '#ccc' }
            ];

            const ctx = document.getElementById('locationDoughnutChart');
            if (!ctx) return;

            new Chart(ctx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: distributions.map(item => item.wilayah),
                    datasets: [{
                        data: distributions.map(item => item.persentase * 100),
                        backgroundColor: distributions.map(item => item.warna),
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '80%', 
                    plugins: {
                        legend: { display: false },
                        tooltip: { callbacks: {
                            label: (context) => {
                                const label = context.label || '';
                                const value = context.parsed;
                                return `${label}: ${value}%`;
                            }
                        } }
                    }
                }
            });
        }

        function renderLatestProductTable() {
            const products = @json($latestProducts);
            const tbody = document.getElementById('latestProductTableBody');
            if (!tbody) return;

            const rows = products.map(product => {
                const statusClass = product.status === "Aktif" ? "status-active" : "status-inactive";
                const imageSrc = product.image_path || `https://via.placeholder.com/40x40?text=P${product.id}`;
                
                return `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img src="${imageSrc}" alt="${product.name}" class="w-10 h-10 object-cover rounded-md mr-3 bg-gray-100">
                                <div class="text-sm font-medium text-gray-900">${product.name}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Elektronik</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Rp ${product.price.toLocaleString('id-ID')}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${product.stock}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="status-badge ${statusClass}">${product.status}</span>
                        </td>
                    </tr>
                `;
            }).join('');
            tbody.innerHTML = rows;
        }

        // Simulasikan filter produk
        function filterProducts(searchTerm) {
            const rows = document.getElementById('productTableBody').getElementsByTagName('tr');
            const search = searchTerm.toLowerCase();

            for (let i = 0; i < rows.length; i++) {
                const productCell = rows[i].getElementsByTagName('td')[0];
                if (productCell) {
                    const productName = productCell.textContent.toLowerCase();
                    if (productName.includes(search)) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>