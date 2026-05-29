<?php
// films/detail.php
require_once '../config.php';
require_once '../auth_check.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
  header('Location: index.php');
  exit();
}

// Ambil data film berdasarkan ID
$stmt = $conn->prepare('SELECT * FROM films WHERE id=?');
$stmt->bind_param('i', $id);
$stmt->execute();
$film = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$film) {
  header('Location: index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang='id'>
<head>
  <meta charset='UTF-8'>
  <title><?= htmlspecialchars($film['judul']) ?> - FilmKu</title>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
</head>
<body>

<!-- Navbar -->
<nav class='navbar navbar-expand-lg navbar-dark bg-primary'>
  <div class='container'>
    <a class='navbar-brand' href='/filmku/dashboard.php'>🎬 FilmKu</a>
    <div class='ms-auto d-flex align-items-center gap-3'>
      <span class='text-white'>
        Halo, <?= htmlspecialchars($_SESSION['username']) ?>
        (<?= htmlspecialchars($_SESSION['role']) ?>)
      </span>
      <a href='/filmku/auth/logout.php' class='btn btn-outline-light btn-sm'>Logout</a>
    </div>
  </div>
</nav>

<div class='container mt-4'>
  <div class='row justify-content-center'>
    <div class='col-md-8'>
      <div class='card shadow'>

        <div class='card-header bg-primary text-white'>
          <h4 class='mb-0'>🎬 <?= htmlspecialchars($film['judul']) ?></h4>
        </div>

        <div class='card-body'>
          <table class='table table-bordered'>
            <tr>
              <th width='150'>Genre</th>
              <td><?= htmlspecialchars($film['genre']) ?></td>
            </tr>
            <tr>
              <th>Tahun</th>
              <td><?= htmlspecialchars($film['tahun']) ?></td>
            </tr>
            <tr>
              <th>Durasi</th>
              <td><?= htmlspecialchars($film['durasi']) ?> menit</td>
            </tr>
            <tr>
              <th>Rating</th>
              <td>⭐ <?= htmlspecialchars($film['rating']) ?> / 10</td>
            </tr>
            <tr>
              <th>Sinopsis</th>
              <td><?= htmlspecialchars($film['sinopsis']) ?></td>
            </tr>
            <tr>
              <th>Ditambahkan</th>
              <td><?= htmlspecialchars($film['created_at']) ?></td>
            </tr>
          </table>

          <!-- Tombol aksi -->
          <div class='d-flex gap-2 mt-3'>
            <a href='index.php' class='btn btn-secondary'>← Kembali</a>

            <?php if ($_SESSION['role'] === 'admin'): ?>
              <a href='edit.php?id=<?= $film['id'] ?>' 
                 class='btn btn-warning'>✏️ Edit Film</a>

              <a href='delete.php?id=<?= $film['id'] ?>'
                 onclick="return confirm('Yakin hapus film ini?')"
                 class='btn btn-danger'>🗑️ Hapus Film</a>
            <?php endif; ?>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>