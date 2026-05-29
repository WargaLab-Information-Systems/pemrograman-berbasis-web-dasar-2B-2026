<?php
// films/edit.php
require_once '../config.php';
require_once '../auth_check.php';

if ($_SESSION['role'] !== 'admin') {
  header('Location: /filmku/dashboard.php');
  exit();
}

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
  header('Location: index.php');
  exit();
}

// Ambil data film yang akan diedit
$stmt = $conn->prepare('SELECT * FROM films WHERE id=?');
$stmt->bind_param('i', $id);
$stmt->execute();
$film = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$film) {
  header('Location: index.php');
  exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $judul    = trim($_POST['judul'] ?? '');
  $genre    = trim($_POST['genre'] ?? '');
  $tahun    = (int)($_POST['tahun'] ?? 0);
  $durasi   = (int)($_POST['durasi'] ?? 0);
  $rating   = (float)($_POST['rating'] ?? 0);
  $sinopsis = trim($_POST['sinopsis'] ?? '');

  if (empty($judul) || empty($genre)) {
    $error = 'Judul dan genre wajib diisi!';
  } else {
    $stmt2 = $conn->prepare(
      'UPDATE films SET judul=?, genre=?, tahun=?, durasi=?, rating=?, sinopsis=? WHERE id=?'
    );
    $stmt2->bind_param('ssiidsi', $judul, $genre, $tahun, $durasi, $rating, $sinopsis, $id);

    if ($stmt2->execute()) {
      header('Location: index.php?updated=1');
      exit();
    } else {
      $error = 'Gagal mengupdate film!';
    }
    $stmt2->close();
  }
}
?>

<!DOCTYPE html>
<html lang='id'>
<head>
  <meta charset='UTF-8'>
  <title>Edit Film - FilmKu</title>
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
      </span>
      <a href='/filmku/auth/logout.php' class='btn btn-outline-light btn-sm'>Logout</a>
    </div>
  </div>
</nav>

<div class='container mt-4'>
  <div class='row justify-content-center'>
    <div class='col-md-8'>
      <div class='card shadow'>
        <div class='card-header bg-warning'>
          <h4 class='mb-0'>✏️ Edit Film</h4>
        </div>
        <div class='card-body'>

          <?php if ($error): ?>
            <div class='alert alert-danger'><?= htmlspecialchars($error) ?></div>
          <?php endif; ?>

          <form method='POST'>
            <div class='mb-3'>
              <label class='form-label'>Judul Film *</label>
              <input type='text' name='judul' class='form-control' required
                     value='<?= htmlspecialchars($film['judul']) ?>'>
            </div>

            <div class='row'>
              <div class='col-md-6 mb-3'>
                <label class='form-label'>Genre *</label>
                <input type='text' name='genre' class='form-control' required
                       value='<?= htmlspecialchars($film['genre']) ?>'>
              </div>
              <div class='col-md-3 mb-3'>
                <label class='form-label'>Tahun *</label>
                <input type='number' name='tahun' class='form-control'
                       min='1900' max='2099' required
                       value='<?= htmlspecialchars($film['tahun']) ?>'>
              </div>
              <div class='col-md-3 mb-3'>
                <label class='form-label'>Durasi (menit) *</label>
                <input type='number' name='durasi' class='form-control' min='1' required
                       value='<?= htmlspecialchars($film['durasi']) ?>'>
              </div>
            </div>

            <div class='mb-3'>
              <label class='form-label'>Rating (0-10)</label>
              <input type='number' name='rating' class='form-control'
                     min='0' max='10' step='0.1'
                     value='<?= htmlspecialchars($film['rating']) ?>'>
            </div>

            <div class='mb-3'>
              <label class='form-label'>Sinopsis</label>
              <textarea name='sinopsis' class='form-control' rows='4'><?= htmlspecialchars($film['sinopsis']) ?></textarea>
            </div>

            <div class='d-flex gap-2'>
              <button type='submit' class='btn btn-warning'>💾 Simpan Perubahan</button>
              <a href='index.php' class='btn btn-secondary'>Batal</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>