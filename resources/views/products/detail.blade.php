<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuadMarket - Samsung Galaxy A56</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation Bar -->
        <div class="bg-white border-b px-6 py-4 flex items-center justify-between shadow-sm">
            <div class="flex items-center space-x-8">
                <img src="https://via.placeholder.com/120x40/00bcd4/ffffff?text=QuadMarket" alt="QuadMarket" class="h-10">
                <div class="relative flex-1 max-w-md">
                    <input type="text" placeholder="Cari Produk.." class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:border-blue-500">
                    <button class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <i class="fas fa-search text-gray-400"></i>
                    </button>
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <i class="fas fa-shopping-cart text-gray-600 text-xl cursor-pointer hover:text-blue-600"></i>
                <i class="fas fa-bell text-gray-600 text-xl cursor-pointer hover:text-blue-600"></i>
                <i class="fas fa-user-circle text-gray-600 text-xl cursor-pointer hover:text-blue-600"></i>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div class="bg-white px-6 py-3 text-sm text-gray-600 border-b">
            <a href="#" class="hover:text-blue-600">Home</a> / 
            <a href="#" class="hover:text-blue-600">Elektronik</a> / 
            <a href="#" class="hover:text-blue-600">Handphone</a>
        </div>

        <!-- Product Section -->
        <div class="w-full px-6 py-8">
            <div class="bg-white rounded-lg shadow-lg p-8 max-w-full">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Product Images -->
                    <div>
                        <!-- Main Product Image -->
                        <div class="bg-white border rounded-lg p-6 mb-4 relative">
                
                            <img id="mainProductImage" src="{{ asset('images/main-phone.png') }}" alt="Samsung Galaxy A56" class="w-full rounded" onerror="this.src='https://via.placeholder.com/600x500/f0f0f0/666666?text=Samsung+Galaxy+A56'">
                        </div>

                        <!-- 5 Thumbnails Kecil -->
                        <div class="grid grid-cols-5 gap-2 mb-6">
                            <img src="{{ asset('images/thumb1.png') }}" class="w-full h-24 object-cover rounded border cursor-pointer hover:border-blue-500 hover:shadow-md transition-all" onclick="changeMainImage('{{ asset('images/thumb1.png') }}')" onerror="this.src='https://via.placeholder.com/100x120/90ee90/666666?text=1'">
                            <img src="{{ asset('images/thumb2.png') }}" class="w-full h-24 object-cover rounded border cursor-pointer hover:border-blue-500 hover:shadow-md transition-all" onclick="changeMainImage('{{ asset('images/thumb2.png') }}')" onerror="this.src='https://via.placeholder.com/100x120/d3d3d3/666666?text=2'">
                            <img src="{{ asset('images/thumb3.png') }}" class="w-full h-24 object-cover rounded border cursor-pointer hover:border-blue-500 hover:shadow-md transition-all" onclick="changeMainImage('{{ asset('images/thumb3.png') }}')" onerror="this.src='https://via.placeholder.com/100x120/90ee90/666666?text=3'">
                            <img src="{{ asset('images/thumb4.png') }}" class="w-full h-24 object-cover rounded border cursor-pointer hover:border-blue-500 hover:shadow-md transition-all" onclick="changeMainImage('{{ asset('images/thumb4.png') }}')" onerror="this.src='https://via.placeholder.com/100x120/d3d3d3/666666?text=4'">
                            <img src="{{ asset('images/thumb5.png') }}" class="w-full h-24 object-cover rounded border cursor-pointer hover:border-blue-500 hover:shadow-md transition-all" onclick="changeMainImage('{{ asset('images/thumb5.png') }}')" onerror="this.src='https://via.placeholder.com/100x120/90ee90/666666?text=5'">
                        </div>

                        <!-- Tabs -->
                        <div class="border-b">
                            <div class="flex space-x-8">
                                <button id="tabDeskripsi" class="py-2 text-gray-800 font-semibold border-b-4 border-transparent hover:text-blue-600 transition" onclick="switchTab('deskripsi')">Deskripsi Produk</button>
                                <button id="tabUlasan" class="py-2 text-gray-800 font-semibold border-b-4 border-transparent hover:text-blue-600 transition" onclick="switchTab('ulasan')">Ulasan Pembeli</button>
                            </div>
                        </div>

                        <div id="contentDeskripsi" class="mt-6">
                            <h3 class="font-bold text-lg mb-3">Spesifikasi</h3>
                            <p class="text-sm text-gray-700 leading-relaxed">
                                Samsung Galaxy A56 hadir dengan desain premium, layar Super AMOLED yang jernih, serta performa cepat untuk keseharian hingga multitasking berat. Cocok untuk bekerja, konten, maupun gaming. Dilengkapi dengan kamera berkualitas tinggi menghasilkan hasil foto tajam dari warna hidup, nyaman untuk dokumentasi maupun kreasi konten. Unit baru & bergaransi resmi, ideal untuk pengguna yang ingin upgrade ke smartphone modern dengan fitur lengkap dan harga terbaik. Pilihan tepat untuk produktivitas dan gaya di tahun 2025.
                            </p>

                            <div class="mt-8">
                                <h3 class="font-bold text-lg mb-4">Ulasan & Penilaian Pembeli</h3>
                                <div class="flex items-center space-x-8">
                                    <div class="text-center">
                                        <div class="text-5xl font-bold text-gray-800">4.6</div>
                                        <div class="text-gray-600">/ 5.0</div>
                                        <div class="flex justify-center mt-2">
                                            <i class="fas fa-star text-yellow-400"></i>
                                            <i class="fas fa-star text-yellow-400"></i>
                                            <i class="fas fa-star text-yellow-400"></i>
                                            <i class="fas fa-star text-yellow-400"></i>
                                            <i class="fas fa-star-half-alt text-yellow-400"></i>
                                        </div>
                                        <div class="text-sm text-gray-600 mt-1">dari 153 ulasan</div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <i class="fas fa-star text-gray-600 text-xs"></i>
                                            <span class="text-sm">5</span>
                                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 96%"></div>
                                            </div>
                                            <span class="text-sm w-8 text-right">147</span>
                                        </div>
                                        <div class="flex items-center space-x-2 mb-2">
                                            <i class="fas fa-star text-gray-600 text-xs"></i>
                                            <span class="text-sm">4</span>
                                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 3%"></div>
                                            </div>
                                            <span class="text-sm w-8 text-right">4</span>
                                        </div>
                                        <div class="flex items-center space-x-2 mb-2">
                                            <i class="fas fa-star text-gray-600 text-xs"></i>
                                            <span class="text-sm">3</span>
                                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 1%"></div>
                                            </div>
                                            <span class="text-sm w-8 text-right">2</span>
                                        </div>
                                        <div class="flex items-center space-x-2 mb-2">
                                            <i class="fas fa-star text-gray-600 text-xs"></i>
                                            <span class="text-sm">2</span>
                                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                <div class="bg-gray-200 h-2 rounded-full" style="width: 0%"></div>
                                            </div>
                                            <span class="text-sm w-8 text-right">0</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-star text-gray-600 text-xs"></i>
                                            <span class="text-sm">1</span>
                                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                <div class="bg-gray-200 h-2 rounded-full" style="width: 0%"></div>
                                            </div>
                                            <span class="text-sm w-8 text-right">0</span>
                                        </div>
                                    </div>
                                    <button class="border-2 border-blue-600 text-blue-600 px-6 py-2 rounded-lg hover:bg-blue-50 transition-all">
                                        <i class="fas fa-edit mr-2"></i>Beri Ulasan
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Content Ulasan Pembeli -->
                        <div id="contentUlasan" class="mt-6 hidden">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h3 class="font-bold text-lg">Ulasan Pembeli</h3>
                                    <div class="flex items-center mt-2">
                                        <span class="text-3xl font-bold mr-2">4.6</span>
                                        <span class="text-gray-600">/ 5.0</span>
                                        <div class="flex text-yellow-400 ml-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <span class="text-sm text-gray-600 ml-2">(153 ulasan)</span>
                                    </div>
                                </div>
                                <button class="border-2 border-blue-600 text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition-all">
                                    <i class="fas fa-edit mr-2"></i>Beri Ulasan
                                </button>
                            </div>

                            <!-- Individual Reviews -->
                            <div class="space-y-6">
                                <div class="border-t pt-4">
                                    <div class="flex items-start space-x-3">
                                        <!-- FOTO REVIEWER 1 -->
                                        <img src="{{ asset('images/reviewer1.png') }}" alt="James" class="w-10 h-10 rounded-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name=James+A&background=4a90e2&color=fff&size=40'">
                                        <div class="flex-1">
                                            <div class="font-semibold">James A.</div>
                                            <div class="flex text-yellow-400 text-sm mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <p class="text-sm text-gray-700">
                                                Sangat puas dengan Samsung Galaxy A56 ini. Performa cepat, layar Super AMOLED-nya jernih banget, dan baterainya awet dipakai seharian. Pengiriman cepat, packaging aman, dan barang benar-benar original. Recommended!
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t pt-4">
                                    <div class="flex items-start space-x-3">
                                        <!-- FOTO REVIEWER 2 -->
                                        <img src="{{ asset('images/reviewer12.png') }}" alt="Michelle" class="w-10 h-10 rounded-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name=Michelle&background=e27a90&color=fff&size=40'">
                                        <div class="flex-1">
                                            <div class="font-semibold">Michelle</div>
                                            <div class="flex text-yellow-400 text-sm mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <p class="text-sm text-gray-700">
                                                Produk datang dalam kondisi sangat baik dan masih segel. Speknya mantap untuk kebutuhan kuliah dan kerja. Nonton, gaming, sampai foto-foto terasa nyaman. Worth every rupiah!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div>
                        <h1 class="text-3xl font-bold text-blue-900 mb-3">Smartphone Samsung Galaxy A56 Terbaru 2025 New</h1>
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400 mr-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="font-semibold mr-2">4.6</span>
                            <span class="text-blue-600 cursor-pointer hover:underline">(153 Ulasan)</span>
                        </div>
                        <div class="text-4xl font-bold text-blue-900 mb-4">Rp 6.500.000,00</div>
                        <div class="text-sm text-gray-600 mb-6">Stok: 12</div>
                        
                        <!-- Quantity -->
                        <div class="mb-6">
                            <label class="text-sm font-semibold mb-2 block">Jumlah:</label>
                            <div class="flex items-center space-x-2">
                                <button id="decreaseBtn" class="border px-4 py-2 rounded hover:bg-gray-100 transition-all">-</button>
                                <input id="quantityInput" type="text" value="1" class="border px-4 py-2 w-20 text-center rounded focus:outline-none focus:border-blue-500">
                                <button id="increaseBtn" class="border px-4 py-2 rounded hover:bg-gray-100 transition-all">+</button>
                            </div>
                        </div>

                        <!-- Seller Info -->
                        <div class="border rounded-lg p-5 mb-4 hover:shadow-md transition-all">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-3">
                                    <!-- LOGO TOKO -->
                                    <img src="{{ asset('images/store-logo.png') }}" alt="Store" class="w-12 h-12 rounded-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name=National+Ponsel&background=00bcd4&color=fff&size=50&bold=true'">
                                    <div>
                                        <h3 class="font-semibold text-lg">National Ponsel Indonesia</h3>
                                        <p class="text-sm text-gray-600"><i class="fas fa-map-marker-alt mr-1"></i>Semarang</p>
                                        <p class="text-sm text-gray-600"><i class="far fa-calendar mr-1"></i>Bergabung sejak Juni 2022</p>
                                    </div>
                                </div>
                                <button class="bg-blue-900 text-white px-5 py-2 rounded-lg text-sm hover:bg-blue-800 transition-all">
                                    <i class="far fa-comment mr-2"></i>Chat Penjual
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to change main product image
        function changeMainImage(imageUrl) {
            const mainImg = document.getElementById('mainProductImage');
            if (mainImg) {
                mainImg.src = imageUrl;
            }
        }

        // Tab switching
        const tabDeskripsi = document.getElementById('tabDeskripsi');
        const tabUlasan = document.getElementById('tabUlasan');
        const contentDeskripsi = document.getElementById('contentDeskripsi');
        const contentUlasan = document.getElementById('contentUlasan');
        const productLabels = document.getElementById('productLabels');

        tabDeskripsi.addEventListener('click', () => {
            tabDeskripsi.classList.add('border-blue-600', 'text-blue-600');
            tabDeskripsi.classList.remove('text-gray-600', 'border-transparent');
            tabUlasan.classList.remove('border-blue-600', 'text-blue-600');
            tabUlasan.classList.add('text-gray-600', 'border-transparent');
    
            contentDeskripsi.classList.remove('hidden');
            contentUlasan.classList.add('hidden');
        });

        tabUlasan.addEventListener('click', () => {
            tabUlasan.classList.add('border-blue-600', 'text-blue-600');
            tabUlasan.classList.remove('text-gray-600', 'border-transparent');
            tabDeskripsi.classList.remove('border-blue-600', 'text-blue-600');
            tabDeskripsi.classList.add('text-gray-600', 'border-transparent');
    
            contentUlasan.classList.remove('hidden');
            contentDeskripsi.classList.add('hidden');
        });

        // Quantity controls
        const decreaseBtn = document.getElementById('decreaseBtn');
        const increaseBtn = document.getElementById('increaseBtn');
        const quantityInput = document.getElementById('quantityInput');

        decreaseBtn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                quantityInput.value = value - 1;
            }
        });

        increaseBtn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            if (value < 12) {
                quantityInput.value = value + 1;
            }
        });

        // Prevent non-numeric input
        quantityInput.addEventListener('input', (e) => {
            let value = parseInt(e.target.value);
            if (isNaN(value) || value < 1) {
                e.target.value = 1;
            } else if (value > 12) {
                e.target.value = 12;
            }
        });
    </script>
</body>
</html>