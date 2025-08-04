<!DOCTYPE html>
<html>
<head>
  <title>Hapus Diklat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h4>Konfirmasi Hapus</h4>
  <div class="alert alert-warning">
    Apakah Anda yakin ingin menghapus diklat:
    <strong><?= $row->nama_diklat ?></strong>?
  </div>
  <a href="<?= site_url('Diklat/destroy/' . $row->id) ?>" class="btn btn-danger">Ya, Hapus</a>
  <a href="<?= site_url('Diklat') ?>" class="btn btn-secondary">Batal</a>
</div>
</body>
</html>
