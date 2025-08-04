<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Upload Schedule Excel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <h4 class="mb-4 fw-bold">Upload Schedule Excel</h4>

        <!-- Flash Message -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
        <?php elseif ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>

        <!-- Info Diklat -->
        <div class="alert alert-info">
            <strong>Diklat:</strong> <?= htmlspecialchars($diklat_nama) ?>
            <?php if (!empty($jenis_diklat) && $jenis_diklat !== '-'): ?>
                <span class="text-muted">(<?= htmlspecialchars($jenis_diklat) ?>)</span>
            <?php endif; ?>
            <br>
            <strong>Tahun:</strong> <?= htmlspecialchars($tahun_id) ?>
        </div>

        <!-- Template Excel Info -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0">📋 Format File Excel yang Dibutuhkan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="table-secondary">
                            <tr>
                                <th>Kolom A</th>
                                <th>Kolom B</th>
                                <th>Kolom C</th>
                                <th>Kolom D</th>
                                <th>Kolom E</th>
                                <th>Kolom F</th>
                                <th>Kolom G</th>
                                <th>Kolom H</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Periode</strong></td>
                                <td><strong>Pendaftaran Mulai</strong></td>
                                <td><strong>Pendaftaran Akhir</strong></td>
                                <td><strong>Pelaksanaan Mulai</strong></td>
                                <td><strong>Pelaksanaan Akhir</strong></td>
                                <td><strong>Jumlah Kelas</strong></td>
                                <td><strong>Kuota</strong></td>
                                <td><strong>Kuota Per Kelas</strong></td>
                            </tr>
                            <tr class="table-light">
                                <td>1</td>
                                <td>2025-01-01</td>
                                <td>2025-01-25</td>
                                <td>2025-02-01</td>
                                <td>2025-02-15</td>
                                <td>2</td>
                                <td>40</td>
                                <td>20</td>
                            </tr>
                            <tr class="table-light">
                                <td>2</td>
                                <td>2025-03-01</td>
                                <td>2025-03-25</td>
                                <td>2025-04-01</td>
                                <td>2025-04-15</td>
                                <td>3</td>
                                <td>60</td>
                                <td>20</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <p class="text-muted small">
                        <strong>Catatan:</strong>
                        <br>• Baris pertama adalah header (akan diabaikan)
                        <br>• Format tanggal: YYYY-MM-DD atau format Excel date
                        <br>• File harus berformat .xlsx atau .xls
                        <br>• Maksimal ukuran file 2MB
                    </p>
                </div>
            </div>
        </div>

        <!-- Upload Form -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">📁 Upload File Excel</h6>
            </div>
            <div class="card-body">
                <?= form_open_multipart('Schedule/process_upload') ?>
                    <?= form_hidden('diklat_id', $diklat_id) ?>
                    <?= form_hidden('tahun_id', $tahun_id) ?>
                    
                    <div class="mb-3">
                        <label for="excel_file" class="form-label">Pilih File Excel</label>
                        <input type="file" class="form-control" id="excel_file" name="excel_file" 
                               accept=".xlsx,.xls" required>
                        <div class="form-text">File harus berformat .xlsx atau .xls, maksimal 2MB</div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-upload"></i> Upload & Proses
                        </button>
                        <a href="<?= site_url('Schedule/' . $diklat_id . '/' . $tahun_id) ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                <?= form_close() ?>
            </div>
        </div>

        <!-- Download Template -->
        <div class="card mt-4">
            <div class="card-body">
                <h6 class="card-title">📥 Download Template Excel</h6>
                <p class="card-text">Download template Excel kosong untuk memudahkan pengisian data.</p>
                <a href="<?= site_url('Schedule/download_template/' . $diklat_id . '/' . $tahun_id) ?>" class="btn btn-outline-success">
                    <i class="bi bi-download"></i> Download Template
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
