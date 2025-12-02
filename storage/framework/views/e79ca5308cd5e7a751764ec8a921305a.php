<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>QuadMarket - <?php echo e($product->name ?? 'Detail Produk'); ?></title>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>

    
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <style>
        html, body {
            font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

    
    <?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php
        // Data Penjual (User)
        $seller = $product->user;
        // Data Kategori
        $categoryName = $product->category->name ?? 'Kategori';
        // Gambar utama
        $mainImageUrl = $product->image_path; 
        $fallbackUrl = asset('assets/images/placeholder.png');
        // Rating
        $rating = $product->rating ?? 0;
    ?>

    
    <div class="bg-white px-6 py-3 text-sm text-gray-600 border-b mt-2">
        <div class="max-w-7xl mx-auto">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-blue-600">Home</a> /
            <a href="<?php echo e(route('katalog', ['kategori' => $categoryName])); ?>" class="hover:text-blue-600"><?php echo e($categoryName); ?></a> /
            <span class="text-gray-800"><?php echo e($product->name ?? 'Detail Produk'); ?></span>
        </div>
    </div>

    
    <div class="max-w-7xl mx-auto px-4 lg:px-6 py-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 lg:p-8">

            
            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>
            <?php if($errors->any()): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">Terdapat kesalahan input form.</span>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10">

                
                <div>
                    
                    <div class="bg-white border rounded-2xl p-4 mb-4">
                        <img id="mainProductImage"
                             src="<?php echo e($mainImageUrl ?? $fallbackUrl); ?>"
                             alt="<?php echo e($product->name); ?>"
                             class="w-full rounded-xl object-cover max-h-[420px]"
                             onerror="this.src='<?php echo e($fallbackUrl); ?>'">
                    </div>

                    
                    <div class="grid grid-cols-5 gap-2 mb-6">
                        <?php for($i = 0; $i < 5; $i++): ?>
                            <img src="<?php echo e($mainImageUrl ?? $fallbackUrl); ?>"
                                 class="w-full h-20 object-cover rounded-xl border cursor-pointer hover:border-blue-500 hover:shadow-md transition-all"
                                 onclick="changeMainImage('<?php echo e($mainImageUrl ?? $fallbackUrl); ?>')"
                                 onerror="this.src='<?php echo e($fallbackUrl); ?>'">
                        <?php endfor; ?>
                    </div>

                    
                    <div class="border-b">
                        <div class="flex space-x-8">
                            <button id="tabDeskripsi"
                                    class="py-2 text-gray-800 font-semibold border-b-4 border-blue-600">
                                Deskripsi Produk
                            </button>
                            <button id="tabUlasan"
                                    class="py-2 text-gray-600 font-semibold border-b-4 border-transparent">
                                Ulasan Pembeli
                            </button>
                        </div>
                    </div>

                    
                    <div id="contentDeskripsi" class="mt-6">
                        <h3 class="font-bold text-lg mb-3">Spesifikasi</h3>
                        <p class="text-sm text-gray-700 leading-relaxed">
                            <?php echo e($product->description ?? 'Produk ini belum memiliki deskripsi.'); ?>

                        </p>

                        <div class="mt-8">
                            <h3 class="font-bold text-lg mb-4">Ulasan & Penilaian Pembeli</h3>
                            <div class="flex flex-col md:flex-row items-start md:items-center md:space-x-8 space-y-4 md:space-y-0">
                                <div class="text-center">
                                    
                                    <div class="text-5xl font-bold text-gray-800"><?php echo e(number_format($rating, 1)); ?></div>
                                    <div class="text-gray-600">/ 5.0</div>
                                    <div class="flex justify-center mt-2 text-yellow-400">
                                        
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <i class="fas fa-star" style="<?php echo e($i > $rating && $i - 1 < $rating ? 'opacity: 0.5;' : ''); ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    
                                    <div class="text-sm text-gray-600 mt-1">dari <?php echo e(number_format($product->total_ulasan ?? 0)); ?> ulasan</div>
                                </div>
                                <div class="flex-1 w-full">
                                    
                                    <?php $__currentLoopData = [5 => 147, 4 => 4, 3 => 2, 2 => 0, 1 => 0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $star => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="text-xs w-4 text-gray-700"><?php echo e($star); ?></span>
                                            <div class="flex-1 bg-gray-200 rounded-full h-2 overflow-hidden">
                                                <div class="bg-yellow-400 h-2 rounded-full"
                                                    style="width: <?php echo e([5=>96,4=>80,3=>40,2=>10,1=>5][$star] ?? 20); ?>%"></div>
                                            </div>
                                            <span class="text-xs w-10 text-right text-gray-700"><?php echo e($count); ?></span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                
                                <button id="openReviewModal" class="border-2 border-blue-600 text-blue-600 px-6 py-2 rounded-lg hover:bg-blue-50 text-sm font-medium">
                                    <i class="fas fa-edit mr-2"></i>Beri Ulasan
                                </button>
                            </div>
                        </div>
                    </div>

                    
                    <div id="contentUlasan" class="mt-6 hidden">
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
                            <div>
                                <h3 class="font-bold text-lg">Ulasan Pembeli</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-3xl font-bold mr-2"><?php echo e(number_format($rating, 1)); ?></span>
                                    <span class="text-gray-600">/ 5.0</span>
                                    <div class="flex text-yellow-400 ml-2">
                                        
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <i class="fas fa-star" style="<?php echo e($i > $rating && $i - 1 < $rating ? 'opacity: 0.5;' : ''); ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="text-sm text-gray-600 ml-2">(<?php echo e(number_format($product->total_ulasan ?? 0)); ?> ulasan)</span>
                                </div>
                            </div>
                            
                            <button id="openReviewModalUlasan" class="mt-4 md:mt-0 border-2 border-blue-600 text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 text-sm font-medium">
                                <i class="fas fa-edit mr-2"></i>Beri Ulasan
                            </button>
                        </div>

                        <div class="space-y-6">
                            
                            <?php $__empty_1 = true; $__currentLoopData = $product->reviews->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="border-t pt-4">
                                <div class="flex items-start space-x-3">
                                    
                                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($review->full_name)); ?>&background=2563EB&color=fff&size=40"
                                            class="w-10 h-10 rounded-full object-cover" alt="<?php echo e($review->full_name); ?>">
                                    <div>
                                        <div class="font-semibold"><?php echo e($review->full_name); ?></div>
                                        <div class="flex text-yellow-400 text-sm mb-2">
                                            
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star" style="<?php echo e($i > $review->rating ? 'opacity: 0.3;' : ''); ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <p class="text-sm text-gray-700">
                                            <?php echo e($review->review_text); ?>

                                        </p>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="p-4 text-center text-gray-500">Belum ada ulasan untuk produk ini. Jadilah yang pertama!</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                
                <div class="flex flex-col justify-start">
                    <h1 class="text-2xl sm:text-3xl font-bold text-blue-900 mb-3">
                        <?php echo e($product->name); ?>

                    </h1>

                    
                    <div class="flex items-center mb-3">
                        <div class="flex text-yellow-400 mr-2">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star" style="<?php echo e($i > $rating && $i - 1 < $rating ? 'opacity: 0.5;' : ''); ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <span class="font-semibold mr-1 text-sm"><?php echo e(number_format($rating, 1)); ?></span>
                        <span class="text-sm text-blue-600 cursor-pointer hover:underline">(<?php echo e(number_format($product->total_ulasan ?? 0)); ?> Ulasan)</span>
                    </div>

                    
                    <div class="text-3xl sm:text-4xl font-extrabold text-blue-900 mb-4">
                        Rp <?php echo e(number_format($product->price ?? 0, 0, ',', '.')); ?>

                    </div>

                    
                    <div class="text-sm text-gray-600 mb-6">
                        Stok: <?php echo e($product->stock ?? 0); ?>

                    </div>

                    
                    <div class="mb-6">
                        <label class="text-sm font-semibold mb-2 block">Jumlah:</label>
                        <div class="inline-flex items-center border rounded-lg overflow-hidden">
                            <button id="decreaseBtn" class="px-4 py-2 text-lg hover:bg-gray-100">-</button>
                            <input id="quantityInput"
                                   type="text"
                                   value="1"
                                   class="px-4 py-2 w-16 text-center text-sm border-x focus:outline-none">
                            <button id="increaseBtn" class="px-4 py-2 text-lg hover:bg-gray-100">+</button>
                        </div>
                    </div>

                    
                    <div class="border rounded-xl p-4 mb-4 flex items-start justify-between hover:shadow-md transition-all">
                        <div class="flex items-start space-x-3">
                            
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold">
                                <?php echo e(mb_substr($seller->nama_toko ?? 'Toko', 0, 2, 'UTF-8')); ?> 
                            </div>
                            <div>
                                
                                <h3 class="font-semibold text-base"><?php echo e($seller->nama_toko ?? 'Penjual Tidak Diketahui'); ?></h3>
                                
                                <p class="text-sm text-gray-600 flex items-center">
                                    <i class="fas fa-map-marker-alt mr-1 text-gray-500"></i> <?php echo e($seller->kabupaten ?? 'N/A'); ?>

                                </p>
                                
                                <p class="text-xs text-gray-500 mt-1 flex items-center">
                                    <i class="far fa-calendar mr-1"></i> Bergabung sejak 2025
                                </p>
                            </div>
                        </div>
                        <button class="hidden sm:inline-flex bg-blue-900 text-white px-4 py-2 rounded-lg text-xs font-medium hover:bg-blue-800">
                            <i class="far fa-comment mr-2"></i>Chat Penjual
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('ulasan', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    
    <script>
        function changeMainImage(imageUrl) {
            const mainImg = document.getElementById('mainProductImage');
            if (mainImg) mainImg.src = imageUrl;
        }

        const tabDeskripsi = document.getElementById('tabDeskripsi');
        const tabUlasan = document.getElementById('tabUlasan');
        const contentDeskripsi = document.getElementById('contentDeskripsi');
        const contentUlasan = document.getElementById('contentUlasan');

        tabDeskripsi.addEventListener('click', () => {
            tabDeskripsi.classList.add('border-blue-600', 'text-gray-900');
            tabUlasan.classList.remove('border-blue-600', 'text-gray-900');
            tabUlasan.classList.add('text-gray-600');
            contentDeskripsi.classList.remove('hidden');
            contentUlasan.classList.add('hidden');
        });

        tabUlasan.addEventListener('click', () => {
            tabUlasan.classList.add('border-blue-600', 'text-gray-900');
            tabDeskripsi.classList.remove('border-blue-600', 'text-gray-900');
            tabDeskripsi.classList.add('text-gray-600');
            contentUlasan.classList.remove('hidden');
            contentDeskripsi.classList.add('hidden');
        });
        
        // Set default active tab on load
        document.addEventListener('DOMContentLoaded', () => {
            tabDeskripsi.click(); 
        });


        const decreaseBtn = document.getElementById('decreaseBtn');
        const increaseBtn = document.getElementById('increaseBtn');
        const quantityInput = document.getElementById('quantityInput');
        const MAX_STOCK = <?php echo e($product->stock ?? 1); ?>;

        decreaseBtn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            if (value > 1) quantityInput.value = value - 1;
        });

        increaseBtn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            if (value < MAX_STOCK) quantityInput.value = value + 1;
        });

        quantityInput.addEventListener('input', (e) => {
            let value = parseInt(e.target.value);
            if (isNaN(value) || value < 1) e.target.value = 1;
            else if (value > MAX_STOCK) e.target.value = MAX_STOCK;
        });

        // ===============================================
        // JS UNTUK FUNGSI MODAL ULASAN (Diambil dari ulasan.blade.php)
        // ===============================================

        const reviewModal = document.getElementById('reviewModal');
        // Mendapatkan semua tombol pemicu modal
        const openReviewModalBtns = document.querySelectorAll('#openReviewModal, #openReviewModalUlasan'); 
        const cancelReviewBtn = document.getElementById('cancelReview');
        const reviewText = document.getElementById('reviewText');
        const charCount = document.getElementById('charCount');
        const ratingStars = document.querySelectorAll('.rating-star');
        const productRatingInput = document.getElementById('productRating');
        const reviewForm = document.getElementById('reviewForm');
        const yellowColor = '#FBBF24'; 

        const openModal = () => {
            reviewModal.classList.add('flex');
            reviewModal.classList.remove('hidden');
        };

        openReviewModalBtns.forEach(btn => btn.addEventListener('click', openModal));

        const closeModal = () => {
            reviewModal.classList.add('hidden');
            reviewModal.classList.remove('flex');
            
            reviewForm.reset();
            charCount.textContent = '0/500';
            
            productRatingInput.value = '0';
            updateStarColors(0, false); 
        };
        
        cancelReviewBtn.addEventListener('click', closeModal);
        
        reviewModal.addEventListener('click', function(e) {
            if (e.target.id === 'reviewModal') {
                closeModal();
            }
        });

        reviewText.addEventListener('input', function() {
            const currentLength = reviewText.value.length;
            charCount.textContent = `${currentLength}/500`;
        });

        function updateStarColors(rating, isHover = false) {
            ratingStars.forEach((star, index) => {
                const shouldBeYellow = (index < rating);
                if (shouldBeYellow) {
                    star.style.color = yellowColor;
                    star.querySelector('path').setAttribute('d', 'M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z');
                } else {
                    star.style.color = 'currentColor';
                    star.querySelector('path').setAttribute('d', 'M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.27 5.82 21 7 14.14l-5-4.87 6.91-.01L12 2z');
                }
            });
        }
        
        ratingStars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = parseInt(this.dataset.rating);
                productRatingInput.value = rating;
                updateStarColors(rating, false);
            });
            star.addEventListener('mouseover', function() {
                const hoverRating = parseInt(this.dataset.rating);
                updateStarColors(hoverRating, true);
            });
            star.addEventListener('mouseout', function() {
                const currentRating = parseInt(productRatingInput.value);
                updateStarColors(currentRating, false);
            });
        });

        // Form Validation/Submission (Cek Rating)
        reviewForm.addEventListener('submit', function(event) {
            const ratingValue = productRatingInput.value;
            if (ratingValue == 0) {
                alert('Mohon berikan penilaian bintang terlebih dahulu (1-5).');
                event.preventDefault();
            }
        });
        
        updateStarColors(parseInt(productRatingInput.value), false); 
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\PPL QUADMARKET\QuadMarket\resources\views/products/detail.blade.php ENDPATH**/ ?>