<?php
    // Data dari PlatformController::dashboard()
    $total_penjual_aktif = $total_penjual_aktif ?? 0;
    $total_penjual_tidak_aktif = $total_penjual_tidak_aktif ?? 0;
    $total_commenters = $total_commenters ?? 0;
    $total_penjual = $total_penjual ?? 0;
    $pending_verifications_count = $pending_verifications_count ?? 0;

    $product_chart_data = $product_chart_data ?? ['labels' => [], 'data' => []];
    $location_chart_data = $location_chart_data ?? [];

    // Persiapan data untuk Chart.js (Location Donut)
    $location_labels = collect($location_chart_data)->pluck('provinsi')->toArray();
    $location_percentages = collect($location_chart_data)->pluck('percentage')->toArray();
    
    // Warna yang menarik dan kontras
    $location_colors = [
        '#007bff', // Biru terang
        '#28a745', // Hijau
        '#ffc107', // Kuning
        '#dc3545', // Merah
        '#6f42c1', // Ungu
        '#6c757d', // Abu-abu (untuk Lainnya)
    ];

    // Persiapan data untuk Chart.js (Product Bar)
    $product_labels = $product_chart_data['labels']->toArray();
    $product_counts = $product_chart_data['data']->toArray();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Platform Admin</title>
    
<script src="https://cdn.tailwindcss.com"></script>
    
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    
<link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
<link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
<style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .sidebar { 
            width: 250px; 
            background-color: #ffffff; 
            padding: 20px; 
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            position: fixed; 
            height: 100%;
            z-index: 10;
        }
        .main-content { 
            flex-grow: 1; 
            padding: 30px; 
            margin-left: 250px;
        }
        .nav-link { 
            display: flex; 
            align-items: center; 
            padding: 12px 16px; 
            border-radius: 8px; 
            color: #6b7280; 
            transition: all 0.2s; 
        }
        .nav-link:hover { 
            background-color: #e0f2fe; /* blue-50 */
            color: #1e40af; /* blue-800 */
        }
        .nav-link.active { 
            background-color: #e5e7eb; /* light gray/blue */
            color: #007bff; /* primary blue */
            font-weight: 600; 
        }
        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            padding: 24px;
            transition: all 0.3s;
            height: 100%;
        }
        .card-shadow-hover:hover {
             box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        /* Style untuk chart container */
        .chart-container {
            position: relative;
            height: 400px; /* Tinggi tetap untuk konsistensi */
            width: 100%;
        }
    </style>
</head>
<body>

    
<div class="flex min-h-screen">
        
        
<aside class="sidebar">
            
<div class="p-6 border-b mb-4">
                
<h3 class="font-bold text-xl text-gray-800">Admin Panel</h3>
            </div>
            
<nav class="space-y-2">
                
<a href="<?php echo e(route('platform.dashboard')); ?>" class="nav-link active">
                    
<i 
class="fas fa-chart-line mr-3"></i> Dashboard
                </a>
                
<a href="<?php echo e(route('platform.verifikasi.list')); ?>" class="nav-link">
                    
<i 
class="fas fa-check-circle mr-3"></i> Verifikasi Penjual
                    <?php if($pending_verifications_count > 0): ?>
                        
<span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full"><?php echo e($pending_verifications_count); ?></span>
                    <?php endif; ?>
                </a>
                
<a href="<?php echo e(route('platform.laporan')); ?>" class="nav-link">
                    
<i 
class="fas fa-file-alt mr-3"></i> Laporan
                </a>
                
<a href="<?php echo e(route('platform.categories.index')); ?>" class="nav-link">
                    
<i 
class="fas fa-tags mr-3"></i> Manajemen Kategori
                </a>
            </nav>
            
<div class="absolute bottom-0 w-full pr-4 border-t p-4 bg-white">
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
<button type="submit" class="w-full text-left nav-link text-red-600 hover:bg-red-50 hover:text-red-800">
                        
<i 
class="fas fa-sign-out-alt mr-3"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>
    
        
<main class="main-content">
            
<div class="flex justify-between items-center mb-8">
                
<div>
                    
<h1 
class="text-3xl font-bold text-blue-900">Dashboard Platform</h1>
                    
<p class="text-gray-500 mt-1">Selamat Datang, Admin QuadMarket. Analisis performa platform secara real-time.</p>
                </div>
                
<div class="flex items-center space-x-3">
                    
<i 
class="fas fa-user-shield text-4xl text-blue-500"></i>
                    
<span class="font-semibold text-lg text-gray-800">Admin</span>
                </div>
            </div>

            
            
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
<div class="card card-shadow-hover flex items-center space-x-4">
                    
<i 
class="fas fa-store text-3xl text-green-500 p-3 bg-green-100 rounded-full"></i>
                    
<div>
                        
<p class="text-sm font-medium text-gray-500">Penjual Aktif</p>
                        
<p class="text-3xl font-bold text-gray-800"><?php echo e(number_format($total_penjual_aktif)); ?></p>
                    </div>
                </div>
                
<div class="card card-shadow-hover flex items-center space-x-4">
                    
<i 
class="fas fa-user-times text-3xl text-red-500 p-3 bg-red-100 rounded-full"></i>
                    
<div>
                        
<p class="text-sm font-medium text-gray-500">Penjual Non-Aktif</p>
                        
<p class="text-3xl font-bold text-gray-800"><?php echo e(number_format($total_penjual_tidak_aktif)); ?></p>
                    </div>
                </div>
                
<div class="card card-shadow-hover flex items-center space-x-4">
                    
<i 
class="fas fa-comments text-3xl text-purple-500 p-3 bg-purple-100 rounded-full"></i>
                    
<div>
                        
<p class="text-sm font-medium text-gray-500">Pemberi Ulasan Unik</p>
                        
<p class="text-3xl font-bold text-gray-800"><?php echo e(number_format($total_commenters)); ?></p>
                    </div>
                </div>
                
<div class="card card-shadow-hover flex items-center space-x-4">
                    
<i 
class="fas fa-users text-3xl text-blue-500 p-3 bg-blue-100 rounded-full"></i>
                    
<div>
                        
<p class="text-sm font-medium text-gray-500">Total Penjual (Proses)</p>
                        
<p class="text-3xl font-bold text-gray-800"><?php echo e(number_format($total_penjual)); ?></p>
                    </div>
                </div>
            </div>

            
            
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
<div class="lg:col-span-2 card">
                    
<h2 
class="text-xl font-bold text-gray-800 mb-6 border-b pb-3">Sebaran Produk Berdasarkan Kategori</h2>
                    
<div class="chart-container">
                        
<canvas id="productBarChart"></canvas>
                    </div>
                    
<p class="text-xs text-gray-500 mt-4">Menampilkan 10 kategori produk teratas berdasarkan jumlah produk.</p>
                </div>
                
<div class="card flex flex-col">
                    
<h2 
class="text-xl font-bold text-gray-800 mb-6 border-b pb-3">Sebaran Toko Berdasarkan Provinsi</h2>
                    
<div class="chart-container flex-1 mb-6 flex justify-center items-center relative">
                        
<canvas id="locationDonutChart"></canvas>
                        
<div id="locationCenterText" class="absolute text-center">
                            
<p class="text-2xl font-bold text-blue-900"><?php echo e(number_format($total_penjual)); ?></p>
                            
<p class="text-sm text-gray-500">Total Toko</p>
                        </div>
                    </div>
                    
<div class="space-y-2 pt-4 border-t">
                        <?php $__empty_1 = true; $__currentLoopData = $location_chart_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            
<div class="flex justify-between items-center text-sm">
                                
<div class="flex items-center">
                                    
<span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color: <?php echo e($location_colors[$index % count($location_colors)]); ?>"></span>
                                    <?php echo e($item['provinsi']); ?>

                                </div>
                                
<span class="font-semibold text-gray-700"><?php echo e($item['percentage']); ?>%</span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            
<p class="text-sm text-gray-500 text-center">Tidak ada data provinsi penjual yang tersedia.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </main>
    </div>

    
<script>
        document.addEventListener('DOMContentLoaded', function() {
            // =====================================================
            // 1. GRAFIK BATANG: Sebaran Produk per Kategori
            // =====================================================
            const productLabels = <?php echo json_encode($product_labels, 15, 512) ?>;
            const productCounts = <?php echo json_encode($product_counts, 15, 512) ?>;
            const productCtx = document.getElementById('productBarChart');

            if (productCtx && productLabels.length > 0) {
                new Chart(productCtx, {
                    type: 'bar',
                    data: {
                        labels: productLabels,
                        datasets: [{
                            label: 'Jumlah Produk',
                            data: productCounts,
                            backgroundColor: '#28a745', // Hijau solid untuk produk
                            borderRadius: 6,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: (context) => {
                                        return `${context.dataset.label}: ${context.parsed.y} unit`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah Produk (Unit)'
                                },
                                ticks: {
                                    precision: 0
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            } else if (productCtx) {
                 productCtx.parentElement.innerHTML = '<div class="text-center p-8 text-gray-500">Data sebaran produk per kategori belum tersedia.</div>';
            }


            // =====================================================
            // 2. GRAFIK DONUT: Sebaran Toko per Provinsi
            // =====================================================
            const locationLabels = <?php echo json_encode($location_labels, 15, 512) ?>;
            const locationPercentages = <?php echo json_encode($location_percentages, 15, 512) ?>;
            const locationColors = <?php echo json_encode($location_colors, 15, 512) ?>;
            const locationCtx = document.getElementById('locationDonutChart');
            const totalSellers = <?php echo e($total_penjual); ?>;

            if (locationCtx && locationLabels.length > 0) {
                new Chart(locationCtx.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: locationLabels,
                        datasets: [{
                            data: locationPercentages,
                            backgroundColor: locationColors.slice(0, locationLabels.length),
                            hoverOffset: 4,
                            borderWidth: 0,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '80%', // Lebih tebal untuk tampilan modern
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        label += context.parsed + '%';
                                        return label;
                                    }
                                }
                            }
                        },
                    },
                });
                // Update center text in the donut
                document.getElementById('locationCenterText').querySelector('p').textContent = totalSellers.toLocaleString('id-ID');

            } else if (locationCtx) {
                 locationCtx.parentElement.innerHTML = '<div class="text-center p-8 text-gray-500">Data sebaran toko per provinsi belum tersedia.</div>';
                 document.getElementById('locationCenterText').style.display = 'none'; // Sembunyikan teks tengah dummy
            }
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\QuadMarket\resources\views/platform/dashboard.blade.php ENDPATH**/ ?>