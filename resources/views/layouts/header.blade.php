<header class="shadow-md sticky top-0 bg-white z-50">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex justify-between items-center">

        <!-- kiri -->
        <div class="flex items-center space-x-6">
            <!-- logo -->
            <div class="flex items-center space-x-2">
                <img src="{{ asset('assets/images/logo.png') }}" alt="QuadMarket Logo" class="h-12">
            </div>
            <!-- menu -->
            <div class="hidden lg:flex items-center space-x-6 text-gray-700">

                <!-- dropdown kategori  -->
				<div class="relative group">
					<button 
						class="flex items-center rounded-3xl px-4 py-2 text-sm text-gray-900">
						Kategori
						<svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 20 12">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M10 10 2 2m8 8 8-8" />
						</svg>
					</button>
					<!-- menu -->
					<div 
						class="absolute left-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg 
							py-2 text-sm text-gray-700 
							opacity-0 invisible group-hover:opacity-100 group-hover:visible
							transition-all duration-200">
						@foreach($headerCategories as $cat)
							<a href="{{ route('catalog.byCategory', $cat->slug) }}"
							class="block px-4 py-2 hover:bg-gray-100">
								{{ $cat->name }}
							</a>
						@endforeach
					</div>
				</div>

                <!-- produk -->
                <a href="{{ route('katalog') }}" class="hover:text-blue-600">
                    Produk
                </a>
            </div>

        </div>

        <!-- tengah: search bar -->
        <div class="flex-1 max-w-sm mx-8 hidden md:block">
            <div class="relative">
                <input type="text" placeholder="Cari Produk..." 
                    class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-lg 
                    focus:outline-none focus:ring-1 focus:ring-blue-500 text-sm">

                <button class="absolute right-0 top-0 mt-2 mr-3">
                    <svg class="w-5 h-5 text-gray-400 hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- kanan: login -->
        <div class="flex items-center">
            <a href="{{ route('login.pilih') }}"
                class="bg-blue-600 text-white font-semibold py-2 px-5 rounded-xl hover:bg-blue-700
                       transition duration-150 flex items-center space-x-2">
                Masuk
            </a>
        </div>

    </nav>
</header>
