<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Tahun Diklat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .toggle-switch {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 24px;
    }
    
    .toggle-switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }
    
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: .4s;
      border-radius: 24px;
    }
    
    .slider:before {
      position: absolute;
      content: "";
      height: 18px;
      width: 18px;
      left: 3px;
      bottom: 3px;
      background-color: white;
      transition: .4s;
      border-radius: 50%;
    }
    
    input:checked + .slider {
      background-color: #28a745;
    }
    
    input:checked + .slider:before {
      transform: translateX(26px);
    }
    
    .status-badge {
      font-size: 0.75rem;
      padding: 0.25rem 0.5rem;
    }
  </style>
</head>
<body class="bg-light">
<div class="container py-4">
  <h4 class="mb-4 fw-bold">Daftar Tahun Diklat</h4>

  <!-- Flash Message -->
  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
  <?php elseif ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
  <?php endif; ?>

  <!-- ✅ Ganti ID dengan Nama Diklat & Jenis Diklat -->
    <div class="alert alert-info">
        <strong>Diklat:</strong> <?= $diklat_nama ?> <span class="text-muted">(<?= $jenis_diklat ?>)</span>
    </div>

  <!-- Form Tambah Tahun -->
  <div class="card mb-4">
    <div class="card-body">
      <form method="post" action="<?= site_url('Diklat/tambah_tahun/' . $diklat_id) ?>">
        <div class="mb-3">
          <label for="tahun" class="form-label">Tahun</label>
          <input type="text" class="form-control" id="tahun" name="tahun" placeholder="Contoh: 2025" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Tahun</button>
      </form>
    </div>
  </div>

  <!-- Tabel Tahun -->
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Tahun</th>
        <th>Status</th>
        <th>&nbsp;</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php $no = 1; foreach ($tahun_diklat as $row): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td>
          <?= htmlspecialchars($row->tahun) ?>
          <?php if ($row->is_active == 1): ?>
            <span class="badge bg-success status-badge ms-2">
              <i class="bi bi-check-circle"></i> Aktif
            </span>
          <?php endif; ?>
        </td>
        <td class="text-center">
          <?php if ($row->is_active == 1): ?>
            <span class="badge bg-success"><i class="bi bi-check-circle"></i> Aktif</span>
          <?php else: ?>
            <span class="badge bg-secondary"><i class="bi bi-circle"></i> Tidak Aktif</span>
          <?php endif; ?>
        </td>
        <td class="text-center">
          <label class="toggle-switch">
            <input type="checkbox" <?= $row->is_active == 1 ? 'checked' : '' ?> 
                   onchange="toggleActive('<?= $row->id ?>', '<?= $row->diklat_id ?>', this.checked)"
                   id="toggle<?= $row->id ?>">
            <span class="slider"></span>
          </label>
        </td>
        <td>
          <a href="<?= site_url('Schedule/show_by_tahun_diklat/' . $row->diklat_id . '/' . $row->tahun) ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-calendar-event"></i> Schedule
          </a>
          <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row->id ?>">
            <i class="bi bi-pencil"></i> Edit
          </button>
          <a href="<?= site_url('Diklat/hapus_tahun/' . $diklat_id . '/' . $row->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
            <i class="bi bi-trash"></i> Hapus
          </a>
        </td>
      </tr>

      <!-- Modal Edit Tahun -->
      <div class="modal fade" id="editModal<?= $row->id ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row->id ?>" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= site_url('Diklat/update_tahun/' . $diklat_id) ?>">
              <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel<?= $row->id ?>">Edit Tahun Diklat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" value="<?= $row->id ?>">
                <div class="mb-3">
                  <label for="tahun<?= $row->id ?>" class="form-label">Tahun</label>
                  <input type="text" class="form-control" id="tahun<?= $row->id ?>" name="tahun" value="<?= htmlspecialchars($row->tahun) ?>" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    <?php endforeach ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleActive(tahunId, diklatId, isChecked) {
    if (isChecked) {
        // Konfirmasi sebelum mengaktifkan
        if (confirm('Yakin ingin mengaktifkan tahun ini?\n\nCatatan: Hanya 1 tahun yang bisa aktif per diklat. Tahun lain akan dinonaktifkan secara otomatis.')) {
            updateActiveStatus(tahunId, diklatId, 1);
        } else {
            // Kembalikan toggle jika dibatalkan
            document.getElementById('toggle' + tahunId).checked = false;
        }
    } else {
        // Konfirmasi sebelum menonaktifkan
        if (confirm('Yakin ingin menonaktifkan tahun ini?')) {
            updateActiveStatus(tahunId, diklatId, 0);
        } else {
            // Kembalikan toggle jika dibatalkan
            document.getElementById('toggle' + tahunId).checked = true;
        }
    }
}

function updateActiveStatus(tahunId, diklatId, status) {
    // Tampilkan loading state
    const toggleElement = document.getElementById('toggle' + tahunId);
    const originalParent = toggleElement.parentNode;
    originalParent.innerHTML = '<span class="spinner-border spinner-border-sm text-primary"></span>';
    
    // Kirim request AJAX
    fetch('<?= site_url('Diklat/toggle_active_tahun') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'tahun_id=' + encodeURIComponent(tahunId) + 
              '&diklat_id=' + encodeURIComponent(diklatId) + 
              '&is_active=' + status
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Refresh halaman untuk menampilkan perubahan
            location.reload();
        } else {
            // Tampilkan error
            alert('Error: ' + (data.message || 'Gagal mengupdate status aktif'));
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate status');
        location.reload();
    });
}

// Auto-hide alerts
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        if (!alert.classList.contains('alert-info')) {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }, 5000);
        }
    });
});
</script>
</body>
</html>
