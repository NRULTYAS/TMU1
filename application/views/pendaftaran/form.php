<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Form Pendaftaran Diklat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        .info-label {
            font-size: 0.875rem;
            color: #6c757d;
            font-weight: 500;
        }
        .info-value {
            font-size: 1rem;
            color: #495057;
            font-weight: 600;
        }
        .step-indicator {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('pendaftaran?diklat_id=14-01807-46') ?>">
                            <i class="fas fa-calendar-alt me-1"></i>Pilih Jadwal
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-user-edit me-1"></i>Form Pendaftaran
                    </li>
                </ol>
            </nav>
            
            <div class="d-flex align-items-center mb-3">
                <span class="step-indicator me-3">Step 2</span>
                <div>
                    <h3 class="mb-1"><i class="fas fa-user-edit me-2 text-primary"></i>Form Pendaftaran Diklat</h3>
                    <p class="text-muted mb-0">Lengkapi data diri Anda untuk melanjutkan pendaftaran</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Info Diklat dan Jadwal -->
        <div class="col-lg-4">
            <div class="card border-primary mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Jadwal Terpilih</h6>
                </div>
                <div class="card-body">
                    <div id="selected-schedule-info">
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="mt-2 text-muted">Memuat informasi jadwal...</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card border-info" id="info-diklat-card" style="display:none;">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Info Diklat</h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <div class="info-label">Nama Diklat</div>
                        <div class="info-value" id="info-nama-diklat">-</div>
                    </div>
                    <div class="mb-2">
                        <div class="info-label">Kode Diklat</div>
                        <div class="info-value" id="info-kode-diklat">-</div>
                    </div>
                    <div class="mb-0">
                        <div class="info-label">Jenis Diklat</div>
                        <div class="info-value" id="info-jenis-diklat">-</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Pendaftaran -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-form me-2"></i>Data Pendaftaran</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo site_url('pendaftaran/simpan'); ?>" id="registration-form">
                        <!-- Hidden fields for jadwal info -->
                        <input type="hidden" name="jadwal_id" id="hidden-jadwal-id" value="">
                        <input type="hidden" name="diklat_id" id="hidden-diklat-id" value="">
                        <input type="hidden" name="gelombang" id="hidden-gelombang" value="">
                        
                        <!-- Personal Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">
                                        Nama Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_telepon" class="form-label">
                                        No. Telepon <span class="text-danger">*</span>
                                    </label>
                                    <input type="tel" class="form-control" id="no_telepon" name="no_telepon" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">
                                        Tanggal Lahir <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="alamat" class="form-label">
                                Alamat Lengkap <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pendidikan_terakhir" class="form-label">
                                        Pendidikan Terakhir <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                                        <option value="">-- Pilih Pendidikan --</option>
                                        <option value="SMA/SMK">SMA/SMK</option>
                                        <option value="D1">Diploma 1</option>
                                        <option value="D2">Diploma 2</option>
                                        <option value="D3">Diploma 3</option>
                                        <option value="D4/S1">Diploma 4 / Sarjana</option>
                                        <option value="S2">Magister</option>
                                        <option value="S3">Doktor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pekerjaan" class="form-label">
                                        Pekerjaan <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Agreement -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agreement" name="agreement" required>
                                <label class="form-check-label" for="agreement">
                                    Saya menyetujui <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">syarat dan ketentuan</a> 
                                    yang berlaku untuk pendaftaran diklat ini. <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="d-flex justify-content-between">
                            <a href="javascript:history.back()" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-success btn-lg" id="submit-btn">
                                <i class="fas fa-paper-plane me-2"></i>Daftar Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Syarat dan Ketentuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6>Ketentuan Pendaftaran:</h6>
                <ul>
                    <li>Peserta wajib memenuhi syarat administrasi yang ditentukan</li>
                    <li>Peserta wajib mengikuti seluruh rangkaian kegiatan diklat</li>
                    <li>Peserta yang tidak hadir tanpa keterangan dapat dibatalkan keikutsertaannya</li>
                    <li>Biaya pendaftaran yang telah dibayar tidak dapat dikembalikan</li>
                    <li>Keputusan panitia tidak dapat diganggu gugat</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Saya Mengerti</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Helper functions
function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

function formatDateNice(dateString) {
    if (!dateString) return 'TBA';
    const date = new Date(dateString);
    if (isNaN(date.getTime())) return 'TBA';
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const day = date.getDate();
    const month = months[date.getMonth()];
    const year = date.getFullYear();
    return `${day} ${month} ${year}`;
}

function formatCurrency(amount) {
    if (!amount || amount == '0') return 'Gratis';
    return 'Rp ' + parseInt(amount).toLocaleString('id-ID');
}

// Load selected schedule information
function loadSelectedScheduleInfo() {
    const jadwalId = getQueryParam('jadwal_id');
    const gelombang = getQueryParam('gelombang');
    
    console.log('Loading schedule info:', { jadwalId, gelombang });
    
    if (!jadwalId) {
        document.getElementById('selected-schedule-info').innerHTML = `
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Parameter tidak lengkap!</strong><br>
                Silakan kembali ke halaman pemilihan jadwal.
            </div>
        `;
        return;
    }
    
    // Set hidden form fields
    document.getElementById('hidden-jadwal-id').value = jadwalId;
    document.getElementById('hidden-gelombang').value = gelombang || '';
    
    // Try to get data from localStorage first (passed from previous page)
    const storedData = localStorage.getItem('selectedPeriodeData');
    if (storedData) {
        try {
            const scheduleData = JSON.parse(storedData);
            displayScheduleInfo(scheduleData);
            loadDiklatInfo(scheduleData.diklat_id);
            return;
        } catch (e) {
            console.warn('Failed to parse stored data:', e);
        }
    }
    
    // Fallback: fetch data from API
    fetchScheduleData(jadwalId);
}

function displayScheduleInfo(data) {
    const pelMulai = data.pelaksanaan_mulai ? formatDateNice(data.pelaksanaan_mulai) : null;
    const pelAkhir = data.pelaksanaan_akhir ? formatDateNice(data.pelaksanaan_akhir) : null;
    const pendMulai = data.pendaftaran_mulai ? formatDateNice(data.pendaftaran_mulai) : null;
    const pendAkhir = data.pendaftaran_akhir ? formatDateNice(data.pendaftaran_akhir) : null;
    
    let jadwalText;
    if (pelMulai && pelAkhir) {
        jadwalText = `${pelMulai} s/d ${pelAkhir}`;
    } else if (pelMulai) {
        jadwalText = pelMulai;
    } else {
        jadwalText = `Gelombang ${data.periode} - Jadwal TBA`;
    }
    
    let pendaftaranText;
    if (pendMulai && pendAkhir) {
        pendaftaranText = `${pendMulai} s/d ${pendAkhir}`;
    } else if (pendMulai) {
        pendaftaranText = pendMulai;
    } else {
        pendaftaranText = 'TBA';
    }
    
    const statusClass = data.is_daftar == '1' ? 'success' : 'danger';
    const statusText = data.is_daftar == '1' ? 'Buka' : 'Tutup';
    const statusIcon = data.is_daftar == '1' ? 'fas fa-check-circle' : 'fas fa-times-circle';
    
    const kuotaTerisi = parseInt(data.kouta || 0) - parseInt(data.sisa_kursi || 0);
    const progressPercent = data.kouta ? Math.round((kuotaTerisi / parseInt(data.kouta)) * 100) : 0;
    
    document.getElementById('selected-schedule-info').innerHTML = `
        <div class="mb-3">
            <div class="info-label">ID Jadwal</div>
            <div class="info-value"><code>${data.id}</code></div>
        </div>
        <div class="mb-3">
            <div class="info-label">Jadwal Pelaksanaan</div>
            <div class="info-value text-primary">${jadwalText}</div>
        </div>
        <div class="mb-3">
            <div class="info-label">Periode Pendaftaran</div>
            <div class="info-value">${pendaftaranText}</div>
        </div>
        <div class="mb-3">
            <div class="info-label">Status Pendaftaran</div>
            <div class="info-value">
                <span class="badge bg-${statusClass}">
                    <i class="${statusIcon} me-1"></i>${statusText}
                </span>
            </div>
        </div>
        <div class="mb-3">
            <div class="info-label">Kuota & Ketersediaan</div>
            <div class="info-value">
                <div class="d-flex justify-content-between mb-1">
                    <small>Terisi: ${kuotaTerisi}</small>
                    <small>Sisa: ${data.sisa_kursi || 0}</small>
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-primary" style="width: ${progressPercent}%"></div>
                </div>
                <small class="text-muted">Total: ${data.kouta || 0} kursi</small>
            </div>
        </div>
    `;
    
    // Store diklat_id for form submission
    if (data.diklat_id) {
        document.getElementById('hidden-diklat-id').value = data.diklat_id;
    }
}

function fetchScheduleData(jadwalId) {
    // This would require a new API endpoint to get jadwal details
    document.getElementById('selected-schedule-info').innerHTML = `
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Jadwal ID:</strong> ${jadwalId}<br>
            <small>API endpoint untuk detail jadwal belum tersedia. Data akan ditambahkan nanti.</small>
        </div>
    `;
}

function loadDiklatInfo(diklatId) {
    if (!diklatId) return;
    
    console.log('Loading diklat info for:', diklatId);
    
    fetch(`<?= base_url('pendaftaran/get_diklat_info/') ?>${diklatId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('info-nama-diklat').textContent = data.nama_diklat || '-';
                document.getElementById('info-kode-diklat').textContent = data.kode_diklat || '-';
                document.getElementById('info-jenis-diklat').textContent = data.jenis_diklat || '-';
                document.getElementById('info-diklat-card').style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Failed to load diklat info:', error);
        });
}

// Form submission handler
function setupFormSubmission() {
    const form = document.getElementById('registration-form');
    const submitBtn = document.getElementById('submit-btn');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Disable submit button
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
        
        // Validate required fields
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Daftar Sekarang';
            alert('Mohon lengkapi semua field yang wajib diisi!');
            return;
        }
        
        // Submit form
        setTimeout(() => {
            // For now, just show success message
            alert('Pendaftaran berhasil! (Demo mode - belum tersimpan ke database)');
            
            // Reset button
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Daftar Sekarang';
        }, 2000);
    });
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    console.log('Form pendaftaran loaded');
    console.log('URL params:', window.location.search);
    
    loadSelectedScheduleInfo();
    setupFormSubmission();
    
    // Auto-focus first input
    setTimeout(() => {
        const firstInput = document.getElementById('nama_lengkap');
        if (firstInput) firstInput.focus();
    }, 500);
});
</script>
</body>
</html>
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
