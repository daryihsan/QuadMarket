
<header class="shadow-md sticky top-0 bg-white z-50">
	<nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex justify-between items-center">
		<div class="flex items-center space-x-6">
			<div class="flex items-center space-x-2">
				<img src="{{ asset('assets/images/logo.png') }}" alt="QuadMarket Logo" class="h-12">
				{{-- <span class="text-lg font-semibold text-blue-600 hidden sm:inline">QuadMarket</span> --}}
			</div>
			<div class="hidden lg:flex items-center space-x-6 text-gray-700">
				<a href="#" class="hover:text-blue-600 flex items-center">
					Kategori
					<svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
				</a>
				<a href="#" class="hover:text-blue-600">Produk</a>
			</div>
		</div>

		<div class="flex-1 max-w-sm mx-8 hidden md:block">
			<div class="relative">
				<input type="text" placeholder="Cari Produk..." class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 text-sm">
				<button class="absolute right-0 top-0 mt-2 mr-3">
					<svg class="w-5 h-5 text-gray-400 hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
				</button>
			</div>
		</div>

		<div class="flex items-center">
			<button class="bg-blue-600 text-white font-medium py-2 px-4 rounded-lg flex items-center hover:bg-blue-700 transition duration-150 text-sm">
				<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
				Masuk
			</button>
		</div>
	</nav>
</header>
