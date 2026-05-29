<?php
// films/delete.php
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

// Cek dulu apakah film ada
$stmt = $conn->prepare('SELECT id, judul FROM films WHERE id=?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$film = $result->fetch_assoc();
$stmt->close();

if (!$film) {
  // Film tidak ditemukan, langsung redirect
  header('Location: index.php');
  exit();
}

// Hapus film
$del = $conn->prepare('DELETE FROM films WHERE id=?');
$del->bind_param('i', $id);
$del->execute();
$del->close();

header('Location: index.php?deleted=1');
exit();
?>