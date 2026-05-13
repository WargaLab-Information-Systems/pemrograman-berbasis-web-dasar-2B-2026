<?php
// register.php
require_once 'includes/koneksi.php';
require_once 'includes/auth.php';


if (isLoggedIn()) {
    header("Location: " . (isAdmin() ? "admin/index.php" : "user/index.php"));
    exit();
}

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = trim($_POST['nama'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $konfirm  = $_POST['konfirmasi'] ?? '';

    // Validasi
    if (empty($nama) || empty($email) || empty($password)) {
        $error = 'Semua field wajib diisi!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    // } elseif (strlen($password) < 6) {
    //     $error = 'Password minimal 6 karakter!';
    // } elseif ($password !== $konfirm) {
    //     $error = 'Konfirmasi password tidak cocok!';
    // } else {
        // Cek email sudah terdaftar
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = 'Email sudah terdaftar!';
        } else {
            $stmt->close();
            // Hash password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // Insert user baru (role default: user)
            $stmt2 = $conn->prepare("INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, 'user')");
            $stmt2->bind_param("sss", $nama, $email, $hash);

            if ($stmt2->execute()) {
                $success = 'Registrasi berhasil! Silakan login.';
            } else {
                $error = 'Terjadi kesalahan, coba lagi.';
            }
            $stmt2->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Perpustakaan Mini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-card card">
        <div class="card-header">
            <div class="icon-wrapper">
                <i class="bi bi-person-plus"></i>
            </div>
            <h4>Daftar Akun</h4>
            <small class="opacity-75">Buat akun baru sebagai anggota</small>
        </div>
        <div class="card-body p-4">
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle me-2"></i><?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <i class="bi bi-check-circle me-2"></i><?= htmlspecialchars($success) ?>
                    <a href="login.php" class="alert-link">Login sekarang</a>
                </div>
            <?php endif; ?>

            <form method="POST" action="" id="registerForm" novalidate>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" name="nama" class="form-control"
                               placeholder="Nama lengkap Anda"
                               value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control"
                               placeholder="contoh@email.com"
                               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control"
                               placeholder="Minimal 6 karakter" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="konfirmasi" class="form-control"
                               placeholder="Ulangi password" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                    <i class="bi bi-person-check me-2"></i>Daftar Sekarang
                </button>
            </form>

            <hr class="my-3">
            <p class="text-center text-muted mb-0 small">
                Sudah punya akun?
                <a href="login.php" class="text-decoration-none fw-semibold">Login di sini</a>
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const nama     = this.nama.value.trim();
    const email    = this.email.value.trim();
    const password = this.password.value;
    const konfirm  = this.konfirmasi.value;

    if (!nama || !email || !password || !konfirm) {
        e.preventDefault();
        alert('Semua field harus diisi!');
        return;
    }
    if (password.length < 6) {
        e.preventDefault();
        alert('Password minimal 6 karakter!');
        return;
    }
    if (password !== konfirm) {
        e.preventDefault();
        alert('Konfirmasi password tidak cocok!');
    }
});
</script>
</body>
</html>