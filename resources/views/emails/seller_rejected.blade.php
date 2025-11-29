<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Pengajuan Ditolak</title>
</head>

<body style="font-family: Arial, sans-serif; background: #f7f7f7; padding: 20px;">

    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 25px; border-radius: 8px;">

        <h2 style="color: #d32f2f; margin-bottom: 10px;">
            Pengajuan Akun Ditolak
        </h2>

        <p style="font-size: 16px; color: #333;">
            Halo {{ $username }},
        </p>

        <p style="font-size: 15px; color: #555; line-height: 1.6;">
            Terima kasih telah melakukan pendaftaran sebagai penjual. 
            Namun, setelah dilakukan pengecekan, <strong>pengajuan akun Anda tidak dapat disetujui</strong> pada saat ini.
        </p>

        @if(isset($alasan))
        <div style="background: #ffebee; padding: 15px; border-left: 4px solid #d32f2f; border-radius: 4px; margin: 20px 0;">
            <strong>Alasan penolakan:</strong>
            <p style="margin: 8px 0 0; color: #333;">{{ $alasan }}</p>
        </div>
        @endif

        <p style="font-size: 15px; color: #555; line-height: 1.6;">
            Anda dapat memperbaiki data atau mengajukan kembali pendaftaran Anda. 
            Jika Anda membutuhkan bantuan lebih lanjut, silakan hubungi tim admin kami.
        </p>

        <p style="margin-top: 30px; font-size: 14px; color: #777;">
            Hormat kami,<br>
            <strong>Tim Verifikasi Penjual</strong>
        </p>

    </div>

</body>
</html>
