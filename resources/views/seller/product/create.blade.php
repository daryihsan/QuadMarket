<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Saya - Totem</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root {
            --primary-color: #007bff; /* Biru */
            --secondary-color: #6c757d; /* Abu-abu */
            --background-color: #f8f9fa; /* Background utama */
            --card-background: #ffffff; /* Background Card */
            --text-color: #212529;
            --border-color: #e9ecef;
            --active-status: #28a745; /* Hijau */
            --inactive-status: #dc3545; /* Merah */
            --stock-out-status: #ffc107; /* Kuning (untuk stok habis) */
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
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR (Kiri) --- */
        .sidebar {
            width: 250px;
            background-color: var(--card-background);
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            flex-shrink: 0;
        }

        .logo-section {
            display: flex;
            align-items: center;
            padding-bottom: 30px;
            border-bottom: 1px solid var(--border-color);
        }

        .logo-icon {
            width: 30px;
            height: 30px;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            font-weight: bold;
            margin-right: 10px;
        }

        .logo-text span {
            display: block;
            font-size: 0.8em;
            color: var(--secondary-color);
        }

        .main-nav, .settings-nav {
            list-style: none;
            padding: 0;
        }

        .main-nav {
            flex-grow: 1;
            padding-top: 20px;
        }

        .sidebar ul li {
            margin-bottom: 5px;
        }

        .sidebar ul li a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            text-decoration: none;
            color: var(--text-color);
            border-radius: 5px;
            transition: background-color 0.2s;
            position: relative; 
            padding-left: 40px;
        }
        
        /* Ikon placeholder untuk Sidebar */
        .sidebar ul li a::before {
            font-family: 'Font Awesome 6 Free'; /* Menggunakan Font Awesome untuk ikon menu */
            font-weight: 900;
            content: "\f009"; /* Default ikon (Dashboard) */
            position: absolute;
            left: 15px;
            font-size: 1.1em;
            color: var(--secondary-color);
        }
        /* Ikon spesifik (Hanya contoh, perlu disesuaikan dengan kebutuhan) */
        .sidebar ul li:nth-child(2) a::before { content: "\f54f"; } /* Produk */
        .sidebar ul li:nth-child(3) a::before { content: "\f570"; } /* Pesanan */
        .sidebar ul li:nth-child(4) a::before { content: "\f0c0"; } /* Pelanggan */
        .sidebar ul li:nth-child(5) a::before { content: "\f65d"; } /* Laporan */
        .settings-nav li:nth-child(1) a::before { content: "\f013"; } /* Pengaturan */
        .settings-nav li:nth-child(2) a::before { content: "\f059"; } /* Bantuan */
        .settings-nav li:nth-child(3) a::before { content: "\f08b"; } /* Keluar */


        .sidebar ul li.active a,
        .sidebar ul li a:hover {
            background-color: var(--background-color);
            color: var(--primary-color);
            font-weight: 500;
        }
        .sidebar ul li.active a::before,
        .sidebar ul li a:hover::before {
            color: var(--primary-color);
        }

        /* --- KONTEN UTAMA (Kanan) --- */
        .main-content {
            flex-grow: 1;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 1.8em;
            font-weight: 700;
        }

        .header p {
            color: var(--secondary-color);
            font-size: 0.9em;
        }

        .brand-logo {
            height: 30px; 
        }

        /* --- TOOLBAR PRODUK (Search, Button) --- */
        .product-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .search-input {
            width: 100%;
            max-width: 450px;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .add-product-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
        }

        .add-product-btn:hover {
            background-color: #0056b3;
        }

        .add-product-btn i {
            margin-right: 8px;
        }

        /* --- SUMMARY CARDS --- */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background-color: var(--card-background);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .summary-card .card-title {
            display: block;
            font-size: 0.9em;
            color: var(--secondary-color);
            margin-bottom: 5px;
        }

        .summary-card .card-value {
            font-size: 2em;
            font-weight: 700;
            color: var(--text-color);
        }

        /* --- TABEL PRODUK --- */
        .product-list-card {
            padding: 0;
        }

        .product-table-wrapper {
            overflow-x: auto;
            border-radius: 8px;
            background-color: var(--card-background);
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-table th, .product-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .product-table th {
            font-size: 0.8em;
            color: var(--secondary-color);
            font-weight: 500;
            text-transform: uppercase;
            background-color: #f4f6f9;
        }

        .product-table tbody tr:last-child td {
            border-bottom: none;
        }

        .product-detail {
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .product-detail img {
            width: 40px;
            height: 40px;
            border-radius: 5px;
            object-fit: cover;
            margin-right: 10px;
            border: 1px solid var(--border-color);
            background-color: #f0f0f0; 
        }

        /* Status Badge */
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.75em;
            font-weight: 700;
            display: inline-block;
        }

        .status-active {
            background-color: #d4edda; 
            color: var(--active-status);
        }

        .status-inactive {
            background-color: #f8d7da; 
            color: var(--inactive-status);
        }

        /* Aksi */
        .action-cell a {
            color: var(--secondary-color);
            margin-right: 15px;
            font-size: 1.1em;
            transition: color 0.2s;
        }

        .action-cell .edit-btn:hover {
            color: var(--primary-color);
        }

        .action-cell .delete-btn {
            color: var(--inactive-status);
        }
        .action-cell .delete-btn:hover {
            color: #b00020;
        }

        /* Footer Tabel & Pagination */
        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-top: 1px solid var(--border-color);
            font-size: 0.9em;
            color: var(--secondary-color);
        }

        .pagination-controls button {
            background-color: var(--card-background);
            color: var(--text-color);
            padding: 8px 15px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
            transition: background-color 0.2s;
        }
        .pagination-controls button:hover:not(:disabled) {
            background-color: #e9ecef;
        }
        .pagination-controls button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Style khusus untuk 'Produk' aktif di sidebar */
        .main-nav ul li:nth-child(2) {
            background-color: var(--background-color);
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-icon">T</div>
                <div class="logo-text">
                    <strong>Totem</strong>
                    <span>Semarang</span>
                </div>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#"> Dashboard</a></li>
                    <li class="active"><a href="#"> Produk</a></li>
                    <li><a href="#"> Pesanan</a></li>
                    <li><a href="#"> Pelanggan</a></li>
                    <li><a href="#"> Laporan</a></li>
                </ul>
            </nav>
            <div class="settings-nav">
                <ul>
                    <li><a href="#"> Pengaturan</a></li>
                    <li><a href="#"> Bantuan</a></li>
                    <li><a href="#"> Keluar</a></li>
                </ul>
            </div>
        </aside>

        <main class="main-content">
            <header class="header">
                <div>
                    <h1>Produk Saya</h1>
                    <p>Kelola semua produk yang Anda jual</p>
                </div>
                <div style="font-weight: bold; color: var(--primary-color); font-size: 1.5em;">QuadMarket</div> 
            </header>

            <div class="product-toolbar">
                <input type="text" placeholder="Cari Produk" class="search-input">
                <button class="add-product-btn">
                    <i class="fas fa-plus"></i> Tambah Produk
                </button>
            </div>

            <section class="summary-cards" id="summary-cards">
                </section>

            <section class="product-list-card">
                <div class="product-table-wrapper">
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>PRODUK</th>
                                <th>KATEGORI</th>
                                <th>HARGA</th>
                                <th>STOK</th>
                                <th>STATUS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="productTableBody">
                            </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    <div id="paginationInfo">Menampilkan 1-8 dari 1.204 produk</div>
                    <div class="pagination-controls">
                        <button disabled>Sebelumnya</button>
                        <button>Selanjutnya</button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        // 1. DATA DUMMY
        const productData = {
            total_produk: 1204,
            produk_aktif: 1029,
            stok_habis: 167,
            tidak_aktif: 8,
            produk: [
                { id: 1, nama: "Smartphone Canggih X1", kategori: "Elektronik", harga: "Rp 4.999.000", stok: 120, status: "Aktif", image: "https://via.placeholder.com/40x40?text=S1" },
                { id: 2, nama: "Smartphone Canggih X1", kategori: "Elektronik", harga: "Rp 4.999.000", stok: 120, status: "Aktif", image: "https://via.placeholder.com/40x40?text=S2" },
                { id: 3, nama: "Smartphone Canggih X1", kategori: "Elektronik", harga: "Rp 4.999.000", stok: 120, status: "NonAktif", image: "https://via.placeholder.com/40x40?text=S3" },
                { id: 4, nama: "Smartphone Canggih X1", kategori: "Elektronik", harga: "Rp 4.999.000", stok: 120, status: "Aktif", image: "https://via.placeholder.com/40x40?text=S4" },
                { id: 5, nama: "Smartphone Canggih X1", kategori: "Elektronik", harga: "Rp 4.999.000", stok: 120, status: "Aktif", image: "https://via.placeholder.com/40x40?text=S5" },
                { id: 6, nama: "Smartphone Canggih X1", kategori: "Elektronik", harga: "Rp 4.999.000", stok: 120, status: "Aktif", image: "https://via.placeholder.com/40x40?text=S6" },
                { id: 7, nama: "Smartphone Canggih X1", kategori: "Elektronik", harga: "Rp 4.999.000", stok: 120, status: "Aktif", image: "https://via.placeholder.com/40x40?text=S7" },
                { id: 8, nama: "Smartphone Canggih X1", kategori: "Elektronik", harga: "Rp 4.999.000", stok: 120, status: "Aktif", image: "https://via.placeholder.com/40x40?text=S8" }
            ]
        };

        document.addEventListener('DOMContentLoaded', () => {
            renderSummaryCards();
            renderProductTable(productData.produk);
        });

        // 2. FUNGSI MERENDER SUMMARY CARDS
        function renderSummaryCards() {
            const summary = [
                { title: "Total Produk", value: productData.total_produk.toLocaleString(), class: "" },
                { title: "Produk Aktif", value: productData.produk_aktif.toLocaleString(), class: "" },
                { title: "Stok Habis", value: productData.stok_habis.toLocaleString(), class: "" },
                { title: "Tidak Aktif", value: productData.tidak_aktif.toLocaleString(), class: "" }
            ];

            const container = document.getElementById('summary-cards');
            container.innerHTML = summary.map(item => `
                <div class="card summary-card ${item.class}">
                    <span class="card-title">${item.title}</span>
                    <strong class="card-value">${item.value}</strong>
                </div>
            `).join('');
        }

        // 3. FUNGSI MERENDER TABEL PRODUK
        function renderProductTable(products) {
            const tbody = document.getElementById('productTableBody');
            tbody.innerHTML = products.map(product => {
                const statusClass = product.status === "Aktif" ? "status-active" : "status-inactive";
                return `
                    <tr>
                        <td>
                            <div class="product-detail">
                                <img src="${product.image}" alt="${product.nama}">
                                ${product.nama}
                            </div>
                        </td>
                        <td>${product.kategori}</td>
                        <td>${product.harga}</td>
                        <td>${product.stok}</td>
                        <td><span class="status-badge ${statusClass}">${product.status}</span></td>
                        <td class="action-cell">
                            <a href="#" class="edit-btn" title="Edit Produk"><i class="fas fa-pencil-alt"></i></a>
                            <a href="#" class="delete-btn" title="Hapus Produk"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                `;
            }).join('');
        }
    </script>
</body>
</html>