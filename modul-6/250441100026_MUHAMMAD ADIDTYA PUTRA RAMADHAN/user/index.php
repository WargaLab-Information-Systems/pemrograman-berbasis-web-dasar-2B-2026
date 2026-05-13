<?php
// user/index.php
require_once '../includes/koneksi.php';
require_once '../includes/auth.php';


requireLogin(); // Semua yang sudah login boleh akses

// Pencarian
$search = trim($_GET['search'] ?? '');
$genre  = trim($_GET['genre'] ?? '');

$sql = "SELECT * FROM buku WHERE 1=1";
$params = [];
$types  = '';

if ($search !== '') {
    $sql     .= " AND (judul LIKE ? OR pengarang LIKE ?)";
    $like     = "%$search%";
    $params[] = $like;
    $params[] = $like;
    $types   .= 'ss';
}

if ($genre !== '') {
    $sql     .= " AND genre = ?";
    $params[] = $genre;
    $types   .= 's';
}

$sql .= " ORDER BY judul ASC";

$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$buku_list = $stmt->get_result();

// Ambil semua genre untuk filter
$genres_result = $conn->query("SELECT DISTINCT genre FROM buku ORDER BY genre");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku - Perpustakaan Mini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="bi bi-book-half me-2"></i>Perpustakaan Mini
        </a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <span class="text-white-50 small">
                <i class="bi bi-person-circle me-1"></i>
                <?= htmlspecialchars($_SESSION['user_nama']) ?>
                <span class="badge bg-primary ms-1">User</span>
            </span>
            <a href="../logout.php" class="btn btn-outline-light btn-sm">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </a>
        </div>
    </div>
</nav>

<div class="d-flex">
    <nav class="sidebar">
        <ul class="nav flex-column">
            <li><a href="index.php" class="nav-link active"><i class="bi bi-journals"></i>Katalog Buku</a></li>
            <hr class="mx-3">
            <li><a href="../logout.php" class="nav-link text-danger"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">Katalog Buku</h4>
                <small class="text-muted">Temukan buku yang kamu suka</small>
            </div>
        </div>

        <!-- Form Pencarian -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="" class="row g-2" id="filterForm">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control"
                                   placeholder="Cari judul atau pengarang..."
                                   value="<?= htmlspecialchars($search) ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="genre" class="form-select">
                            <option value="">Semua Genre</option>
                            <?php
                            $genres_result->data_seek(0);
                            while ($g = $genres_result->fetch_assoc()):
                                $sel = $genre === $g['genre'] ? 'selected' : '';
                            ?>
                                <option value="<?= htmlspecialchars($g['genre']) ?>" <?= $sel ?>>
                                    <?= htmlspecialchars($g['genre']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="bi bi-search me-1"></i>Cari
                        </button>
                        <a href="index.php" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Daftar Buku -->
        <div class="row g-3">
            <?php if ($buku_list->num_rows === 0): ?>
                <div class="col-12">
                    <div class="card text-center py-5">
                        <div class="card-body">
                            <i class="bi bi-search fs-1 text-muted mb-3 d-block"></i>
                            <h5 class="text-muted">Buku tidak ditemukan</h5>
                            <p class="text-muted small">Coba kata kunci atau genre yang berbeda</p>
                            <a href="index.php" class="btn btn-primary btn-sm">Lihat Semua Buku</a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php while ($buku = $buku_list->fetch_assoc()): ?>
                <div class="col-md-4 col-sm-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge-genre"><?= htmlspecialchars($buku['genre']) ?></span>
                                <?php if ($buku['stok'] == 0): ?>
                                    <span class="badge bg-danger">Habis</span>
                                <?php elseif ($buku['stok'] <= 2): ?>
                                    <span class="badge bg-warning text-dark">Stok <?= $buku['stok'] ?></span>
                                <?php else: ?>
                                    <span class="badge bg-success">Tersedia</span>
                                <?php endif; ?>
                            </div>
                            <h6 class="card-title fw-bold mt-2 mb-1">
                                <?= htmlspecialchars($buku['judul']) ?>
                            </h6>
                            <p class="text-muted small mb-1">
                                <i class="bi bi-person me-1"></i><?= htmlspecialchars($buku['pengarang']) ?>
                            </p>
                            <p class="text-muted small mb-2">
                                <i class="bi bi-calendar me-1"></i><?= htmlspecialchars($buku['tahun_terbit']) ?>
                            </p>
                            <?php if ($buku['deskripsi']): ?>
                                <p class="small text-muted" style="
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                ">
                                    <?= htmlspecialchars($buku['deskripsi']) ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer bg-transparent border-0 pt-0">
                            <small class="text-muted">
                                <i class="bi bi-archive me-1"></i>Stok: <?= $buku['stok'] ?> eksemplar
                            </small>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>