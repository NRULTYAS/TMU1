<!-- Modal Tambah/Edit Jenis Diklat -->
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title><?= isset($row) ? 'Edit Jenis Diklat' : 'Tambah Jenis Diklat' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f2f6fc;
      font-family: 'Segoe UI', sans-serif;
    }

    .modal-content {
      border-radius: 1rem;
    }

    .modal-header {
      background: linear-gradient(45deg, #0d6efd, #6610f2);
    }

    .modal-title {
      font-weight: 600;
    }

    .form-label {
      font-weight: 500;
    }

    .form-select,
    .form-control {
      border-radius: 0.75rem;
    }

    .btn-primary {
      border-radius: 0.75rem;
    }

    .btn-outline-secondary {
      border-radius: 0.75rem;
    }
  </style>
</head>

<body>
  <div class="modal show d-block" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content shadow">

        <div class="modal-header text-white">
          <h5 class="modal-title">
            <i class="bi bi-journal-text me-2"></i>
            <?= isset($row) ? 'Edit Jenis Diklat' : 'Tambah Jenis Diklat' ?>
          </h5>
          <a href="<?= site_url('JenisDiklat') ?>" class="btn-close btn-close-white" aria-label="Close"></a>
        </div>

        <form action="<?= isset($row) ? site_url('JenisDiklat/update/' . $row->id) : site_url('JenisDiklat/insert') ?>" method="post">
          <div class="modal-body bg-light">

            <h6 class="text-primary fw-bold text-center mb-4">
              <?= isset($row) ? 'Formulir Edit Jenis Diklat' : 'Formulir Tambah Jenis Diklat' ?>
            </h6>

            <?php if (!isset($row)): ?>
              <div class="mb-3">
                <label for="id" class="form-label">ID (unik)</label>
                <input type="text" name="id" id="id" class="form-control shadow-sm" required>
              </div>
            <?php endif; ?>

            <div class="mb-3">
              <label for="jenis_diklat" class="form-label">Jenis Diklat</label>
              <select name="jenis_diklat" id="jenis_diklat" class="form-select shadow-sm" required>
                <option value="">-- Pilih Jenis Diklat --</option>
                <?php foreach ($dropdown_jenis_diklat as $opt): ?>
                  <option value="<?= $opt->jenis_diklat ?>" <?= isset($row) && $row->jenis_diklat == $opt->jenis_diklat ? 'selected' : '' ?>>
                    <?= $opt->jenis_diklat ?>
                  </option>
                <?php endforeach ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="category" class="form-label">Kategori</label>
              <select name="category" id="category" class="form-select shadow-sm" required>
                <option value="">-- Pilih Category --</option>
                <?php
                $categories = [
                  'B' => 'B (Pembentukan)',
                  'T' => 'T (Peningkatan)',
                  'S' => 'S (Short Course)',
                  'E' => 'E (Endorse)',
                  'R' => 'R (Revalidasi)'
                ];
                foreach ($categories as $val => $label): ?>
                  <option value="<?= $val ?>" <?= isset($row) && $row->category == $val ? 'selected' : '' ?>>
                    <?= $label ?>
                  </option>
                <?php endforeach ?>
              </select>
            </div>

          </div>

          <div class="modal-footer bg-white">
            <a href="<?= site_url('JenisDiklat') ?>" class="btn btn-outline-secondary px-4">
              <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary px-4">
              <i class="bi bi-save2 me-1"></i> Simpan
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
