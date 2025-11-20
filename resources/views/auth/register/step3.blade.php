<!DOCTYPE html>

<html class="light" lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Registrasi Penjual - Katalog Produk Market Place</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary": "#0f3343",
              "accent": "#00D1C1",
              "background-light": "#f6f7f8",
              "background-dark": "#131b1f",
              "text-primary": "#0F1E42",
              "text-secondary": "#567e8f"
            },
            fontFamily: {
              "display": ["Inter", "sans-serif"]
            },
            borderRadius: {"DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px"},
          },
        },
      }
    </script>
<style>
      .material-symbols-outlined {
        font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24
      }
    </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-text-primary dark:text-gray-200">
<div class="relative flex min-h-screen w-full flex-col group/design-root overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">
<header class="flex justify-center py-6 px-4">
<a class="flex items-center gap-3" href="#">
<span class="material-symbols-outlined text-primary text-4xl">store</span>
<span class="text-2xl font-bold tracking-tight text-primary">Katalog Produk Market Place</span>
</a>
</header>
<main class="flex flex-1 justify-center py-5 px-4">
<div class="layout-content-container flex flex-col w-full max-w-2xl flex-1">
<div class="mb-8">
<div class="flex flex-col gap-3 p-4">
<div class="flex gap-6 justify-between">
<p class="text-primary text-base font-medium leading-normal">Langkah 3 dari 3</p>
</div>
<div class="rounded-full bg-primary/20 h-2">
<div class="h-2 rounded-full bg-accent" style="width: 100%;"></div>
</div>
</div>
</div>
<div class="flex flex-wrap justify-between gap-3 p-4 mb-4">
<div class="flex min-w-72 flex-col gap-2">
<h1 class="text-text-primary dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Registrasi Penjual - Verifikasi Identitas</h1>
<p class="text-text-secondary dark:text-gray-400 text-base font-normal leading-normal">Lengkapi data diri Anda untuk menyelesaikan pendaftaran.</p>
</div>
</div>

<form action="{{ route('register.step3.post') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6 p-4">
    @csrf

    <div>
        <label class="flex flex-col">
            <p class="text-text-primary dark:text-white text-base font-medium leading-normal pb-2">Nomor KTP Penanggung Jawab (PIC)</p>
            <input name="nik" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-primary dark:text-gray-200 dark:bg-background-dark focus:outline-0 focus:ring-2 focus:ring-accent/50 border border-[#d2dfe4] dark:border-gray-700 bg-white h-14 placeholder:text-text-secondary p-[15px] text-base font-normal leading-normal shadow-sm" placeholder="Masukkan 16 digit nomor KTP Anda" value="{{ old('nik') }}"/>
            @error('nik')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </label>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <label class="flex flex-col">
            <p class="text-text-primary dark:text-white text-base font-medium leading-normal pb-2">Kata Sandi</p>
            <input name="password" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-primary dark:text-gray-200 dark:bg-background-dark focus:outline-0 focus:ring-2 focus:ring-accent/50 border border-[#d2dfe4] dark:border-gray-700 bg-white h-14 placeholder:text-text-secondary p-[15px] text-base font-normal leading-normal shadow-sm" placeholder="Minimal 8 karakter" type="password" />
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </label>

        <label class="flex flex-col">
            <p class="text-text-primary dark:text-white text-base font-medium leading-normal pb-2">Konfirmasi Kata Sandi</p>
            <input name="password_confirmation" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-primary dark:text-gray-200 dark:bg-background-dark focus:outline-0 focus:ring-2 focus:ring-accent/50 border border-[#d2dfe4] dark:border-gray-700 bg-white h-14 placeholder:text-text-secondary p-[15px] text-base font-normal leading-normal shadow-sm" placeholder="Ulangi kata sandi" type="password" />
        </label>
    </div>

    <div>
        <h3 class="text-text-primary dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] pb-2 pt-4">Unggah Dokumen</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col gap-2">
                <p class="text-text-primary dark:text-white text-base font-medium leading-normal">Upload Foto PIC</p>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col items-center justify-center w-full h-48 border-2 border-[#d2dfe4] dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-white dark:bg-background-dark hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" for="dropzone-file-pic">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <span class="material-symbols-outlined text-text-secondary text-4xl mb-3">cloud_upload</span>
                            <p class="mb-2 text-sm text-text-secondary dark:text-gray-400"><span class="font-semibold">Klik untuk mengunggah</span></p>
                            <p class="text-xs text-text-secondary dark:text-gray-400">atau seret dan lepas</p>
                        </div>
                        <input class="hidden" id="dropzone-file-pic" name="foto_pic" type="file"/>
                    </label>
                </div>
                @error('foto_pic')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <p class="text-text-primary dark:text-white text-base font-medium leading-normal">Upload File KTP PIC</p>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col items-center justify-center w-full h-48 border-2 border-[#d2dfe4] dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-white dark:bg-background-dark hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" for="dropzone-file-ktp">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <span class="material-symbols-outlined text-text-secondary text-4xl mb-3">badge</span>
                            <p class="mb-2 text-sm text-text-secondary dark:text-gray-400"><span class="font-semibold">Klik untuk mengunggah</span></p>
                            <p class="text-xs text-text-secondary dark:text-gray-400">atau seret dan lepas</p>
                        </div>
                        <input class="hidden" id="dropzone-file-ktp" name="foto_ktp" type="file"/>
                    </label>
                </div>
                @error('foto_ktp')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="mt-6 flex flex-col gap-4">
        <p class="text-center text-xs text-text-secondary dark:text-gray-400">
            Dengan menekan tombol Kirim, Anda menyetujui <a class="font-semibold text-accent hover:underline" href="#">Syarat &amp; Ketentuan</a> dan <a class="font-semibold text-accent hover:underline" href="#">Kebijakan Privasi</a> kami.
        </p>
        <button class="flex items-center justify-center w-full h-14 px-6 py-3.5 bg-accent rounded-lg shadow-lg hover:bg-accent/90 transition-all focus:outline-none focus:ring-4 focus:ring-accent/30" type="submit">
            <span class="text-base font-bold text-white">Kirim</span>
        </button>
    </div>
</form>
</div>
</main>
</div>
</div>
</body></html>
