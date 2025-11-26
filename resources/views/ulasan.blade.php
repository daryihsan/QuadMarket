<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pop-up Ulasan Produk</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Terapkan Font Inter secara global */
        body {
            font-family: 'Inter', sans-serif;
        }
        .rating-star {
            cursor: pointer;
            transition: color 0.15s;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen p-10">

    <div class="bg-white p-6 rounded-lg shadow-md max-w-2xl mx-auto">
        <h1 class="text-xl font-bold">Konten Produk di Belakang</h1>
        <p class="text-gray-600 mt-2">Ini adalah konten yang akan tampak redup.</p>
        <button id="openReviewModal" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
            Buka Form Ulasan
        </button>
    </div>

    <div id="reviewModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center p-4 z-50 **hidden**">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-auto p-8" style="font-family: 'Inter', sans-serif;">
            
            <h2 class="text-xl font-bold text-gray-900 mb-2">Beri Ulasan untuk Produk Anda</h2>
            <p class="text-sm text-gray-500 mb-6">Isi detail di bawah ini untuk mengirimkan ulasan Anda.</p>

            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="fullName" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="fullName" name="fullName" placeholder="Masukkan nama lengkap Anda" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm 
                                      focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="phoneNumber" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Contoh: 081234567890" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm 
                                      focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="emailAddress" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                    <input type="email" id="emailAddress" name="emailAddress" placeholder="Contoh: email@example.com" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm 
                                  focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bagaimana penilaian Anda terhadap produk ini?</label>
                    <div id="starContainer" class="flex items-center text-gray-300 text-3xl space-x-0.5">
                        <svg class="rating-star w-8 h-8 fill-current text-gray-300" data-rating="1" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.27 5.82 21 7 14.14l-5-4.87 6.91-.01L12 2z"/></svg>
                        <svg class="rating-star w-8 h-8 fill-current text-gray-300" data-rating="2" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.27 5.82 21 7 14.14l-5-4.87 6.91-.01L12 2z"/></svg>
                        <svg class="rating-star w-8 h-8 fill-current text-gray-300" data-rating="3" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.27 5.82 21 7 14.14l-5-4.87 6.91-.01L12 2z"/></svg>
                        <svg class="rating-star w-8 h-8 fill-current text-gray-300" data-rating="4" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.27 5.82 21 7 14.14l-5-4.87 6.91-.01L12 2z"/></svg>
                        <svg class="rating-star w-8 h-8 fill-current text-gray-300" data-rating="5" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.27 5.82 21 7 14.14l-5-4.87 6.91-.01L12 2z"/></svg>
                        <input type="hidden" id="productRating" name="productRating" value="0">
                    </div>
                </div>

                <div class="mb-8">
                    <label for="reviewText" class="block text-sm font-medium text-gray-700 mb-1">Tulis Ulasan Anda</label>
                    <div class="relative">
                        <textarea id="reviewText" name="reviewText" rows="4" maxlength="500" placeholder="Bagikan pengalaman Anda mengenai produk ini" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm resize-none 
                                         focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                        <span id="charCount" class="absolute bottom-2 right-3 text-xs text-gray-400">0/500</span>
                    </div>
                </div>

                <div class="flex justify-end items-center space-x-6">
                    <button type="button" id="cancelReview" 
                            class="py-2 text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none">
                        Batalkan
                    </button>
                    <button type="submit" 
                            class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-md 
                                   shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Kirim Ulasan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reviewModal = document.getElementById('reviewModal');
            const openReviewModalBtn = document.getElementById('openReviewModal');
            const cancelReviewBtn = document.getElementById('cancelReview');
            const reviewText = document.getElementById('reviewText');
            const charCount = document.getElementById('charCount');
            const ratingStars = document.querySelectorAll('.rating-star');
            const productRatingInput = document.getElementById('productRating');
            const yellowColor = '#FBBF24'; // Tailwind yellow-400 color

            // --- Fungsionalitas Modal ---
            openReviewModalBtn.addEventListener('click', function() {
                // Saat membuka, tambahkan 'flex' dan hapus 'hidden' (Memperbaiki konflik CSS)
                reviewModal.classList.add('flex');
                reviewModal.classList.remove('hidden');
            });

            const closeModal = () => {
                // Saat menutup, tambahkan 'hidden' dan hapus 'flex'
                reviewModal.classList.add('hidden');
                reviewModal.classList.remove('flex');
                
                // Reset form
                document.querySelector('#reviewModal form').reset();
                charCount.textContent = '0/500';
                
                // Reset bintang
                productRatingInput.value = '0';
                updateStarColors(0, false); 
            };
            
            cancelReviewBtn.addEventListener('click', closeModal);
            
            // Tutup modal jika klik di luar area modal (overlay)
            reviewModal.addEventListener('click', function(e) {
                if (e.target.id === 'reviewModal') {
                    closeModal();
                }
            });


            // --- Fungsionalitas Textarea ---
            reviewText.addEventListener('input', function() {
                const currentLength = reviewText.value.length;
                charCount.textContent = `${currentLength}/500`;
            });

            // --- Fungsionalitas Rating Bintang ---
            
            function updateStarColors(rating, isHover = false) {
                ratingStars.forEach((star, index) => {
                    const shouldBeYellow = isHover ? (index < rating) : (index < rating);
                    
                    if (shouldBeYellow) {
                        star.style.color = yellowColor;
                        // Ganti path SVG untuk bintang terisi (Fill)
                        star.querySelector('path').setAttribute('d', 'M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z');
                    } else {
                        star.style.color = 'currentColor'; // Warna default (gray-300)
                        // Ganti path SVG untuk bintang kosong (Outline)
                        star.querySelector('path').setAttribute('d', 'M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.27 5.82 21 7 14.14l-5-4.87 6.91-.01L12 2z');
                    }
                });
            }
            
            // Event Click (Memilih Rating)
            ratingStars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = parseInt(this.dataset.rating);
                    productRatingInput.value = rating;
                    updateStarColors(rating, false);
                });

                // Event Mouse Over (Hover)
                star.addEventListener('mouseover', function() {
                    const hoverRating = parseInt(this.dataset.rating);
                    updateStarColors(hoverRating, true);
                });

                // Event Mouse Out (Meninggalkan Bintang)
                star.addEventListener('mouseout', function() {
                    const currentRating = parseInt(productRatingInput.value);
                    updateStarColors(currentRating, false); // Kembali ke rating yang sudah dipilih
                });
            });
        });
    </script>
</body>
</html>