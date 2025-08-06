<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $diklat_info['nama_diklat'] ?> - Pendaftaran</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-radius: 12px; }
        .progress-custom { height: 8px; border-radius: 4px; }
        .status-open { color: #28a745; font-weight: 600; }
        .status-closed { color: #dc3545; font-weight: 600; }
        .status-full { color: #ffc107; font-weight: 600; }
        .dropdown-custom { border-radius: 8px; border: 2px solid #e9ecef; }
        .btn-primary-custom { 
            background: linear-gradient(135deg, #007bff, #0056b3); 
            border: none; 
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
        }
        .btn-secondary-custom { 
            background: #6c757d; 
            border: none; 
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
        }
        .info-label { 
            font-size: 0.85rem; 
            color: #6c757d; 
            font-weight: 500; 
            text-transform: uppercase; 
            letter-spacing: 0.5px;
        }
        .info-value { 
            font-size: 1.1rem; 
            font-weight: 600; 
            color: #2c3e50; 
        }
        .category-badge {
            background: linear-gradient(135deg, #6f42c1, #007bff);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
    </style>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand text-primary" href="<?= base_url() ?>">
            <i class="fas fa-graduation-cap me-2"></i>
            Portal Diklat
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="<?= base_url('home/about') ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Informasi AIRIS
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Berita Terbaru</a></li>
                        <li><a class="dropdown-item" href="#">Sertifikat Terbit</a></li>
                        <li><a class="dropdown-item" href="#">Kuota Kursi Diklat</a></li>
                        <li><a class="dropdown-item" href="#">Alur & Tata Cara Pembayaran Diklat</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('home/contact') ?>">Kamus Maritim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">AIRIS Mobile</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="row g-4">
                
                <!-- Layout 1: Pilih Jadwal (Kiri) -->
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>
                                <?php if (isset($single_periode_mode) && $single_periode_mode): ?>
                                    Detail Jadwal Pendaftaran - Periode <?= isset($periode) ? $periode : '' ?>
                                <?php else: ?>
                                    Pilih Jadwal Pendaftaran
                                <?php endif; ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            
                            <?php if (isset($single_periode_mode) && $single_periode_mode): ?>
                                <!-- Mode single periode - tampilkan info langsung -->
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Anda melihat detail untuk periode <strong><?= $periode ?></strong>
                                </div>
                            <?php else: ?>
                                <!-- Mode multiple periode - tampilkan dropdown -->
                                <div class="mb-4">
                                    <label class="info-label mb-2">Pilih Periode</label>
                                    <select class="form-select form-select-lg dropdown-custom" id="jadwalSelect" onchange="loadJadwalInfo()">
                                        <option value="">-- Pilih Periode Pendaftaran --</option>
                                        <?php foreach ($jadwal_list as $jadwal): ?>
                                            <?php 
                                            // Create date range display with Indonesian format
                                            $date_display = '';
                                            
                                            // Priority: registration date range
                                            if (!empty($jadwal['pendaftaran_mulai']) && !empty($jadwal['pendaftaran_akhir'])) {
                                                $tanggal_mulai = date('j F Y', strtotime($jadwal['pendaftaran_mulai']));
                                                $tanggal_akhir = date('j F Y', strtotime($jadwal['pendaftaran_akhir']));
                                                
                                                // Convert English months to Indonesian
                                                $bulan_en = ['January', 'February', 'March', 'April', 'May', 'June', 
                                                            'July', 'August', 'September', 'October', 'November', 'December'];
                                                $bulan_id = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                                                            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                            
                                            $tanggal_mulai = str_replace($bulan_en, $bulan_id, $tanggal_mulai);
                                            $tanggal_akhir = str_replace($bulan_en, $bulan_id, $tanggal_akhir);
                                            
                                            $date_display = $tanggal_mulai . ' s/d ' . $tanggal_akhir;
                                        } 
                                        // If no registration dates, use execution date range
                                        elseif (!empty($jadwal['pelaksanaan_mulai']) && !empty($jadwal['pelaksanaan_akhir'])) {
                                            $tanggal_mulai = date('j F Y', strtotime($jadwal['pelaksanaan_mulai']));
                                            $tanggal_akhir = date('j F Y', strtotime($jadwal['pelaksanaan_akhir']));
                                            
                                            // Convert English months to Indonesian
                                            $bulan_en = ['January', 'February', 'March', 'April', 'May', 'June', 
                                                        'July', 'August', 'September', 'October', 'November', 'December'];
                                            $bulan_id = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                                                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                            
                                            $tanggal_mulai = str_replace($bulan_en, $bulan_id, $tanggal_mulai);
                                            $tanggal_akhir = str_replace($bulan_en, $bulan_id, $tanggal_akhir);
                                            
                                            $date_display = $tanggal_mulai . ' s/d ' . $tanggal_akhir;
                                        } 
                                        // If no dates available
                                        else {
                                            $date_display = 'Tanggal belum tersedia';
                                        }
                                        ?>
                                        <option value="<?= $jadwal['id'] ?>" 
                                                data-info='<?= json_encode($jadwal) ?>'>
                                            <?= $date_display ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php endif; ?>

                            <!-- Card Informasi Jadwal -->
                            <div id="jadwalInfo">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        
                                        <!-- Tanggal Pelaksanaan -->
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <span class="info-label">Tanggal Pelaksanaan</span>
                                                <div class="info-value" id="tglPelaksanaan">-</div>
                                            </div>
                                            <div class="col-6">
                                                <span class="info-label">Status Pendaftaran</span>
                                                <div id="statusPendaftaran">-</div>
                                            </div>
                                        </div>

                                        <!-- Kuota & Biaya -->
                                        <div class="row mb-3">
                                            <div class="col-3">
                                                <span class="info-label">Kuota</span>
                                                <div class="info-value" id="kuotaTotal">-</div>
                                            </div>
                                            <div class="col-3">
                                                <span class="info-label">Sisa Kuota</span>
                                                <div class="info-value text-success" id="sisaKuota">-</div>
                                            </div>
                                            <div class="col-6">
                                                <span class="info-label">Biaya</span>
                                                <div class="info-value text-primary" id="biaya">-</div>
                                            </div>
                                        </div>

                                        <!-- Progress Bar -->
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="info-label">Pendaftar</span>
                                                <span class="info-label" id="progressText">- / -</span>
                                            </div>
                                            <div class="progress progress-custom">
                                                <div class="progress-bar bg-success" id="progressBar" style="width: 0%"></div>
                                            </div>
                                        </div>

                                        <!-- Button Action -->
                                        <div class="d-grid">
                                            <button class="btn btn-secondary-custom" id="btnAction" onclick="handleAction()" disabled>
                                                <i class="fas fa-calendar me-2"></i>Pilih Tanggal Terlebih Dahulu
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Layout 2: Informasi Diklat (Kanan) -->
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0"><i class="fas fa-info-circle text-info me-2"></i>Informasi Diklat</h5>
                        </div>
                        <div class="card-body">
                            
                            <!-- Kategori Diklat -->
                            <div class="mb-3">
                                <span class="category-badge">
                                    <?php 
                                    $kategori = 'PROGRAM DIKLAT';
                                    if (!empty($diklat_info['kategori_diklat'])) {
                                        $kategori = strtoupper($diklat_info['kategori_diklat']);
                                    }
                                    echo $kategori;
                                    ?>
                                </span>
                            </div>

                            <!-- Nama Diklat -->
                            <div class="mb-3">
                                <span class="info-label">Nama Diklat</span>
                                <h5 class="info-value mb-0"><?= $diklat_info['nama_diklat'] ?></h5>
                                <small class="text-muted">Kode: <?= $diklat_info['kode_diklat'] ?></small>
                            </div>

                            <!-- Total Kuota & Sisa -->
                            <div class="row mb-3">
                                <div class="col-6">
                                    <span class="info-label">Total Kuota</span>
                                    <div class="info-value" id="totalKuotaDiklat">
                                        -
                                    </div>
                                </div>
                                <div class="col-6">
                                    <span class="info-label">Sisa Kuota</span>
                                    <div class="info-value text-success" id="sisaKuotaDiklat">
                                        -
                                    </div>
                                </div>
                            </div>

                            <!-- Biaya -->
                            <div class="mb-3">
                                <span class="info-label">Biaya Program</span>
                                <div class="info-value text-primary">
                                    <?php if (!empty($jadwal_list[0]['biaya']) && $jadwal_list[0]['biaya'] > 0): ?>
                                        Rp <?= number_format($jadwal_list[0]['biaya'], 0, ',', '.') ?>
                                    <?php else: ?>
                                        <span class="text-success">GRATIS</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Persyaratan -->
                            <div>
                                <span class="info-label">Persyaratan Administrasi</span>
                                <div class="mt-2">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item px-0 py-2 border-0">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            <small>Kartu Identitas (KTP/SIM/Passport)</small>
                                        </div>
                                        <div class="list-group-item px-0 py-2 border-0">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            <small>Ijazah Pendidikan Terakhir</small>
                                        </div>
                                        <div class="list-group-item px-0 py-2 border-0">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            <small>Pas Foto Background Merah 4x6 (2 lembar)</small>
                                        </div>
                                        <?php if ($diklat_info['check_kesehatan']): ?>
                                        <div class="list-group-item px-0 py-2 border-0">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            <small>Surat Keterangan Sehat dari Dokter</small>
                                        </div>
                                        <?php endif; ?>
                                        <div class="list-group-item px-0 py-2 border-0">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            <small>Mengisi formulir pendaftaran</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Data jadwal dari PHP
const jadwalData = <?= json_encode($jadwal_list) ?>;
let selectedJadwal = null;

function loadJadwalInfo() {
    const select = document.getElementById('jadwalSelect');
    
    if (select.value === '') {
        // Reset to default values
        document.getElementById('tglPelaksanaan').textContent = '-';
        document.getElementById('statusPendaftaran').innerHTML = '-';
        document.getElementById('kuotaTotal').textContent = '-';
        document.getElementById('sisaKuota').textContent = '-';
        document.getElementById('biaya').textContent = '-';
        document.getElementById('progressText').textContent = '- / -';
        document.getElementById('progressBar').style.width = '0%';
        
        // Reset sidebar kanan
        document.getElementById('totalKuotaDiklat').textContent = '-';
        document.getElementById('sisaKuotaDiklat').textContent = '-';
        
        // Update button state
        const btnAction = document.getElementById('btnAction');
        btnAction.className = 'btn btn-secondary-custom';
        btnAction.innerHTML = '<i class="fas fa-calendar me-2"></i>Pilih Tanggal Terlebih Dahulu';
        btnAction.disabled = true;
        return;
    }
    
    // Find selected jadwal
    selectedJadwal = jadwalData.find(j => j.id == select.value);
    
    if (!selectedJadwal) return;
    
    // Update tanggal pelaksanaan
    let tglPelaksanaanText = '-';
    if (selectedJadwal.pelaksanaan_mulai && selectedJadwal.pelaksanaan_akhir) {
        const tglMulai = new Date(selectedJadwal.pelaksanaan_mulai).toLocaleDateString('id-ID', {
            day: '2-digit', month: 'short', year: 'numeric'
        });
        const tglSelesai = new Date(selectedJadwal.pelaksanaan_akhir).toLocaleDateString('id-ID', {
            day: '2-digit', month: 'short', year: 'numeric'
        });
        tglPelaksanaanText = `${tglMulai} - ${tglSelesai}`;
    } else {
        tglPelaksanaanText = 'Tanggal belum ditentukan';
    }
    document.getElementById('tglPelaksanaan').textContent = tglPelaksanaanText;
    
    // Update status pendaftaran
    const now = new Date();
    let status = '';
    let statusClass = '';
    
    if (selectedJadwal.pendaftaran_mulai && selectedJadwal.pendaftaran_akhir) {
        const mulaiDaftar = new Date(selectedJadwal.pendaftaran_mulai);
        const selesaiDaftar = new Date(selectedJadwal.pendaftaran_akhir);
        
        if (now < mulaiDaftar) {
            status = '🕐 Belum Dibuka';
            statusClass = 'text-warning';
        } else if (now > selesaiDaftar) {
            status = '❌ Tutup';
            statusClass = 'status-closed';
        } else if (selectedJadwal.pendaftar_count >= selectedJadwal.kouta) {
            status = '📝 Penuh';
            statusClass = 'status-full';
        } else {
            status = '✅ Buka';
            statusClass = 'status-open';
        }
    } else {
        // If no registration dates, check if execution dates have passed
        if (selectedJadwal.pelaksanaan_mulai && selectedJadwal.pelaksanaan_akhir) {
            const mulaiPelaksanaan = new Date(selectedJadwal.pelaksanaan_mulai);
            const selesaiPelaksanaan = new Date(selectedJadwal.pelaksanaan_akhir);
            
            if (now > selesaiPelaksanaan) {
                status = '❌ Tutup (Sudah Berakhir)';
                statusClass = 'status-closed';
            } else if (now > mulaiPelaksanaan) {
                status = '⚠️ Sedang Berlangsung';
                statusClass = 'text-warning';
            } else {
                // Use database status
                status = selectedJadwal.is_daftar ? '✅ Buka' : '❌ Tutup';
                statusClass = selectedJadwal.is_daftar ? 'status-open' : 'status-closed';
            }
        } else {
            // No dates available, use database status
            status = selectedJadwal.is_daftar ? '✅ Buka' : '❌ Tutup';
            statusClass = selectedJadwal.is_daftar ? 'status-open' : 'status-closed';
        }
    }
    
    document.getElementById('statusPendaftaran').innerHTML = `<span class="${statusClass}">${status}</span>`;
    
    // Update kuota - gunakan langsung sisa_kursi dari database
    document.getElementById('kuotaTotal').textContent = selectedJadwal.kouta + ' Orang';
    document.getElementById('sisaKuota').textContent = selectedJadwal.sisa_kursi + ' Orang';
    
    // Update biaya
    if (selectedJadwal.biaya && selectedJadwal.biaya > 0) {
        document.getElementById('biaya').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(selectedJadwal.biaya);
    } else {
        document.getElementById('biaya').innerHTML = '<span class="text-success">GRATIS</span>';
    }
    
    // Update progress bar - gunakan data yang konsisten
    const totalKuota = parseInt(selectedJadwal.kouta);
    const sisaKuota = parseInt(selectedJadwal.sisa_kursi);
    const terdaftar = totalKuota - sisaKuota;
    const progressPercent = totalKuota > 0 ? (terdaftar / totalKuota) * 100 : 0;
    
    document.getElementById('progressBar').style.width = progressPercent + '%';
    document.getElementById('progressText').textContent = `${terdaftar} / ${totalKuota}`;
    
    // Update sidebar kanan dengan data jadwal yang dipilih
    document.getElementById('totalKuotaDiklat').textContent = totalKuota + ' Orang';
    document.getElementById('sisaKuotaDiklat').textContent = sisaKuota + ' Orang';
    
    // Update button
    const btnAction = document.getElementById('btnAction');
    let canRegister = true;
    let buttonMessage = 'Lanjut Mendaftar';
    
    if (selectedJadwal.pendaftaran_mulai && selectedJadwal.pendaftaran_akhir) {
        const mulaiDaftar = new Date(selectedJadwal.pendaftaran_mulai);
        const selesaiDaftar = new Date(selectedJadwal.pendaftaran_akhir);
        
        if (now < mulaiDaftar) {
            canRegister = false;
            buttonMessage = 'Pendaftaran Belum Dibuka';
        } else if (now > selesaiDaftar) {
            canRegister = false;
            buttonMessage = 'Pendaftaran Sudah Ditutup';
        } else if (sisaKuota <= 0) {
            canRegister = false;
            buttonMessage = 'Kuota Sudah Penuh';
        }
    } else {
        // If no registration dates, check execution dates and database status
        if (selectedJadwal.pelaksanaan_mulai && selectedJadwal.pelaksanaan_akhir) {
            const mulaiPelaksanaan = new Date(selectedJadwal.pelaksanaan_mulai);
            const selesaiPelaksanaan = new Date(selectedJadwal.pelaksanaan_akhir);
            
            if (now > selesaiPelaksanaan) {
                canRegister = false;
                buttonMessage = 'Program Sudah Berakhir';
            } else if (now > mulaiPelaksanaan) {
                canRegister = false;
                buttonMessage = 'Program Sedang Berlangsung';
            } else if (!selectedJadwal.is_daftar) {
                canRegister = false;
                buttonMessage = 'Pendaftaran Ditutup';
            } else if (sisaKuota <= 0) {
                canRegister = false;
                buttonMessage = 'Kuota Sudah Penuh';
            }
        } else {
            // No dates, check database status and quota
            if (!selectedJadwal.is_daftar) {
                canRegister = false;
                buttonMessage = 'Pendaftaran Ditutup';
            } else if (sisaKuota <= 0) {
                canRegister = false;
                buttonMessage = 'Kuota Sudah Penuh';
            }
        }
    }
    
    if (!canRegister) {
        btnAction.className = 'btn btn-secondary-custom';
        btnAction.innerHTML = `<i class="fas fa-times me-2"></i>${buttonMessage}`;
        btnAction.disabled = true;
    } else {
        btnAction.className = 'btn btn-primary-custom';
        btnAction.innerHTML = '<i class="fas fa-user-plus me-2"></i>Lanjut Mendaftar';
        btnAction.disabled = false;
    }
}

function handleAction() {
    if (!selectedJadwal) return;
    
    const now = new Date();
    let canRegister = true;
    
    if (selectedJadwal.pendaftaran_mulai && selectedJadwal.pendaftaran_akhir) {
        const mulaiDaftar = new Date(selectedJadwal.pendaftaran_mulai);
        const selesaiDaftar = new Date(selectedJadwal.pendaftaran_akhir);
        canRegister = (now >= mulaiDaftar && now <= selesaiDaftar && selectedJadwal.pendaftar_count < selectedJadwal.kouta);
        
        if (now > selesaiDaftar) {
            alert('Pendaftaran sudah ditutup. Tanggal pendaftaran berakhir pada ' + selesaiDaftar.toLocaleDateString('id-ID'));
            return;
        }
    } else {
        // Check execution dates and database status
        if (selectedJadwal.pelaksanaan_mulai && selectedJadwal.pelaksanaan_akhir) {
            const selesaiPelaksanaan = new Date(selectedJadwal.pelaksanaan_akhir);
            if (now > selesaiPelaksanaan) {
                alert('Program diklat sudah berakhir.');
                return;
            }
        }
        
        canRegister = (selectedJadwal.is_daftar && selectedJadwal.pendaftar_count < selectedJadwal.kouta);
    }
    
    if (canRegister) {
        // Redirect ke form pendaftaran dengan diklat_id parameter
        const diklatId = '<?= $diklat_id ?>';
        window.location.href = '<?= base_url("pendaftaran/form/") ?>' + selectedJadwal.id + '?diklat_id=' + diklatId;
    } else {
        alert('Pendaftaran tidak tersedia. Silahkan pilih jadwal lain.');
    }
}

console.log('🎓 Simple registration page loaded');
console.log('📊 Available schedules:', jadwalData.length);

// Auto-load untuk mode single periode
<?php if (isset($single_periode_mode) && $single_periode_mode): ?>
// Mode single periode - auto load informasi jadwal pertama
console.log('🎯 Single periode mode activated for periode: <?= isset($periode) ? $periode : '' ?>');
if (jadwalData.length > 0) {
    loadJadwalInfo(jadwalData[0]);
}
<?php endif; ?>
</script>
