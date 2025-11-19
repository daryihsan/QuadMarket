<!DOCTYPE html>

<html class="light" lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Katalog Produk Market Place - Pendaftaran Penjual</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<style>.form-select {
    background-image: url(https://lh3.googleusercontent.com/aida-public/AB6AXuBWpSdYhLkc54YGDd1mgM495eO7KA-YEqbeowGcCTG80_Mnid6wDglCtzyHFo5yqkKPL4qx-McPU0vHlFSbrdDGdSHajmkZEgBswITV14AmQIssrpUZsfGj4-kuFsl5wUY2w7Hb47-C_I3VUenAIFy7biPFD8HxmZz3TRu8SkxTpn-JtaywE94Iavi9Q9F4dK_gcK45_CRn3qiLqVHzf73cioW5bwquWRAXFj9qXtqw3c-0ZUXKlt4bXfBhDOWxeTUIb7jrTpv7lA);
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
    -webkit-print-color-adjust: exact;
    color-adjust: exact;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none
    }</style>
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
              "form-border": "#E0E0E0"
            },
            fontFamily: {
              "display": ["Inter", "sans-serif"]
            },
            borderRadius: {"DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px"},
          },
        },
      }
    </script>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-[#0f3343] dark:text-white/90">
<div class="relative flex min-h-screen w-full flex-col items-center justify-center p-4 sm:p-6 lg:p-8">
<div class="w-full max-w-3xl">
<!-- Progress Bar -->
<div class="mb-8 px-4">
<p class="text-primary/80 dark:text-white/70 text-sm font-medium">Langkah 2 dari 3</p>
<div class="mt-2 h-2 w-full rounded-full bg-gray-200 dark:bg-gray-700">
<div class="h-2 rounded-full bg-accent" style="width: 66%;"></div>
</div>
</div>
<!-- Main Content Card -->
<div class="rounded-xl border border-gray-200/50 bg-white dark:bg-background-dark dark:border-white/10 p-6 sm:p-10 shadow-lg shadow-gray-200/40 dark:shadow-none">
<!-- Page Heading -->
<div class="mb-8 text-center">
<h1 class="text-3xl font-black tracking-tighter text-primary dark:text-white sm:text-4xl">Lengkapi Alamat Toko Anda</h1>
<p class="mt-2 text-base text-primary/60 dark:text-white/60">Pastikan alamat yang Anda masukkan sudah benar.</p>
</div>
<!-- Form -->
<form action="#" class="space-y-6" method="POST">
<!-- Alamat Singkat -->
<div>
<label class="block text-sm font-medium text-primary dark:text-white/80 pb-2" for="alamat-singkat">Alamat Singkat (e.g., Nama Jalan, Nomor Rumah)</label>
<textarea class="form-input block w-full resize-none rounded-lg border-form-border bg-background-light/50 dark:bg-white/5 dark:border-white/20 p-4 text-base placeholder:text-primary/40 dark:placeholder:text-white/40 focus:border-accent focus:ring-accent" id="alamat-singkat" name="alamat-singkat" placeholder="Masukkan alamat lengkap toko Anda" rows="4"></textarea>
</div>
<!-- RT/RW and Kelurahan -->
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
<div>
<label class="block text-sm font-medium text-primary dark:text-white/80 pb-2" for="rt-rw">RT/RW</label>
<input class="form-input block w-full rounded-lg border-form-border bg-background-light/50 dark:bg-white/5 dark:border-white/20 p-4 text-base placeholder:text-primary/40 dark:placeholder:text-white/40 focus:border-accent focus:ring-accent" id="rt-rw" name="rt-rw" placeholder="Contoh: 001/002" type="text"/>
</div>
<div>
<label class="block text-sm font-medium text-primary dark:text-white/80 pb-2" for="kelurahan">Kelurahan</label>
<input class="form-input block w-full rounded-lg border-form-border bg-background-light/50 dark:bg-white/5 dark:border-white/20 p-4 text-base placeholder:text-primary/40 dark:placeholder:text-white/40 focus:border-accent focus:ring-accent" id="kelurahan" name="kelurahan" placeholder="Masukkan kelurahan" type="text"/>
</div>
</div>
<!-- Provinsi and Kabupaten/Kota -->
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
<div>
<label class="block text-sm font-medium text-primary dark:text-white/80 pb-2" for="provinsi">Provinsi</label>
<div class="relative">
<select class="form-select block w-full rounded-lg border-form-border bg-background-light/50 dark:bg-white/5 dark:border-white/20 p-4 text-base text-primary dark:text-white focus:border-accent focus:ring-accent" id="provinsi" name="provinsi">
<option>Pilih Provinsi</option>
<option>DKI Jakarta</option>
<option>Jawa Barat</option>
<option>Jawa Tengah</option>
</select>
</div>
</div>
<div>
<label class="block text-sm font-medium text-primary dark:text-white/80 pb-2" for="kota">Kabupaten/Kota</label>
<div class="relative">
<select class="form-select block w-full rounded-lg border-form-border bg-background-light/50 dark:bg-white/5 dark:border-white/20 p-4 text-base text-primary dark:text-white focus:border-accent focus:ring-accent" id="kota" name="kota">
<option>Pilih Kabupaten/Kota</option>
<option>Jakarta Pusat</option>
<option>Bandung</option>
<option>Semarang</option>
</select>
</div>
</div>
</div>
<!-- Navigation Buttons -->
<div class="flex flex-col-reverse items-center gap-4 pt-4 sm:flex-row sm:justify-between">
<a class="text-sm font-medium text-primary/70 dark:text-white/60 hover:text-primary dark:hover:text-white" href="#">Kembali</a>
<button class="flex w-full items-center justify-center rounded-lg bg-accent px-8 py-4 text-base font-bold text-primary shadow-sm shadow-accent/20 transition-all hover:bg-accent/90 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 dark:focus:ring-offset-background-dark sm:w-auto" type="submit">
                            Lanjutkan
                            <span class="material-symbols-outlined ml-2 text-xl">arrow_forward</span>
</button>
</div>
</form>
</div>
</div>
</div>
</body></html>