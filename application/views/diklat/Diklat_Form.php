<!DOCTYPE html>
<html>

<head>
  <title>Edit Jenis Diklat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5" style="max-width: 600px;">
    <h4>Edit Jenis Diklat</h4>

    <form method="post" action="<?= site_url('JenisDiklat/update/' . $row->id) ?>">

      <div class="mb-3">
        <label for="jenis_diklat">Jenis Diklat</label>
        <select name="jenis_diklat" class="form-select" required>
          <option value="">Pilih Jenis</option>
          <?php foreach ($kategori_list as $kategori): ?>
            <option value="<?= $kategori->jenis_diklat ?>" <?= ($kategori->jenis_diklat == $row->jenis_diklat) ? 'selected' : '' ?>>
              <?= $kategori->jenis_diklat ?>
            </option>
          <?php endforeach ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="category">Kategori</label>
        <select name="category" class="form-select" required>
          <?php foreach (['B (Pembentukan)', 'T (Peningkatan)', 'S (Short Course)', 'E (Endorse)', 'R (Revalidasi)'] as $cat): ?>
            <option value="<?= $cat ?>" <?= ($row->category == $cat) ? 'selected' : '' ?>>
              <?= $cat ?>
            </option>
          <?php endforeach ?>
        </select>
      </div>

      <div class="d-flex justify-content-between">
        <a href="<?= site_url('JenisDiklat') ?>" class="btn btn-outline-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</body>

</html>
