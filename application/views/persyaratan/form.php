<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= isset($row) ? 'Edit' : 'Tambah' ?> Persyaratan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3 class="mb-4"><?= isset($row) ? 'Edit' : 'Tambah' ?> Persyaratan</h3>
    
    <form action="<?= $form_action ?>" method="post">
        <?php if (isset($row)): ?>
            <input type="hidden" name="id" value="<?= $row->id ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label for="persyaratan" class="form-label">Nama Persyaratan</label>
            <input type="text" name="persyaratan" id="persyaratan" class="form-control"
                   value="<?= isset($row) ? htmlspecialchars($row->persyaratan) : '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="jenis_persyaratan" class="form-label">Jenis Persyaratan</label>
            <select name="jenis_persyaratan" id="jenis_persyaratan" class="form-select" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="Wajib" <?= isset($row) && $row->jenis_persyaratan === 'Wajib' ? 'selected' : '' ?>>Wajib</option>
                <option value="Tambahan" <?= isset($row) && $row->jenis_persyaratan === 'Tambahan' ? 'selected' : '' ?>>Tambahan</option>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">
            <i class="bi bi-check-circle me-1"></i> Simpan
        </button>
        <a href="<?= site_url('persyaratan') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
        </a>
    </form>
</div>

<!-- Optional Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
