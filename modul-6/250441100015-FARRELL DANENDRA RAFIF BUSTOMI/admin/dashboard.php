<?php
include '../middleware/admin.php';
include '../config/koneksi.php';
/** @var mysqli $conn */
$query = "
    SELECT servis.*, users.nama_user, kategori_servis.nama_kategori
    FROM servis
    JOIN users ON servis.id_user = users.id_user
    JOIN kategori_servis ON servis.id_kategori = kategori_servis.id_kategori
    ";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Bengkel</a>
            <div class="ms-auto">
                <span class="text-white me-3">
                    <?= htmlspecialchars($_SESSION['nama_user']); ?>
                </span>
                <a href="../auth/logout.php" class="btn btn-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-4">Kelola Data Servis</h2>
                <a href="kategori/data_kategori.php" class="btn btn-success mb-3">Kelola Kategori</a>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Nama Kendaraan</th>
                                    <th>Kategori</th>
                                    <th>Keluhan</th>
                                    <th>Tanggal Booking</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th>Biaya</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)):
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $no++; ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($row['nama_user']); ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($row['nama_kendaraan']); ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($row['nama_kategori']); ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($row['keluhan']); ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($row['tanggal_booking']); ?>
                                        </td>
                                        <td>
                                            <?= $row['tanggal_selesai'] ? htmlspecialchars($row['tanggal_selesai']) : 'Belum selesai'; ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($row['status_pengerjaan']); ?>
                                        </td>
                                        <td>Rp
                                            <?= number_format($row['biaya']); ?>
                                        </td>
                                        <td>
                                            <a href="edit_servis.php?id=<?= $row['id_servis']; ?>"
                                                class="btn btn-warning btn-sm mb-1">Edit</a>
                                            <a href="hapus_servis.php?id=<?= $row['id_servis']; ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>