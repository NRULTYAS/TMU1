<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Portal Pendaftaran Diklat - Admin</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
	<style>
		.menu-card {
			transition: all 0.2s ease;
			border: 1px solid #dee2e6;
		}
		
		.menu-card:hover {
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
		}
		
		.menu-icon {
			font-size: 2rem;
			margin-bottom: 1rem;
		}
		
		.menu-title {
			font-size: 1.1rem;
			font-weight: 600;
			margin-bottom: 0.5rem;
		}
	</style>
</head>

<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg bg-white shadow-sm">
		<div class="container-fluid">
			<a class="navbar-brand text-primary fw-bold" href="#">Portal Pendaftaran Diklat</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
				aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
				<ul class="navbar-nav align-items-center gap-3">
					<?php
					$namaPengguna = $this->session->userdata('nama') ?? 'User';
					$inisial = strtoupper(substr($namaPengguna, 0, 1));
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false">
							<div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-2"
								style="width: 32px; height: 32px; font-size: 16px;">
								<?= $inisial ?>
							</div>
							<span class="d-none d-sm-inline fw-semibold"><?= $namaPengguna ?></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="#"><i class="fa fa-user me-2"></i> Profil Saya</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="<?= site_url('login/logout') ?>" id="logout-link"><i
										class="fa fa-sign-out-alt me-2"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Layout -->
	<div class="container-fluid p-4">
		<div class="row">
			<div class="col-12">
				<!-- Welcome Section -->
				<div class="card mb-4">
					<div class="card-body bg-primary text-white">
						<h4>Selamat Datang, <?= $this->session->userdata('nama') ?? 'Admin' ?>!</h4>
						<p class="mb-0">Dashboard Admin Pendaftaran Diklat</p>
					</div>
				</div>

				<!-- Menu -->
				<div class="row mb-4">
					<div class="col-md-3 mb-3">
						<a href="<?= site_url('diklat') ?>" class="text-decoration-none">
							<div class="card menu-card">
								<div class="card-body text-center">
									<i class="fa fa-book-open menu-icon text-primary"></i>
									<div class="menu-title">Diklat</div>
									<small class="text-muted">Kelola data diklat</small>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3 mb-3">
						<a href="<?= site_url('jenisdiklat') ?>" class="text-decoration-none">
							<div class="card menu-card">
								<div class="card-body text-center">
									<i class="fa fa-layer-group menu-icon text-success"></i>
									<div class="menu-title">Jenis Diklat</div>
									<small class="text-muted">Kelola jenis diklat</small>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3 mb-3">
						<a href="<?= site_url('persyaratan') ?>" class="text-decoration-none">
							<div class="card menu-card">
								<div class="card-body text-center">
									<i class="fa fa-list-check menu-icon text-warning"></i>
									<div class="menu-title">Persyaratan</div>
									<small class="text-muted">Kelola persyaratan</small>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3 mb-3">
						<a href="<?= site_url('pendaftaran') ?>" class="text-decoration-none">
							<div class="card menu-card">
								<div class="card-body text-center">
									<i class="fa fa-users menu-icon text-info"></i>
									<div class="menu-title">Pendaftaran</div>
									<small class="text-muted">Kelola pendaftaran</small>
								</div>
							</div>
						</a>
					</div>
				</div>

				<!-- Statistik -->
				<div class="row">
					<div class="col-md-3 mb-3">
						<div class="card">
							<div class="card-body text-center">
								<i class="fa fa-book-open text-primary mb-2" style="font-size: 2rem;"></i>
								<h5><?= $total_diklat ?? '0' ?></h5>
								<small class="text-muted">Total Diklat</small>
							</div>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<div class="card">
							<div class="card-body text-center">
								<i class="fa fa-layer-group text-success mb-2" style="font-size: 2rem;"></i>
								<h5><?= $total_jenis_diklat ?? '0' ?></h5>
								<small class="text-muted">Jenis Diklat</small>
							</div>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<div class="card">
							<div class="card-body text-center">
								<i class="fa fa-users text-info mb-2" style="font-size: 2rem;"></i>
								<h5><?= $total_pendaftar ?? '0' ?></h5>
								<small class="text-muted">Total Pendaftar</small>
							</div>
						</div>
					</div>
					<div class="col-md-3 mb-3">
						<div class="card">
							<div class="card-body text-center">
								<i class="fa fa-calendar text-secondary mb-2" style="font-size: 2rem;"></i>
								<h5>2025</h5>
								<small class="text-muted">Tahun Aktif</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Konfirmasi Logout -->
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			const logoutLink = document.getElementById("logout-link");
			if (logoutLink) {
				logoutLink.addEventListener("click", function (e) {
					if (!confirm("Apakah Anda yakin ingin logout?")) {
						e.preventDefault();
					}
				});
			}
		});
	</script>

</body>

</html>
