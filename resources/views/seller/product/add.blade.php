<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru Totem</title>
    <link href="[https://fonts.googleapis.com/css?family=Roboto:wght@300;400;500;700&display=swap](https://fonts.googleapis.com/css?family=Roboto:wght@300;400;500;700&display=swap)" rel="stylesheet">
    <link rel="stylesheet" href="[https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css](https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css)">
    <style>
        :root {
            --primary-color: #007bff;
            /* Biru */
            --secondary-color: #6c757d;
            /* Abu-abu */
            --background-color: #f8f9fa;
            /* Background utama */
            --card-background: #ffffff;
            /* Background Card */
            --text-color: #212529;
            --border-color: #e9ecef;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        /* HEADER & NAVIGATION */
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .back-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--secondary-color);
            font-size: 0.9em;
            margin-bottom: 20px;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: var(--primary-color);
        }

        .back-link i {
            margin-right: 5px;
        }

        .title-group h1 {
            font-size: 1.8em;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .title-group p {
            color: var(--secondary-color);
            font-size: 0.9em;
        }

        .brand-logo {
            font-weight: bold;
            color: var(--primary-color);
            font-size: 1.5em;
        }

        /* CARD FORM SECTIONS */
        .card {
            background-color: var(--card-background);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .card h2 {
            font-size: 1.4em;
            font-weight: 600;
            margin-bottom: 25px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 15px;
        }

        .card-subtitle {
            font-size: 1em;
            color: var(--secondary-color);
            margin-top: -10px;
            margin-bottom: 20px;
        }

        /* FOTO PRODUK SECTION */
        .photo-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            padding: 50px 20px;
            text-align: center;
            color: var(--secondary-color);
            cursor: pointer;
            transition: border-color 0.2s;
        }

        .photo-upload-area:hover {
            border-color: var(--primary-color);
        }

        .upload-icon {
            font-size: 2em;
            margin-bottom: 10px;
            color: var(--secondary-color);
        }

        .upload-text {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .upload-hint {
            font-size: 0.8em;
            margin-top: 15px;
            display: block;
        }

        /* FORM ELEMENTS */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-full,
        .input-half {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 1em;
            transition: border-color 0.2s;
        }

        .input-full:focus,
        .input-half:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        textarea.input-full {
            resize: vertical;
            min-height: 100px;
        }

        .two-column-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* VARIAN PRODUK SECTION */
        .variant-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 15px;
        }

        .add-variant-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            font-size: 0.9em;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
        }

        .add-variant-btn:hover {
            background-color: #0056b3;
        }

        .add-variant-btn i {
            margin-right: 5px;
        }

        .no-variant-text {
            color: var(--secondary-color);
            font-size: 0.9em;
        }

        /* FOOTER AKSI (Button) */
        .action-footer {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            padding-top: 20px;
            position: sticky;
            bottom: 0;
            background-color: var(--background-color);
            z-index: 100;
        }

        .action-footer button {
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .cancel-btn {
            background-color: var(--card-background);
            color: var(--secondary-color);
            border: 1px solid var(--border-color);
        }

        .save-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .save-btn:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="{{ route('seller.products.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Produk
        </a>

        <div class="header-section">
            <div class="title-group">
                <h1>Tambah Produk Baru</h1>
                <p>Lengkapi informasi produk yang akan dijual</p>
            </div>
            <div class="brand-logo">QuadMarket</div>
        </div>

        <form action="{{ route('seller.products.store') }}" method="POST">
            @csrf

            <div class="card">
                <h2>Foto Produk</h2>
                <div class="photo-upload-area">
                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                    <div class="upload-text">Klik untuk mengunggah atau seret dan lepas</div>
                    <small class="upload-hint">Format: JPG, PNG. Maksimal 5 foto. Foto pertama akan menjadi foto
                        utama.</small>
                    <input type="file" name="images[]" multiple accept=".jpg,.jpeg,.png" style="display: none;">
                </div>
            </div>

            <div class="card">
                <h2>Informasi Produk</h2>
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" id="name" name="name" class="input-full"
                        placeholder="Contoh: Smartphone Canggih X1" required value="{{ old('name') }}">
                    @error('name') <small style="color: red;">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select id="category_id" name="category_id" class="input-full">
                        <option value="">Pilih salah satu</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                        </select>
                    @error('category_id') <small style="color: red;">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="input-full"
                        placeholder="Jelaskan produk Anda secara detail...">{{ old('description') }}</textarea>
                    @error('description') <small style="color: red;">{{ $message }}</small> @enderror
                </div>
                <div class="two-column-group">
                    <div class="form-group">
                        <label for="kondisi">Kondisi</label>
                        <select id="kondisi" name="condition" class="input-half">
                            <option value="">Pilih kondisi barang</option>
                            <option value="baru">Baru</option>
                            <option value="bekas">Bekas</option>
                        </select>
                        </div>
                    <div class="form-group">
                        <label for="min_order">Minimal Pemesanan</label>
                        <input type="number" id="min_order" name="min_order" class="input-half" value="{{ old('min_order', 1) }}" min="1">
                        </div>
                </div>
            </div>

            <div class="card">
                <h2>Harga & Stok</h2>
                <div class="two-column-group">
                    <div class="form-group">
                        <label for="price">Harga (Rp)</label>
                        <input type="number" id="price" name="price" class="input-half"
                            placeholder="0" min="0" required value="{{ old('price') }}">
                        @error('price') <small style="color: red;">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="stock">Stok Barang</label>
                        <input type="number" id="stock" name="stock" class="input-half"
                            placeholder="0" min="1" required value="{{ old('stock') }}">
                        @error('stock') <small style="color: red;">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="variant-header">
                    <h2>Varian Produk</h2>
                    <button type="button" class="add-variant-btn">
                        <i class="fas fa-plus"></i> Tambah Varian
                    </button>
                </div>
                <div class="card-subtitle">(Opsional)</div>
                <div class="no-variant-text">
                    Belum ada varian. Klik Tambah Varian untuk menambahkan varian seperti ukuran, warna, dll.
                </div>
            </div>

            <div class="action-footer">
                <button type="button" class="cancel-btn" onclick="window.location.href='{{ route('seller.products.index') }}'">Batal</button>
                <button type="submit" class="save-btn">Simpan Produk</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const uploadArea = document.querySelector('.photo-upload-area');
            const fileInput = uploadArea.querySelector('input[type="file"]');

            // Klik area upload memicu klik input file tersembunyi
            uploadArea.addEventListener('click', () => {
                fileInput.click();
            });

            // Mencegah default browser behavior untuk drag and drop (dari Quad.pdf)
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Highlighting area saat file di-drag over (dari Quad.pdf)
            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, () => {
                    uploadArea.style.borderColor = '#007bff'
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, () => {
                    uploadArea.style.borderColor = '#e9ecef'
                }, false);
            });

            // Handle file drop (fungsi ini hanya alert, bukan upload sebenarnya) (dari Quad.pdf)
            uploadArea.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length > 0) {
                    alert(`Mengunggah ${files.length} file: ${Array.from(files).map(f => f.name).join(', ')}`);
                }
            }, false);

            // Button actions dummy (dari Quad.pdf, diganti dengan action form submit)
            document.querySelector('.add-variant-btn').addEventListener('click', () => {
                alert('Fungsi Tambah Varian dipanggil! (Akan membuka modal atau menambah form)');
            });
        });
    </script>
</body>

</html>