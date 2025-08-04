<!DOCTYPE html>
<html lang="id">


<head>
	<meta charset="utf-8">
	<title>List Diklat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
						<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
							<div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-2"
								style="width: 32px; height: 32px;">
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

	<div class="container-fluid">
		<div class="row">
			<div class="col-12 p-4">
				<!-- Breadcrumb / Navigation -->
				<nav aria-label="breadcrumb" class="mb-4">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>"><i class="fa fa-home me-1"></i>Beranda</a></li>
						<li class="breadcrumb-item active" aria-current="page">Diklat</li>
					</ol>
				</nav>

				<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('success') ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					</div>
				<?php endif; ?>

				<div class="d-flex justify-content-between mb-3">
					<h4 class="fw-bold">List Diklat</h4>
					<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDiklat" id="btnTambah">
						<i class="bi bi-plus-lg"></i> Diklat
					</button>
				</div>

				<form method="get" class="mb-3">
					<div class="input-group" style="max-width: 400px;">
						<select name="kategori" class="form-select">
							<option value="">Semua Kategori</option>
							<?php foreach ($kategori_list as $k): ?>
								<option value="<?= $k->id ?>" <?= ($this->input->get('kategori') == $k->id ? 'selected' : '') ?>>
									<?= $k->jenis_diklat ?>
								</option>
							<?php endforeach ?>
						</select>
						<button type="submit" class="btn btn-outline-primary">
							<i class="bi bi-funnel-fill"></i> Filter
						</button>
					</div>
				</form>

				<table class="table table-bordered table-hover align-middle">
					<thead class="table-light text-center">
						<tr>
							<th style="width:5%">No.</th>
							<th>Kategori</th>
							<th>Kode/Nama Diklat</th>
							<th>Manage</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($diklat)): ?>
							<tr>
								<td colspan="5" class="text-center">Data belum tersedia</td>
							</tr>
						<?php else: ?>
							<?php $no = 1;
							foreach ($diklat as $d): ?>
								<tr>
									<td class="text-center"><?= $no++ ?></td>
									<td class="text-uppercase fw-semibold"><?= $d->jenis_diklat ?></td>
									<td>
										<span class="badge bg-dark me-1">(<?= $d->kode_diklat ?>)</span> <?= $d->nama_diklat ?>
									</td>
									<td>
										<div class="d-flex flex-wrap gap-2">
											<!-- ✅ FIX: Link benar -->
											<a href="<?= site_url('Diklat/persyaratan/' . $d->id) ?>" class="btn btn-sm btn-warning">
												<i class="bi bi-list-task"></i> Persyaratan
											</a>
											<a href="<?= site_url('Diklat/tahun/' . $d->id) ?>" class="btn btn-sm btn-secondary">
												<i class="bi bi-calendar-event"></i> Tahun
											</a>
										</div>
									</td>
									<td class="text-center">
										<div class="d-flex justify-content-center gap-2">
											<button class="btn btn-sm btn-outline-primary btn-edit-diklat" data-id="<?= $d->id ?>"
												data-nama="<?= $d->nama_diklat ?>" data-kode="<?= $d->kode_diklat ?>"
												data-jenis="<?= $d->jenis_diklat_id ?? '' ?>" data-no="<?= $d->no_urut ?? '' ?>"
												data-bs-toggle="modal" data-bs-target="#modalDiklat">
												<i class="bi bi-pencil-square"></i>
											</button>
											<a href="<?= site_url('Diklat/delete/' . $d->id) ?>" class="btn btn-sm btn-outline-danger"
												onclick="return confirm('Yakin hapus data ini?')">
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

	<!-- Modal Tambah/Edit -->
	<div class="modal fade" id="modalDiklat" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content shadow rounded-4">
				<div class="modal-header bg-primary text-white rounded-top-4">
					<h5 class="modal-title fw-bold" id="modalDiklatLabel">
						<i class="bi bi-journal-plus me-2"></i> Tambah Diklat
					</h5>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
				</div>
				<form method="post" id="formDiklat" action="<?= site_url('Diklat/insert') ?>">
					<div class="modal-body px-4 pt-3 pb-4 bg-light rounded-bottom-4">
						<input type="hidden" name="id" id="diklat_id">
						<div class="row g-3 mb-3">
							<div class="col-md-2">
								<label class="form-label fw-semibold">No.</label>
								<input type="text" id="urutan_diklat" class="form-control text-center bg-secondary-subtle" readonly
									value="<?= count($diklat) + 1 ?>">
							</div>
							<div class="col-md-5">
								<label class="form-label fw-semibold">Kategori / Jenis Diklat</label>
								<select name="jenis_diklat_id" class="form-select shadow-sm" required id="jenis_diklat">
									<option value="">Pilih Kategori</option>
									<?php foreach ($kategori_list as $opt): ?>
										<option value="<?= $opt->id ?>"><?= $opt->jenis_diklat ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-md-5">
								<label class="form-label fw-semibold">Kode Diklat</label>
								<input type="text" name="kode_diklat" id="kode_diklat" class="form-control shadow-sm"
									placeholder="Contoh: DP-III N" required>
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label fw-semibold">Nama Diklat</label>
							<input type="text" name="nama_diklat" id="nama_diklat" class="form-control shadow-sm"
								placeholder="Masukkan nama diklat..." required>
						</div>
					</div>
					<div class="modal-footer border-top-0 d-flex justify-content-between px-4 pb-4">
						<button type="submit" class="btn btn-success rounded-pill px-4">
							<i class="bi bi-check2-circle me-1"></i> Simpan
						</button>
						<button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
							<i class="bi bi-x-circle me-1"></i> Batal
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const form = document.getElementById('formDiklat');
			const modalTitle = document.getElementById('modalDiklatLabel');

			document.querySelectorAll('.btn-edit-diklat').forEach(button => {
				button.addEventListener('click', function () {
					form.action = '<?= site_url("Diklat/update/") ?>' + this.dataset.id;
					document.getElementById('diklat_id').value = this.dataset.id;
					document.getElementById('nama_diklat').value = this.dataset.nama;
					document.getElementById('kode_diklat').value = this.dataset.kode;
					document.getElementById('jenis_diklat').value = this.dataset.jenis;
					document.getElementById('urutan_diklat').value = this.dataset.no;
					modalTitle.innerHTML = '<i class="bi bi-pencil-square me-2"></i> Edit Diklat';
				});
			});

			document.getElementById('btnTambah').addEventListener('click', function () {
				form.action = '<?= site_url("Diklat/insert") ?>';
				form.reset();
				document.getElementById('diklat_id').value = '';
				document.getElementById('urutan_diklat').value = '<?= count($diklat) + 1 ?>';
				modalTitle.innerHTML = '<i class="bi bi-journal-plus me-2"></i> Tambah Diklat';
			});
		});
	</script>
</body>

</html>
