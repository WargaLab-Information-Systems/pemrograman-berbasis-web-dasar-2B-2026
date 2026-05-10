<?php
include 'config.php';
include 'auth.php';

if ($_SESSION['role'] !== 'admin') {
    die("Akses Ditolak: Anda bukan admin!");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM data_mancing WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        mysqli_query($conn, "SET @count = 0");
        
        mysqli_query($conn, "UPDATE data_mancing SET id = (@count := @count + 1)");
        
        mysqli_query($conn, "ALTER TABLE data_mancing AUTO_INCREMENT = 1");

        header("Location: index.php");
    } else {
        echo "Gagal menghapus data.";
    }
}
?>