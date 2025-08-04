<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Form Pendaftaran Diklat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
<div class="container mt-4">
  <h3>Form Pendaftaran Diklat</h3>
  <div class="row">
    <div class="col-md-4">
      <div class="card mb-3" id="info-diklat-singkat" style="display:none;">
        <div class="card-header bg-info text-white"><b>Info Diklat</b></div>
        <div class="card-body">
          <div><b>Nama:</b> <span id="info-nama-diklat">-</span></div>
          <div><b>Kode:</b> <span id="info-kode-diklat">-</span></div>
          <div><b>Jenis:</b> <span id="info-jenis-diklat">-</span></div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <form method="post" action="<?php echo site_url('pendaftaran/simpan'); ?>">
        <div class="mb-3">
          <label for="diklat_id" class="form-label">Pilih Diklat</label>
          <select name="diklat_id" id="diklat_id" class="form-select" required>
            <option value="">-- Pilih Diklat --</option>
            <?php if(isset($list_diklat)) foreach($list_diklat as $d): ?>
              <option value="<?php echo $d->id; ?>"><?php echo $d->nama_diklat; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div id="dynamic-dropdowns"></div>
        <div id="info-detail" class="mt-3"></div>
        <button type="submit" class="btn btn-primary">Daftar</button>
      </form>
    </div>
  </div>
</div>
<script>
// Helper untuk ambil query string dari URL
function getQueryParam(param) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

$(function(){
    function updateInfoDiklat(diklat_id) {
        console.log('updateInfoDiklat, diklat_id:', diklat_id);
        if(diklat_id) {
            $.getJSON('<?php echo site_url('pendaftaran/get_diklat_info/'); ?>'+diklat_id, function(res){
                console.log('API get_diklat_info response:', res);
                if(res.success) {
                    $('#info-nama-diklat').text(res.nama_diklat || '-');
                    $('#info-kode-diklat').text(res.kode_diklat || '-');
                    $('#info-jenis-diklat').text(res.jenis_diklat || '-');
                    $('#info-diklat-singkat').show();
                } else {
                    $('#info-diklat-singkat').hide();
                }
            });
        } else {
            $('#info-diklat-singkat').hide();
        }
    }

    function handleDiklatChange(diklat_id) {
        console.log('handleDiklatChange, diklat_id:', diklat_id);
        $('#dynamic-dropdowns').html('');
        $('#info-detail').html('');
        updateInfoDiklat(diklat_id);
        if(diklat_id) {
            $.getJSON('<?php echo site_url('pendaftaran/get_diklat_info/'); ?>'+diklat_id, function(res){
                console.log('API get_diklat_info response (handleDiklatChange):', res);
                if(res.success) {
                    if(res.is_gelombang) {
                        $.getJSON('<?php echo site_url('pendaftaran/get_periode_list/'); ?>'+diklat_id, function(list){
                            var html = '<div class="mb-3">';
                            html += '<label for="jadwal_id" class="form-label">Pilih Gelombang/Periode</label>';
                            html += '<select name="jadwal_id" id="jadwal_id" class="form-select" required>';
                            html += '<option value="">-- Pilih Gelombang/Periode --</option>';
                            $.each(list, function(i, item){
                                html += '<option value="'+item.id+'">Ke '+item.periode+'</option>';
                            });
                            html += '</select></div>';
                            $('#dynamic-dropdowns').html(html);
                        });
                    } else if(res.is_tanggal) {
                        $.getJSON('<?php echo site_url('pendaftaran/get_tahun/'); ?>'+diklat_id, function(tahunList){
                            var html = '<div class="mb-3">';
                            html += '<label for="tahun_id" class="form-label">Pilih Tahun</label>';
                            html += '<select name="tahun_id" id="tahun_id" class="form-select" required>';
                            html += '<option value="">-- Pilih Tahun --</option>';
                            $.each(tahunList, function(i, item){
                                html += '<option value="'+item.id+'">'+item.tahun+'</option>';
                            });
                            html += '</select></div>';
                            html += '<div class="mb-3">';
                            html += '<label for="jadwal_id" class="form-label">Pilih Jadwal</label>';
                            html += '<select name="jadwal_id" id="jadwal_id" class="form-select" required>';
                            html += '<option value="">-- Pilih Jadwal --</option>';
                            html += '</select></div>';
                            $('#dynamic-dropdowns').html(html);
                        });
                    }
                }
            });
        }
    }

    $('#diklat_id').change(function(){
        var diklat_id = $(this).val();
        handleDiklatChange(diklat_id);
    });

    // Jika ada diklat_id di query string, set otomatis di dropdown dan trigger change
    var diklatIdFromUrl = getQueryParam('diklat_id');
    if(diklatIdFromUrl) {
        $('#diklat_id').val(diklatIdFromUrl);
        handleDiklatChange(diklatIdFromUrl);
    } else {
        var val = $('#diklat_id').val();
        handleDiklatChange(val);
    }

    // Event dinamis untuk dropdown gelombang/periode (pembentukan)
    $(document).on('change', '#jadwal_id', function(){
        var jadwal_id = $(this).val();
        if(jadwal_id) {
            $.getJSON('<?php echo site_url('Schedule/get_detail_jadwal/'); ?>'+jadwal_id, function(data){
                var html = '';
                if(data && data.success) {
                    html += '<div class="card mt-2 mb-2">';
                    html += '<div class="card-header bg-primary text-white"><b>Informasi Gelombang / Jadwal</b></div>';
                    html += '<div class="card-body">';
                    html += '<div class="row mb-2">';
                    html += '<div class="col-5">Periode/Gelombang</div><div class="col-7"><b>'+(data.periode || '-')+'</b></div>';
                    html += '</div>';
                    html += '<div class="row mb-2">';
                    html += '<div class="col-5">Biaya</div><div class="col-7"><b>'+(data.biaya || '-')+'</b></div>';
                    html += '</div>';
                    html += '<div class="row mb-2">';
                    html += '<div class="col-5">Pendaftaran</div><div class="col-7"><b>'+(data.pendaftaran_mulai || '-')+' s/d '+(data.pendaftaran_akhir || '-')+'</b></div>';
                    html += '</div>';
                    html += '<div class="row mb-2">';
                    html += '<div class="col-5">Pelaksanaan</div><div class="col-7"><b>'+(data.pelaksanaan_mulai || '-')+' s/d '+(data.pelaksanaan_akhir || '-')+'</b></div>';
                    html += '</div>';
                    html += '<div class="row mb-2">';
                    html += '<div class="col-5">Status</div><div class="col-7"><b>'+(data.status || '-')+'</b></div>';
                    html += '</div>';
                    html += '<div class="row mb-2">';
                    html += '<div class="col-5">Kuota</div><div class="col-7"><b>'+(data.kuota || '-')+'</b></div>';
                    html += '</div>';
                    html += '<div class="row mb-2">';
                    html += '<div class="col-5">Sisa Kuota</div><div class="col-7"><b>'+(data.sisa_kursi || '-')+'</b></div>';
                    html += '</div>';
                    html += '<div class="row mb-2">';
                    html += '<div class="col-5">Kuota Terisi</div><div class="col-7"><b>'+(data.kuota_terisi || '-')+'</b></div>';
                    html += '</div>';
                    html += '</div></div>';
                }
                $('#info-detail').html(html);
            });
        } else {
            $('#info-detail').html('');
        }
    });

    // Event dinamis untuk tahun (bukan pembentukan)
    $(document).on('change', '#tahun_id', function(){
        var tahun_id = $(this).val();
        $('#jadwal_id').html('<option value="">-- Pilih Jadwal --</option>');
        if(tahun_id) {
            $.getJSON('<?php echo site_url('pendaftaran/get_schedule/'); ?>'+tahun_id, function(data){
                $.each(data, function(i, item){
                    $('#jadwal_id').append('<option value="'+item.id+'">'+item.nama_jadwal+' ('+item.tanggal+')</option>');
                });
            });
        }
    });
});
</script>
</body>
</html>
