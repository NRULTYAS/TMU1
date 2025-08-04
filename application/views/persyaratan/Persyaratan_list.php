<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<title>List Persyaratan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap & Font Awesome -->
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

		.sidebar .nav-link {
			color: #000;
		}

		.sidebar .nav-link:hover,
		.sidebar .nav-link:focus {
			background-color: #e9ecef;
		}

		.table td,
		.table th {
			vertical-align: middle;
		}

		.btn-sm {
			padding: 0.35rem 0.6rem;
			font-size: 0.85rem;
		}
	</style>
</head>

<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg bg-white shadow-sm">
		<div class="container-fluid">
			<a class="navbar-brand text-primary fw-bold" href="#">Portal Pendaftaran Diklat</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
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
							<li><a class="dropdown-item" href="<?= site_url('login/logout') ?>"><i
										class="fa fa-sign-out-alt me-2"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Layout -->
	<div class="container-fluid">
		<div class="row">
			<!-- Main Content -->
			<div class="col-12 p-4">
				<!-- Breadcrumb / Navigation -->
				<nav aria-label="breadcrumb" class="mb-4">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>"><i class="fa fa-home me-1"></i>Beranda</a></li>
						<li class="breadcrumb-item active" aria-current="page">Persyaratan</li>
					</ol>
				</nav>

				<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('success') ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>

				<div class="d-flex justify-content-between mb-3">
					<h4 class="fw-bold">List Persyaratan</h4>
					<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
						<i class="fa fa-plus"></i> Persyaratan
					</button>
				</div>

				<table class="table table-bordered table-hover align-middle">
					<thead class="table-light text-center">
						<tr>
							<th style="width:5%">No.</th>
							<th>Persyaratan</th>
							<th style="width:15%">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($persyaratan)): ?>
							<tr>
								<td colspan="3" class="text-center">Data belum tersedia</td>
							</tr>
						<?php else: ?>
							<?php $no = 1;
							foreach ($persyaratan as $p): ?>
								<tr>
									<td class="text-center"><?= $no++ ?></td>
									<td><?= $p->persyaratan ?></td>
									<td class="text-center">
										<div class="d-flex justify-content-center gap-2">
											<button type="button" class="btn btn-sm btn-outline-primary btn-edit" data-id="<?= $p->id ?>"
												data-persyaratan="<?= htmlspecialchars($p->persyaratan) ?>" data-bs-toggle="modal"
												data-bs-target="#modalEdit">
												<i class="bi bi-pencil"></i>
											</button>
											<a href="<?= site_url('persyaratan/hapus/' . $p->id) ?>" class="btn btn-sm btn-outline-danger"
												onclick="return confirm('Yakin ingin menghapus?')">
												<i class="bi bi-trash"></i>
											</a>
										</div>
									</td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Modal Tambah Persyaratan -->
	<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content shadow rounded-4">
				<form method="post" action="<?= site_url('persyaratan/insert') ?>">
					<div class="modal-header bg-primary text-white rounded-top-4">
						<h5 class="modal-title fw-bold">
							<i class="fa fa-file-circle-plus me-2"></i> Tambah Persyaratan
						</h5>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label fw-semibold">Persyaratan</label>
							<textarea class="form-control" name="persyaratan" required></textarea>
						</div>
					</div>
					<div class="modal-footer border-top-0 d-flex justify-content-between px-4 pb-4">
						<button type="submit" class="btn btn-success rounded-pill px-4">
							<i class="fa fa-circle-check me-1"></i> Simpan
						</button>
						<button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
							<i class="fa fa-circle-xmark me-1"></i> Batal
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal Edit Persyaratan -->
	<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content shadow rounded-4">
				<form method="post" action="<?= site_url('persyaratan/update') ?>">
					<div class="modal-header bg-warning text-white rounded-top-4">
						<h5 class="modal-title fw-bold">
							<i class="fa fa-pen-to-square me-2"></i> Edit Persyaratan
						</h5>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="id" id="editId">
						<div class="mb-3">
							<label class="form-label fw-semibold">Persyaratan</label>
							<textarea class="form-control" name="persyaratan" id="editPersyaratan" required></textarea>
						</div>
					</div>
					<div class="modal-footer border-top-0 d-flex justify-content-between px-4 pb-4">
						<button type="submit" class="btn btn-warning text-white rounded-pill px-4">
							<i class="fa fa-circle-check me-1"></i> Update
						</button>
						<button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
							<i class="fa fa-circle-xmark me-1"></i> Batal
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			document.querySelectorAll('.btn-edit').forEach(function (button) {
				button.addEventListener('click', function () {
					document.getElementById('editId').value = this.dataset.id;
					document.getElementById('editPersyaratan').value = this.dataset.persyaratan;
				});
			});
		});
	</script>
</body>

</html>
