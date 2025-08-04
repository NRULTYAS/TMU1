<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<title>Jadwal Diklat</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
	<style>
		.table-responsive {
			box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
			border-radius: 0.375rem;
		}
		.action-btn {
			width: 32px;
			height: 32px;
			padding: 0;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			border-radius: 6px;
			font-size: 14px;
		}
		.action-btn i {
			line-height: 1;
		}
		.action-column {
			width: 100px;
			text-align: center;
		}
		.number-column {
			width: 60px;
		}
		.periode-column {
			width: 80px;
		}
		.date-column {
			width: 120px;
			font-size: 0.875rem;
		}
		.numeric-column {
			width: 80px;
		}
		.table th {
			font-weight: 600;
			font-size: 0.875rem;
			white-space: nowrap;
		}
		.table td {
			font-size: 0.875rem;
			vertical-align: middle;
		}
		@media (max-width: 768px) {
			.action-btn {
				width: 28px;
				height: 28px;
				font-size: 12px;
			}
			.table-responsive {
				font-size: 0.8rem;
			}
			.date-column {
				width: 100px;
				font-size: 0.75rem;
			}
			.numeric-column {
				width: 70px;
			}
			.badge {
				font-size: 0.7rem;
			}
		}
		
		/* Hover effects */
		.action-btn:hover {
			transform: translateY(-1px);
			box-shadow: 0 2px 4px rgba(0,0,0,0.1);
		}
		
		.table tbody tr:hover {
			background-color: rgba(0, 123, 255, 0.05);
		}
		
		/* Custom scrollbar for table */
		.table-responsive::-webkit-scrollbar {
			height: 8px;
		}
		
		.table-responsive::-webkit-scrollbar-track {
			background: #f1f1f1;
			border-radius: 4px;
		}
		
		.table-responsive::-webkit-scrollbar-thumb {
			background: #888;
			border-radius: 4px;
		}
		
		.table-responsive::-webkit-scrollbar-thumb:hover {
			background: #555;
		}
	</style>
</head>

<body class="bg-light">
	<div class="container py-4">
		<!-- Flash Messages -->
		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<i class="bi bi-check-circle"></i>
				<?= $this->session->flashdata('success') ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			</div>
		<?php endif; ?>
		
		<?php if ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<i class="bi bi-exclamation-triangle"></i>
				<?= $this->session->flashdata('error') ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			</div>
		<?php endif; ?>

		<h4 class="mb-4 fw-bold">
			Daftar Jadwal Diklat
			<?php if (!empty($jadwal) && isset($jadwal[0]->tahun)): ?>
				Tahun <?= htmlspecialchars($jadwal[0]->tahun) ?>
			<?php endif; ?>
		</h4>

		<!-- ℹ️ Info Diklat -->
		<?php if (!empty($diklat_nama) && $diklat_nama !== '-'): ?>
			<div class="alert alert-info">
				<strong>Diklat:</strong> <?= htmlspecialchars($diklat_nama) ?>
				<?php if (!empty($jenis_diklat) && $jenis_diklat !== '-'): ?>
					<span class="text-muted">(<?= htmlspecialchars($jenis_diklat) ?>)</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<!-- 📊 Jumlah Data -->
		<div class="alert alert-secondary small d-flex justify-content-between align-items-center">
			<div>
				<b>Jumlah Data Ditampilkan:</b> <?= isset($jadwal) ? count($jadwal) : 0 ?>
			</div>
			<?php 
			$current_diklat_id = !empty($diklat_id) ? $diklat_id : (!empty($jadwal[0]) ? $jadwal[0]->diklat_id ?? null : null);
			$current_tahun = !empty($jadwal[0]) ? $jadwal[0]->tahun ?? null : null;
			?>
			<?php if (!empty($current_diklat_id) && !empty($current_tahun)): ?>
				<div>
					<a href="<?= site_url('Schedule/upload_form/' . $current_diklat_id . '/' . $current_tahun) ?>" 
					   class="btn btn-success btn-sm">
						<i class="bi bi-upload"></i> Upload Excel
					</a>
				</div>
			<?php endif; ?>
		</div>

		<!-- 📅 Tabel Jadwal -->
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover mb-0">
				<thead class="table-dark">
					<tr class="text-center">
						<th class="number-column">No</th>
						<th>Nama Diklat</th>
						<th class="periode-column">Periode</th>
						<th class="date-column">Pelaksanaan Mulai</th>
						<th class="date-column">Pelaksanaan Akhir</th>
						<th class="date-column">Pendaftaran Mulai</th>
						<th class="date-column">Pendaftaran Akhir</th>
						<th class="numeric-column">Jml Kelas</th>
						<th class="numeric-column">Kuota</th>
						<th class="numeric-column">Sisa Kursi</th>
						<th class="action-column">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php if (empty($jadwal)): ?>
						<tr>
							<td colspan="11" class="text-center text-muted py-4">
								<i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i><br>
								Data tidak ditemukan
							</td>
						</tr>
					<?php else:
						$no = $start + 1;
						foreach ($jadwal as $row): ?>
							<tr>
								<td class="text-center fw-bold"><?= $no++ ?></td>
								<td class="text-start">
									<div class="fw-semibold"><?= htmlspecialchars($row->nama_diklat ?? '-') ?></div>
								</td>
								<td class="text-center fw-bold">
									<?= htmlspecialchars($row->periode) ?>
								</td>
								<td class="text-center date-column">
									<?= $row->pelaksanaan_mulai ? date('d/m/Y', strtotime($row->pelaksanaan_mulai)) : '-' ?>
								</td>
								<td class="text-center date-column">
									<?= $row->pelaksanaan_akhir ? date('d/m/Y', strtotime($row->pelaksanaan_akhir)) : '-' ?>
								</td>
								<td class="text-center date-column">
									<?= $row->pendaftaran_mulai ? date('d/m/Y', strtotime($row->pendaftaran_mulai)) : '-' ?>
								</td>
								<td class="text-center date-column">
									<?= $row->pendaftaran_akhir ? date('d/m/Y', strtotime($row->pendaftaran_akhir)) : '-' ?>
								</td>
								<td class="text-center">
									<span class="badge bg-secondary"><?= htmlspecialchars($row->jumlah_kelas ?? '-') ?></span>
								</td>
								<td class="text-center fw-bold">
									<?= isset($row->kouta) ? number_format($row->kouta) : '-' ?>
								</td>
								<td class="text-center">
									<?php 
									$sisa = $row->sisa_kursi ?? 0;
									$kuota = $row->kouta ?? 0;
									$percentage = $kuota > 0 ? ($sisa / $kuota) * 100 : 0;
									$badgeClass = $percentage > 50 ? 'success' : ($percentage > 20 ? 'warning' : 'danger');
									?>
									<span class="badge bg-<?= $badgeClass ?>"><?= number_format($sisa) ?></span>
								</td>
								<td class="action-column">
									<div class="d-flex gap-1 justify-content-center">
										<button class="btn btn-warning action-btn" 
												data-bs-toggle="modal" 
												data-bs-target="#editModal<?= $row->id ?>" 
												title="Edit Jadwal">
											<i class="bi bi-pencil-square"></i>
										</button>
										<button class="btn btn-danger action-btn" 
												onclick="confirmDelete('<?= $row->id ?>', '<?= htmlspecialchars($row->nama_diklat) ?>', '<?= $row->periode ?>')" 
												title="Hapus Jadwal">
											<i class="bi bi-trash3"></i>
										</button>
									</div>
								</td>
							</tr>
						<?php endforeach; endif; ?>
				</tbody>
			</table>
		</div>

		<!-- 🔁 Pagination & Navigasi -->
		<div class="mt-3 d-flex justify-content-between align-items-center">
			<div><?= isset($pagination) ? $pagination : '' ?></div>
			
			<?php if (!empty($back_id)): ?>
				<a href="<?= site_url('Diklat/tahun/' . $back_id) ?>" class="btn btn-outline-secondary">
					← Kembali ke Daftar Tahun
				</a>
			<?php endif; ?>
		</div>
	</div>

	<!-- Modal Edit Jadwal -->
	<?php if (!empty($jadwal)): ?>
		<?php foreach ($jadwal as $row): ?>
			<div class="modal fade" id="editModal<?= $row->id ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row->id ?>" aria-hidden="true">
				<div class="modal-dialog modal-xl">
					<div class="modal-content">
						<form method="post" action="<?= site_url('Schedule/update_jadwal') ?>">
							<div class="modal-header bg-primary text-white">
								<h5 class="modal-title" id="editModalLabel<?= $row->id ?>">
									<i class="bi bi-pencil-square me-2"></i>Edit Jadwal - <?= htmlspecialchars($row->nama_diklat) ?>
								</h5>
								<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<input type="hidden" name="jadwal_id" value="<?= $row->id ?>">
								<input type="hidden" name="diklat_id" value="<?= isset($diklat_id) ? $diklat_id : '' ?>">
								<input type="hidden" name="tahun_id" value="<?= isset($tahun_id) ? $tahun_id : '' ?>">
								
								<!-- Info Jadwal -->
								<div class="alert alert-light border">
									<h6 class="mb-2"><i class="bi bi-info-circle text-primary"></i> Informasi Jadwal</h6>
									<div class="row">
										<div class="col-md-6">
											<small class="text-muted">ID Jadwal:</small><br>
											<code><?= $row->id ?></code>
										</div>
										<div class="col-md-6">
											<small class="text-muted">Diklat:</small><br>
											<strong><?= htmlspecialchars($row->nama_diklat) ?></strong>
										</div>
									</div>
								</div>
								
								<!-- Form Fields -->
								<div class="row g-3">
									<div class="col-md-4">
										<label for="periode<?= $row->id ?>" class="form-label fw-semibold">
											<i class="bi bi-calendar-event text-primary"></i> Periode
										</label>
										<input type="text" class="form-control" id="periode<?= $row->id ?>" name="periode" 
											   value="<?= htmlspecialchars($row->periode) ?>" required>
									</div>
									<div class="col-md-4">
										<label for="jumlah_kelas<?= $row->id ?>" class="form-label fw-semibold">
											<i class="bi bi-building text-success"></i> Jumlah Kelas
										</label>
										<input type="number" class="form-control" id="jumlah_kelas<?= $row->id ?>" name="jumlah_kelas" 
											   value="<?= htmlspecialchars($row->jumlah_kelas) ?>" min="1" required>
									</div>
									<div class="col-md-4">
										<label for="kouta<?= $row->id ?>" class="form-label fw-semibold">
											<i class="bi bi-people text-info"></i> Kuota Total
										</label>
										<input type="number" class="form-control" id="kouta<?= $row->id ?>" name="kouta" 
											   value="<?= isset($row->kouta) ? $row->kouta : '' ?>" min="0">
									</div>
								</div>
								
								<div class="row g-3 mt-2">
									<div class="col-md-6">
										<label for="pelaksanaan_mulai<?= $row->id ?>" class="form-label fw-semibold">
											<i class="bi bi-calendar-check text-success"></i> Pelaksanaan Mulai
										</label>
										<input type="date" class="form-control" id="pelaksanaan_mulai<?= $row->id ?>" name="pelaksanaan_mulai" 
											   value="<?= $row->pelaksanaan_mulai ?>">
									</div>
									<div class="col-md-6">
										<label for="pelaksanaan_akhir<?= $row->id ?>" class="form-label fw-semibold">
											<i class="bi bi-calendar-x text-danger"></i> Pelaksanaan Akhir
										</label>
										<input type="date" class="form-control" id="pelaksanaan_akhir<?= $row->id ?>" name="pelaksanaan_akhir" 
											   value="<?= $row->pelaksanaan_akhir ?>">
									</div>
								</div>
								
								<div class="row g-3 mt-2">
									<div class="col-md-6">
										<label for="pendaftaran_mulai<?= $row->id ?>" class="form-label fw-semibold">
											<i class="bi bi-calendar-plus text-warning"></i> Pendaftaran Mulai
										</label>
										<input type="date" class="form-control" id="pendaftaran_mulai<?= $row->id ?>" name="pendaftaran_mulai" 
											   value="<?= $row->pendaftaran_mulai ?>">
									</div>
									<div class="col-md-6">
										<label for="pendaftaran_akhir<?= $row->id ?>" class="form-label fw-semibold">
											<i class="bi bi-calendar-minus text-secondary"></i> Pendaftaran Akhir
										</label>
										<input type="date" class="form-control" id="pendaftaran_akhir<?= $row->id ?>" name="pendaftaran_akhir" 
											   value="<?= $row->pendaftaran_akhir ?>">
									</div>
								</div>
								
								<div class="row g-3 mt-2">
									<div class="col-md-6">
										<label for="kuota_per_kelas<?= $row->id ?>" class="form-label fw-semibold">
											<i class="bi bi-person-lines-fill text-primary"></i> Kuota per Kelas
										</label>
										<input type="number" class="form-control" id="kuota_per_kelas<?= $row->id ?>" name="kuota_per_kelas" 
											   value="<?= isset($row->kuota_per_kelas) ? $row->kuota_per_kelas : '' ?>" min="0">
									</div>
									<div class="col-md-6">
										<label for="sisa_kursi<?= $row->id ?>" class="form-label fw-semibold">
											<i class="bi bi-chair text-success"></i> Sisa Kursi
										</label>
										<input type="number" class="form-control" id="sisa_kursi<?= $row->id ?>" name="sisa_kursi" 
											   value="<?= isset($row->sisa_kursi) ? $row->sisa_kursi : '' ?>" min="0">
									</div>
								</div>
							</div>
							<div class="modal-footer bg-light">
								<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
									<i class="bi bi-x-circle"></i> Batal
								</button>
								<button type="submit" class="btn btn-primary">
									<i class="bi bi-check-circle"></i> Simpan Perubahan
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	
	<script>
		function confirmDelete(jadwalId, namaJadwal, periode) {
			// Custom confirmation dialog
			const modal = document.createElement('div');
			modal.innerHTML = `
				<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header bg-danger text-white">
								<h5 class="modal-title">
									<i class="bi bi-trash3"></i> Konfirmasi Hapus
								</h5>
								<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
							</div>
							<div class="modal-body text-center">
								<div class="mb-3">
									<i class="bi bi-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
								</div>
								<h5>Yakin ingin menghapus jadwal ini?</h5>
								<div class="alert alert-light">
									<strong>Diklat:</strong> ${namaJadwal}<br>
									<strong>Periode:</strong> ${periode}
								</div>
								<p class="text-muted">
									<i class="bi bi-info-circle"></i> 
									Data yang sudah dihapus tidak dapat dikembalikan.
								</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
									<i class="bi bi-x-circle"></i> Batal
								</button>
								<button type="button" class="btn btn-danger" onclick="executeDelete('${jadwalId}')">
									<i class="bi bi-trash3"></i> Ya, Hapus
								</button>
							</div>
						</div>
					</div>
				</div>
			`;
			
			document.body.appendChild(modal);
			const modalInstance = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
			modalInstance.show();
			
			// Clean up modal when hidden
			document.getElementById('deleteConfirmModal').addEventListener('hidden.bs.modal', function () {
				document.body.removeChild(modal);
			});
		}
		
		function executeDelete(jadwalId) {
			// Show loading state
			const deleteBtn = document.querySelector('[onclick*="executeDelete"]');
			if (deleteBtn) {
				deleteBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Menghapus...';
				deleteBtn.disabled = true;
			}
			
			// Redirect to delete URL
			const diklatId = '<?= isset($diklat_id) ? $diklat_id : '' ?>';
			const tahunId = '<?= isset($tahun_id) ? $tahun_id : '' ?>';
			window.location.href = `<?= site_url('Schedule/delete_jadwal/') ?>${jadwalId}/${diklatId}/${tahunId}`;
		}
		
		// Auto-hide alerts after 5 seconds
		document.addEventListener('DOMContentLoaded', function() {
			const alerts = document.querySelectorAll('.alert-dismissible');
			alerts.forEach(alert => {
				setTimeout(() => {
					const bsAlert = new bootstrap.Alert(alert);
					bsAlert.close();
				}, 5000);
			});
		});
	</script>
</body>

</html>
