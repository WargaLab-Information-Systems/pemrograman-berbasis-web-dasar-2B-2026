<?php
// admin/index.php
require_once '../includes/koneksi.php';
require_once '../includes/auth.php';

requireAdmin(); 

$total_buku  = $conn->query("SELECT COUNT(*) as total FROM buku")->fetch_assoc()['total'];
$total_user  = $conn->query("SELECT COUNT(*) as total FROM users WHERE role = 'user'")->fetch_assoc()['total'];
$stok_habis  = $conn->query("SELECT COUNT(*) as total FROM buku WHERE stok = 0")->fetch_assoc()['total'];

$buku_list = $conn->query("SELECT * FROM buku ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Perpustakaan Mini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        /* CSS Tambahan untuk memastikan layout penuh */
        body {
            overflow-x: hidden;
        }
        .main-content {
            flex: 1; /* Membuat konten utama mengambil sisa ruang kosong di kanan */
            min-height: 100vh;
            background-color: #f8f9fa;
            padding: 25px;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
        }
        .table-responsive {
            background: white;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
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
    <nav class="sidebar bg-light border-end">
        <ul class="nav flex-column py-3">
            <li class="nav-item">
                <a href="index.php" class="nav-link active">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="buku_tambah.php" class="nav-link text-dark">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Buku
                </a>
            </li>
            <li class="nav-item">
                <a href="users.php" class="nav-link text-dark">
                    <i class="bi bi-people me-2"></i>Kelola User
                </a>
            </li>
            <hr class="mx-3">
            <li class="nav-item">
                <a href="../logout.php" class="nav-link text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </a>
            </li>
        </ul>
    </nav>

    <main class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-0 fw-bold">Dashboard Admin</h4>
                    <small class="text-muted">Selamat datang, <?= htmlspecialchars($_SESSION['user_nama']) ?>!</small>
                </div>
                <a href="buku_tambah.php" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Buku
                </a>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-journals fs-4 text-primary"></i>
                            </div>
                            <div>
                                <div class="h3 fw-bold mb-0 text-primary"><?= $total_buku ?></div>
                                <div class="text-muted small">Total Buku</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-3" style="border-left: 4px solid #198754 !important">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-people fs-4 text-success"></i>
                            </div>
                            <div>
                                <div class="h3 fw-bold mb-0 text-success"><?= $total_user ?></div>
                                <div class="text-muted small">Anggota</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-3" style="border-left: 4px solid #dc3545 !important">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-exclamation-triangle fs-4 text-danger"></i>
                            </div>
                            <div>
                                <div class="h3 fw-bold mb-0 text-danger"><?= $stok_habis ?></div>
                                <div class="text-muted small">Stok Habis</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">
                        <i class="bi bi-list-ul me-2"></i>Daftar Buku
                    </h5>

                    <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle me-2"></i>
                            <?= htmlspecialchars($_GET['success']) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">#</th>
                                    <th>Judul</th>
                                    <th>Pengarang</th>
                                    <th>Tahun</th>
                                    <th>Genre</th>
                                    <th>Stok</th>
                                    <th width="150" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; while ($row = $buku_list->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td class="fw-bold"><?= htmlspecialchars($row['judul']) ?></td>
                                    <td><?= htmlspecialchars($row['pengarang']) ?></td>
                                    <td><?= htmlspecialchars($row['tahun_terbit']) ?></td>
                                    <td>
                                        <span class="badge bg-secondary opacity-75"><?= htmlspecialchars($row['genre']) ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        $stok = $row['stok'];
                                        if ($stok == 0) {
                                            echo '<span class="badge bg-danger">Habis</span>';
                                        } elseif ($stok <= 2) {
                                            echo '<span class="badge bg-warning text-dark">' . $stok . '</span>';
                                        } else {
                                            echo '<span class="badge bg-info text-dark">' . $stok . '</span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group gap-1">
                                            <a href="buku_detail.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info text-white" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="buku_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="buku_hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus buku ini?')" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>