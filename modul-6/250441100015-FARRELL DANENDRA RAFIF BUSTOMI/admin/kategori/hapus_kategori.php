<?php

include '../../middleware/admin.php';
include '../../config/koneksi.php';

/** @var mysqli $conn */

$id_kategori = $_GET['id'];

$stmt = $conn->prepare("
    DELETE FROM kategori_servis
    WHERE id_kategori = ?
");

$stmt->bind_param("i", $id_kategori);

if ($stmt->execute()) {

    header("Location: data_kategori.php");
    exit();

} else {

    echo "Gagal menghapus kategori!";

}

$stmt->close();
$conn->close();

?>