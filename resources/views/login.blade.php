<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Sedikit style agar rapi seperti di screenshot */
        body { font-family: sans-serif; display: grid; place-items: center; min-height: 80vh; }
        form { border: 1px solid #ccc; padding: 20px; border-radius: 8px; }
        table { border-collapse: collapse; width: 300px; }
        td { padding: 5px 0; }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box; /* Agar padding tidak merusak lebar */
        }
        button { width: 100%; padding: 10px; background-color: #f0f0f0; border: 1px solid #ccc; cursor: pointer; margin-top: 10px; }
        a { color: purple; text-decoration: none; }
        .error { color: red; font-size: 0.9em; }
    </style>
</head>
<body>

    <form action="/login" method="POST">
        @csrf <h2 style="text-align: center;">Login</h2>

        @if ($errors->any())
            <div class="error" style="text-align: center; margin-bottom: 10px;">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <table>
            <tr>
                <td>Email Universitas</td>
            </tr>
            <tr>
                <td><input type="email" name="email" value="{{ old('email') }}" required></td>
            </tr>
            <tr>
                <td>Kata Sandi</td>
            </tr>
            <tr>
                <td><input type="password" name="password" required></td>
            </tr>
        </table>
        
        <button type="submit">Masuk</button>

        <p style="text-align: center; font-size: 0.9em; margin-top: 15px;">
            Belum punya akun? <a href="/register">Registrasi Sekarang</a>
        </p>
    </form>

</body>
</html>