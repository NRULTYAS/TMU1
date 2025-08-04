<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #003366;
            --secondary-color: #0056b3;
            --accent-color: #f8f9fa;
            --text-color: #2c3e50;
            --border-color: #e9ecef;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: var(--text-color);
        }

        /* Header Styles */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }

        .hero-section h1 {
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 2.5rem;
        }

        .hero-section .lead {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* Program Detail Cards */
        .detail-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .detail-card .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            padding: 1.5rem;
        }

        .detail-card .card-header h4 {
            margin: 0;
            font-weight: 600;
        }

        .detail-card .card-body {
            padding: 2rem;
        }

        /* Info Boxes */
        .info-box {
            background: var(--accent-color);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--secondary-color);
        }

        .info-box h6 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        /* Jadwal Table */
        .jadwal-table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .jadwal-table .table th {
            background: var(--primary-color);
            color: white;
            border: none;
            font-weight: 600;
            padding: 1rem;
        }

        .jadwal-table .table td {
            padding: 1rem;
            border-color: var(--border-color);
        }

        /* Status Badges */
        .badge-open {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .badge-closed {
            background: linear-gradient(135deg, #dc3545, #e74c3c);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        /* Buttons */
        .btn-daftar {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-daftar:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
            color: white;
        }

        .btn-back {
            background: var(--secondary-color);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
            color: white;
        }

        /* Persyaratan List */
        .persyaratan-list {
            list-style: none;
            padding: 0;
        }

        .persyaratan-list li {
            background: white;
            margin-bottom: 0.5rem;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid var(--secondary-color);
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .persyaratan-list li:before {
            content: "✓";
            color: #28a745;
            font-weight: bold;
            margin-right: 0.5rem;
        }

        /* Footer */
        footer {
            background: var(--primary-color);
            color: white;
            margin-top: 3rem;
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

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }
            
            .detail-card .card-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="fas fa-graduation-cap me-2"></i>Portal Diklat
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1><?= htmlspecialchars($program->nama_diklat) ?></h1>
                    <p class="lead">
                        Informasi lengkap program diklat, jadwal pelaksanaan, dan persyaratan pendaftaran
                    </p>
                    <div class="mt-4">
                        <a href="javascript:history.back()" class="btn btn-back me-3">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="<?= base_url('pendaftaran') ?>" class="btn btn-daftar">
                            <i class="fas fa-edit me-2"></i>Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Details -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Informasi Program -->
                <div class="detail-card">
                    <div class="card-header">
                        <h4><i class="fas fa-info-circle me-2"></i>Informasi Program</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <h6><i class="fas fa-tag me-2"></i>Kode Program</h6>
                                    <p class="mb-0"><?= htmlspecialchars($program->kode_diklat) ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <h6><i class="fas fa-folder me-2"></i>Kategori</h6>
                                    <p class="mb-0"><?= htmlspecialchars($program->jenis_diklat) ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <?php if ($program->check_kesehatan == 1): ?>
                        <div class="alert alert-warning" role="alert">
                            <i class="fas fa-medical-kit me-2"></i>
                            <strong>Perhatian:</strong> Program ini memerlukan pemeriksaan kesehatan sebelum mengikuti diklat.
                        </div>
                        <?php endif; ?>

                        <div class="info-box">
                            <h6><i class="fas fa-graduation-cap me-2"></i>Deskripsi Program</h6>
                            <p class="mb-0">
                                Program pelatihan profesional <?= htmlspecialchars($program->nama_diklat) ?> 
                                dirancang untuk meningkatkan kompetensi dan keahlian peserta sesuai dengan standar nasional 
                                dan internasional. Program ini dilaksanakan dengan metode pembelajaran yang efektif 
                                dan didukung oleh instruktur berpengalaman serta fasilitas yang memadai.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Pelaksanaan -->
                <div class="detail-card">
                    <div class="card-header">
                        <h4><i class="fas fa-calendar me-2"></i>Jadwal Pelaksanaan</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($jadwal_list)): ?>
                            <div class="jadwal-table">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Periode</th>
                                            <th>Pelaksanaan</th>
                                            <th>Pendaftaran</th>
                                            <th>Kuota</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($jadwal_list as $jadwal): ?>
                                        <tr>
                                            <td>
                                                <strong>Periode <?= $jadwal->periode ?></strong><br>
                                                <small class="text-muted">Tahun <?= $jadwal->tahun ?></small>
                                            </td>
                                            <td>
                                                <?php if ($jadwal->pelaksanaan_mulai && $jadwal->pelaksanaan_akhir): ?>
                                                    <?= date('d M Y', strtotime($jadwal->pelaksanaan_mulai)) ?><br>
                                                    <small>s/d <?= date('d M Y', strtotime($jadwal->pelaksanaan_akhir)) ?></small>
                                                <?php else: ?>
                                                    <span class="text-muted">Akan diumumkan</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($jadwal->pendaftaran_akhir): ?>
                                                    <?php if ($jadwal->pendaftaran_mulai): ?>
                                                        <?= date('d M Y', strtotime($jadwal->pendaftaran_mulai)) ?><br>
                                                    <?php endif; ?>
                                                    <small>s/d <?= date('d M Y', strtotime($jadwal->pendaftaran_akhir)) ?></small>
                                                <?php else: ?>
                                                    <span class="text-muted">Belum dibuka</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <strong><?= $jadwal->kouta ?> orang</strong><br>
                                                <small class="text-success">Sisa: <?= $jadwal->sisa_kursi ?> kursi</small>
                                            </td>
                                            <td>
                                                <?php 
                                                $today = date('Y-m-d');
                                                $is_open = $jadwal->pendaftaran_akhir && $today <= $jadwal->pendaftaran_akhir && $jadwal->sisa_kursi > 0;
                                                ?>
                                                <span class="badge <?= $is_open ? 'badge-open' : 'badge-closed' ?>">
                                                    <?= $is_open ? 'Buka' : 'Tutup' ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                <h5>Belum Ada Jadwal</h5>
                                <p class="text-muted">Jadwal pelaksanaan untuk program ini sedang dalam penyusunan.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Persyaratan -->
                <div class="detail-card">
                    <div class="card-header">
                        <h4><i class="fas fa-list-check me-2"></i>Persyaratan Pendaftaran</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($persyaratan_list)): ?>
                            <ul class="persyaratan-list">
                                <?php foreach ($persyaratan_list as $persyaratan): ?>
                                    <li><?= htmlspecialchars($persyaratan->persyaratan) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <div class="info-box">
                                <h6><i class="fas fa-file-alt me-2"></i>Persyaratan Umum</h6>
                                <ul class="persyaratan-list">
                                    <li>Fotokopi KTP yang masih berlaku</li>
                                    <li>Fotokopi ijazah terakhir</li>
                                    <li>Pas foto 3x4 sebanyak 2 lembar</li>
                                    <li>Surat keterangan sehat dari dokter</li>
                                    <li>Mengisi formulir pendaftaran</li>
                                </ul>
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Persyaratan dapat berbeda tergantung program diklat yang dipilih
                                </small>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Actions -->
                <div class="detail-card">
                    <div class="card-header">
                        <h4><i class="fas fa-bolt me-2"></i>Aksi Cepat</h4>
                    </div>
                    <div class="card-body text-center">
                        <a href="<?= base_url('pendaftaran') ?>" class="btn btn-daftar w-100 mb-3">
                            <i class="fas fa-edit me-2"></i>Daftar Program Ini
                        </a>
                        <a href="https://wa.me/628118693067?text=Saya%20ingin%20bertanya%20tentang%20program%20<?= urlencode($program->nama_diklat) ?>" 
                           class="btn btn-success w-100 mb-3" target="_blank">
                            <i class="fab fa-whatsapp me-2"></i>Tanya via WhatsApp
                        </a>
                        <a href="<?= base_url('home/contact') ?>" class="btn btn-outline-primary w-100">
                            <i class="fas fa-book me-2"></i>Petunjuk Pendaftaran
                        </a>
                    </div>
                </div>

                <!-- Program Stats -->
                <div class="detail-card">
                    <div class="card-header">
                        <h4><i class="fas fa-chart-bar me-2"></i>Statistik Program</h4>
                    </div>
                    <div class="card-body">
                        <div class="info-box text-center">
                            <h6><i class="fas fa-users me-2"></i>Total Kuota Tersedia</h6>
                            <h3 class="text-primary mb-0">
                                <?php 
                                $total_kuota = 0;
                                if (!empty($jadwal_list)) {
                                    foreach ($jadwal_list as $jadwal) {
                                        $total_kuota += $jadwal->sisa_kursi;
                                    }
                                }
                                echo $total_kuota;
                                ?> Kursi
                            </h3>
                        </div>
                        <div class="info-box text-center">
                            <h6><i class="fas fa-calendar-alt me-2"></i>Jadwal Aktif</h6>
                            <h3 class="text-success mb-0"><?= count($jadwal_list) ?> Periode</h3>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="detail-card">
                    <div class="card-header">
                        <h4><i class="fas fa-headset me-2"></i>Butuh Bantuan?</h4>
                    </div>
                    <div class="card-body">
                        <div class="info-box">
                            <h6><i class="fas fa-phone me-2"></i>Hubungi Kami</h6>
                            <p class="mb-2">
                                <strong>WhatsApp:</strong><br>
                                <a href="https://wa.me/628118693067" target="_blank" class="text-decoration-none">
                                    +62 811-8693-067
                                </a>
                            </p>
                            <p class="mb-0">
                                <strong>Jam Operasional:</strong><br>
                                Senin - Jumat: 08:00 - 16:00 WIB
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-graduation-cap me-2"></i>Portal Diklat</h5>
                    <p>Sistem pendaftaran online untuk program diklat dan pelatihan profesional.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; 2024 Portal Diklat. All rights reserved.</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
