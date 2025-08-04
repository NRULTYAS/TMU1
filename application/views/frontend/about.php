<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Tentang Kami' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand text-primary fw-bold" href="<?= base_url() ?>">
                <i class="fas fa-graduation-cap me-2"></i>
                Portal Diklat
            </a>
            
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('home/about') ?>">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home/contact') ?>">Kontak</a>
                    </li>
                </ul>
                
                <div class="d-flex">
                    <a href="<?= base_url('login') ?>" class="btn btn-primary me-2">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="text-center mb-5">
                    <h1 class="fw-bold">Tentang Portal Diklat</h1>
                    <p class="lead text-muted">Platform pendaftaran online untuk berbagai program diklat dan pelatihan</p>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h3><i class="fas fa-bullseye text-primary me-2"></i>Visi</h3>
                        <p>Menjadi platform pendaftaran diklat terdepan yang memberikan layanan terbaik dalam pengembangan sumber daya manusia yang berkualitas dan profesional.</p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h3><i class="fas fa-rocket text-success me-2"></i>Misi</h3>
                        <ul>
                            <li>Menyediakan platform pendaftaran yang mudah dan efisien</li>
                            <li>Menyelenggarakan program diklat berkualitas tinggi</li>
                            <li>Mengembangkan kompetensi peserta sesuai standar industri</li>
                            <li>Memberikan sertifikasi yang diakui secara nasional</li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3><i class="fas fa-star text-warning me-2"></i>Keunggulan</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check text-success me-2"></i>Instruktur berpengalaman</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Fasilitas modern</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Kurikulum terupdate</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check text-success me-2"></i>Sertifikat resmi</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Pendaftaran online</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Support 24/7</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
