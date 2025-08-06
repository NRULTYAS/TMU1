<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Portal Pendaftaran Diklat Online' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        .carousel-item {
            height: 250px;
            color: white;
            position: relative;
        }
        
        .carousel-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }
        
        .carousel-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        
        .slide-1 {
            background: linear-gradient(135deg, #007bff, #0056b3);
        }
        
        .slide-2 {
            background: linear-gradient(135deg, #28a745, #1e7e34);
        }
        
        .slide-3 {
            background: linear-gradient(135deg, #dc3545, #c82333);
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
        
        .card {
            transition: all 0.2s ease;
            border: 1px solid #ddd;
        }
        
        .card:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .list-group-item {
            transition: all 0.2s ease;
        }
        
        .list-group-item:hover {
            background-color: #f8f9fa;
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
                        <a class="nav-link active" href="<?= base_url() ?>">Home</a>
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
                
                <div class="d-flex">
                    <a href="<?= base_url('login') ?>" class="btn btn-primary me-2">
                        <i class="fas fa-sign-in-alt me-2"></i>Login Admin
                    </a>
                    <a href="<?= base_url('daftar') ?>" class="btn btn-outline-primary">
                        <i class="fas fa-user-plus me-2"></i>Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Carousel -->
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active slide-1">
                <div class="carousel-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <h2 class="fw-bold mb-2">Selamat Datang</h2>
                                <p class="mb-3">Portal Pendaftaran Online untuk Program Diklat Terbaik</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#kategori" class="btn btn-light">
                                        <i class="fas fa-search me-2"></i>Lihat Program
                                    </a>
                                    <a href="<?= base_url('daftar') ?>" class="btn btn-outline-light">
                                        <i class="fas fa-edit me-2"></i>Daftar Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 2 -->
            <div class="carousel-item slide-2">
                <div class="carousel-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <h2 class="fw-bold mb-2">Program Berkualitas</h2>
                                <p class="mb-3">Dapatkan sertifikasi resmi dari program diklat profesional</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#kategori" class="btn btn-light">
                                        <i class="fas fa-certificate me-2"></i>Lihat Sertifikasi
                                    </a>
                                    <a href="<?= base_url('home/about') ?>" class="btn btn-outline-light">
                                        <i class="fas fa-info-circle me-2"></i>Pelajari Lebih Lanjut
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 3 -->
            <div class="carousel-item slide-3">
                <div class="carousel-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <h2 class="fw-bold mb-2">Instruktur Berpengalaman</h2>
                                <p class="mb-3">Belajar dari para ahli dengan pengalaman puluhan tahun</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= base_url('home/contact') ?>" class="btn btn-light">
                                        <i class="fas fa-phone me-2"></i>Hubungi Kami
                                    </a>
                                    <a href="<?= base_url('daftar') ?>" class="btn btn-outline-light">
                                        <i class="fas fa-user-plus me-2"></i>Bergabung Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Program Categories -->
    <section id="kategori" class="py-4 bg-light">
        <div class="container">
            <div class="row">
                <!-- Left Column - Kategori Pendaftaran -->
                <div class="col-lg-6">
                    <div class="text-center mb-4">
                        <h3>Kategori Pendaftaran</h3>
                        <p class="text-muted">Pilih dan Daftar Sekarang Juga</p>
                    </div>
                    
                    <?php if (!empty($jenis_diklat)): ?>
                        <div class="list-group">
                            <?php foreach ($jenis_diklat as $jenis): ?>
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong><?= htmlspecialchars($jenis->jenis_diklat) ?></strong>
                                        <?php if (!empty($jenis->deskripsi)): ?>
                                            <br><small class="text-muted ms-4"><?= htmlspecialchars($jenis->deskripsi) ?></small>
                                        <?php else: ?>
                                            <br><small class="text-muted ms-4">Kategori pendaftaran untuk <?= htmlspecialchars($jenis->jenis_diklat) ?></small>
                                        <?php endif; ?>
                                    </div>
                                    <a href="<?= base_url('home/detail_jenis/' . $jenis->id) ?>" class="btn btn-light btn-sm">
                                        Lihat
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="list-group">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-ship text-primary me-3"></i>
                                    <strong>DIKLAT PELAUT - PEMBENTUKAN</strong>
                                    <br><small class="text-muted ms-4">Program pembentukan pelaut profesional</small>
                                </div>
                                <a href="<?= base_url('pendaftaran') ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>Lihat Program
                                </a>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-arrow-up text-success me-3"></i>
                                    <strong>DIKLAT PENINGKATAN</strong>
                                    <br><small class="text-muted ms-4">Program peningkatan keterampilan</small>
                                </div>
                                <a href="<?= base_url('pendaftaran') ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>Lihat Program
                                </a>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-tools text-warning me-3"></i>
                                    <strong>DIKLAT KETERAMPILAN PELAUT</strong>
                                    <br><small class="text-muted ms-4">Program keterampilan khusus pelaut</small>
                                </div>
                                <a href="<?= base_url('pendaftaran') ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>Lihat
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Right Column - Informasi & Berita -->
                <div class="col-lg-6">
                    <!-- Informasi Section -->
                    <div class="mb-4">
                        <h4 class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Informasi Terbaru</h4>
                        
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <i class="fas fa-clock text-warning me-2"></i>
                                    Jadwal Operasional
                                </h6>
                                <p class="card-text mb-2">
                                    Dalam rangka memaksimalkan pelayanan kepada calon peserta diklat, 
                                    waktu operasional pendaftaran:
                                </p>
                                <p class="mb-0"><strong>Senin - Jumat: 08:00 - 16:00 WIB</strong></p>
                            </div>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <i class="fas fa-download text-success me-2"></i>
                                    File Download
                                </h6>
                                <p class="card-text mb-2">Dokumen yang diperlukan untuk pendaftaran:</p>
                                <ul class="mb-0">
                                    <li>Formulir Pendaftaran</li>
                                    <li>Surat Pernyataan</li>
                                    <li>Dokumen Persyaratan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Berita Section -->
                    <div>
                        <h4 class="mb-3"><i class="fas fa-newspaper text-info me-2"></i>Berita Terbaru</h4>
                        
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title">Pembukaan Pendaftaran Gelombang Baru</h6>
                                <p class="card-text">
                                    Pendaftaran untuk program diklat gelombang kedua tahun 2025 telah dibuka. 
                                    Segera daftarkan diri Anda sebelum kuota terpenuhi.
                                </p>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>28 Juli 2025
                                </small>
                            </div>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title">Peningkatan Fasilitas Pelatihan</h6>
                                <p class="card-text">
                                    Fasilitas pelatihan telah diupgrade dengan teknologi terbaru untuk 
                                    memberikan pengalaman belajar yang lebih baik.
                                </p>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>25 Juli 2025
                                </small>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Sertifikat Telah Terbit</h6>
                                <p class="card-text">
                                    Sertifikat untuk peserta diklat bulan Juni 2025 telah selesai dan 
                                    dapat diambil di kantor administrasi.
                                </p>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>20 Juli 2025
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-graduation-cap me-2"></i>Portal Diklat</h5>
                    <p>Sistem pendaftaran online untuk program diklat dan pelatihan.</p>
                </div>
                <div class="col-md-3">
                    <h6>Menu</h6>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url() ?>" class="text-white-50">Beranda</a></li>
                        <li><a href="<?= base_url('home/about') ?>" class="text-white-50">Tentang</a></li>
                        <li><a href="<?= base_url('home/contact') ?>" class="text-white-50">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Kontak</h6>
                    <p class="text-white-50 mb-1">
                        <i class="fas fa-envelope me-2"></i>info@portaldiklat.id
                    </p>
                    <p class="text-white-50">
                        <i class="fas fa-phone me-2"></i>+62 811 8693 067
                    </p>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p class="mb-0">&copy; 2025 Portal Diklat. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        
        // Auto slide carousel
        var heroCarousel = new bootstrap.Carousel(document.getElementById('heroCarousel'), {
            interval: 5000,
            wrap: true
        });
    </script>
</body>
</html>
