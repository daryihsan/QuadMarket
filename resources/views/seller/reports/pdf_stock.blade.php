<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
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
    <h1>{{ $title }}</h1>
    <p class="meta">
        Tanggal dibuat: {{ $reportDate }} oleh {{ $processorName }}
    </p>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Rating</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $index => $product)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="text-center">{{ number_format($product->rating ?? 0, 1) }}</td>
                    <td class="text-center">{{ $product->stock }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data stok produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>