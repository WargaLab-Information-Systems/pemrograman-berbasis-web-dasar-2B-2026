<?php
session_start();
if ($_SESSION['role'] != 'Admin') {
    header("Location: ../index.php");
    exit;
}

include 'koneksi.php';

$data = $conn->query(
    "SELECT * FROM sepatu"
);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Data Sepatu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h2>Data Sepatu</h2>
            <a href="../logout.php" onclick="return confirm('Yakin ingin Logout?')" class="btn btn-danger">Logout</a>
        </div>
        <div class="alert alert-success">
            Selamat datang, <b><?php echo $_SESSION['nama']; ?></b>, Anda Login sebagai <b><?php echo $_SESSION['role']; ?></b>
        </div>
        <a href="tambah.php" class="btn btn-primary mb-3">
            Tambah Data
        </a>
        <a href="pembelian.php" class="btn btn-success mb-3">
            Data Pembelian
        </a>

        <table class="table table-bordered table-striped">
            <tr>
                <th>No</th>
                <th>Nama Sepatu</th>
                <th>Merk</th>
                <th>Ukuran</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;

            while ($row = $data->fetch_assoc()) {
            ?>

                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama_sepatu']) ?></td>
                    <td><?= htmlspecialchars($row['merk']) ?></td>
                    <td><?= htmlspecialchars($row['ukuran']) ?></td>
                    <td><?= htmlspecialchars($row['harga']) ?></td>
                    <td><?= htmlspecialchars($row['stok']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id_sepatu'] ?>" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <a href="hapus.php?id=<?= $row['id_sepatu'] ?>" onclick="return confirm('Yakin ingin menghapus,' $row['nama_sepatu'] ', ini?')" class="btn btn-danger btn-sm">
                            Hapus
                        </a>
                    </td>
                </tr>

            <?php } ?>

        </table>
    </div>
</body>

</html>