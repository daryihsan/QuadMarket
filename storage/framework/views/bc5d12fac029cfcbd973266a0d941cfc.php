<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Status Penjual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .sidebar { width: 250px; background-color: #ffffff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); flex-shrink: 0; }
        .main-content { flex-grow: 1; padding: 30px; margin-left: 250px; }
        .nav-link { display: flex; align-items: center; padding: 12px 16px; border-radius: 8px; color: #6b7280; transition: all 0.2s; }
        .nav-link:hover { background-color: #f3f4f6; color: #1f2937; }
        .nav-link.active { background-color: #e5e7eb; color: #007bff; font-weight: 600; }
    </style>
</head>
<body>
<div class="flex min-h-screen">
    
    <aside class="sidebar fixed h-full">
        <div class="p-6 border-b mb-4">
            <h3 class="font-bold text-lg text-gray-800">Admin Menu</h3>
        </div>
        <nav class="space-y-2">
            <a href="<?php echo e(route('platform.dashboard')); ?>" class="nav-link">
                <i class="fas fa-chart-line mr-3"></i> Dashboard
            </a>
            <a href="<?php echo e(route('platform.verifikasi.list')); ?>" class="nav-link">
                <i class="fas fa-check-circle mr-3"></i> Verifikasi Penjual
            </a>
            <a href="<?php echo e(route('platform.laporan')); ?>" class="nav-link active">
                <i class="fas fa-file-alt mr-3"></i> Laporan
            </a>
            <a href="<?php echo e(route('platform.categories.index')); ?>" class="nav-link">
                <i class="fas fa-tags mr-3"></i> Manajemen Kategori
            </a>
        </nav>
        <div class="absolute bottom-0 w-full pr-4 border-t p-4 bg-white">
            <a href="#" class="nav-link">
                <i class="fas fa-cog mr-3"></i>
                <span>Pengaturan</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fas fa-question-circle mr-3"></i>
                <span>Bantuan</span>
            </a>
        </div>
    </aside>

    
    <main class="main-content">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-blue-900">Dashboard Laporan</h1>
                <p class="text-sm text-gray-500 mt-1">Daftar penjual yang terdaftar di QuadMarket.</p>
            </div>
            <img src="<?php echo e(url('assets/images/logo.png')); ?>" alt="QuadMarket" class="h-20">
        </div>

        <div class="bg-white rounded-t-lg shadow">
            <div class="flex border-b">
                <a href="<?php echo e(route('platform.laporan')); ?>"
                   class="px-6 py-4 text-blue-900 font-semibold border-b-2 border-blue-900 whitespace-nowrap hover:bg-gray-50 transition-colors">
                    Daftar Penjual
                </a>
                <a href="<?php echo e(route('platform.laporan.provinsi')); ?>"
                   class="px-6 py-4 text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition-colors whitespace-nowrap">
                    Penjual per Provinsi
                </a>
                <a href="<?php echo e(route('platform.laporan.produk')); ?>"
                   class="px-6 py-4 text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition-colors whitespace-nowrap">
                    Produk Lengkap
                </a>
            </div>
        </div>

        
        <div class="bg-white shadow px-6 py-4">
            <div class="flex justify-between items-start flex-wrap gap-4">
                <form method="GET" action="<?php echo e(route('platform.laporan')); ?>"
                      class="flex items-start space-x-3 flex-wrap gap-3">
                    <label class="text-gray-700 whitespace-nowrap pt-2">Filter berdasarkan status :</label>
                    <select name="status"
                            class="border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 min-w-[160px]">
                        <option value="semua" <?php echo e($statusFilter === 'semua' ? 'selected' : ''); ?>>Semua Status</option>
                        <option value="aktif" <?php echo e($statusFilter === 'aktif' ? 'selected' : ''); ?>>Aktif</option>
                        <option value="tidak_aktif" <?php echo e($statusFilter === 'tidak_aktif' ? 'selected' : ''); ?>>Tidak Aktif</option>
                    </select>
                </form>

                
                <a href="<?php echo e(route('platform.laporan.download', ['type' => 'status', 'status' => $statusFilter])); ?>"
                   class="flex items-center space-x-2 bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600 transition">
                    <i class="fas fa-download text-white"></i>
                    <span>Unduh PDF</span>
                </a>
            </div>
        </div>

        
        <div class="bg-white shadow rounded-b-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[180px]">Nama Penjual</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[150px]">ID Penjual</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[200px]">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[120px]">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 min-w-[150px]">Tanggal Bergabung</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-800 font-medium"><?php echo e($seller->nama_toko); ?></td>
                            <td class="px-6 py-4 text-gray-600">
                                ID-Penjual-<?php echo e(str_pad($seller->id, 3, '0', STR_PAD_LEFT)); ?>

                            </td>
                            <td class="px-6 py-4 text-gray-600"><?php echo e($seller->email_pic ?? $seller->email); ?></td>
                            <td class="px-6 py-4">
                                <?php
                                    $isActive = $seller->status_akun === 'active';
                                ?>
                                <span class="px-3 py-1 text-xs font-medium rounded-full whitespace-nowrap inline-block
                                    <?php echo e($isActive ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'); ?>">
                                    <?php echo e($isActive ? 'Aktif' : 'Tidak Aktif'); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                <?php echo e(optional($seller->created_at)->format('d M Y')); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Belum ada penjual yang terdaftar.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="bg-white px-6 py-4 border-t flex items-center justify-between flex-wrap gap-4">
                <div class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold"><?php echo e($sellers->count()); ?></span> penjual
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html><?php /**PATH C:\xampp\htdocs\PPL QUADMARKET\QuadMarket\resources\views/platform/laporan.blade.php ENDPATH**/ ?>