<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .sidebar { width: 250px; background-color: #ffffff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); flex-shrink: 0; }
        .main-content { flex-grow: 1; padding: 30px; }
        .nav-link { display: flex; align-items: center; padding: 12px 16px; border-radius: 8px; color: #6b7280; transition: all 0.2s; }
        .nav-link:hover { background-color: #f3f4f6; color: #1f2937; }
        .nav-link.active { background-color: #e5e7eb; color: #007bff; font-weight: 600; }
        .blue-gradient { background-image: linear-gradient(to right, #1E3A8A, #3B82F6); }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        
        <aside class="sidebar">
            <div class="p-6 border-b mb-4">
                <h3 class="font-bold text-lg text-gray-800">Admin Menu</h3>
            </div>
            <nav class="space-y-2">
                <a href="<?php echo e(route('platform.dashboard')); ?>" class="nav-link"><i class="fas fa-chart-line mr-3"></i> Dashboard</a>
                <a href="<?php echo e(route('platform.verifikasi.list')); ?>" class="nav-link"><i class="fas fa-check-circle mr-3"></i> Verifikasi Penjual</a>
                <a href="<?php echo e(route('platform.laporan')); ?>" class="nav-link"><i class="fas fa-file-alt mr-3"></i> Laporan</a>
                <a href="<?php echo e(route('platform.categories.index')); ?>" class="nav-link active"><i class="fas fa-tags mr-3"></i> Manajemen Kategori</a>
            </nav>
        </aside>
        
        <main class="main-content">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Manajemen Kategori Produk</h1>
            </div>
            
            
            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>
            <?php if($errors->any()): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">Terjadi kesalahan input.</span>
                </div>
            <?php endif; ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-semibold mb-4 border-b pb-3 text-gray-800">Tambah Kategori Baru</h2>
                        <form action="<?php echo e(route('platform.categories.store')); ?>" method="POST" class="space-y-4" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                                <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Elektronik" value="<?php echo e(old('name')); ?>" required>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div>
                                <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Ikon Kategori (PNG/JPG)</label>
                                <input type="file" id="icon" name="icon" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition">
                                <i class="fas fa-plus mr-2"></i> Tambah
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-semibold mb-4 border-b pb-3 text-gray-800">Daftar Kategori Tersedia</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <?php echo e($categories->firstItem() + $index); ?>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                <div class="flex items-center space-x-3">
                                                    <?php if($category->icon_path): ?>
                                                        <img src="<?php echo e($category->icon_path); ?>" alt="Icon" class="h-8 w-8 object-cover rounded-full">
                                                    <?php else: ?>
                                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                                            <i class="fas fa-tag"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <span><?php echo e($category->name); ?></span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="openEditModal(<?php echo e($category->id); ?>, '<?php echo e($category->name); ?>')" class="text-blue-600 hover:text-blue-900 transition mr-3"><i class="fas fa-pencil-alt"></i> Edit</button>
                                                <button onclick="confirmDelete(<?php echo e($category->id); ?>)" class="text-red-600 hover:text-red-900 transition"><i class="fas fa-trash-alt"></i> Hapus</button>
                                                
                                                <form id="delete-form-<?php echo e($category->id); ?>" action="<?php echo e(route('platform.categories.destroy', $category)); ?>" method="POST" style="display: none;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">Tidak ada kategori yang ditambahkan.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            <?php echo e($categories->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-bold mb-4">Edit Kategori</h2>
            <form id="editForm" method="POST" action="" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div>
                    <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                    <input type="text" id="edit_name" name="name" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div class="mt-4">
                    <label for="edit_icon" class="block text-sm font-medium text-gray-700 mb-1">Ganti Ikon (Kosongkan jika tidak diubah)</label>
                    <input type="file" id="edit_icon" name="icon" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus kategori ini? Tindakan ini tidak dapat dibatalkan.')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');
        const editNameInput = document.getElementById('edit_name');
        
        function openEditModal(id, name) {
            const updateUrl = '<?php echo e(route('platform.categories.update', 'REPLACE_ID')); ?>';
            editForm.action = updateUrl.replace('REPLACE_ID', id);
            editNameInput.value = name;
            editModal.classList.remove('hidden');
            editModal.classList.add('flex');
        }
        function closeEditModal() {
            editModal.classList.add('hidden');
            editModal.classList.remove('flex');
        }
        
        // Menangani penutupan modal saat mengklik di luar modal
        editModal.addEventListener('click', (e) => {
            if (e.target === editModal) {
                closeEditModal();
            }
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\QuadMarket\resources\views/platform/categories.blade.php ENDPATH**/ ?>