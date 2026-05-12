<?php

include '../../middleware/admin.php';
include '../../config/koneksi.php';

/** @var mysqli $conn */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_kategori = $_POST['nama_kategori'];

    $stmt = $conn->prepare("
        INSERT INTO kategori_servis (nama_kategori)
        VALUES (?)
    ");

    $stmt->bind_param("s", $nama_kategori);

    if ($stmt->execute()) {

        header("Location: data_kategori.php");
        exit();

    } else {

        echo "Gagal menambahkan kategori!";

    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori Servis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card shadow p-4" style="width: 600px;">
            <h2 class="text-center mb-4">Tambah Kategori Servis</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Tambah Kategori</button>
            </form>
            <a href="data_kategori.php" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</body>

</html>