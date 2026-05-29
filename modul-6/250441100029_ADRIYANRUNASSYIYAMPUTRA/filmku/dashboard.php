<?php
// dashboard.php
require_once 'config.php';
require_once 'auth_check.php'; // <-- Wajib ada di baris ini!

// Ambil total film di database
$result = $conn->query('SELECT COUNT(*) as total FROM films');
$row    = $result->fetch_assoc();
$total_films = $row['total'];

// Ambil 5 film terbaru
$films = $conn->query(
  'SELECT * FROM films ORDER BY created_at DESC LIMIT 5'
);
?>

<!DOCTYPE html>
<html lang='id'>
<head>
  <meta charset='UTF-8'>
  <title>Dashboard - FilmKu</title>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
</head>
<body>

<!-- Navbar -->
<nav class='navbar navbar-expand-lg navbar-dark bg-primary'>
  <div class='container'>
    <a class='navbar-brand' href='dashboard.php'>🎬 FilmKu</a>
    <div class='ms-auto d-flex align-items-center gap-3'>
      <span class='text-white'>
        Halo, <?= htmlspecialchars($_SESSION['username']) ?>
        (<?= htmlspecialchars($_SESSION['role']) ?>)
      </span>
      <a href='auth/logout.php' class='btn btn-outline-light btn-sm'>Logout</a>
    </div>
  </div>
</nav>

<div class='container mt-4'>
  <!-- Kartu Statistik -->
  <div class='row mb-4'>
    <div class='col-md-4'>
      <div class='card text-white bg-primary'>
        <div class='card-body'>
          <h5>Total Film</h5>
          <h2><?= $total_films ?></h2>
        </div>
      </div>
    </div>
  </div>

  <!-- Tombol hanya muncul untuk admin -->
  <?php if ($_SESSION['role'] === 'admin'): ?>
    <a href='films/create.php' class='btn btn-success mb-3'>+ Tambah Film Baru</a>
  <?php endif; ?>

  <a href='films/index.php' class='btn btn-primary mb-3'>Lihat Semua Film</a>

  <!-- Tabel film terbaru -->
  <h5>5 Film Terbaru</h5>
  <table class='table table-striped table-hover'>
    <thead class='table-dark'>
      <tr><th>Judul</th><th>Genre</th><th>Tahun</th><th>Rating</th></tr>
    </thead>
    <tbody>
      <?php while ($film = $films->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($film['judul']) ?></td>
          <td><?= htmlspecialchars($film['genre']) ?></td>
          <td><?= htmlspecialchars($film['tahun']) ?></td>
          <td><?= htmlspecialchars($film['rating']) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body></html>
