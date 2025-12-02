<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo e($title); ?></title>
    <style>
        * { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        h1 { font-size: 16px; text-align: center; margin-bottom: 4px; }
        .meta { font-size: 11px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #000; padding: 4px 6px; }
        th { text-align: center; font-weight: bold; }
        td { vertical-align: top; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h1><?php echo e($title); ?></h1>
    <p class="meta">
        Tanggal dibuat: <?php echo e($reportDate); ?> oleh <?php echo e($processorName); ?>

    </p>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-center"><?php echo e($index + 1); ?></td>
                    <td><?php echo e($product->name); ?></td>
                    <td><?php echo e($product->category->name ?? '-'); ?></td>
                    <td class="text-right">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></td>
                    <td class="text-center"><?php echo e($product->stock); ?></td>
                    <td class="text-center"><?php echo e(number_format($product->rating ?? 0, 1)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data rating produk.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH C:\xampp\htdocs\PPL QUADMARKET\QuadMarket\resources\views/seller/reports/pdf_rating.blade.php ENDPATH**/ ?>