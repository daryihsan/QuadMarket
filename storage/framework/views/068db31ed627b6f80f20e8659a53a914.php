<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | QuadMarket</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link 
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" 
        rel="stylesheet"
    />

    <link 
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" 
        rel="stylesheet"
    />

    <style>
        .material-symbols-outlined {
            font-variation-settings:
            'FILL' 0,
            'wght' 400,
            'GRAD' 0,
            'opsz' 24;
        }
    </style>

    <!-- Tailwind Theme -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#4c98e1",
                        "primary-dark": "#0F1E42",
                        "background-light": "#F8F9FA",
                        "background-dark": "#0A142A",
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.75rem",
                        xl: "1rem",
                        full: "9999px",
                    }
                }
            }
        }
    </script>
</head>

<body class="font-display bg-background-light dark:bg-background-dark">

    <div class="relative flex min-h-screen w-full flex-col">

        <!-- Header -->
        <header class="absolute top-0 left-0 right-0 z-10 p-10">
            <div class="flex items-center gap-4 text-primary-dark dark:text-white">
                
                <!-- <svg width="48" height="48" viewBox="0 0 48 48"> -->
                    <g clip-path="url(#clip0)">
                        <path 
                            fill-rule="evenodd" 
                            clip-rule="evenodd"
                            d="M47.2426 24L24 47.2426L0.757355 24L24 0.757355L47.2426 24ZM12.2426 21H35.7574L24 9.24264L12.2426 21Z"
                        />
                    </g>
                    <defs>
                        <clipPath id="clip0">
                            <rect width="48" height="48" fill="white"></rect>
                        </clipPath>
                    </defs>
                </svg>

            </div>
        </header>
        <!-- End Header -->

        <!-- Content -->
        <div class="flex flex-1 items-center justify-center px-4 py-20">

            <div class="flex w-full max-w-2xl flex-col items-center rounded-xl bg-white p-8 shadow-sm dark:bg-primary-dark sm:p-12">

                <!-- Logo -->
                <img 
                    src="<?php echo e(asset('assets/quadmarket-logo.png')); ?>" 
                    alt="QuadMarket Logo" 
                    class="w-29 h-24"
                />

                <h1 class="text-primary-dark dark:text-white text-4xl font-extrabold text-center pb-8 mt-6">
                    Masuk ke Akun Anda
                </h1>

                <!-- Login Options -->
                <div class="grid w-full grid-cols-1 gap-6 md:grid-cols-2">

                    <!-- Login Penjual -->
                    <a href="<?php echo e(route('login.login')); ?>"
                        class="group relative flex flex-col items-center rounded-xl border border-gray-200 bg-white p-6 text-center transition-all duration-300 hover:shadow-lg hover:-translate-y-1 dark:border-gray-700 dark:bg-background-dark dark:hover:border-primary">

                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-primary/20">
                            <span class="material-symbols-outlined text-4xl">storefront</span>
                        </div>

                        <p class="text-primary-dark dark:text-white text-lg font-bold">
                            Masuk sebagai Penjual
                        </p>

                        <p class="text-gray-500 dark:text-gray-400 text-base mt-1">
                            Kelola toko dan produk Anda
                        </p>

                        <!-- <div class="absolute bottom-6 flex w-40 h-10 items-center justify-center rounded-lg bg-primary text-primary-dark text-sm font-bold opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                            Pilih
                        </div> -->
                    </a>

                    <!-- Login Admin -->
                    <a href="<?php echo e(route('login.admin')); ?>"
                        class="group relative flex flex-col items-center rounded-xl border border-gray-200 bg-white p-6 text-center transition-all duration-300 hover:shadow-lg hover:-translate-y-1 dark:border-gray-700 dark:bg-background-dark dark:hover:border-primary">

                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary dark:bg-primary/20">
                            <span class="material-symbols-outlined text-4xl">admin_panel_settings</span>
                        </div>

                        <p class="text-primary-dark dark:text-white text-lg font-bold">
                            Masuk sebagai Admin
                        </p>

                        <p class="text-gray-500 dark:text-gray-400 text-base mt-1">
                            Akses dasbor administrasi
                        </p>

                        <!-- <div class="absolute bottom-6 flex w-40 h-10 items-center justify-center rounded-lg bg-primary text-primary-dark text-sm font-bold opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                            Pilih
                        </div> -->
                    </a>

                </div>

                <!-- Register -->
                <p class="text-gray-500 dark:text-gray-400 text-sm pt-8 text-center">
                    Belum punya akun?  
                    <a href="<?php echo e(route('register.step1')); ?>" class="font-semibold text-primary underline hover:text-primary/80">
                        Daftar sebagai Penjual
                    </a>
                </p>

            </div>
        </div>
        <!-- End Content -->

    </div>

</body>

</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/QuadMarketPPL/resources/views/auth/login/pilih.blade.php ENDPATH**/ ?>