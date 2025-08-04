<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portal Pendaftaran Diklat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        .login-link {
            color: #007bff;
            font-weight: 500;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            transition: all 0.2s ease-in-out;
        }
        
        .menu-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }
        
        .menu-card .card-body {
            padding: 2rem 1.5rem;
        }
        
        .menu-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .menu-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .menu-description {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .stat-card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand text-primary fw-bold" href="#">Portal Pendaftaran Diklat</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?php if (!$this->session->userdata('user')): ?>
                        <a href="<?= site_url('login') ?>" class="nav-link login-link">
                            <i class="fa fa-sign-in-alt me-1"></i> Login
                        </a>
                    <?php else: ?>
                        <a href="<?= site_url('login/logout') ?>" class="nav-link login-link">
                            <i class="fa fa-sign-out-alt me-1"></i> Logout
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Selamat Datang di Portal Pendaftaran Diklat</h2>
            <p class="mb-4 text-muted">Pilih menu di bawah untuk mengakses fitur yang tersedia.</p>

            <!-- Statistics Cards -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card stat-card text-bg-info text-center">
                        <div class="card-body">
                            <h4><?= isset($total_diklat) ? $total_diklat : '25' ?></h4>
                            <p class="mb-0">Diklat Tersedia</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card text-bg-success text-center">
                        <div class="card-body">
                            <h4><?= isset($total_jenis_diklat) ? $total_jenis_diklat : '15' ?></h4>
                            <p class="mb-0">Jenis Diklat</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card text-bg-warning text-center">
                        <div class="card-body">
                            <h4><?= isset($total_pendaftar) ? $total_pendaftar : '100' ?>+</h4>
                            <p class="mb-0">Pendaftar Terdaftar</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Cards -->
            <h4 class="mb-4">Menu Aplikasi</h4>
            <div class="row g-4 mb-5">
                <!-- Diklat Menu -->
                <div class="col-lg-3 col-md-6">
                    <a href="<?= site_url('diklat') ?>" class="text-decoration-none">
                        <div class="card menu-card h-100">
                            <div class="card-body text-center">
                                <i class="fa fa-book-open menu-icon text-primary"></i>
                                <div class="menu-title text-dark">Diklat</div>
                                <p class="menu-description">Kelola data diklat dan lihat daftar diklat yang tersedia</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Jenis Diklat Menu -->
                <div class="col-lg-3 col-md-6">
                    <a href="<?= site_url('jenisdiklat') ?>" class="text-decoration-none">
                        <div class="card menu-card h-100">
                            <div class="card-body text-center">
                                <i class="fa fa-layer-group menu-icon text-success"></i>
                                <div class="menu-title text-dark">Jenis Diklat</div>
                                <p class="menu-description">Kelola kategori dan jenis-jenis diklat</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Persyaratan Menu -->
                <div class="col-lg-3 col-md-6">
                    <a href="<?= site_url('persyaratan') ?>" class="text-decoration-none">
                        <div class="card menu-card h-100">
                            <div class="card-body text-center">
                                <i class="fa fa-list-check menu-icon text-warning"></i>
                                <div class="menu-title text-dark">Persyaratan</div>
                                <p class="menu-description">Kelola persyaratan untuk setiap diklat</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Schedule Menu -->
                <div class="col-lg-3 col-md-6">
                    <a href="<?= site_url('schedule') ?>" class="text-decoration-none">
                        <div class="card menu-card h-100">
                            <div class="card-body text-center">
                                <i class="fa fa-calendar-alt menu-icon text-info"></i>
                                <div class="menu-title text-dark">Schedule</div>
                                <p class="menu-description">Kelola jadwal dan timeline diklat</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            </div>

            <!-- Tabel Diklat -->
            <h4 class="mb-4">Daftar Diklat Terbaru</h4>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Diklat Yang Tersedia</h5>
                    <a href="<?= site_url('diklat') ?>" class="btn btn-primary btn-sm">
                        <i class="fa fa-arrow-right me-1"></i> Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Diklat</th>
                                <th>Jenis</th>
                                <th>Durasi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($diklat_terbaru) && !empty($diklat_terbaru)): ?>
                                <?php foreach ($diklat_terbaru as $diklat): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($diklat->nama_diklat ?? 'Nama Diklat') ?></td>
                                        <td><?= htmlspecialchars($diklat->jenis_diklat ?? 'Jenis') ?></td>
                                        <td>-</td>
                                        <td><span class="badge bg-success">Tersedia</span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td>Diklat</td>
                                    <td>Pengembangan</td>
                                    <td>3 Hari</td>
                                    <td><span class="badge bg-success">Tersedia</span></td>
                                </tr>
                                <tr>
                                    <td>Diklat Dasar</td>
                                    <td>Teknologi</td>
                                    <td>5 Hari</td>
                                    <td><span class="badge bg-success">Tersedia</span></td>
                                </tr>
                                <tr>
                                    <td>Diklat Kelas</td>
                                    <td>Pendidikan</td>
                                    <td>2 Hari</td>
                                    <td><span class="badge bg-warning text-dark">Segera Dibuka</span></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div> <!-- /.container-fluid -->
    </div> <!-- /.row -->
</div> <!-- /.container-fluid -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
