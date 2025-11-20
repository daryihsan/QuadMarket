<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk ke Akun Anda | QuadMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                'quad-dark-blue': '#0a1d41', 
                'quad-light-blue': '#4c98e1',
              }
            }
          }
        }
    </script>
</head>
<body class="bg-white">
    <div class="flex h-screen">
        
        <div class="hidden lg:flex w-1/2 bg-quad-dark-blue p-16 flex-col justify-center items-start text-white">
            
            <div class="flex items-center mb-5">
            <img src="{{ asset('assets/quadmarket-logo.png') }}" 
                alt="QuadMarket Logo" 
                class="w-29 h-20 mr-1">
                <!-- <span class="text-3xl font-semibold">QuadMarket</span> -->
            </div>
            
            <h1 class="text-6xl font-bold mb-6 leading-tight">Selamat Datang Kembali, Penjual</h1>
            <p class="text-xl opacity-80">Kelola katalog produk Anda dan jangkau lebih banyak pelanggan</p>
        </div>

        <div class="w-full lg:w-1/2 p-8 sm:p-16 flex flex-col justify-center">
            
            <h2 class="text-4xl font-bold mb-4 text-gray-800">Masuk ke Akun Anda</h2>
            <p class="text-gray-500 mb-8">Silahkan masukkan detail Anda</p>
            
            <form action="#" method="POST" class="space-y-6">
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email atau Nama Toko</label>
                    <div class="mt-1">
                        <input type="text" name="email" id="email" 
                               placeholder="Masukkan email atau nama toko Anda" 
                               required 
                               class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-quad-light-blue focus:border-quad-light-blue sm:text-base">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-quad-light-blue hover:text-blue-700">Lupa Kata Sandi?</a>
                        </div>
                    </div>
                    <div class="mt-1 relative">
                        <input type="password" name="password" id="password" 
                               placeholder="Nama lengkap contact person" 
                               required 
                               class="block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-quad-light-blue focus:border-quad-light-blue sm:text-base pr-10">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-gray-400">
                                <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                <path fill-rule="evenodd" d="M.335 10A9.916 9.916 0 0 1 4.78 2.768a10.05 10.05 0 0 1 10.44 0A9.916 9.916 0 0 1 19.665 10c-.39.73-.836 1.41-1.335 2.032a12.73 12.73 0 0 1-5.632 4.156A10 10 0 0 1 10 17.5a10 10 0 0 1-2.698-.67c-.259-.092-.511-.194-.758-.307A10.007 10.007 0 0 1 .335 10ZM5.52 4.108c-.736.427-1.396.95-1.944 1.554.437.568.966 1.18 1.57 1.834C6.34 7.625 7.02 7.917 7.74 7.98a3.99 3.99 0 0 0 4.52 0c.72-.063 1.4-.355 2.394-1.127.604-.654 1.133-1.266 1.57-1.834-.548-.604-1.208-1.127-1.944-1.554-.613.356-1.17.653-1.684.887A3.99 3.99 0 0 0 10 8.5a3.99 3.99 0 0 0-2.392-.767c-.514-.234-1.07-.53-1.684-.887Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-lg font-medium text-white bg-quad-light-blue hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-quad-light-blue transition duration-150 ease-in-out">
                        Lanjutkan
                    </button>
                </div>
            </form>
            
            <p class="mt-8 text-center text-gray-500">
                Sudah Punya Akun? 
                <a href="#" class="font-medium text-quad-light-blue hover:text-blue-700">Masuk</a>
            </p>

        </div>
    </div>
</body>
</html>
