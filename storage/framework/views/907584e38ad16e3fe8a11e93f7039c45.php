<?php $__env->startSection('title', 'Registrasi'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-center items-center min-h-screen bg-gray-100 px-4">
    <div class="bg-white w-full max-w-lg shadow-xl rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Registrasi</h2>

        
        <?php if($errors->any()): ?>
            <div class="mb-5 bg-red-50 border border-red-300 text-red-700 text-sm rounded-lg p-3">
                <ul class="list-disc pl-5">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($err); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>

            <!-- Nama depan & belakang -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Depan</label>
                    <input id="first_name" name="first_name" type="text"
                        class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 shadow-sm"
                        required>
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Belakang</label>
                    <input id="last_name" name="last_name" type="text"
                        class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 shadow-sm"
                        required>
                </div>
            </div>

            <!-- Email -->
            <div>
                <label for="university_email" class="block text-sm font-medium text-gray-700 mb-1">Email Universitas</label>
                <input id="university_email" name="university_email" type="email"
                    class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 shadow-sm"
                    placeholder="contoh@students.undip.ac.id" required>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                <input id="password" name="password" type="password"
                    class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 px-3 py-2 shadow-sm"
                    required>
                <p class="text-xs text-gray-500 mt-1">
                    Minimal 8 karakter, wajib mengandung huruf, angka, dan simbol unik (@, #, $).
                </p>
            </div>

            <!-- Tombol -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-md transition">
                    Sign Up
                </button>
            </div>
        </form>

        <p class="text-center text-sm mt-5 text-gray-600">
            Sudah punya akun?
            <a href="<?php echo e(route('login')); ?>" class="text-blue-600 hover:underline font-semibold">Masuk Sekarang</a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\QuadMarket\resources\views/auth/register.blade.php ENDPATH**/ ?>