<?php
// admin/users.php
require_once '../includes/koneksi.php';
require_once '../includes/auth.php';

session_start();
requireAdmin();

// Ambil semua user
$users = $conn->query("SELECT id, nama, email, role, created_at FROM users ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - Admin</title>
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
            <a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="d-flex">
    <nav class="sidebar">
        <ul class="nav flex-column">
            <li><a href="index.php" class="nav-link"><i class="bi bi-speedometer2"></i>Dashboard</a></li>
            <li><a href="buku_tambah.php" class="nav-link"><i class="bi bi-plus-circle"></i>Tambah Buku</a></li>
            <li><a href="users.php" class="nav-link active"><i class="bi bi-people"></i>Kelola User</a></li>
            <hr class="mx-3">
            <li><a href="../logout.php" class="nav-link text-danger"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <h4 class="fw-bold mb-4"><i class="bi bi-people me-2"></i>Kelola User</h4>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Bergabung</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; while ($row = $users->fetch_assoc()): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td>
                                    <?php if ($row['role'] === 'admin'): ?>
                                        <span class="badge bg-warning text-dark">Admin</span>
                                    <?php else: ?>
                                        <span class="badge bg-primary">User</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>