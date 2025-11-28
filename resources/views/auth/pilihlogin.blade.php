<!DOCTYPE html>

<html class="light" lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Login - Katalog Produk Market Place</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
<style>
    .material-symbols-outlined {
      font-variation-settings:
      'FILL' 0,
      'wght' 400,
      'GRAD' 0,
      'opsz' 24
    }
  </style>
<script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "primary": "#00D1C1",
            "primary-dark": "#0F1E42",
            "background-light": "#F8F9FA",
            "background-dark": "#0A142A",
          },
          fontFamily: {
            "display": ["Inter", "sans-serif"]
          },
          borderRadius: {
            "DEFAULT": "0.25rem",
            "lg": "0.75rem",
            "xl": "1rem",
            "full": "9999px"
          },
        },
      },
    }
  </script>
</head>
<body class="font-display bg-background-light dark:bg-background-dark">
<div class="relative flex min-h-screen w-full flex-col group/design-root" style='font-family: Inter, "Noto Sans", sans-serif;'>
<div class="layout-container flex h-full grow flex-col">
<header class="absolute top-0 left-0 right-0 z-10 p-10">
<div class="flex items-center gap-4 text-primary-dark dark:text-white">
<svg class="h-8 w-8 text-primary-dark dark:text-primary" fill="currentColor" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_6_535)">
<path clip-rule="evenodd" d="M47.2426 24L24 47.2426L0.757355 24L24 0.757355L47.2426 24ZM12.2426 21H35.7574L24 9.24264L12.2426 21Z" fill-rule="evenodd"></path>
</g>
<defs>
<clippath id="clip0_6_535">
<rect fill="white" height="48" width="48"></rect>
</clippath>
</defs>
</svg>
<h2 class="text-xl font-bold leading-tight tracking-tighter">Katalog Produk Market Place</h2>
</div>
</header>
<div class="flex flex-1 items-center justify-center px-4 py-20">
<div class="flex w-full max-w-2xl flex-col items-center rounded-xl bg-white p-8 shadow-sm dark:bg-primary-dark sm:p-12">
<h1 class="text-primary-dark dark:text-white tracking-tight text-4xl font-extrabold leading-tight text-center pb-8">Masuk ke Akun Anda</h1>
<div class="grid w-full grid-cols-1 gap-6 md:grid-cols-2">
<div class="group relative flex cursor-pointer flex-col items-center justify-start rounded-xl border border-gray-200 bg-white p-6 text-center transition-all duration-300 hover:shadow-lg hover:-translate-y-1 dark:border-gray-700 dark:bg-background-dark dark:hover:border-primary">
<div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-primary/20">
<span class="material-symbols-outlined text-4xl">storefront</span>
</div>
<p class="text-primary-dark dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">Masuk sebagai Penjual</p>
<p class="text-gray-500 dark:text-gray-400 text-base font-normal leading-normal mt-1">Kelola toko dan produk Anda</p>
<button class="absolute bottom-6 flex w-40 min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-primary-dark text-sm font-bold leading-normal opacity-0 transition-opacity duration-300 group-hover:opacity-100">
<span class="truncate">Pilih</span>
</button>
</div>
<div class="group relative flex cursor-pointer flex-col items-center justify-start rounded-xl border border-gray-200 bg-white p-6 text-center transition-all duration-300 hover:shadow-lg hover:-translate-y-1 dark:border-gray-700 dark:bg-background-dark dark:hover:border-primary">
<div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-primary/20">
<span class="material-symbols-outlined text-4xl">admin_panel_settings</span>
</div>
<p class="text-primary-dark dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">Masuk sebagai Admin</p>
<p class="text-gray-500 dark:text-gray-400 text-base font-normal leading-normal mt-1">Akses dasbor administrasi</p>
<button class="absolute bottom-6 flex w-40 min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-primary-dark text-sm font-bold leading-normal opacity-0 transition-opacity duration-300 group-hover:opacity-100">
<span class="truncate">Pilih</span>
</button>
</div>
</div>
<p class="text-gray-500 dark:text-gray-400 text-sm font-normal leading-normal pt-8 text-center">Belum punya akun? <a class="font-semibold text-primary underline hover:text-primary/80" href="#">Daftar sebagai Penjual</a></p>
</div>
</div>
</div>
</div>
</body></html>