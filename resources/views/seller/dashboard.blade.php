<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Toko - Totem</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

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
            /* Placeholder untuk ikon Totem */
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
            /* Placeholder untuk ikon */
            position: relative; 
            padding-left: 40px;
        }
        
        /* Ikon placeholder, Anda bisa ganti ini dengan Font Awesome atau SVG */
        .sidebar ul li a::before {
            content: "◼︎"; /* Ikon placeholder */
            position: absolute;
            left: 15px;
            font-size: 1.1em;
            color: var(--secondary-color);
        }
        .sidebar ul li.active a::before {
            color: var(--primary-color);
        }

        .sidebar ul li.active a,
        .sidebar ul li a:hover {
            background-color: var(--background-color);
            color: var(--primary-color);
            font-weight: 500;
        }
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

        /* --- CARD UMUM --- */
        .card {
            background-color: var(--card-background);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* --- SUMMARY CARDS (4 Card Atas) --- */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
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

        /* --- CHART AND LOCATION SECTION --- */
        .chart-and-location-section {
            display: grid;
            grid-template-columns: 2fr 1fr; 
            gap: 20px;
            margin-bottom: 30px;
        }

        /* Penjualan Berdasarkan Kategori Card */
        .sales-chart-card h3 {
            margin-bottom: 20px;
        }

        /* Chart Area untuk Bar Chart */
        .chart-area {
            position: relative;
            height: 180px;
            margin-bottom: 10px;
        }

        .categories {
            display: flex;
            justify-content: space-around;
            font-size: 0.8em;
            color: var(--secondary-color);
            padding-top: 10px;
        }

        /* Lokasi Pembeli Card */
        .location-card {
            display: flex;
            flex-direction: column;
        }

        .location-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-grow: 1;
        }

        .donut-chart-wrapper {
            /* Wrapper untuk menahan Donut Chart dan teks di tengah */
            width: 150px;
            height: 150px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .order-center-text {
            position: absolute;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
        .order-count {
            font-size: 1.8em;
            font-weight: 700;
        }
        .order-label {
            font-size: 0.8em;
            color: var(--secondary-color);
        }

        .legend {
            list-style: none;
            padding: 0;
            font-size: 0.9em;
        }

        .legend li {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .color-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 8px;
            flex-shrink: 0;
        }
        
        /* --- TABEL PRODUK TERBARU --- */
        .recent-products-section h2 {
            font-size: 1.4em;
            margin-bottom: 15px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--card-background);
            border-radius: 8px;
            overflow: hidden;
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
            background-color: #f0f0f0; /* Untuk simulasi gambar */
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
                    <li class="active"><a href="#"> Dashboard</a></li>
                    <li><a href="#"> Produk</a></li>
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
                    <h1>Dashboard Toko</h1>
                    <p>Selamat Datang, Totem! Ini ringkasan performa tokomu.</p>
                </div>
                <div style="font-weight: bold; color: var(--primary-color); font-size: 1.5em;">QuadMarket</div> 
            </header>

            <section class="summary-cards" id="summary-cards">
                </section>

            <section class="chart-and-location-section">
                <div class="card sales-chart-card">
                    <h3>Penjualan Berdasarkan Kategori</h3>
                    <div class="chart-area">
                        <canvas id="salesBarChart"></canvas>
                    </div>
                </div>

                <div class="card location-card">
                    <h3>Lokasi Pembeli</h3>
                    <div class="location-content">
                        <div class="donut-chart-wrapper">
                            <canvas id="locationDoughnutChart"></canvas>
                            <div class="order-center-text">
                                <span class="order-count" id="totalPesanan">389</span>
                                <span class="order-label">Pesanan</span>
                            </div>
                        </div>
                        <ul class="legend" id="locationLegend">
                            </ul>
                    </div>
                </div>
            </section>

            <section class="recent-products-section">
                <h2>Daftar Produk Terbaru</h2>
                <div class="table-responsive">
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>PRODUK</th>
                                <th>KATEGORI</th>
                                <th>HARGA</th>
                                <th>STOK</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody id="productTableBody">
                            </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <script>
        // 1. DATA DUMMY (Sesuai skema JSON sebelumnya)
        const dashboardData = {
            summary: [
                { title: "Total Produk", value: "1,204", type: "number" },
                { title: "Penjualan Bulan Ini", value: "Rp 15.7M", type: "currency" },
                { title: "Pesanan Baru", value: 89, type: "number" },
                { title: "Rating Rata-Rata", value: 4.8, type: "rating" }
            ],
            penjualanPerKategori: [
                { kategori: "Elektronik", jumlah: 350 },
                { kategori: "Pakaian", jumlah: 150 },
                { kategori: "Rumah", jumlah: 450 },
                { kategori: "Kecantikan", jumlah: 250 },
                { kategori: "Hobi", jumlah: 300 }
            ],
            lokasiPembeli: {
                total_pesanan: 389,
                distribusi: [
                    { wilayah: "Sumatra Selatan", persentase: 0.78, warna: "#dc3545" }, // Merah
                    { wilayah: "Jawa Tengah", persentase: 0.17, warna: "#007bff" }, // Biru
                    { wilayah: "Lainnya", persentase: 0.05, warna: "#ccc" } // Abu-abu
                ]
            },
            produkTerbaru: [
                { nama: "Smartphone Canggih X1", kategori: "Elektronik", harga: "Rp 4.999.000", stok: 120, status: "Aktif", image: "https://via.placeholder.com/40x40?text=P1" },
                { nama: "Smartphone Canggih X1", kategori: "Elektronik", harga: "Rp 4.999.000", stok: 120, status: "NonAktif", image: "https://via.placeholder.com/40x40?text=P2" },
                { nama: "Smartphone Canggih X1", kategori: "Elektronik", harga: "Rp 4.999.000", stok: 120, status: "Aktif", image: "https://via.placeholder.com/40x40?text=P3" },
                { nama: "Smartphone Canggih X1", kategori: "Elektronik", harga: "Rp 4.999.000", stok: 120, status: "Aktif", image: "https://via.placeholder.com/40x40?text=P4" }
            ]
        };

        document.addEventListener('DOMContentLoaded', () => {
            renderSummaryCards(dashboardData.summary);
            renderSalesBarChart(dashboardData.penjualanPerKategori);
            renderLocationDoughnutChart(dashboardData.lokasiPembeli);
            renderProductTable(dashboardData.produkTerbaru);
        });

        // 2. FUNGSI MERENDER SUMMARY CARDS
        function renderSummaryCards(summaryData) {
            const container = document.getElementById('summary-cards');
            container.innerHTML = summaryData.map(item => `
                <div class="card summary-card">
                    <span class="card-title">${item.title}</span>
                    <strong class="card-value">${item.value}</strong>
                </div>
            `).join('');
        }

        // 3. FUNGSI MERENDER BAR CHART (Chart.js)
        function renderSalesBarChart(data) {
            const ctx = document.getElementById('salesBarChart').getContext('2d');
            const labels = data.map(item => item.kategori);
            const values = data.map(item => item.jumlah);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: '#007bff', // Warna Bar Biru
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false 
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            display: false // Sembunyikan Axis Y
                        },
                        x: {
                            grid: {
                                display: false // Sembunyikan garis grid X
                            },
                            ticks: {
                                display: true,
                                font: {
                                    size: 10
                                }
                            }
                        }
                    },
                    layout: {
                        padding: {
                            top: 0
                        }
                    }
                }
            });
        }

        // 4. FUNGSI MERENDER DOUGHNUT CHART (Chart.js)
        function renderLocationDoughnutChart(locationData) {
            const ctx = document.getElementById('locationDoughnutChart').getContext('2d');
            const data = locationData.distribusi;

            // Update Total Pesanan
            document.getElementById('totalPesanan').textContent = locationData.total_pesanan;

            // Render Chart
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.map(item => item.wilayah),
                    datasets: [{
                        data: data.map(item => item.persentase * 100),
                        backgroundColor: data.map(item => item.warna),
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '80%', // Ukuran lubang tengah
                    plugins: {
                        legend: {
                            display: false // Legend dihandle manual di HTML
                        },
                        tooltip: {
                            callbacks: {
                                label: (context) => {
                                    const label = context.label || '';
                                    const value = context.parsed;
                                    return `${label}: ${value}%`;
                                }
                            }
                        }
                    }
                }
            });

            // Render Legend Manual
            const legendContainer = document.getElementById('locationLegend');
            legendContainer.innerHTML = data.map(item => `
                <li>
                    <span class="color-dot" style="background-color: ${item.warna};"></span>
                    ${item.wilayah} (${Math.round(item.persentase * 100)}%)
                </li>
            `).join('');
        }

        // 5. FUNGSI MERENDER TABEL PRODUK
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
                    </tr>
                `;
            }).join('');
        }
    </script>
</body>
</html>