<!DOCTYPE html>
<html>
<head>
    <title>Hapus Jenis Diklat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h3>Konfirmasi Hapus</h3>
    <div class="alert alert-warning">
        Apakah Anda yakin ingin menghapus data:
        <strong><?= htmlspecialchars($row->jenis_diklat) ?></strong>?
    </div>
    <a href="<?= site_url('JenisDiklat/destroy/' . $row->id) ?>" class="btn btn-danger">Ya, Hapus</a>
    <a href="<?= site_url('JenisDiklat') ?>" class="btn btn-secondary">Batal</a>
</div>
</body>
</html>
