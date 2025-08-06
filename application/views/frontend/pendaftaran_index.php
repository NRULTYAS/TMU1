<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Diklat - Pilih Program</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        .hero-section { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .diklat-card { 
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            border-radius: 15px;
        }
        .diklat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .stats-card {
            background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
            border-radius: 15px;
        }
        .category-badge {
            border-radius: 20px;
        }
    </style>
</head>
<body>

<!-- Hero Section -->
<section class="hero-section py-5">
    <div class="container">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-3">🎓 Pendaftaran Diklat</h1>
            <p class="lead mb-4">Pilih program diklat yang sesuai dengan kebutuhan Anda</p>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="stats-card text-white p-4">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <h3 class="fw-bold"><?= count($diklat_list) ?></h3>
                                <p class="mb-0">Program Tersedia</p>
                            </div>
                            <div class="col-md-4">
                                <h3 class="fw-bold"><?= $total_jadwal ?></h3>
                                <p class="mb-0">Total Jadwal</p>
                            </div>
                            <div class="col-md-4">
                                <h3 class="fw-bold"><?= $diklat_aktif ?></h3>
                                <p class="mb-0">Program Aktif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari program diklat...">
                </div>
            </div>
            <div class="col-md-6">
                <select class="form-select" id="categoryFilter">
                    <option value="">Semua Kategori</option>
                    <option value="NAUTIKA">Nautika</option>
                    <option value="TEKNIKA">Teknika</option>
                    <option value="RATING">Rating</option>
                    <option value="ENDORSEMENT">Endorsement</option>
                    <option value="LAINNYA">Lainnya</option>
                </select>
            </div>
        </div>
    </div>
</section>

<!-- Diklat Cards Section -->
<section class="py-5">
    <div class="container">
        <div class="row" id="diklatContainer">
            
            <?php foreach ($diklat_list as $diklat): ?>
                <?php
                // Determine category from name
                $category = 'LAINNYA';
                $nama_upper = strtoupper($diklat['nama_diklat']);
                if (strpos($nama_upper, 'NAUTIKA') !== false || strpos($nama_upper, 'NAVIGASI') !== false) {
                    $category = 'NAUTIKA';
                } elseif (strpos($nama_upper, 'TEKNIK') !== false || strpos($nama_upper, 'ENGINE') !== false) {
                    $category = 'TEKNIKA';
                } elseif (strpos($nama_upper, 'RATING') !== false) {
                    $category = 'RATING';
                } elseif (strpos($nama_upper, 'ENDORSE') !== false || strpos($nama_upper, 'RENEWAL') !== false) {
                    $category = 'ENDORSEMENT';
                }
                
                $category_colors = [
                    'NAUTIKA' => 'bg-primary',
                    'TEKNIKA' => 'bg-success', 
                    'RATING' => 'bg-info',
                    'ENDORSEMENT' => 'bg-warning text-dark',
                    'LAINNYA' => 'bg-secondary'
                ];
                ?>
                
                <div class="col-lg-4 col-md-6 mb-4 diklat-item" data-category="<?= $category ?>" data-name="<?= strtolower($diklat['nama_diklat']) ?>">
                    <div class="card diklat-card h-100 shadow">
                        <div class="card-header bg-white border-bottom-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <span class="badge <?= $category_colors[$category] ?> category-badge"><?= $category ?></span>
                                <span class="badge <?= $diklat['is_exist'] ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= $diklat['is_exist'] ? '✅ Aktif' : '❌ Non-Aktif' ?>
                                </span>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title"><?= $diklat['nama_diklat'] ?></h5>
                            <p class="text-muted mb-2">
                                <i class="fas fa-code"></i> <strong>Kode:</strong> <?= $diklat['kode_diklat'] ?>
                            </p>
                            <p class="text-muted mb-3">
                                <i class="fas fa-id-card"></i> <strong>ID:</strong> <?= $diklat['id'] ?>
                            </p>
                            
                            <?php if (!empty($diklat['jenis_diklat'])): ?>
                                <p class="text-info mb-2">
                                    <i class="fas fa-tag"></i> <?= $diklat['jenis_diklat'] ?>
                                </p>
                            <?php endif; ?>
                            
                            <?php if ($diklat['check_kesehatan']): ?>
                                <p class="text-danger mb-2">
                                    <i class="fas fa-heartbeat"></i> <small>Memerlukan cek kesehatan</small>
                                </p>
                            <?php endif; ?>
                            
                            <div class="mt-3">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="border-end">
                                            <h6 class="text-primary mb-0"><?= $diklat['total_jadwal'] ?></h6>
                                            <small class="text-muted">Periode</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="text-success mb-0"><?= $diklat['jadwal_aktif'] ?></h6>
                                        <small class="text-muted">Aktif</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-transparent">
                            <div class="d-grid">
                                <?php if ($diklat['is_exist'] && $diklat['jadwal_aktif'] > 0): ?>
                                    <a href="<?= base_url('pendaftaran/' . $diklat['id']) ?>" class="btn btn-primary">
                                        <i class="fas fa-calendar-check"></i> Lihat Jadwal (<?= $diklat['jadwal_aktif'] ?>)
                                    </a>
                                <?php elseif (!$diklat['is_exist']): ?>
                                    <button class="btn btn-secondary" disabled>
                                        <i class="fas fa-times"></i> Program Non-Aktif
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-warning" disabled>
                                        <i class="fas fa-calendar-times"></i> Belum Ada Jadwal
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
        </div>
        
        <!-- No Results Message -->
        <div id="noResults" class="text-center mt-5" style="display: none;">
            <div class="alert alert-info">
                <i class="fas fa-search"></i>
                <h5>Tidak ditemukan</h5>
                <p>Tidak ada program diklat yang sesuai dengan kriteria pencarian Anda.</p>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Search and Filter functionality
const searchInput = document.getElementById('searchInput');
const categoryFilter = document.getElementById('categoryFilter');
const diklatItems = document.querySelectorAll('.diklat-item');
const noResults = document.getElementById('noResults');

function filterDiklat() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedCategory = categoryFilter.value;
    let visibleCount = 0;
    
    diklatItems.forEach(item => {
        const itemName = item.getAttribute('data-name');
        const itemCategory = item.getAttribute('data-category');
        
        const matchesSearch = itemName.includes(searchTerm);
        const matchesCategory = !selectedCategory || itemCategory === selectedCategory;
        
        if (matchesSearch && matchesCategory) {
            item.style.display = 'block';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });
    
    // Show/hide no results message
    noResults.style.display = visibleCount === 0 ? 'block' : 'none';
}

// Event listeners
searchInput.addEventListener('input', filterDiklat);
categoryFilter.addEventListener('change', filterDiklat);

// Add loading state to cards when clicked
diklatItems.forEach(item => {
    const link = item.querySelector('a.btn-primary');
    if (link) {
        link.addEventListener('click', function() {
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        });
    }
});

console.log('🎓 Diklat selection page loaded');
console.log('📊 Total programs:', <?= count($diklat_list) ?>);
</script>

</body>
</html>
