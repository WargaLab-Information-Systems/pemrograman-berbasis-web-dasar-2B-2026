<?php

include '../middleware/admin.php';
include '../config/koneksi.php';

/** @var mysqli $conn */

$id_servis = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM servis WHERE id_servis = ?");

$stmt->bind_param("i", $id_servis);

if ($stmt->execute()) {

    header("Location: dashboard.php");
    exit();

} else {

    echo "Gagal menghapus data!";

}

$stmt->close();
$conn->close();

?>