<!DOCTYPE html>
<html>
<body>
    <h2>Verifikasi Berhasil!</h2>

    <p>Halo {{ $username }},</p>

    <p>Email anda berhasil diverifikasi! Silakan klik tombol di bawah untuk mengaktifkan akun anda.</p>

    <a href="{{ $activationUrl }}" 
       style="display:inline-block;padding:10px 20px;background:#4CAF50;color:white;text-decoration:none;border-radius:5px;">
       Aktivasi Akun
    </a>

    <p>Jika tombol tidak berfungsi, buka link berikut:</p>
    <p>{{ $activationUrl }}</p>

</body>
</html>
