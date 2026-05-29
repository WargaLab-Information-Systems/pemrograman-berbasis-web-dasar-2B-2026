<?php
// auth/logout.php
// File ini TIDAK punya tampilan HTML — langsung proses dan redirect
session_start();

// Hapus semua data session
session_unset();
session_destroy();

// Redirect ke halaman login
header('Location: /filmku/auth/login.php');
exit();
?>
