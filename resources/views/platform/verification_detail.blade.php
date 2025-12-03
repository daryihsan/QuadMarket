<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Verifikasi Penjual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .sidebar { width: 250px; background-color: #ffffff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.05); flex-shrink: 0; position: fixed; height: 100%; }
        .main-content { flex-grow: 1; padding: 30px; margin-left: 250px; }
        .nav-link { display: flex; align-items: center; padding: 12px 16px; border-radius: 8px; color: #6b7280; transition: all 0.2s; }
        .nav-link:hover { 
            background-color: #e0f2fe;
            color: #1e40af;
        }
        .nav-link.active { background-color: #e5e7eb; color: #007bff; font-weight: 600; }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        <aside class="sidebar">
            <div class="p-6 border-b mb-4">
                <h3 class="font-bold text-lg text-gray-800">Admin Menu</h3>
            </div>
            <nav class="space-y-2">
                <a href="{{ route('platform.dashboard') }}" class="nav-link"><i class="fas fa-chart-line mr-3"></i> Dashboard</a>
                <a href="{{ route('platform.verifikasi.list') }}" class="nav-link active"><i class="fas fa-check-circle mr-3"></i> Verifikasi Penjual</a>
                <a href="{{ route('platform.laporan') }}" class="nav-link"><i class="fas fa-file-alt mr-3"></i> Laporan</a>
                <a href="{{ route('platform.categories.index') }}" class="nav-link"><i class="fas fa-tags mr-3"></i> Manajemen Kategori</a>
            </nav>
            
            <div class="absolute bottom-0 left-0 w-[250px] border-t p-4 bg-white">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog mr-3"></i>
                    <span>Pengaturan</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-question-circle mr-3"></i>
                    <span>Bantuan</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span>Keluar</span>
                </a>
            </div>
        </aside>

        <main class="main-content">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-blue-900">Verifikasi Penjual: {{ $seller->nama_toko }}</h1>
                    <p class="text-gray-600">Tinjau dan verifikasi data penjual baru</p>
                </div>
                <img src="{{ asset('assets/images/logo.png') }}" class="h-20" alt="QuadMarket">
            </div>

            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-lg font-bold text-blue-900 mb-6 border-b pb-3">Data Registrasi Penjual (toko)</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">1. Nama Toko</p>
                        <p class="text-lg text-gray-900 mb-3">{{ $seller->nama_toko }}</p>

                        <p class="text-sm font-medium text-gray-500">2. Deskripsi Singkat</p>
                        <p class="text-lg text-gray-900 mb-3">{{ $seller->deskripsi_singkat }}</p>

                        <p class="text-sm font-medium text-gray-500">Lokasi Toko</p>
                        <p class="text-lg text-gray-900 mb-3">
                            {{ $seller->nama_jalan_pic }}, RT {{ $seller->rt }} / RW {{ $seller->rw }}, Kel. {{ $seller->nama_kelurahan }}, Kab/Kota {{ $seller->kabupaten_kota }}, Propinsi {{ $seller->propinsi }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">3. Nama PIC</p>
                        <p class="text-lg text-gray-900 mb-3">{{ $seller->nama_pic }}</p>

                        <p class="text-sm font-medium text-gray-500">4. No Handphone PIC</p>
                        <p class="text-lg text-gray-900 mb-3">{{ $seller->no_hp_pic }}</p>
                        
                        <p class="text-sm font-medium text-gray-500">5. Email PIC</p>
                        <p class="text-lg text-gray-900 mb-3">{{ $seller->email_pic }}</p>
                        
                        <p class="text-sm font-medium text-gray-500">12. No. KTP PIC</p>
                        <p class="text-lg text-gray-900 mb-3">{{ $seller->no_ktp_pic }}</p>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t">
                    <h3 class="text-base font-semibold text-gray-800 mb-3">Dokumen Administrasi (Kelengkapan Syarat Verifikasi)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">13. Foto PIC</p>
                            <a href="{{ $seller->foto_pic_url }}" target="_blank" class="text-blue-600 hover:underline flex items-center">
                                <i class="fas fa-image mr-2"></i> Lihat Foto PIC
                            </a>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">14. File Upload KTP PIC</p>
                            <a href="{{ $seller->file_upload_ktp_url }}" target="_blank" class="text-blue-600 hover:underline flex items-center">
                                <i class="fas fa-file-pdf mr-2"></i> Lihat File KTP PIC (.pdf/.jpg)
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-bold text-blue-900 mb-4">Aksi Verifikasi</h2>
                <p class="text-gray-700 mb-6">Proses verifikasi ini akan mengirimkan notifikasi via email (diterima/ditolak) kepada calon penjual.</p>

                <form action="{{ route('platform.verifikasi.process', $seller->id) }}" method="POST" class="flex space-x-4">
                    @csrf 
                    
                    <input type="hidden" name="action" id="action_input">

                    <button type="submit" 
                            onclick="document.getElementById('action_input').value='approve'"
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition duration-150 flex items-center justify-center">
                        <i class="fas fa-check mr-2"></i>
                        Terima & Aktifkan Akun
                    </button>
                    
                    <button type="submit" 
                            onclick="document.getElementById('action_input').value='reject'"
                            class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition duration-150 flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i>
                        Tolak & Kirim Notifikasi Penolakan
                    </button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>