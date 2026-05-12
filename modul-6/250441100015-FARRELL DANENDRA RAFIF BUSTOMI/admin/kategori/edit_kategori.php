<?php

include '../../middleware/admin.php';
include '../../config/koneksi.php';

/** @var mysqli $conn */

$id_kategori = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM kategori_servis WHERE id_kategori = ?");
$stmt->bind_param("i", $id_kategori);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_kategori = $_POST['nama_kategori'];

    $update = $conn->prepare("
        UPDATE kategori_servis
        SET
            nama_kategori = ?
        WHERE id_kategori = ?
    ");

    $update->bind_param(
        "si",
        $nama_kategori,
        $id_kategori
    );

    if ($update->execute()) {

        header("Location: data_kategori.php");
        exit();

    } else {

        echo "Gagal mengupdate kategori!";

    }

    $update->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori Servis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow p-4" style="width: 600px;">
        <h2 class="text-center mb-4">Edit Kategori Servis</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" value="<?= htmlspecialchars($data['nama_kategori']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Update Kategori</button>
        </form>
        <a href="data_kategori.php" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
</body>
</html>