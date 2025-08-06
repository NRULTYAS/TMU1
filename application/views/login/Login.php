<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Portal Diklat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-sm p-4" style="width: 400px;">
        <h4 class="text-center mb-4 text-primary">Login Portal Diklat</h4>

        <!-- Pesan error dari session flash -->
        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- FORM LOGIN -->
        <form method="post" action="<?= site_url('login/proses') ?>" autocomplete="on">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-control"
                    placeholder="Masukkan Username"
                    required
                    autocomplete="username"
                >
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan Password"
                    required
                    autocomplete="current-password"
                >
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Masuk</button>
            </div>
        </form>
        
        <hr class="my-4">
        
        <div class="text-center">
            <p class="mb-2">Belum punya akun?</p>
            <a href="<?= base_url('daftar') ?>" class="btn btn-outline-primary">
                <i class="fas fa-user-plus me-2"></i>Daftar Akun Baru
            </a>
        </div>
        
        <div class="text-center mt-3">
            <a href="<?= base_url() ?>" class="btn btn-link text-muted">
                <i class="fas fa-home me-1"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

</body>
</html>
