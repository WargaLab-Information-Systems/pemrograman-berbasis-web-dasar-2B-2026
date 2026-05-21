<?php 
include 'auth_check.php'; 
include 'config.php';
$pageTitle = "Dashboard Laundry";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> — EasyWash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-dark: #1A1207;
            --accent-amber: #C8871A;
            --bg-cream: #F8F4EE;
            --white: #ffffff;
        }
        body {
            background-color: var(--bg-cream);
            font-family: 'DM Sans', sans-serif;
            color: var(--primary-dark);
        }

        .navbar-custom {
            background: var(--primary-dark);
            border-bottom: 3px solid var(--accent-amber);
            padding: 1rem 0;
        }
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--accent-amber) !important;
        }
        .main-card {
            background: var(--white);
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            padding: 2rem;
            margin-top: -40px; 
        }
        .header-section {
            background: var(--primary-dark);
            color: var(--white);
            padding: 4rem 0 5rem;
        }
        .table-custom thead {
            background: var(--primary-dark);
            color: var(--white);
        }
        .table-custom th {
            font-weight: 500;
            padding: 1rem;
            border: none;
        }
        .table-custom td {
            padding: 1rem;
            vertical-align: middle;
        }
        .badge-status {
            font-size: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
        }
        .btn-action {
            border-radius: 8px;
            transition: all 0.2s;
        }
        .btn-action:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="#">Easy<span>Wash</span></a>
        <div class="ms-auto d-flex align-items-center">
            <div class="text-white me-3 d-none d-md-block">
                <small class="text-muted">Logged in as:</small> 
                <span class="fw-bold"><?= htmlspecialchars($_SESSION['username']); ?></span>
                <span class="badge bg-warning text-dark ms-1" style="font-size: 0.6rem;"><?= strtoupper($_SESSION['role']); ?></span>
            </div>
            <a href="logout.php" class="btn btn-outline-light btn-sm btn-action">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </a>
        </div>
    </div>
</nav>

<div class="header-section">
    <div class="container">
        <h2 class="fw-bold"><i class="bi bi-water me-2"></i>Data Pesanan Laundry</h2>
        <p class="text-muted-light">Kelola transaksi pelanggan dengan efisien dan cepat.</p>
    </div>
</div>

<div class="container">
    <div class="main-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-bold text-uppercase tracking-wider">Daftar Transaksi</h5>
            <?php if($_SESSION['role'] == 'admin'): ?>
                <a href="tambah.php" class="btn btn-success btn-action px-4">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Pesanan
                </a>
            <?php endif; ?>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-custom">
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>Layanan</th>
                        <th>Berat</th>
                        <th>Estimasi Selesai</th>
                        <th>Status</th>
                        <?php if($_SESSION['role'] == 'admin'): ?><th class="text-center">Aksi</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM pesanan");
                    while($row = mysqli_fetch_assoc($res)):
                    ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($row['nama_pelanggan']); ?></td>
                        <td><i class="bi bi-tag-fill me-1 text-muted"></i><?= htmlspecialchars($row['jenis_layanan']); ?></td>
                        <td><?= $row['berat_kg']; ?> <small class="text-muted">Kg</small></td>
                        <td><i class="bi bi-calendar3 me-1 text-muted"></i><?= date('d M Y', strtotime($row['tgl_selesai'])); ?></td>
                        <td>
                            <?php if($row['status_bayar']): ?>
                                <span class="badge badge-status bg-success-subtle text-success border border-success">Lunas</span>
                            <?php else: ?>
                                <span class="badge badge-status bg-danger-subtle text-danger border border-danger">Belum Lunas</span>
                            <?php endif; ?>
                        </td>
                        <?php if($_SESSION['role'] == 'admin'): ?>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-warning btn-action">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger btn-action" onclick="return confirm('Hapus pesanan ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer class="mt-5 py-4 text-center text-muted">
    <small>&copy; 2026 <strong>EasyWash</strong>. modul 6 Sistem Informasi.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>