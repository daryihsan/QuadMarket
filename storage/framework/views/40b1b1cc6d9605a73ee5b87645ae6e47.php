<!DOCTYPE html>
<html>
<body>
    <h2>Verifikasi Berhasil!</h2>

    <p>Halo <?php echo e($username); ?>,</p>

    <p>Email anda berhasil diverifikasi! Silakan klik tombol di bawah untuk mengaktifkan akun anda.</p>

    <a href="<?php echo e($activationUrl); ?>" 
       style="display:inline-block;padding:10px 20px;background:#4CAF50;color:white;text-decoration:none;border-radius:5px;">
       Aktivasi Akun
    </a>

    <p>Jika tombol tidak berfungsi, buka link berikut:</p>
    <p><?php echo e($activationUrl); ?></p>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\PPL QUADMARKET\QuadMarket\resources\views/emails/seller_verified.blade.php ENDPATH**/ ?>