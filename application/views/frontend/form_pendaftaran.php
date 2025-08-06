<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Diklat - Portal Diklat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Base Styling - sama dengan pendaftaran_simple.php */
        body { 
            background-color: #f8f9fa; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card { 
            border: none; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.08); 
            border-radius: 12px; 
        }
        
        .container {
            max-width: 1200px;
        }
        
        /* Info Labels & Values - sama dengan pendaftaran_simple.php */
        .info-label { 
            font-size: 0.85rem; 
            color: #6c757d; 
            font-weight: 500; 
            text-transform: uppercase; 
            letter-spacing: 0.5px;
            margin-bottom: 4px; 
        }
        
        .info-value { 
            font-size: 1.1rem; 
            font-weight: 600; 
            color: #2c3e50; 
            margin-bottom: 15px;
        }
        
        /* Sidebar Section - update styling */
        .sidebar-section {
            background: #ffffff;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .sidebar-section h6 {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        
        /* Category Badge */
        .category-badge {
            background: linear-gradient(135deg, #6f42c1, #007bff);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
        }
        
        /* Progress & Status */
        .progress { 
            border-radius: 4px; 
            overflow: hidden; 
            height: 8px; 
        }
        
        .badge {
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 600;
        }
        
        .text-success { color: #28a745 !important; }
        .text-danger { color: #dc3545 !important; }
        .text-warning { color: #ffc107 !important; }
        
        /* Pastikan semua ikon check dalam persyaratan berwarna hijau */
        .list-group-item .fa-check-circle,
        .list-group-item i.fa-check-circle {
            color: #28a745 !important;
        }
        
        /* Button Styling */
        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 20px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
        }
        
        /* Form Elements */
        .form-label { 
            font-weight: 600; 
            color: #2c3e50;
            font-size: 0.95rem;
        }
        
        .form-control {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        
        /* Registration Type Cards */
        .registration-type-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            background: #ffffff;
            cursor: pointer;
            transition: all 0.2s ease;
            height: 100%;
        }
        
        .registration-type-card:hover {
            border-color: #007bff;
            background-color: #f8f9fa;
        }
        
        .registration-type-card.active {
            border-color: #007bff;
            background-color: #e7f3ff;
        }
        
        .registration-type-card i {
            font-size: 2rem;
        }
        
        .registration-type-card .card-title {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            font-size: 1rem;
        }
        
        .registration-type-card .card-description {
            color: #6c757d;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
        
        .registration-type-card .card-badge small {
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 4px;
            background: #f8f9fa;
            display: inline-block;
            font-size: 0.8rem;
            color: #6c757d;
        }
        
        /* Step Indicator */
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        
        .step {
            text-align: center;
            margin: 0 15px;
            opacity: 0.5;
            transition: opacity 0.3s ease;
        }
        
        .step.active {
            opacity: 1;
        }
        
        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
            font-weight: 600;
            color: #6c757d;
        }
        
        .step.active .step-number {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
        }
        
        /* Dropdown hover effect */
        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 0.5rem 0;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand text-primary" href="<?= base_url() ?>">
                <i class="fas fa-graduation-cap me-2"></i>
                Portal Diklat
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('home/about') ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Informasi AIRIS
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Berita Terbaru</a></li>
                            <li><a class="dropdown-item" href="#">Sertifikat Terbit</a></li>
                            <li><a class="dropdown-item" href="#">Kuota Kursi Diklat</a></li>
                            <li><a class="dropdown-item" href="#">Alur & Tata Cara Pembayaran Diklat</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home/contact') ?>">Kamus Maritim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">AIRIS Mobile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="row">
            <!-- Right Column - Informasi Diklat -->
            <div class="col-md-4 order-md-2">
                <div class="card">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0"><i class="fas fa-info-circle text-info me-2"></i>Informasi Diklat</h5>
                    </div>
                    <div class="card-body">
                        
                        <!-- Kategori Diklat -->
                        <div class="mb-3">
                            <span class="category-badge" id="kategori-badge">
                                PROGRAM DIKLAT
                            </span>
                        </div>

                        <!-- Nama Diklat -->
                        <div class="mb-3">
                            <span class="info-label">Nama Diklat</span>
                            <h5 class="info-value mb-0" id="info-nama-diklat">-</h5>
                            <small class="text-muted">Kode: <span id="info-kode-diklat">-</span></small>
                        </div>

                        <!-- Total Kuota & Sisa -->
                        <div class="row mb-3">
                            <div class="col-6">
                                <span class="info-label">Total Kuota</span>
                                <div class="info-value" id="info-kuota">-</div>
                            </div>
                            <div class="col-6">
                                <span class="info-label">Sisa Kuota</span>
                                <div class="info-value text-success" id="info-sisa-kuota">-</div>
                            </div>
                        </div>

                        <!-- Biaya -->
                        <div class="mb-3">
                            <span class="info-label">Biaya Program</span>
                            <div class="info-value text-primary" id="info-biaya">Gratis</div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <span class="info-label">Status Pendaftaran</span>
                            <div class="mt-2">
                                <span class="badge text-success" id="info-status">Terbuka</span>
                            </div>
                        </div>

                        <!-- Persyaratan -->
                        <div>
                            <span class="info-label">Persyaratan Administrasi</span>
                            <div class="mt-2">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item px-0 py-2 border-0">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <small>Kartu Identitas (KTP/SIM/Passport)</small>
                                    </div>
                                    <div class="list-group-item px-0 py-2 border-0">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <small>Ijazah Pendidikan Terakhir</small>
                                    </div>
                                    <div class="list-group-item px-0 py-2 border-0">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <small>Pas Foto Background Merah 4x6 (2 lembar)</small>
                                    </div>
                                    <div class="list-group-item px-0 py-2 border-0">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <small>Surat Keterangan Sehat dari Dokter</small>
                                    </div>
                                    <div class="list-group-item px-0 py-2 border-0">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <small>Mengisi formulir pendaftaran</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Left Column - Form -->
            <div class="col-md-8 order-md-1">
                <!-- Registration Form -->
                <div class="card">
                    <div class="card-body">
                        <!-- Step Indicator -->
                        <div class="step-indicator">
                            <div class="step active" id="step-1">
                                <div class="step-number">1</div>
                                <small>Kategori & Data</small>
                            </div>
                            <div class="step" id="step-2">
                                <div class="step-number">2</div>
                                <small>Dokumen</small>
                            </div>
                            <div class="step" id="step-3">
                                <div class="step-number">3</div>
                                <small>Konfirmasi</small>
                            </div>
                        </div>

            <form id="registrationForm" method="POST" enctype="multipart/form-data">
                <!-- Step 1: Registration Type Selection with Forms -->
                <div class="form-section active" id="section-1">
                    <h5 class="mb-3 text-center">Pilih Kategori Pendaftaran</h5>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="registration-type-card text-center" data-type="existing">
                                <i class="fas fa-user-check text-success mb-3"></i>
                                <h6 class="card-title">Pernah Daftar</h6>
                                <p class="card-description">
                                    Sudah pernah mendaftar diklat sebelumnya
                                </p>
                                <div class="card-badge">
                                    <small>Masukkan NIK</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="registration-type-card text-center" data-type="new">
                                <i class="fas fa-user-plus text-primary mb-3"></i>
                                <h6 class="card-title">Belum Pernah Daftar</h6>
                                <p class="card-description">
                                    Pendaftaran pertama kali
                                </p>
                                <div class="card-badge">
                                    <small>Isi data lengkap</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Existing User Form - Hidden initially -->
                    <div id="existing-user-form" style="display: none;" class="mt-4">
                        <hr>
                        <h5 class="mb-4">Masukkan NIK Anda</h5>
                        
                        <div class="row">
                            <div class="col-md-8">
                                <label class="form-label required">NIK</label>
                                <input type="text" class="form-control" id="existing-nik" placeholder="Masukkan NIK 16 digit" maxlength="16">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">&nbsp;</label>
                                <button type="button" class="btn btn-success w-100" id="btn-check-nik">
                                    <i class="fas fa-search me-2"></i>Cari Data
                                </button>
                            </div>
                        </div>
                        
                        <div id="nik-result" class="mt-3" style="display: none;">
                            <div class="alert alert-info">
                                <div id="existing-user-info"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- New User Form - Hidden initially -->
                    <div id="new-user-form" style="display: none;" class="mt-4">
                        <hr>
                        <h5 class="mb-4">Data Pendaftar Baru</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">NIK</label>
                                <input type="text" class="form-control" id="id" name="id" placeholder="16 digit" maxlength="16">
                                <small class="form-text text-muted">NIK akan digunakan sebagai ID unik</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama sesuai KTP">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Kota kelahiran">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Agama</label>
                                <select class="form-select" id="agama" name="agama">
                                    <option value="">Pilih agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label required">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap sesuai KTP"></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">No. HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="08xxxxxxxxxx">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Pendidikan Terakhir</label>
                                <select class="form-select" id="pendidikan_terakhir" name="pendidikan_terakhir">
                                    <option value="">Pilih pendidikan terakhir</option>
                                    <option value="SD">SD/Sederajat</option>
                                    <option value="SMP">SMP/Sederajat</option>
                                    <option value="SMA">SMA/Sederajat</option>
                                    <option value="SMK">SMK/Sederajat</option>
                                    <option value="D1">Diploma I (D1)</option>
                                    <option value="D2">Diploma II (D2)</option>
                                    <option value="D3">Diploma III (D3)</option>
                                    <option value="D4/S1">Diploma IV/Sarjana (D4/S1)</option>
                                    <option value="S2">Magister (S2)</option>
                                    <option value="S3">Doktor (S3)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan saat ini">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Nama Ayah</label>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama lengkap ayah">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Nama Ibu</label>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama lengkap ibu">
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-primary" id="btn-next-1">
                            Lanjutkan <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden inputs for selected data -->
    <input type="hidden" id="selected-diklat-id" name="diklat_id" value="14-01807-46">
    <input type="hidden" id="selected-jadwal-id" name="jadwal_id" value="">
    <input type="hidden" id="selected-periode" name="periode" value="">
    <input type="hidden" id="registration-type" name="registration_type" value="">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <script>
        let currentStep = 1;
        let registrationType = '';
        let selectedData = {};
        
        // Load diklat information for sidebar
        function loadDiklatInfo() {
            const urlParams = new URLSearchParams(window.location.search);
            const diklatId = urlParams.get('diklat_id');
            
            // Get jadwal_id from URL path (after /form/)
            const pathArray = window.location.pathname.split('/');
            const formIndex = pathArray.indexOf('form');
            const jadwalId = formIndex !== -1 && pathArray[formIndex + 1] ? pathArray[formIndex + 1] : null;
            
            const periode = urlParams.get('periode');
            
            console.log('Loading diklat info for:', diklatId, jadwalId, periode);
            
            if (diklatId) {
                // Set hidden form values
                document.getElementById('selected-diklat-id').value = diklatId;
                document.getElementById('selected-jadwal-id').value = jadwalId || '';
                document.getElementById('selected-periode').value = periode || '';
                
                // Load diklat information
                const apiUrl = `<?= base_url('Pendaftaran/get_diklat_info_detailed'); ?>?diklat_id=${diklatId}&jadwal_id=${jadwalId || ''}&periode=${periode || ''}`;
                console.log('API URL:', apiUrl);
                
                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        console.log('API Response:', data);
                        if (data.status === 'success') {
                            const info = data.data;
                            console.log('Diklat info:', info);
                            
                            // Update sidebar dengan informasi diklat menggunakan struktur card yang baru
                            const namaElement = document.getElementById('info-nama-diklat');
                            const jenisElement = document.getElementById('info-jenis-diklat');  
                            const tahunElement = document.getElementById('info-tahun');
                            const kuotaElement = document.getElementById('info-kuota');
                            const sisaKuotaElement = document.getElementById('info-sisa-kuota');
                            const kodeElement = document.getElementById('info-kode-diklat');
                            const biayaElement = document.getElementById('info-biaya');
                            const statusElement = document.getElementById('info-status');
                            const kategoriBadgeElement = document.getElementById('kategori-badge');
                            
                            if (namaElement) namaElement.textContent = info.nama_diklat || '-';
                            if (jenisElement) jenisElement.textContent = info.jenis_diklat || '-';
                            if (tahunElement) tahunElement.textContent = info.tahun || '-';
                            if (kuotaElement) kuotaElement.textContent = info.kuota || '-';
                            if (sisaKuotaElement) sisaKuotaElement.textContent = info.sisa_kuota || info.kuota || '-';
                            if (kodeElement) kodeElement.textContent = info.kode_diklat || info.diklat_id || '-';
                            if (kategoriBadgeElement) kategoriBadgeElement.textContent = info.jenis_diklat || 'PROGRAM DIKLAT';
                            
                            // Update biaya information
                            if (biayaElement) {
                                if (info.biaya && info.biaya > 0) {
                                    biayaElement.textContent = 'Rp ' + parseInt(info.biaya).toLocaleString('id-ID');
                                } else {
                                    biayaElement.textContent = 'Gratis';
                                }
                            }
                            
                            // Update status dengan badge
                            let statusText = 'Tertutup';
                            let statusBadgeClass = 'bg-danger';
                            
                            if (info.status === 'open') {
                                statusText = 'Terbuka';
                                statusBadgeClass = 'bg-success';
                            } else if (info.status === 'not_yet_open') {
                                statusText = 'Belum Dibuka';
                                statusBadgeClass = 'bg-warning';
                            } else if (info.status === 'execution_passed') {
                                statusText = 'Pelaksanaan Telah Selesai';
                                statusBadgeClass = 'bg-secondary';
                            }
                            
                            if (statusElement) {
                                statusElement.innerHTML = `<span class="badge ${statusBadgeClass}">${statusText}</span>`;
                            }
                        } else {
                            console.error('API returned error:', data.message);
                            // Load default data if API fails
                            loadDefaultDiklatInfo();
                        }
                    })
                    .catch(error => {
                        console.error('Error loading diklat info:', error);
                        // Load default data if API fails
                        loadDefaultDiklatInfo();
                    });
            } else {
                console.log('No diklat_id found in URL parameters');
                // Load default data if no diklat_id
                loadDefaultDiklatInfo();
            }
        }
        
        // Load default diklat information if API fails
        function loadDefaultDiklatInfo() {
            console.log('Loading default diklat info');
            
            // Set default values (menggunakan "-" sesuai dengan struktur baru)
            const namaElement = document.getElementById('info-nama-diklat');
            const jenisElement = document.getElementById('info-jenis-diklat');
            const tahunElement = document.getElementById('info-tahun');
            const kuotaElement = document.getElementById('info-kuota');
            const sisaKuotaElement = document.getElementById('info-sisa-kuota');
            const kodeElement = document.getElementById('info-kode-diklat');
            const biayaElement = document.getElementById('info-biaya');
            const statusElement = document.getElementById('info-status');
            const kategoriBadgeElement = document.getElementById('kategori-badge');
            
            if (namaElement) namaElement.textContent = '-';
            if (jenisElement) jenisElement.textContent = '-';
            if (tahunElement) tahunElement.textContent = '-';
            if (kuotaElement) kuotaElement.textContent = '-';
            if (sisaKuotaElement) sisaKuotaElement.textContent = '-';
            if (kodeElement) kodeElement.textContent = '-';
            if (biayaElement) biayaElement.textContent = '-';
            if (kategoriBadgeElement) kategoriBadgeElement.textContent = 'PROGRAM DIKLAT';
            
            // Set default status dengan badge
            if (statusElement) {
                statusElement.innerHTML = '<span class="badge bg-secondary">-</span>';
            }
        }
        
        // Step navigation
        function goToStep(step) {
            console.log('Going to step:', step);
            
            // Hide all sections
            document.querySelectorAll('.form-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Show target section
            const targetSection = document.getElementById(`section-${step}`);
            if (targetSection) {
                targetSection.classList.add('active');
            }
            
            // Update step indicators
            document.querySelectorAll('.step').forEach((stepEl, index) => {
                stepEl.classList.remove('active', 'completed');
                if (index + 1 < step) {
                    stepEl.classList.add('completed');
                } else if (index + 1 === step) {
                    stepEl.classList.add('active');
                }
            });
            
            currentStep = step;
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded - Initializing form...');
            
            // Load diklat information for sidebar
            loadDiklatInfo();
            
            goToStep(1);
            
            // Registration type card click handlers
            document.querySelectorAll('.registration-type-card').forEach(card => {
                card.addEventListener('click', function() {
                    console.log('Card clicked:', this.dataset.type);
                    
                    // Remove active state from all cards
                    document.querySelectorAll('.registration-type-card').forEach(c => c.classList.remove('active'));
                    
                    // Add active state to clicked card
                    this.classList.add('active');
                    
                    // Set registration type
                    registrationType = this.dataset.type;
                    console.log('Registration type set to:', registrationType);
                    
                    // Show/hide forms based on selection
                    const existingForm = document.getElementById('existing-user-form');
                    const newForm = document.getElementById('new-user-form');
                    
                    if (registrationType === 'existing') {
                        existingForm.style.display = 'block';
                        newForm.style.display = 'none';
                        console.log('Showing existing user form');
                    } else if (registrationType === 'new') {
                        existingForm.style.display = 'none';
                        newForm.style.display = 'block';
                        console.log('Showing new user form');
                    }
                    
                    // Set hidden field
                    document.getElementById('registration-type').value = registrationType;
                });
            });
            
            // Next button for step 1
            document.getElementById('btn-next-1').addEventListener('click', function() {
                if (!registrationType) {
                    alert('Mohon pilih kategori registrasi terlebih dahulu');
                    return;
                }
                
                if (registrationType === 'existing') {
                    const existingNik = document.getElementById('existing-nik').value.trim();
                    
                    if (!existingNik) {
                        alert('Mohon masukkan NIK Anda');
                        document.getElementById('existing-nik').focus();
                        return;
                    }
                    
                    if (existingNik.length !== 16) {
                        alert('NIK harus terdiri dari 16 digit');
                        document.getElementById('existing-nik').focus();
                        return;
                    }
                } else if (registrationType === 'new') {
                    const requiredFields = ['id', 'nama_lengkap', 'nama_ayah', 'nama_ibu', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'alamat', 'no_hp', 'email', 'pendidikan_terakhir', 'pekerjaan'];
                    
                    for (let fieldId of requiredFields) {
                        const element = document.getElementById(fieldId);
                        if (!element || !element.value.trim()) {
                            const fieldName = fieldId.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                            alert(`Mohon lengkapi field ${fieldName}`);
                            if (element) element.focus();
                            return;
                        }
                    }
                    
                    // Validate ID (NIK)
                    const id = document.getElementById('id').value.trim();
                    if (id.length !== 16) {
                        alert('NIK harus terdiri dari 16 digit');
                        document.getElementById('id').focus();
                        return;
                    }
                    // Validate email
                    const email = document.getElementById('email').value.trim();
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(email)) {
                        alert('Format email tidak valid');
                        document.getElementById('email').focus();
                        return;
                    }
                }
                
                goToStep(2);
            });
            
            // Previous button for step 2
            document.getElementById('btn-prev-2').addEventListener('click', function() {
                goToStep(1);
            });
            
            // Next button for step 2
            document.getElementById('btn-next-2').addEventListener('click', function() {
                goToStep(3);
            });
            
            // Previous button for step 3
            document.getElementById('btn-prev-3').addEventListener('click', function() {
                goToStep(2);
            });
            
            // Agreement checkbox handler
            document.getElementById('agreement-final').addEventListener('change', function() {
                document.getElementById('btn-submit').disabled = !this.checked;
            });
            
            // Form submission
            document.getElementById('registrationForm').addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Form submitted successfully!');
            });
            
            // Cancel Diklat button
            document.getElementById('btn-cancel-diklat').addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin membatalkan pendaftaran diklat ini?')) {
                    // Get diklat_id from URL or form
                    const urlParams = new URLSearchParams(window.location.search);
                    const diklatId = urlParams.get('diklat_id') || '14-01807-46';
                    
                    // Redirect back to pendaftaran page
                    window.location.href = '<?= base_url("pendaftaran") ?>?diklat_id=' + diklatId;
                }
            });
            
            console.log('All event handlers set up successfully');
        });
    </script>
</body>
</html>
