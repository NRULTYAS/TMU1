<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<title>Daftar Jenis Diklat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap & Icons -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

	<style>
		.sidebar .nav-link {
			color: #000;
		}

		.sidebar .nav-link:hover {
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
			<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
				<ul class="navbar-nav align-items-center gap-3">
					<?php
					$namaPengguna = $this->session->userdata('nama') ?? 'User';
					$inisial = strtoupper(substr($namaPengguna, 0, 1));
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown"
							data-bs-toggle="dropdown">
							<div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-2"
								style="width: 32px; height: 32px;">
								<?= $inisial ?>
							</div>
							<span class="fw-semibold"><?= $namaPengguna ?></span>
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
						<li class="breadcrumb-item active" aria-current="page">Jenis Diklat</li>
					</ol>
				</nav>

				<div class="d-flex justify-content-between mb-3">
					<h4 class="fw-bold">Daftar Jenis Diklat</h4>
					<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalJenisDiklat" id="btnTambah">
						<i class="bi bi-plus-lg me-1"></i> Jenis Diklat
					</button>
				</div>

				<table class="table table-bordered table-hover align-middle">
					<thead class="table-light text-center">
						<tr>
							<th style="width:5%">No.</th>
							<th>Jenis Diklat</th>
							<th style="width:15%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($jenis_diklat)): ?>
							<tr>
								<td colspan="3" class="text-center text-muted">Data belum tersedia</td>
							</tr>
						<?php else: ?>
							<?php $no = 1;
							foreach ($jenis_diklat as $jd): ?>
								<tr>
									<td class="text-center"><?= $no ?></td>
									<td><?= htmlspecialchars($jd->jenis_diklat) ?></td>
									<td class="text-center">
										<div class="d-flex justify-content-center gap-2">
											<button class="btn btn-sm btn-outline-primary btn-edit-jenis" data-id="<?= $jd->id ?>"
												data-jenis="<?= htmlspecialchars($jd->jenis_diklat) ?>" data-sorting="<?= $jd->sorting ?>"
												data-no="<?= $no ?>" data-bs-toggle="modal" data-bs-target="#modalJenisDiklat">
												<i class="bi bi-pencil"></i>
											</button>
											<a href="<?= site_url('JenisDiklat/destroy/' . $jd->id) ?>" class="btn btn-sm btn-outline-danger"
												onclick="return confirm('Yakin ingin menghapus data ini?')">
												<i class="bi bi-trash"></i>
											</a>
										</div>
									</td>
								</tr>
								<?php $no++; endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modalJenisDiklat" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content shadow">
				<form method="post" id="formJenisDiklat" action="<?= site_url('JenisDiklat/insert') ?>">
					<div class="modal-header bg-primary text-white">
						<h5 class="modal-title fw-bold" id="modalJenisDiklatLabel">
							<i class="bi bi-journal-plus me-2"></i> Jenis Diklat
						</h5>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
					</div>

					<div class="modal-body px-4 pt-3 pb-4 bg-light">
						<input type="hidden" name="id" id="jenis_id">
						<input type="hidden" name="sorting" id="sorting">

						<div class="mb-3">
							<label class="form-label fw-semibold">No. Urut</label>
							<input type="number" class="form-control shadow-sm" id="no_urut_display" readonly>
						</div>

						<div class="mb-3">
							<label class="form-label fw-semibold">Jenis Diklat</label>
							<select class="form-control shadow-sm" name="jenis_diklat" id="jenis_diklat" required>
								<option value="">-- Pilih Jenis Diklat --</option>
								<?php foreach ($jenis_diklat as $jd): ?>
									<option value="<?= htmlspecialchars($jd->jenis_diklat) ?>"><?= htmlspecialchars($jd->jenis_diklat) ?>
									</option>
								<?php endforeach; ?>
							</select>
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

	<!-- Script -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const form = document.getElementById('formJenisDiklat');
			const modalTitle = document.getElementById('modalJenisDiklatLabel');
			const jenisSelect = document.getElementById('jenis_diklat');

			document.querySelectorAll('.btn-edit-jenis').forEach(btn => {
				btn.addEventListener('click', () => {
					form.action = '<?= site_url('JenisDiklat/update') ?>';
					document.getElementById('jenis_id').value = btn.dataset.id;
					document.getElementById('sorting').value = btn.dataset.sorting;
					document.getElementById('no_urut_display').value = btn.dataset.no;

					const jenisValue = btn.dataset.jenis;
					const exists = [...jenisSelect.options].some(opt => opt.value === jenisValue);
					if (!exists) {
						const opt = new Option(jenisValue, jenisValue, true, true);
						jenisSelect.appendChild(opt);
					}
					jenisSelect.value = jenisValue;

					modalTitle.innerHTML = '<i class="bi bi-pencil-square me-2"></i> Edit Jenis Diklat';
				});
			});

			document.getElementById('btnTambah').addEventListener('click', () => {
				form.action = '<?= site_url('JenisDiklat/insert') ?>';
				form.reset();
				document.getElementById('jenis_id').value = '';

				const rowCount = document.querySelectorAll('table tbody tr').length;
				const nextSorting = rowCount + 1;

				document.getElementById('no_urut_display').value = nextSorting;
				document.getElementById('sorting').value = nextSorting;

				modalTitle.innerHTML = '<i class="bi bi-journal-plus me-2"></i> Tambah Jenis Diklat';
			});
		});
	</script>
</body>

</html>
