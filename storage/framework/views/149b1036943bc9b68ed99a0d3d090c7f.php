<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Verifikasi Penjual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .blue-gradient {
            background-image: linear-gradient(to right, #1E3A8A, #3B82F6);
        }
    </style>
</head>
<body class="bg-gray-200">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white shadow-lg p-6">
            <h3 class="font-bold text-lg mb-4">Admin Menu</h3>
            <a href="<?php echo e(route('platform.dashboard')); ?>" class="block p-2 text-gray-600 hover:bg-gray-100 rounded-lg">Dashboard</a>
            <a href="<?php echo e(route('platform.verifikasi.list')); ?>" class="block p-2 text-white blue-gradient rounded-lg font-semibold">Verifikasi Penjual</a>
            <a href="<?php echo e(route('platform.laporan')); ?>" class="block p-2 text-gray-600 hover:bg-gray-100 rounded-lg">Laporan</a>
        </aside>

        <main class="flex-1 p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-blue-900">Verifikasi Penjual: <?php echo e($seller->nama_toko); ?></h1>
                <a href="<?php echo e(route('platform.verifikasi.list')); ?>" class="text-sm font-medium text-gray-600 hover:text-gray-800">&larr; Kembali ke Daftar</a>
            </div>

            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Data Registrasi Penjual (toko) [cite: 30]</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">1. Nama Toko [cite: 32]</p>
                        <p class="text-lg text-gray-900 mb-3"><?php echo e($seller->nama_toko); ?></p>

                        <p class="text-sm font-medium text-gray-500">2. Deskripsi Singkat [cite: 33]</p>
                        <p class="text-lg text-gray-900 mb-3"><?php echo e($seller->deskripsi_singkat); ?></p>

                        <p class="text-sm font-medium text-gray-500">Lokasi Toko</p>
                        <p class="text-lg text-gray-900 mb-3">
                            <?php echo e($seller->nama_jalan_pic); ?>, RT <?php echo e($seller->rt); ?> / RW <?php echo e($seller->rw); ?>, Kel. <?php echo e($seller->nama_kelurahan); ?>, Kab/Kota <?php echo e($seller->kabupaten_kota); ?>, **Propinsi <?php echo e($seller->propinsi); ?>** [cite: 37, 38, 39, 40, 41, 42]
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">3. Nama PIC [cite: 34]</p>
                        <p class="text-lg text-gray-900 mb-3"><?php echo e($seller->nama_pic); ?></p>

                        <p class="text-sm font-medium text-gray-500">4. No Handphone PIC [cite: 35]</p>
                        <p class="text-lg text-gray-900 mb-3"><?php echo e($seller->no_hp_pic); ?></p>
                        
                        <p class="text-sm font-medium text-gray-500">5. Email PIC [cite: 36]</p>
                        <p class="text-lg text-gray-900 mb-3"><?php echo e($seller->email_pic); ?></p>
                        
                        <p class="text-sm font-medium text-gray-500">12. No. KTP PIC [cite: 43]</p>
                        <p class="text-lg text-gray-900 mb-3"><?php echo e($seller->no_ktp_pic); ?></p>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t">
                    <h3 class="text-base font-semibold text-gray-800 mb-3">Dokumen Administrasi (Kelengkapan Syarat Verifikasi) [cite: 55]</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">13. Foto PIC [cite: 44]</p>
                            <a href="<?php echo e($seller->foto_pic_url); ?>" target="_blank" class="text-blue-600 hover:underline">Lihat Foto PIC</a>
                            </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">14. File Upload KTP PIC [cite: 45]</p>
                            <a href="<?php echo e($seller->file_upload_ktp_url); ?>" target="_blank" class="text-blue-600 hover:underline">Lihat File KTP PIC (.pdf/.jpg)</a>
                            </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-red-700 mb-4">Aksi Verifikasi (SRS-MartPlace-02)</h2>
                <p class="text-gray-700 mb-4">Proses verifikasi ini akan mengirimkan notifikasi via email (diterima/ditolak) kepada calon penjual. [cite: 56]</p>

                <form action="<?php echo e(route('platform.verifikasi.process', $seller->id)); ?>" method="POST" class="flex space-x-4">
                    <?php echo csrf_field(); ?> 
                    
                    <input type="hidden" name="action" id="action_input">

                    <button type="submit" 
                            onclick="document.getElementById('action_input').value='approve'"
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition duration-150">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Terima & Aktifkan Akun
                    </button>
                    
                    <button type="submit" 
                            onclick="document.getElementById('action_input').value='reject'"
                            class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition duration-150">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        Tolak & Kirim Notifikasi Penolakan
                    </button>
                </form>
            </div>
        </main>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\PPL QUADMARKET\QuadMarket\resources\views/platform/verification_detail.blade.php ENDPATH**/ ?>