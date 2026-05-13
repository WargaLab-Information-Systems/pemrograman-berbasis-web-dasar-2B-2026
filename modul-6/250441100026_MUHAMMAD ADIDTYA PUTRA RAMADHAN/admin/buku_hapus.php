<?php
// admin/buku_hapus.php
require_once '../includes/koneksi.php';
require_once '../includes/auth.php';

requireAdmin();

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM buku WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        header("Location: index.php?success=Buku berhasil dihapus!");
    } else {
        header("Location: index.php?error=Buku tidak ditemukan!");
    }
    $stmt->close();
} else {
    header("Location: index.php");
}
exit();
?>