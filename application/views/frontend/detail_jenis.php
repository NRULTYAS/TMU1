<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Detail Jenis Diklat' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        .program-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border: 1px solid var(--border-color);
            overflow: hidden;
            transition: all 0.3s ease;
            aspect-ratio: 1;
            width: 100%;
            cursor: pointer;
        }

        .program-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            text-decoration: none !important;
        }

        .program-card h6 {
            font-size: 0.95rem;
            font-weight: 600;
            line-height: 1.2;
            margin: 0;
        }

        .program-card .text-primary {
            color: var(--secondary-color) !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }
            
            .program-card {
                width: 100%;
                aspect-ratio: 1;
            }
            
            .program-card h6 {
                font-size: 0.9rem;
            }
            
            .search-section .row .col-md-4 {
                margin-bottom: 0.5rem;
            }
        }

        @media (min-width: 1200px) {
            .program-card {
                width: 100%;
                aspect-ratio: 1;
            }
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
            <a class="navbar-brand text-primary fw-bold" href="<?= base_url() ?>">
                <i class="fas fa-graduation-cap me-2"></i>
                Portal Diklat
            </a>
            
            <div class="collapse navbar-collapse">
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

    <!-- Breadcrumb -->
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
                <li class="breadcrumb-item active"><?= htmlspecialchars($jenis_diklat->jenis_diklat) ?></li>
            </ol>
        </nav>
    </div>

    <!-- Program Cards Grid -->
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4 text-center">Program Diklat Tersedia</h3>
                <?php if (!empty($diklat_programs)): ?>
                    <div class="row g-2">
                        <?php foreach ($diklat_programs as $program): ?>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                                <a href="<?= base_url('pendaftaran?diklat_id=' . $program->id) ?>" class="card program-card h-100 text-decoration-none">
                                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-3">
                                        <div class="text-center">
                                            <i class="fas fa-folder text-primary mb-2" style="font-size: 2.5rem;"></i>
                                            <h6 class="mb-2 text-dark">
                                                <?= htmlspecialchars($program->nama_diklat) ?>
                                            </h6>
                                            <small class="text-muted"><?= htmlspecialchars($program->kode_diklat) ?></small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                        <h5>Belum Ada Program Tersedia</h5>
                        <p class="text-muted">Program diklat untuk kategori ini sedang dalam persiapan.</p>
                        <a href="<?= base_url() ?>" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
        <!-- Footer -->
    <footer class="bg-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-graduation-cap me-2 text-primary"></i>Portal Diklat</h5>
                    <p class="text-muted">Sistem pendaftaran online untuk program diklat dan pelatihan.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted">&copy; 2024 Portal Diklat. All rights reserved.</p>
                    <div class="social-links">
                        <a href="#" class="text-primary me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-primary me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-primary"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
        <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
    <script>
        function searchProgram() {
            const programSelect = document.getElementById('programSelect');
            const selectedProgramId = programSelect.value;
            
            if (selectedProgramId && selectedProgramId !== '') {
                // Redirect ke halaman detail program
                window.location.href = '<?= base_url("home/detail_program/") ?>' + selectedProgramId;
            } else {
                alert('Silakan pilih program diklat terlebih dahulu');
            }
        }

        // Filter program cards based on search
        function filterPrograms() {
            const searchInput = document.getElementById('searchInput');
            const programCards = document.querySelectorAll('.program-card');
            
            if (searchInput) {
                const searchText = searchInput.value.toLowerCase();
                
                programCards.forEach(card => {
                    const programName = card.querySelector('h5').textContent.toLowerCase();
                    const programCode = card.querySelector('strong').textContent.toLowerCase();
                    
                    if (programName.includes(searchText) || programCode.includes(searchText)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
        }
    </script>
</body>
</html>
