<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Pendaftaran Berhasil | QuadMarket</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#0f3343",
                        "background-light": "#f6f7f8",
                        "background-dark": "#131b1f",
                        "accent": "#00d1c1",
                        "quad-blue": "#4c98e1",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                        lg: "1rem",
                        xl: "1.5rem",
                        full: "9999px",
                    },
                },
            },
        }
    </script>
</head>

<body class="font-display bg-background-light dark:bg-background-dark text-gray-800 dark:text-gray-200">
    <div class="relative flex min-h-screen w-full flex-col group/design-root">
        <div class="flex-grow w-full max-w-7xl mx-auto p-4 sm:p-8 lg:p-12">

            <div
                class="flex flex-col items-center justify-center bg-white dark:bg-background-dark rounded-xl border border-gray-200 dark:border-gray-700 min-h-[80vh] p-8 text-center">
                
                <div class="mb-8">
                <img src="{{ asset('assets/quadmarket-logo.png') }}" 
                    alt="QuadMarket Logo" 
                    class="w-29 h-24 mr-0 ml-0">
                    <!-- <p class="text-xl font-bold text-primary dark:text-white mt-2">QuadMarket</p> -->
                </div>

                <h1 class="text-4xl sm:text-5xl font-extrabold text-primary dark:text-white mb-4">
                    Pendaftaran Berhasil!
                </h1>
                
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-lg mb-6">
                    Akun Anda telah berhasil dibuat dan sedang menunggu verifikasi dari kami. Anda akan diberitahu melalui email setelah email Anda aktif.
                </p>

                <p class="text-sm text-gray-500 dark:text-gray-500 mb-8">
                    Verifikasi biasanya memakan waktu 1 - 2 hari kerja.
                </p>

                <a href="{{ route('login.login') }}"
                    class="inline-flex items-center justify-center bg-primary text-white font-bold py-3 px-8 rounded-lg hover:bg-opacity-90 focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-background-dark transition-colors duration-300 h-14 shadow-md hover:shadow-lg">
                    Masuk
                </a>

            </div>

        </div>
    </div>
</body>

</html>