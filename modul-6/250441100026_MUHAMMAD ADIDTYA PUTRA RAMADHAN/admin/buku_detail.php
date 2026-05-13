<?php
// admin/buku_detail.php
require_once '../includes/koneksi.php';
require_once '../includes/auth.php';

requireAdmin();

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header("Location: index.php");
    exit();
}

// Ambil data buku
$stmt = $conn->prepare("SELECT * FROM buku WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$buku   = $result->fetch_assoc();
$stmt->close();

if (!$buku) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku - Admin</title>
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
        <div class="ms-auto d-flex align-items-center gap-3">
            <span class="text-white-50 small">
                <i class="bi bi-person-circle me-1"></i>
                <?= htmlspecialchars($_SESSION['user_nama']) ?>
                <span class="badge bg-warning text-dark ms-1">Admin</span>
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
            <li><a href="index.php" class="nav-link active"><i class="bi bi-speedometer2"></i>Dashboard</a></li>
            <li><a href="buku_tambah.php" class="nav-link"><i class="bi bi-plus-circle"></i>Tambah Buku</a></li>
            <li><a href="users.php" class="nav-link"><i class="bi bi-people"></i>Kelola User</a></li>
            <hr class="mx-3">
            <li><a href="../logout.php" class="nav-link text-danger"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Detail Buku</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0"><i class="bi bi-book me-2"></i>Detail Buku</h4>
            <div class="d-flex gap-2">
                <a href="buku_edit.php?id=<?= $buku['id'] ?>" class="btn btn-warning text-white">
                    <i class="bi bi-pencil me-1"></i>Edit
                </a>
                <a href="buku_hapus.php?id=<?= $buku['id'] ?>"
                   class="btn btn-danger"
                   onclick="return confirm('Yakin hapus buku ini?')">
                    <i class="bi bi-trash me-1"></i>Hapus
                </a>
                <a href="index.php" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </div>

        <div class="row g-4">
            <!-- Card Detail Buku -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start gap-3 mb-4">
                            <!-- Ikon buku placeholder -->
                            <div style="
                                width: 80px; height: 100px;
                                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                                border-radius: 8px;
                                display: flex; align-items: center; justify-content: center;
                                flex-shrink: 0;
                                box-shadow: 3px 3px 10px rgba(0,0,0,0.2);
                            ">
                                <i class="bi bi-book text-white fs-2"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1"><?= htmlspecialchars($buku['judul']) ?></h4>
                                <p class="text-muted mb-1">
                                    <i class="bi bi-person me-1"></i><?= htmlspecialchars($buku['pengarang']) ?>
                                </p>
                                <span class="badge-genre"><?= htmlspecialchars($buku['genre']) ?></span>
                            </div>
                        </div>

                        <hr>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-primary bg-opacity-10 rounded p-2">
                                        <i class="bi bi-calendar text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="small text-muted">Tahun Terbit</div>
                                        <div class="fw-semibold"><?= htmlspecialchars($buku['tahun_terbit']) ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-success bg-opacity-10 rounded p-2">
                                        <i class="bi bi-archive text-success"></i>
                                    </div>
                                    <div>
                                        <div class="small text-muted">Stok</div>
                                        <div class="fw-semibold">
                                            <?php
                                            $stok = $buku['stok'];
                                            if ($stok == 0) {
                                                echo '<span class="text-danger">Habis (0 eksemplar)</span>';
                                            } elseif ($stok <= 2) {
                                                echo '<span class="text-warning">' . $stok . ' eksemplar (sedikit)</span>';
                                            } else {
                                                echo '<span class="text-success">' . $stok . ' eksemplar</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-info bg-opacity-10 rounded p-2">
                                        <i class="bi bi-tag text-info"></i>
                                    </div>
                                    <div>
                                        <div class="small text-muted">Genre</div>
                                        <div class="fw-semibold"><?= htmlspecialchars($buku['genre']) ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-warning bg-opacity-10 rounded p-2">
                                        <i class="bi bi-hash text-warning"></i>
                                    </div>
                                    <div>
                                        <div class="small text-muted">ID Buku</div>
                                        <div class="fw-semibold">#<?= $buku['id'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($buku['deskripsi'])): ?>
                        <hr>
                        <div>
                            <h6 class="fw-bold mb-2"><i class="bi bi-card-text me-2"></i>Deskripsi</h6>
                            <p class="text-muted mb-0" style="line-height: 1.7">
                                <?= nl2br(htmlspecialchars($buku['deskripsi'])) ?>
                            </p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Card Info Tambahan -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3"><i class="bi bi-clock-history me-2"></i>Info Waktu</h6>
                        <div class="mb-2">
                            <div class="small text-muted">Ditambahkan</div>
                            <div class="fw-semibold small">
                                <?= date('d M Y, H:i', strtotime($buku['created_at'])) ?>
                            </div>
                        </div>
                        <div>
                            <div class="small text-muted">Terakhir Diupdate</div>
                            <div class="fw-semibold small">
                                <?= date('d M Y, H:i', strtotime($buku['updated_at'])) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Stok -->
                <div class="card">
                    <div class="card-body text-center">
                        <?php if ($buku['stok'] == 0): ?>
                            <div class="text-danger mb-2"><i class="bi bi-x-circle fs-1"></i></div>
                            <h6 class="text-danger fw-bold">Stok Habis</h6>
                            <p class="small text-muted mb-0">Buku tidak tersedia untuk dipinjam</p>
                        <?php elseif ($buku['stok'] <= 2): ?>
                            <div class="text-warning mb-2"><i class="bi bi-exclamation-circle fs-1"></i></div>
                            <h6 class="text-warning fw-bold">Stok Terbatas</h6>
                            <p class="small text-muted mb-0">Hanya tersisa <?= $buku['stok'] ?> eksemplar</p>
                        <?php else: ?>
                            <div class="text-success mb-2"><i class="bi bi-check-circle fs-1"></i></div>
                            <h6 class="text-success fw-bold">Tersedia</h6>
                            <p class="small text-muted mb-0"><?= $buku['stok'] ?> eksemplar siap dipinjam</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>