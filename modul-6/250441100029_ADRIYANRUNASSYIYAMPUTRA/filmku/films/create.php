<?php
// films/create.php
require_once '../config.php';
require_once '../auth_check.php';

// Cek role — hanya admin yang boleh
if ($_SESSION['role'] !== 'admin') {
  header('Location: /filmku/dashboard.php');
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
  $user_id  = $_SESSION['user_id'];

  if (empty($judul) || empty($genre) || $tahun < 1900 || $durasi < 1) {
    $error = 'Harap isi semua field dengan benar!';
  } else {
    $stmt = $conn->prepare(
      'INSERT INTO films
       (judul, genre, tahun, durasi, rating, sinopsis, created_by)
       VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->bind_param('ssiidsi', $judul, $genre, $tahun,
                                $durasi, $rating, $sinopsis, $user_id);

    if ($stmt->execute()) {
      header('Location: index.php?success=1');
      exit();
    } else {
      $error = 'Gagal menyimpan film!';
    }
    $stmt->close();
  }
}
?>

<!DOCTYPE html>
<html lang='id'>
<head>
  <meta charset='UTF-8'>
  <title>Tambah Film - FilmKu</title>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
</head>
<body>
<div class='container mt-4'>
  <h3>Tambah Film Baru</h3>
  <?php if ($error): ?>
    <div class='alert alert-danger'><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <form method='POST' id='formFilm'>
    <div class='mb-3'>
      <label class='form-label'>Judul Film *</label>
      <input type='text' name='judul' class='form-control' required>
    </div>
    <div class='row'>
      <div class='col-md-6 mb-3'>
        <label class='form-label'>Genre *</label>
        <input type='text' name='genre' class='form-control' required>
      </div>
      <div class='col-md-3 mb-3'>
        <label class='form-label'>Tahun *</label>
        <input type='number' name='tahun' class='form-control'
               min='1900' max='2099' required>
      </div>
      <div class='col-md-3 mb-3'>
        <label class='form-label'>Durasi (menit) *</label>
        <input type='number' name='durasi' class='form-control' min='1' required>
      </div>
    </div>
    <div class='mb-3'>
      <label class='form-label'>Rating (0-10)</label>
      <input type='number' name='rating' class='form-control'
             min='0' max='10' step='0.1'>
    </div>
    <div class='mb-3'>
      <label class='form-label'>Sinopsis</label>
      <textarea name='sinopsis' class='form-control' rows='4'></textarea>
    </div>
    <button type='submit' class='btn btn-success'>Simpan Film</button>
    <a href='index.php' class='btn btn-secondary ms-2'>Batal</a>
  </form>
</div>
</body></html>
