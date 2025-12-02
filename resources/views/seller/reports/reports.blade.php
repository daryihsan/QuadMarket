@php
// Data yang dikirim dari ReportController
$activeReportTab = $activeReportTab ?? 'rating';
$categories = $categories ?? collect([]);
$reportData = $reportData ?? collect([]);

// DATA TOKO DARI USER LOGIN (sama logika dengan dashboard)
$user = auth()->user();
$storeName    = $user->nama_toko ?? 'Nama Toko';
$storeInitial = mb_substr($storeName, 0, 1, 'UTF-8');
$storeCity    = $user->kabupaten ?? 'Semarang';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjual | QuadMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #007bff; --secondary-color: #6c757d; --background-color: #f8f9fa;
            --card-background: #ffffff; --text-color: #212529; --border-color: #e9ecef;
            --active-status: #28a745; --inactive-status: #dc3545; --warn-status: #ffc107;
        }
        body { background-color: var(--background-color); color: var(--text-color); font-family: 'Inter', sans-serif; }
        .dashboard-container { display: flex; min-height: 100vh; }
        .sidebar { 
            width: 250px; 
            background-color: var(--card-background); 
            padding: 20px; 
            display: flex; 
            flex-direction: column; 
            justify-content: space-between; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); 
            flex-shrink: 0; 
        }
        .main-content { flex-grow: 1; padding: 30px; overflow-y: auto; }
        .card { background-color: var(--card-background); padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); }
        .nav-link.active { background-color: var(--background-color); color: var(--primary-color); font-weight: 500; }
        .tab-link { padding: 10px 15px; border-bottom: 3px solid transparent; font-weight: 500; cursor: pointer; transition: all 0.2s; }
        .tab-link.active { color: var(--primary-color); border-bottom-color: var(--primary-color); }
        .status-badge { padding: 5px 10px; border-radius: 20px; font-size: 0.75em; font-weight: 700; display: inline-block; }
        .status-aman { background-color: #d4edda; color: var(--active-status); }
        .status-hampir-habis { background-color: #fff3cd; color: #856404; }
        .status-habis { background-color: #f8d7da; color: var(--inactive-status); }
        .action-icon:hover { color: var(--primary-color); }
        .logo-section { display: flex; align-items: center; padding-bottom: 30px; border-bottom: 1px solid var(--border-color); }
        .logo-icon { width: 30px; height: 30px; background-color: var(--primary-color); color: white; display: flex; align-items: center; justify-content: center; border-radius: 5px; font-weight: bold; margin-right: 10px; }
        .settings-nav .nav-link { transition: all 0.2s; }
        .settings-nav .nav-link:hover { background-color: #f8d7da; color: var(--inactive-status); } 
    </style>
</head>
<body>
    <div class="dashboard-container">
        {{-- SIDEBAR --}}
        <aside class="sidebar">
            <div> {{-- Container untuk Logo dan Navigasi --}}
                <div class="logo-section mb-10">
                    <div class="logo-icon">
                        {{ $storeInitial }}
                    </div>
                    <div class="logo-text">
                        <strong class="text-lg">{{ $storeName }}</strong>
                        <span class="block text-xs text-gray-500">{{ $storeCity }}</span>
                    </div>
                </div>
                <nav class="main-nav">
                    <ul>
                        <li class="mb-1">
                            <a href="{{ route('seller.dashboard', ['tab' => 'overview']) }}" class="nav-link flex items-center p-2 rounded-lg text-gray-700">
                                <i class="fas fa-chart-line mr-3 text-lg text-gray-500"></i> Dashboard
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="{{ route('seller.dashboard', ['tab' => 'products']) }}" class="nav-link flex items-center p-2 rounded-lg text-gray-700">
                                <i class="fas fa-box-open mr-3 text-lg text-gray-500"></i> Produk
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="{{ route('seller.reports.index') }}" class="nav-link flex items-center p-2 rounded-lg text-gray-700 active">
                                <i class="fas fa-file-alt mr-3 text-lg text-gray-500"></i> Laporan
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            
            {{-- TOMBOL KELUAR --}}
            <div class="settings-nav pt-4 border-t" style="border-color: var(--border-color);">
                <ul>
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
            <header class="header flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        @if ($activeReportTab === 'rating')
                            Laporan Rating
                        @elseif ($activeReportTab === 'stock')
                            Laporan Stok
                        @elseif ($activeReportTab === 'low_stock')
                            Laporan Peringatan Stok Rendah
                        @endif
                    </h1>
                    <p class="text-sm text-gray-500">
                        @if ($activeReportTab === 'low_stock')
                            Daftar produk dengan stok kurang dari atau sama dengan 2 unit.
                        @else
                            Kelola dan unduh laporan performa produk Anda.
                        @endif
                    </p>
                </div>
                {{-- Unduh PDF --}}
                <a href="{{ route('seller.reports.download', array_merge(request()->all(), ['type' => $activeReportTab])) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg flex items-center transition">
                    <i class="fas fa-download mr-2"></i> Unduh PDF
                </a>
            </header>

            {{-- TAB NAVIGATION --}}
            <div class="flex border-b border-gray-200 mb-6">
                <a href="{{ route('seller.reports.index', ['report_tab' => 'rating']) }}" class="tab-link @if($activeReportTab === 'rating') active @endif">Laporan Rating</a>
                <a href="{{ route('seller.reports.index', ['report_tab' => 'stock']) }}" class="tab-link @if($activeReportTab === 'stock') active @endif">Laporan Stok</a>
                <a href="{{ route('seller.reports.index', ['report_tab' => 'low_stock']) }}" class="tab-link @if($activeReportTab === 'low_stock') active @endif">Laporan Peringatan Stok Rendah</a>
            </div>

            <div class="card p-0">
                @if ($activeReportTab === 'rating')
                    {{-- 1. Laporan Rating --}}
                    <div class="filter-bar p-4 flex gap-4 items-center border-b border-gray-200">
                        <form method="GET" class="flex gap-4 items-center" action="{{ route('seller.reports.index') }}">
                            <input type="hidden" name="report_tab" value="rating">
                            <select name="category_id" class="p-2 border border-gray-300 rounded-lg">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if(request('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <select name="rating_min" class="p-2 border border-gray-300 rounded-lg">
                                <option value="1" @if(request('rating_min') == 1) selected @endif>Rating Min: 1</option>
                                <option value="3" @if(request('rating_min') == 3) selected @endif>Rating Min: 3</option>
                            </select>
                            <select name="rating_max" class="p-2 border border-gray-300 rounded-lg">
                                <option value="5" @if(request('rating_max') == 5) selected @endif>Rating Max: 5</option>
                            </select>
                            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg transition">Terapkan</button>
                        </form>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PRODUK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">RATING RATA-RATA</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TOTAL ULASAN</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($reportData as $product)
                                <tr>
                                    <td class="px-6 py-4"><input type="checkbox"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ $product->image_path ?? 'https://via.placeholder.com/40x40?text=P' }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-md mr-3 bg-gray-100">
                                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="text-yellow-500 flex items-center">
                                            @php $rating = $product->rating ?? 0; @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star text-xs @if($i <= floor($rating)) text-yellow-500 @else text-gray-300 @endif"></i>
                                            @endfor
                                            <span class="ml-1">{{ number_format($rating, 1) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ number_format($product->total_ulasan ?? 0) }}
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data rating produk.</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                @elseif ($activeReportTab === 'stock')
                    {{-- 2. Laporan Stok --}}
                    <div class="filter-bar p-4 flex gap-4 items-center border-b border-gray-200">
                        <form method="GET" class="flex gap-4 items-center" action="{{ route('seller.reports.index') }}">
                            <input type="hidden" name="report_tab" value="stock">
                            <input type="text" name="search" placeholder="Cari Produk" class="p-2 border border-gray-300 rounded-lg w-64" value="{{ request('search') }}">
                            <select name="category_id" class="p-2 border border-gray-300 rounded-lg">
                                <option value="">Filter Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if(request('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <select name="sort" class="p-2 border border-gray-300 rounded-lg">
                                <option value="stock_desc">Urutan Stok (Default)</option>
                                <option value="stock_desc" @if(request('sort') == 'stock_desc') selected @endif>Stok Terbanyak</option>
                                <option value="stock_asc" @if(request('sort') == 'stock_asc') selected @endif>Stok Tersedikit</option>
                            </select>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">Terapkan</button>
                        </form>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PRODUK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KATEGORI</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">HARGA</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STOK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">RATING</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($reportData as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><input type="checkbox"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ $product->image_path ?? 'https://via.placeholder.com/40x40?text=P' }}" alt="{{ $product->name }}" class="w-10 h-10 object-cover rounded-md mr-3 bg-gray-100">
                                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->category->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->stock }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($product->rating ?? 0, 1) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data stok produk.</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                @elseif ($activeReportTab === 'low_stock')
                    {{-- 3. Laporan Peringatan Stok Rendah --}}
                    <div class="filter-bar p-4 flex justify-between items-center border-b border-gray-200">
                        <form method="GET" class="flex gap-4 items-center" action="{{ route('seller.reports.index') }}">
                            <input type="hidden" name="report_tab" value="low_stock">
                            <input type="text" name="search" placeholder="Cari Produk" class="p-2 border border-gray-300 rounded-lg w-64" value="{{ request('search') }}">
                            <select name="category_id" class="p-2 border border-gray-300 rounded-lg">
                                <option value="">Filter Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if(request('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">Terapkan</button>
                        </form>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PRODUK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KATEGORI</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">HARGA</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STOK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($reportData as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><input type="checkbox"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ $product->image_path ?? 'https://via.placeholder.com/40x40?text=P' }}" alt="{{ $product->name }}" class="w-10 h-10 object-cover rounded-md mr-3 bg-gray-100">
                                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->category->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->stock }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $stockStatus = $product->stock === 0 ? 'Stok Habis' : ($product->stock <= 2 ? 'Stok Hampir Habis' : 'Stok Aman');
                                            $statusClass = $product->stock === 0 ? 'status-habis' : ($product->stock <= 2 ? 'status-hampir-habis' : 'status-aman');
                                        @endphp
                                        <span class="status-badge {{ $statusClass }}">
                                            {{ $stockStatus }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="editProduct({{ $product->id }})" class="text-blue-600 hover:text-blue-900 transition mr-2 action-icon"><i class="fas fa-pencil-alt"></i></button>
                                        <button onclick="deleteProductAction({{ $product->id }})" class="text-red-600 hover:text-red-900 transition action-icon"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada produk dengan stok rendah.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                @endif

                <div class="table-footer flex justify-between items-center p-4 border-t border-gray-200">
                    <div>Menampilkan {{ $reportData->firstItem() ?? 0 }} sampai {{ $reportData->lastItem() ?? 0 }} dari {{ $reportData->total() }} hasil</div>
                    {{ $reportData->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </main>
    </div>

    {{-- Scripts untuk edit/delete action di laporan --}}
    <script>
        function editProduct(id) {
            window.location.href = "{{ route('seller.dashboard', ['tab' => 'addProduct']) }}" + `&mode=edit&id=${id}`;
        }
        function deleteProductAction(id) {
            const routeUrl = "{{ route('seller.products.destroy', ['product' => '__ID__']) }}";
            const finalRouteUrl = routeUrl.replace('__ID__', id);
            
            if (confirm('Yakin ingin menghapus produk ini?')) {
                const form = document.getElementById('delete-form');
                if (form) {
                    form.action = finalRouteUrl;
                    form.submit();
                }
            }
        }
    </script>
</body>
</html>