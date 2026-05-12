<?php
include 'auth.php'; 
include 'config.php'; 

if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php?pesan=dilarang");
    exit();
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $stmt = $conn->prepare("DELETE FROM inventaris WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }
    
    $stmt->close();
} else {
    header("Location: index.php");
}

$conn->close();
exit();
?>