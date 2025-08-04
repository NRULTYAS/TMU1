<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Diklat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .info-section { background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); padding: 24px; margin-bottom: 30px; }
        .card { border-radius: 8px; }
        .form-label { font-weight: 600; }
        .info-label { font-size: 0.95rem; color: #6c757d; font-weight: 500; margin-bottom: 4px; }
        .info-value { font-size: 1.1rem; color: #333; font-weight: 600; }
        .progress { border-radius: 10px; overflow: hidden; height: 8px; }
        .progress-bar { transition: width 0.6s ease; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand text-primary fw-bold" href="#">
                <i class="fas fa-graduation-cap me-2"></i>Portal Diklat
            </a>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="info-section mb-4">
                    <h4 class="mb-3" id="main-heading">
                        <i class="fas fa-calendar-alt text-success me-2"></i>Tentukan Periode Pendaftaran
                    </h4>
                    <p class="text-muted mb-4" id="main-description">
                        Silakan pilih periode pendaftaran yang masih terbuka untuk melanjutkan proses pendaftaran
                    </p>
                    <div class="mb-4">
                        <label for="gelombang-select" class="form-label" id="dropdown-label">
                            <i class="fas fa-calendar-alt me-2"></i>Pilih Periode Pendaftaran
                        </label>
                        <select class="form-select form-select-lg" id="gelombang-select" required>
                            <option value="">-- Pilih Periode Pendaftaran --</option>
                        </select>
                        <div class="form-text">Pilih periode pendaftaran sesuai dengan jadwal yang tersedia</div>
                    </div>
                    <div id="periode-detail-container" class="mt-4">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Detail Periode Pendaftaran
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-label">Periode</div>
                                        <div class="info-value" id="detail-periode">-</div>
                                        <div class="info-label mt-3">Status Pendaftaran</div>
                                        <div class="info-value"><span id="detail-status" class="badge bg-secondary">-</span></div>
                                        <div class="info-label mt-3">Tanggal Pelaksanaan</div>
                                        <div class="info-value" id="detail-tanggal">-</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-label">Biaya (Rp.)</div>
                                        <div class="info-value text-success" id="detail-biaya">-</div>
                                        <div class="info-label mt-3">Kuota Total</div>
                                        <div class="info-value" id="detail-kuota">-</div>
                                        <div class="info-label mt-3">Sisa Kuota</div>
                                        <div class="info-value text-primary" id="detail-sisa-kuota">-</div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Kuota Terisi:</span>
                                        <span class="text-muted" id="progress-text">0/0</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" id="progress-bar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-primary btn-lg" id="btn-lanjut" disabled>
                            <i class="fas fa-arrow-right me-2"></i>Lanjutkan Pendaftaran
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Diklat</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="text-muted mb-1">Kategori Diklat</h6>
                            <p class="mb-0 fw-bold" id="kategori-diklat">
                                <?php 
                                $diklat_id = $this->input->get('diklat_id') ?? '14-01807-46';
                                
                                // Get diklat info from database directly
                                $diklat = $this->db->get_where('scre_diklat', ['id' => $diklat_id])->row();
                                if ($diklat && !empty($diklat->jenis_diklat_id)) {
                                    $jenis = $this->db->get_where('scre_jenis_diklat', ['id' => $diklat->jenis_diklat_id])->row();
                                    echo $jenis ? $jenis->jenis_diklat : 'SIPENCATAR DIKLAT PELAUT';
                                } else {
                                    echo 'SIPENCATAR DIKLAT PELAUT';
                                }
                                ?>
                            </p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted mb-1">Nama Diklat</h6>
                            <p class="mb-0 fw-bold" id="nama-diklat">
                                <?php 
                                if ($diklat) {
                                    echo $diklat->nama_diklat;
                                } else {
                                    echo 'DP-III NAUTIKA';
                                }
                                ?>
                            </p>
                        </div>
                        <div class="mt-4">
                            <h6 class="text-muted mb-2">Persyaratan Administrasi</h6>
                            <p class="small text-muted mb-3">Silahkan siapkan beberapa informasi dan dokumen berikut untuk mempercepat proses pendaftaran.</p>
                            <ol class="small ps-3">
                                <li class="mb-1">File Scan PDF SKCK</li>
                                <li class="mb-1">File Scan PDF AKTE KELAHIRAN</li>
                                <li class="mb-1">File Scan PDF KTP</li>
                                <li class="mb-1">File Pas Foto Warna (Latar Belakang Biru untuk Nautika) jpeg</li>
                                <li class="mb-1">File Scan PDF Surat Keterangan Belum Menikah dari Kelurahan Setempat</li>
                                <li class="mb-1">File Scan PDF Surat Pernyataan Calon Siswa Diklat (Unduh di Menu Awal Pendaftaran Online)</li>
                                <li class="mb-1">File Scan PDF Raport Semester I sd V (khusus yang menggunakan paket C - IPA)</li>
                                <li class="mb-1">File Scan PDF Ijazah + Nilai Ijazah (Ijazah Pendidikan Terakhir)</li>
                                <li class="mb-1">File Scan PDF Kartu Keluarga</li>
                                <li class="mb-1">File Scan PDF Surat Keterangan Lulus (yang masih kelas XII)</li>
                                <li class="mb-1">File Scan PDF Surat Pernyataan Sanggup Tidak Menikah (Unduh di Menu Awal Pendaftaran Online)</li>
                                <li class="mb-1">File Scan Piagam Penghargaan Akademik / Non Akademik (Tingkat Provinsi)</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h5><i class="fas fa-graduation-cap me-2"></i>Portal Diklat</h5>
                    <p>© 2024 Divisi IT - Politeknik Pelayaran Banten</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <script>
        console.log('Script loaded!');
        console.log('jQuery loaded:', typeof jQuery !== 'undefined');
        
        // Use vanilla JavaScript approach as backup
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded!');
            try {
                loadGelombangData();
                setupEventListeners();
                setupJQueryEvents();
            } catch (error) {
                console.error('Error during initialization:', error);
            }
        });
        
        // Backup with window.onload
        window.onload = function() {
            console.log('Window loaded!');
            
            // Set immediate fallback values first
            setTimeout(function() {
                const urlParams = new URLSearchParams(window.location.search);
                const diklatId = urlParams.get('diklat_id');
                
                if (diklatId && $('#kategori-diklat').text() === 'Loading...') {
                    console.log('Setting fallback info for diklat ID:', diklatId);
                    $('#kategori-diklat').text('Memuat data...');
                    $('#nama-diklat').text('Memuat data...');
                    
                    // Try loading again if still loading
                    loadDiklatInfo();
                }
            }, 1000);
        };
        
        function loadGelombangData() {
            console.log('=== SIMPLE LOADING DATA ===');
            
            const select = document.getElementById('gelombang-select');
            if (!select) {
                console.error('Select element not found!');
                return;
            }
            
            console.log('Select element found, starting API call...');
            
            // Add loading indicator
            select.innerHTML = '<option value="">Loading data...</option>';
            
            // Get diklat_id from URL
            const urlParams = new URLSearchParams(window.location.search);
            const diklatId = urlParams.get('diklat_id') || '14-01807-46';
            
            const apiUrl = 'http://localhost/tugas1_tmu1/pendaftaran/get_periode_list/' + diklatId;
            console.log('Fetching:', apiUrl);
            
            fetch(apiUrl)
                .then(response => {
                    console.log('Response received:', response.status);
                    if (!response.ok) throw new Error('HTTP ' + response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Data received:', data);
                    
                    let options = '<option value="">-- Pilih Periode Pendaftaran --</option>';
                    
                    if (data.data && data.data.length > 0) {
                        // Group data by periode untuk menghindari duplikasi
                        const groupedByPeriode = {};
                        
                        data.data.forEach(item => {
                            if (!groupedByPeriode[item.periode]) {
                                groupedByPeriode[item.periode] = [];
                            }
                            groupedByPeriode[item.periode].push(item);
                        });
                        
                        console.log('Grouped data:', groupedByPeriode);
                        
                        // Create options - one per unique periode
                        Object.keys(groupedByPeriode).sort((a, b) => parseInt(a) - parseInt(b)).forEach(periode => {
                            const itemsInPeriode = groupedByPeriode[periode];
                            const count = itemsInPeriode.length;
                            
                            // Simple display: just show periode number
                            const displayText = count > 1 
                                ? `Periode ${periode} (${count} jadwal tersedia)`
                                : `Periode ${periode}`;
                                
                            options += `<option value="${periode}">${displayText}</option>`;
                        });
                        
                        // Store data globally
                        window.globalGelombangData = data.data;
                    } else {
                        options += '<option value="">Tidak ada data tersedia</option>';
                        window.globalGelombangData = [];
                    }
                    
                    select.innerHTML = options;
                    console.log('Dropdown updated successfully');
                    
                    // Add event listener
                    select.addEventListener('change', function() {
                        const value = this.value;
                        if (value && window.globalGelombangData) {
                            showPeriodeDetail(value, window.globalGelombangData, false);
                        } else {
                            resetPeriodeDetail();
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    select.innerHTML = '<option value="">-- Error loading data --</option>';
                });
        }
        
        function showPeriodeDetail(periode, allData, useGelombang = false) {
            console.log('Showing detail for periode:', periode, 'Data-driven mode');
            
            // Filter data for selected periode
            const periodeData = allData.filter(item => 
                item.periode == periode && item.kouta > 0 && item.is_exist == 1
            );
            
            if (periodeData.length > 0) {
                const data = periodeData[0]; // Ambil data pertama
                console.log('Periode data:', data);
                
                // Calculate totals from multiple items if any
                const totalKuota = periodeData.reduce((sum, item) => sum + (parseInt(item.kouta) || 0), 0);
                const totalSisa = periodeData.reduce((sum, item) => sum + (parseInt(item.sisa_kursi) || 0), 0);
                const totalTerisi = totalKuota - totalSisa;
                const persentase = totalKuota > 0 ? (totalTerisi / totalKuota) * 100 : 0;
                const isOpen = periodeData.some(item => item.is_daftar == 1);

                // Update detail display dengan data dari database
                const detailPeriode = document.getElementById('detail-periode');
                const detailStatus = document.getElementById('detail-status');
                const detailTanggal = document.getElementById('detail-tanggal');
                const detailBiaya = document.getElementById('detail-biaya');
                const detailKuota = document.getElementById('detail-kuota');
                const detailSisaKuota = document.getElementById('detail-sisa-kuota');
                const progressText = document.getElementById('progress-text');
                const progressBar = document.getElementById('progress-bar');

                // 1. PERIODE - Tampilkan periode dengan jumlah jadwal
                if (detailPeriode) {
                    const jadwalCount = periodeData.length;
                    let periodeText = 'Periode ' + periode;
                    if (jadwalCount > 1) {
                        periodeText += ' (' + jadwalCount + ' jadwal tersedia)';
                    }
                    detailPeriode.textContent = periodeText;
                }

                // 2. STATUS PENDAFTARAN - Berdasarkan field is_daftar
                if (detailStatus) {
                    detailStatus.textContent = isOpen ? 'Buka Pendaftaran' : 'Tutup Pendaftaran';
                    detailStatus.className = 'badge ' + (isOpen ? 'bg-success' : 'bg-danger');
                }

                // 3. TANGGAL - Tampilkan semua jadwal dalam periode ini
                if (detailTanggal) {
                    let tanggalHtml = '';
                    
                    if (periodeData.length === 1) {
                        // Jika hanya satu jadwal, tampilkan normal
                        const item = periodeData[0];
                        if (item.pendaftaran_mulai && item.pendaftaran_akhir) {
                            const startReg = formatDate(item.pendaftaran_mulai);
                            const endReg = formatDate(item.pendaftaran_akhir);
                            tanggalHtml = '<strong>Pendaftaran:</strong> ' + startReg + ' - ' + endReg;
                        }
                        if (item.pelaksanaan_mulai && item.pelaksanaan_akhir) {
                            const startExec = formatDate(item.pelaksanaan_mulai);
                            const endExec = formatDate(item.pelaksanaan_akhir);
                            if (tanggalHtml) tanggalHtml += '<br>';
                            tanggalHtml += '<strong>Pelaksanaan:</strong> ' + startExec + ' - ' + endExec;
                        }
                    } else {
                        // Jika multiple jadwal, tampilkan semuanya
                        tanggalHtml = '<strong>Jadwal Tersedia:</strong><br>';
                        periodeData.forEach((item, index) => {
                            tanggalHtml += '<div class="mb-1"><strong>Jadwal ' + (index + 1) + ':</strong><br>';
                            if (item.pendaftaran_mulai && item.pendaftaran_akhir) {
                                const startReg = formatDate(item.pendaftaran_mulai);
                                const endReg = formatDate(item.pendaftaran_akhir);
                                tanggalHtml += '<small>📅 Daftar: ' + startReg + ' - ' + endReg + '</small><br>';
                            }
                            if (item.pelaksanaan_mulai && item.pelaksanaan_akhir) {
                                const startExec = formatDate(item.pelaksanaan_mulai);
                                const endExec = formatDate(item.pelaksanaan_akhir);
                                tanggalHtml += '<small>🏫 Pelaksanaan: ' + startExec + ' - ' + endExec + '</small>';
                            }
                            if (item.is_daftar == 1) {
                                tanggalHtml += ' <span class="badge bg-success">Buka</span>';
                            } else {
                                tanggalHtml += ' <span class="badge bg-secondary">Tutup</span>';
                            }
                            tanggalHtml += '</div>';
                        });
                    }
                    
                    detailTanggal.innerHTML = tanggalHtml || 'Akan ditentukan kemudian';
                }

                // 4. BIAYA - Dari field biaya jika ada
                if (detailBiaya) {
                    if (data.biaya && data.biaya !== '0' && data.biaya !== '' && data.biaya !== null) {
                        const biayaFormatted = parseInt(data.biaya).toLocaleString('id-ID');
                        detailBiaya.textContent = 'Rp ' + biayaFormatted;
                    } else {
                        detailBiaya.textContent = 'Gratis / Belum ditentukan';
                    }
                }

                // 5. KUOTA TOTAL - Dari field kouta
                if (detailKuota) {
                    detailKuota.textContent = totalKuota ? totalKuota.toLocaleString('id-ID') + ' orang' : '-';
                }

                // 6. SISA KUOTA - Dari field sisa_kursi
                if (detailSisaKuota) {
                    detailSisaKuota.textContent = totalSisa ? totalSisa.toLocaleString('id-ID') + ' orang' : '-';
                }

                // 7. PROGRESS BAR & KUOTA TERISI
                if (progressText) {
                    const terisiText = totalTerisi ? totalTerisi.toLocaleString('id-ID') : '0';
                    const totalText = totalKuota ? totalKuota.toLocaleString('id-ID') : '0';
                    progressText.textContent = terisiText + '/' + totalText + ' orang';
                }
                
                if (progressBar) {
                    const percentage = totalKuota > 0 ? persentase : 0;
                    progressBar.style.width = percentage + '%';
                    progressBar.setAttribute('aria-valuenow', percentage);
                    progressBar.className = 'progress-bar';
                    
                    // Color coding based on occupancy
                    if (percentage < 50) {
                        progressBar.classList.add('bg-success');
                    } else if (percentage < 80) {
                        progressBar.classList.add('bg-warning');
                    } else {
                        progressBar.classList.add('bg-danger');
                    }
                }

                // Show the detail container
                const container = document.getElementById('periode-detail-container');
                if (container) {
                    container.style.display = 'block';
                }

                console.log('Detail updated for periode ' + periode);
            } else {
                console.log('No valid data found for periode:', periode);
                resetPeriodeDetail();
            }
        }
        
        function resetPeriodeDetail() {
            const elements = {
                'detail-periode': '-',
                'detail-status': '-',
                'detail-tanggal': '-',
                'detail-biaya': '-',
                'detail-kuota': '-',
                'detail-sisa-kuota': '-',
                'progress-text': '-/-'
            };
            
            Object.keys(elements).forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    if (id === 'detail-status') {
                        el.textContent = elements[id];
                        el.className = 'badge bg-secondary';
                    } else {
                        el.textContent = elements[id];
                    }
                }
            });
            
            // Reset progress bar
            const progressBar = document.getElementById('progress-bar');
            if (progressBar) {
                progressBar.style.width = '0%';
                progressBar.className = 'progress-bar bg-secondary';
            }
        }
        
        function formatDate(dateStr) {
            if (!dateStr) return '-';
            
            try {
                const date = new Date(dateStr);
                if (isNaN(date.getTime())) return '-';
                
                const months = [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];
                
                const day = date.getDate();
                const month = months[date.getMonth()];
                const year = date.getFullYear();
                
                return day + ' ' + month + ' ' + year;
            } catch (error) {
                console.error('Error formatting date:', dateStr, error);
                return '-';
            }
        }
        
        function setupEventListeners() {
            // Add event listener for dropdown change
            const gelombangSelect = document.getElementById('gelombang-select');
            if (gelombangSelect) {
                gelombangSelect.addEventListener('change', function() {
                    const selectedPeriode = this.value;
                    if (selectedPeriode && window.globalGelombangData) {
                        // Gunakan data yang sudah dimuat sebelumnya
                        showPeriodeDetail(selectedPeriode, window.globalGelombangData, false);
                        const btnLanjut = document.getElementById('btn-lanjut');
                        if (btnLanjut) btnLanjut.disabled = false;
                    } else {
                        resetPeriodeDetail();
                        const btnLanjut = document.getElementById('btn-lanjut');
                        if (btnLanjut) btnLanjut.disabled = true;
                    }
                });
            }
        }
        
        function updateUIForTanggalMode() {
            // Update heading
            const heading = document.getElementById('main-heading');
            if (heading) {
                heading.innerHTML = '<i class="fas fa-calendar-alt text-success me-2"></i>Tentukan Tanggal';
            }
            
            // Update description
            const description = document.getElementById('main-description');
            if (description) {
                description.textContent = 'Silakan pilih tanggal yang kamu minati untuk melanjutkan proses pendaftaran';
            }
            
            // Update dropdown label
            const label = document.getElementById('dropdown-label');
            if (label) {
                label.innerHTML = '<i class="fas fa-calendar-alt me-2"></i>Pilih Tanggal Pelaksanaan';
            }
            
            console.log('UI updated for tanggal mode');
        }
        
        function setupJQueryEvents() {
            // Handle lanjutkan pendaftaran
            $(document).ready(function() {
                $('#btn-lanjut').click(function() {
                    const selectedGelombang = $('#gelombang-select').val();
                    if (selectedGelombang) {
                        // Get the selected periode data
                        const selectedData = JSON.parse(localStorage.getItem('selectedPeriodeData') || '{}');
                        // Redirect to actual registration form
                        window.location.href = '<?= base_url("pendaftaran/form") ?>?gelombang=' + selectedGelombang + '&jadwal_id=' + selectedData.id;
                    }
                });
            });
        }
        
        function loadDiklatInfo() {
            // Get diklat info from URL parameter or default
            const urlParams = new URLSearchParams(window.location.search);
            const diklatId = urlParams.get('diklat_id') || '14-01807-46'; // Default DP-III NAUTIKA
            
            console.log('Loading diklat info for ID:', diklatId);
            
            const kategoriEl = document.getElementById('kategori-diklat');
            const namaEl = document.getElementById('nama-diklat');
            
            // Set loading state
            if (kategoriEl) kategoriEl.textContent = 'Mengambil data...';
            if (namaEl) namaEl.textContent = 'Mengambil data...';
            
            // Use simple fetch with vanilla JS
            fetch('<?= base_url("pendaftaran/get_diklat_info/") ?>' + diklatId)
                .then(response => {
                    console.log('Response received:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Data received:', data);
                    
                    if (data.success) {
                        if (kategoriEl) {
                            kategoriEl.textContent = data.jenis_diklat || 'SIPENCATAR DIKLAT PELAUT';
                        }
                        if (namaEl) {
                            namaEl.textContent = data.nama_diklat || 'DP-III NAUTIKA';
                        }
                        console.log('Successfully updated elements');
                    } else {
                        if (kategoriEl) kategoriEl.textContent = 'Data tidak tersedia';
                        if (namaEl) namaEl.textContent = 'Data tidak tersedia';
                        console.log('Data not found');
                    }
                })
                .catch(error => {
                    console.error('Error loading diklat info:', error);
                    if (kategoriEl) kategoriEl.textContent = 'Error loading data';
                    if (namaEl) namaEl.textContent = 'Error loading data';
                });
        }
        
        function formatDateShort(dateString) {
            if (!dateString) return '-';
            
            const date = new Date(dateString);
            const months = [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
            ];
            
            const day = date.getDate();
            const month = months[date.getMonth()];
            const year = date.getFullYear();
            
            return day + ' ' + month + ' ' + year;
        }
    </script>
</body>
</html>
