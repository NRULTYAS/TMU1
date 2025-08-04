<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Persyaratan Diklat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h4 class="mb-4 fw-bold">Persyaratan Diklat</h4>

    <!-- ✅ Ganti ID dengan Nama Diklat & Jenis Diklat -->
    <div class="alert alert-info">
        <strong>Diklat:</strong> <?= $diklat_nama ?> <span class="text-muted">(<?= $jenis_diklat ?>)</span>
    </div>

    <div class="row">
        <!-- Template Persyaratan -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-warning text-white fw-semibold">Template Persyaratan</div>
                <div class="card-body">
                    <input type="text" id="searchTemplate" class="form-control mb-3" placeholder="Cari persyaratan...">
                    <div id="listTemplate">
                        <?php foreach ($template_persyaratan as $p): ?>
                            <div class="template-item d-flex justify-content-between align-items-center mb-2" id="item-<?= $p->id ?>">
                                <span class="persyaratan-text"><?= $p->persyaratan ?></span>
                                <button class="btn btn-sm btn-primary btn-tambah" data-id="<?= $p->id ?>">Tambahkan</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Persyaratan Dipilih -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header text-white fw-semibold bg-primary">Persyaratan yang Dipilih</div>
                <div class="card-body" id="listDipilih">
                    <?php if (empty($persyaratan_dipilih)): ?>
                        <div class="text-muted fst-italic">Belum ada persyaratan yang dipilih.</div>
                    <?php else: ?>
                        <?php foreach ($persyaratan_dipilih as $p): ?>
                            <div class="d-flex justify-content-between align-items-center mb-2" id="dipilih-<?= $p->id ?>">
                                <span class="persyaratan-text"><?= $p->persyaratan ?></span>
                                <button class="btn btn-sm btn-danger btn-hapus" data-id="<?= $p->id ?>">Hapus</button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Filter Search -->
<script>
    $(document).ready(function () {
        const originalItems = $('#listTemplate .template-item').toArray();

        $('#searchTemplate').on('input', function () {
            const keyword = $(this).val().toLowerCase();
            const filtered = originalItems.filter(item =>
                $(item).text().toLowerCase().includes(keyword)
            );
            $('#listTemplate').empty().append(keyword === '' ? originalItems : filtered);
        });
    });
</script>

<!-- Tambah Persyaratan -->
<script>
    $(document).on('click', '.btn-tambah', function () {
        const persyaratanID = $(this).data('id');
        const diklatID = '<?= $diklat_id ?>';

        $.ajax({
            url: '<?= site_url('Diklat/ajax_tambah_persyaratan') ?>',
            method: 'POST',
            data: {
                diklat_id: diklatID,
                persyaratan_id: persyaratanID
            },
            success: function (res) {
                const data = typeof res === 'string' ? JSON.parse(res) : res;
                $('#listDipilih .text-muted').remove();

                $('#listDipilih').append(`
                    <div class="d-flex justify-content-between align-items-center mb-2" id="dipilih-${data.id}">
                        <span class="persyaratan-text">${data.persyaratan}</span>
                        <button class="btn btn-sm btn-danger btn-hapus" data-id="${data.id}">Hapus</button>
                    </div>
                `);

                $('#item-' + data.id).remove();
            }
        });
    });
</script>

<!-- Hapus Persyaratan -->
<script>
    $(document).on('click', '.btn-hapus', function (e) {
        e.preventDefault();
        if (!confirm('Yakin ingin menghapus persyaratan ini?')) return;

        const persyaratanID = $(this).data('id');
        const diklatID = '<?= $diklat_id ?>';
        const container = $(this).closest('.d-flex');

        $.ajax({
            url: '<?= site_url('Diklat/ajax_hapus_persyaratan') ?>',
            method: 'POST',
            data: {
                diklat_id: diklatID,
                persyaratan_id: persyaratanID
            },
            success: function (res) {
                const data = typeof res === 'string' ? JSON.parse(res) : res;

                if (data.status === 'deleted') {
                    container.remove();
                    $('#listTemplate').prepend(`
                        <div class="template-item d-flex justify-content-between align-items-center mb-2" id="item-${data.id}">
                            <span class="persyaratan-text">${data.persyaratan}</span>
                            <button class="btn btn-sm btn-primary btn-tambah" data-id="${data.id}">Tambahkan</button>
                        </div>
                    `);
                    if ($('#listDipilih .d-flex').length === 0) {
                        $('#listDipilih').html('<div class="text-muted fst-italic">Belum ada persyaratan yang dipilih.</div>');
                    }
                }
            }
        });
    });
</script>
</body>
</html>
