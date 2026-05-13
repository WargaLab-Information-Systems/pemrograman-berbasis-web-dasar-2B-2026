<?php
// films/index.php
require_once '../config.php';
require_once '../auth_check.php';

// Ambil semua film, urutkan dari terbaru
$films = $conn->query(
  'SELECT * FROM films ORDER BY created_at DESC'
);
?>

<!DOCTYPE html>
<html lang='id'>
<head>
  <meta charset='UTF-8'>
  <title>Daftar Film - FilmKu</title>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
</head>
<body>
<div class='container mt-4'>
  <div class='d-flex justify-content-between align-items-center mb-3'>
    <h3>🎬 Koleksi Film</h3>
    <?php if ($_SESSION['role'] === 'admin'): ?>
      <a href='create.php' class='btn btn-success'>+ Tambah Film</a>
    <?php endif; ?>
  </div>

  <table class='table table-striped table-bordered'>
    <thead class='table-dark'>
      <tr>
        <th>#</th><th>Judul</th><th>Genre</th>
        <th>Tahun</th><th>Rating</th><th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while ($film = $films->fetch_assoc()): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($film['judul']) ?></td>
          <td><?= htmlspecialchars($film['genre']) ?></td>
          <td><?= htmlspecialchars($film['tahun']) ?></td>
          <td><?= htmlspecialchars($film['rating']) ?></td>
          <td>
            <a href='detail.php?id=<?= $film['id'] ?>' class='btn btn-info btn-sm'>Detail</a>
            <?php if ($_SESSION['role'] === 'admin'): ?>
              <a href='edit.php?id=<?= $film['id'] ?>' class='btn btn-warning btn-sm'>Edit</a>
              <a href='delete.php?id=<?= $film['id'] ?>'
                 onclick="return confirm('Hapus film ini?')"
                 class='btn btn-danger btn-sm'>Hapus</a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <a href='../dashboard.php' class='btn btn-secondary'>Kembali</a>
</div>
</body>
</html>