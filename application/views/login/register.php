<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Portal Diklat</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding: 20px 0;">
    <div class="card shadow-sm p-4" style="width: 500px;">
        <h4 class="text-center mb-4 text-primary">
            <i class="fas fa-user-plus me-2"></i>Daftar Akun Baru
        </h4>

        <!-- Pesan error dari session flash -->
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>
        
        <?php if (validation_errors()): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?= validation_errors() ?>
            </div>
        <?php endif; ?>

        <!-- FORM REGISTRASI -->
        <form action="<?= base_url('login/proses_register') ?>" method="post">
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="nama_lengkap" 
                    name="nama_lengkap" 
                    placeholder="Masukkan nama lengkap" 
                    value="<?= set_value('nama_lengkap') ?>" 
                    required
                >
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="nip" 
                        name="nip" 
                        placeholder="Masukkan NIP" 
                        value="<?= set_value('nip') ?>" 
                        required
                    >
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="username" 
                        name="username" 
                        placeholder="Masukkan username" 
                        value="<?= set_value('username') ?>" 
                        required
                    >
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="password" 
                        name="password" 
                        placeholder="Masukkan password" 
                        required
                    >
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="confirm_password" 
                        name="confirm_password" 
                        placeholder="Konfirmasi password" 
                        required
                    >
                </div>
            </div>
            
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-user-plus me-2"></i>Daftar
                </button>
            </div>
        </form>
        
        <hr class="my-4">
        
        <div class="text-center">
            <p class="mb-2">Sudah punya akun?</p>
            <a href="<?= base_url('login') ?>" class="btn btn-outline-primary">
                <i class="fas fa-sign-in-alt me-2"></i>Login di Sini
            </a>
        </div>
        
        <div class="text-center mt-3">
            <a href="<?= base_url() ?>" class="btn btn-link text-muted">
                <i class="fas fa-home me-1"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Password match validation
    document.getElementById('confirm_password').addEventListener('input', function() {
        const password = document.getElementById('password').value;
        const confirmPassword = this.value;
        
        if (password !== confirmPassword) {
            this.setCustomValidity('Password tidak sama');
        } else {
            this.setCustomValidity('');
        }
    });
</script>
</body>
</html>
