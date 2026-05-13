<?php
// admin/buku_tambah.php
require_once '../includes/koneksi.php';
require_once '../includes/auth.php';

requireAdmin();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul        = trim($_POST['judul'] ?? '');
    $pengarang    = trim($_POST['pengarang'] ?? '');
    $tahun_terbit = trim($_POST['tahun_terbit'] ?? '');
    $genre        = trim($_POST['genre'] ?? '');
    $stok         = (int)($_POST['stok'] ?? 0);
    $deskripsi    = trim($_POST['deskripsi'] ?? '');

    if (empty($judul) || empty($pengarang) || empty($tahun_terbit) || empty($genre)) {
        $error = 'Field judul, pengarang, tahun, dan genre wajib diisi!';
    } elseif ($stok < 0) {
        $error = 'Stok tidak boleh negatif!';
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO buku (judul, pengarang, tahun_terbit, genre, stok, deskripsi) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssssis", $judul, $pengarang, $tahun_terbit, $genre, $stok, $deskripsi);

        if ($stmt->execute()) {
            header("Location: index.php?success=Buku berhasil ditambahkan!");
            exit();
        } else {
            $error = 'Gagal menambahkan buku!';
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-book-half me-2"></i>Perpustakaan Mini
        </a>
        <div class="ms-auto">
            <a href="../logout.php" class="btn btn-outline-light btn-sm">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </a>
        </div>
    </div>
</nav>

<div class="d-flex">
    <nav class="sidebar">
        <ul class="nav flex-column">
            <li><a href="index.php" class="nav-link"><i class="bi bi-speedometer2"></i>Dashboard</a></li>
            <li><a href="buku_tambah.php" class="nav-link active"><i class="bi bi-plus-circle"></i>Tambah Buku</a></li>
            <li><a href="users.php" class="nav-link"><i class="bi bi-people"></i>Kelola User</a></li>
            <hr class="mx-3">
            <li><a href="../logout.php" class="nav-link text-danger"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <div class="mb-4">
            <a href="index.php" class="btn btn-outline-secondary btn-sm mb-3">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
            <h4 class="fw-bold">Tambah Buku Baru</h4>
        </div>

        <div class="card" style="max-width: 700px">
            <div class="card-body p-4">
                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle me-2"></i><?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" id="formTambah" novalidate>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control"
                               value="<?= htmlspecialchars($_POST['judul'] ?? '') ?>"
                               placeholder="Masukkan judul buku" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Pengarang <span class="text-danger">*</span></label>
                            <input type="text" name="pengarang" class="form-control"
                                   value="<?= htmlspecialchars($_POST['pengarang'] ?? '') ?>"
                                   placeholder="Nama pengarang" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Tahun Terbit <span class="text-danger">*</span></label>
                            <input type="number" name="tahun_terbit" class="form-control"
                                   value="<?= htmlspecialchars($_POST['tahun_terbit'] ?? date('Y')) ?>"
                                   min="1900" max="<?= date('Y') ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Stok</label>
                            <input type="number" name="stok" class="form-control"
                                   value="<?= htmlspecialchars($_POST['stok'] ?? 0) ?>"
                                   min="0" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Genre <span class="text-danger">*</span></label>
                        <select name="genre" class="form-select" required>
                            <option value="">-- Pilih Genre --</option>
                            <?php
                            $genres = ['Novel','Sejarah','Pengembangan Diri','Fantasi','Sains','Teknologi','Biografi','Anak-anak','Komik','Lainnya'];
                            $selectedGenre = $_POST['genre'] ?? '';
                            foreach ($genres as $g) {
                                $sel = $selectedGenre === $g ? 'selected' : '';
                                echo "<option value=\"$g\" $sel>$g</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"
                                  placeholder="Deskripsi singkat buku (opsional)"><?= htmlspecialchars($_POST['deskripsi'] ?? '') ?></textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i>Simpan Buku
                        </button>
                        <a href="index.php" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('formTambah').addEventListener('submit', function(e) {
    const judul     = this.judul.value.trim();
    const pengarang = this.pengarang.value.trim();
    const tahun     = this.tahun_terbit.value;
    const genre     = this.genre.value;

    if (!judul || !pengarang || !tahun || !genre) {
        e.preventDefault();
        alert('Field dengan tanda * wajib diisi!');
    }
});
</script>
</body>
</html>