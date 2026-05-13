<?php
// auth_check.php
// Include file ini di SETIAP halaman yang butuh login

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Kalau belum login, paksa ke halaman login
if (!isset($_SESSION['user_id'])) {
  header('Location: /filmku/auth/login.php');
  exit(); // Wajib ada! Tanpa ini, kode di bawah tetap jalan
}
?>
