<?php
use Illuminate\Support\Str;
// Variabel yang dikirim dari CatalogController: $trendingProducts, $categories

// 1. Ambil 6 kategori teratas
$visibleCategories = $categories->take(6); 
// 2. Tentukan kategori yang akan menjadi ikon "Lihat Semua" (kategori ke-7)
//    Jika ada kategori ke-7, ambil ikonnya. Jika tidak ada, gunakan fallback default.
$nextCategory = $categories->get(6); // Mengambil elemen pada index 6 (kategori ke-7)

$allCategoriesIcon = $nextCategory->icon_path ?? asset('assets/images/kategori-lainnya.jpg');

// Jika kategori ke-7 tidak ada atau tidak punya ikon, gunakan ikon kategori pertama (sebagai secondary fallback)
if (!$nextCategory || !$nextCategory->icon_path) {
    $firstVisibleCategory = $categories->where('icon_path', '!=', null)->first();
    $allCategoriesIcon = $firstVisibleCategory->icon_path ?? asset('assets/images/kategori-lainnya.jpg');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda QuadMarket</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        html, body {
            font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif;
        }
        .category-card, .product-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            cursor: pointer;
        }
        .category-card:hover, .product-card:hover {
            transform: translateY(-5px); 
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); 
        }
        .hero-section {
            min-height: 400px;
            background-color: #e6f1f8;
            /* GANTI path gambar hero-bg.png dengan path gambar produk background Anda */
            background-image: url('assets/images/hero.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .hero-search-input:focus {
            outline: none;
            box-shadow: none;
            border-color: transparent;
        }
    </style>
</head>
<body class="bg-gray-50">
    <?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <section class="hero-section text-center pt-20 pb-28 flex flex-col items-center justify-center">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-4">
                Temukan Jutaan Produk Terbaik
            </h1>
            <p class="text-lg text-gray-600 mb-10">
                Jelajahi berbagai kategori dan temukan barang impian Anda dengan harga terbaik
            </p>
            <div class="max-w-xl mx-auto">
                <div class="relative flex items-center bg-white p-2 rounded-xl shadow-lg">
                    <input type="text" placeholder="Cari Produk..." class="hero-search-input flex-grow pl-4 pr-4 py-3 border-none rounded-xl text-gray-700">
                    <button class="bg-blue-600 text-white font-semibold py-3 px-8 rounded-xl hover:bg-blue-700 transition duration-150 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span class="hidden sm:inline">Cari Sekarang</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
    
    
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 z-10 relative">
        <div class="grid grid-cols-3 sm:grid-cols-7 gap-4 sm:gap-6 bg-white p-4 sm:p-8 rounded-2xl shadow-xl">
            
            
            <?php $__currentLoopData = $visibleCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('katalog', ['kategori' => $category->name])); ?>" class="category-card flex flex-col items-center text-center p-2 sm:p-3 hover:shadow-xl rounded-lg">
                
                <img src="<?php echo e($category->icon_path ?? asset('assets/images/kategori-placeholder.jpg')); ?>" 
                    alt="<?php echo e($category->name); ?>" 
                    class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg mb-2"
                    onerror="this.onerror=null;this.src='<?php echo e(asset('assets/images/kategori-placeholder.jpg')); ?>';"
                >
                <span class="text-xs sm:text-sm font-medium text-gray-700"><?php echo e($category->name); ?></span>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <a href="<?php echo e(route('katalog')); ?>" class="category-card flex flex-col items-center text-center p-2 sm:p-3 hover:shadow-xl rounded-lg">
                
                <img src="<?php echo e($allCategoriesIcon); ?>" 
                    alt="Lihat Semua" 
                    class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg mb-2"
                    onerror="this.onerror=null;this.src='<?php echo e(asset('assets/images/kategori-lainnya.jpg')); ?>';"
                >
                <span class="text-xs sm:text-sm font-medium text-gray-700">Lihat Semua</span>
            </a>

        </div>
    </section>
    
    
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-16">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6">Produk yang Sedang Tren</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 lg:gap-6">
            
            <?php $__empty_1 = true; $__currentLoopData = $trendingProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('product.detail', ['id' => $product->id])); ?>" class="product-card block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl">
                
                <img src="<?php echo e($product->image_path ?? asset('assets/images/placeholder.png')); ?>" 
                    alt="<?php echo e($product->name); ?>" 
                    class="w-full h-40 object-cover"
                    onerror="this.onerror=null;this.src='<?php echo e(asset('assets/images/placeholder.png')); ?>';">
                
                <div class="p-4">
                    <p class="text-sm font-medium text-gray-800 truncate mb-1"><?php echo e($product->name); ?></p>
                    <div class="flex items-center mb-2 text-xs">
                        <span class="font-semibold text-yellow-500 mr-1"> ⭐  <?php echo e(number_format($product->rating, 1)); ?></span>
                        <span class="text-gray-500">(<?php echo e(number_format($product->total_ulasan)); ?>)</span>
                    </div>
                    
                    <p class="text-lg font-bold text-gray-900">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></p>
                    <div class="text-right">
                        
                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full"> 📍  <?php echo e($product->user->kabupaten ?? 'N/A'); ?></span>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="col-span-5 text-center text-gray-500">Tidak ada produk yang sedang tren saat ini.</p>
            <?php endif; ?>
        </div>
    </section>
    <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\PPL QUADMARKET\QuadMarket\resources\views/home.blade.php ENDPATH**/ ?>