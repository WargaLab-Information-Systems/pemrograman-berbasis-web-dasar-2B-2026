<?php
include '../middleware/user.php';
include '../config/koneksi.php';

/** @var mysqli $conn */
$id_user = $_SESSION['id_user'];

$stmt = $conn->prepare("
    SELECT servis.*, kategori_servis.nama_kategori
    FROM servis
    JOIN kategori_servis
    ON servis.id_kategori = kategori_servis.id_kategori
    WHERE servis.id_user = ?
");

$stmt->bind_param("i", $id_user);
$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Bengkel App</a>
            <div class="ms-auto">
                <span class="text-white me-3">
                    <?= htmlspecialchars($_SESSION['nama_user']); ?>
                </span>
                <a href="../auth/logout.php" class="btn btn-light btn-sm">
                    Logout
                </a>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Data Servis Saya</h2>
            <a href="tambah_servis.php" class="btn btn-success">Tambah Servis</a>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Kendaraan</th>
                                <th>Kategori</th>
                                <th>Keluhan</th>
                                <th>Tanggal Booking</th>
                                <th>Status</th>
                                <th>Biaya</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = $result->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['nama_kendaraan']); ?></td>
                                    <td><?= htmlspecialchars($row['nama_kategori']); ?></td>
                                    <td><?= htmlspecialchars($row['keluhan']); ?></td>
                                    <td><?= htmlspecialchars($row['tanggal_booking']); ?></td>
                                    <td><?= htmlspecialchars($row['status_pengerjaan']); ?></td>
                                    <td>Rp <?= number_format($row['biaya']); ?></td>
                                    <td>
                                        <a href="edit_servis.php?id=<?= $row['id_servis']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>