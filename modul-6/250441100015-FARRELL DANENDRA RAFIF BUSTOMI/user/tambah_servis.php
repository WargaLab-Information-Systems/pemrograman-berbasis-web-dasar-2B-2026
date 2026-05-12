<?php

include '../middleware/user.php';
include '../config/koneksi.php';

/** @var mysqli $conn */

$query = mysqli_query($conn, "SELECT * FROM kategori_servis");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = $_SESSION['id_user'];

    $id_kategori = $_POST['id_kategori'];
    $nama_kendaraan = $_POST['nama_kendaraan'];
    $keluhan = $_POST['keluhan'];
    $tanggal_booking = $_POST['tanggal_booking'];

    $status_pengerjaan = "pending";

    $biaya = 0;

    $stmt = $conn->prepare("
    INSERT INTO servis
    (
        id_user,
        id_kategori,
        nama_kendaraan,
        keluhan,
        tanggal_booking,
        status_pengerjaan,
        biaya
    )
    VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "iissssi",
        $id_user,
        $id_kategori,
        $nama_kendaraan,
        $keluhan,
        $tanggal_booking,
        $status_pengerjaan,
        $biaya
    );

    if ($stmt->execute()) {
        header("Location: ../user/dashboard.php");

    } else {

        echo "Data servis gagal ditambahkan!";

    }

    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Servis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card shadow p-4" style="width: 600px;">
            <h2 class="text-center mb-4">Tambah Servis</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Kendaraan</label>
                    <input type="text" name="nama_kendaraan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keluhan</label>
                    <textarea name="keluhan" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Booking</label>
                    <input type="date" name="tanggal_booking" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori Servis</label>
                    <select name="id_kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php while ($kategori = mysqli_fetch_assoc($query)): ?>
                            <option value="<?= $kategori['id_kategori']; ?>">
                                <?= htmlspecialchars($kategori['nama_kategori']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100">Tambah Servis</button>
            </form>
            <a href="dashboard.php" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</body>

</html>