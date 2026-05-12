<?php

include '../middleware/user.php';
include '../config/koneksi.php';

/** @var mysqli $conn */

$id_servis = $_GET['id'];
$id_user = $_SESSION['id_user'];

$query = mysqli_query($conn, "SELECT * FROM kategori_servis");

$stmt = $conn->prepare("
    SELECT * FROM servis
    WHERE id_servis = ? AND id_user = ?
");

$stmt->bind_param("ii", $id_servis, $id_user);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan atau akses ditolak.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_servis = $_POST['id_servis'];
    $nama_kendaraan = $_POST['nama_kendaraan'];
    $id_kategori = $_POST['id_kategori'];
    $keluhan = $_POST['keluhan'];
    $tanggal_booking = $_POST['tanggal_booking'];

    $update = $conn->prepare("
        UPDATE servis
        SET
            nama_kendaraan = ?,
            id_kategori = ?,
            keluhan = ?,
            tanggal_booking = ?
        WHERE id_servis = ? AND id_user = ?
    ");

    $update->bind_param(
        "sissii",
        $nama_kendaraan,
        $id_kategori,
        $keluhan,
        $tanggal_booking,
        $id_servis,
        $id_user
    );

    if ($update->execute()) {

        header("Location: dashboard.php");
        exit();

    } else {

        echo "Gagal update data!";

    }

    $update->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Servis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow p-4" style="width: 600px;">
        <h2 class="text-center mb-4">Edit Data Servis</h2>
        <form method="POST">
            <input type="hidden" name="id_servis" value="<?= $data['id_servis']; ?>">
            <div class="mb-3">
                <label class="form-label">Nama Kendaraan</label>
                <input type="text" name="nama_kendaraan" class="form-control" value="<?= htmlspecialchars($data['nama_kendaraan']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori Servis</label>
                <select name="id_kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php while ($kategori = mysqli_fetch_assoc($query)): ?>
                        <option value="<?= $kategori['id_kategori']; ?>"
                            <?= $kategori['id_kategori'] == $data['id_kategori'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($kategori['nama_kategori']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Keluhan</label>
                <textarea name="keluhan" class="form-control" rows="4"required><?= htmlspecialchars($data['keluhan']); ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Booking</label>
                <input type="date" name="tanggal_booking" class="form-control" value="<?= htmlspecialchars($data['tanggal_booking']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Update Data</button>
        </form>
        <a href="dashboard.php" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
</body>
</html>