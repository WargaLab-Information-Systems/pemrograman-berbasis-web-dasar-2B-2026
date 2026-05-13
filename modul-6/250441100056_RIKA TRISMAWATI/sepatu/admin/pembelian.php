<?php
session_start();
include 'koneksi.php';

if ($_SESSION['role'] != 'Admin') {
    header("Location: ../index.php");
    exit;
}

$query = $conn->prepare(
    "SELECT p.*, u.nama, s.nama_sepatu, s.merk, s.harga
     FROM pembelian p
     JOIN user u ON p.id_user = u.id_user
     JOIN sepatu s ON p.id_sepatu = s.id_sepatu
     ORDER BY p.tanggal DESC"
);

$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <h3 class="mb-4">Data Pembelian</h3>
        <a href="index.php" class="btn btn-primary mb-3">
            ⬅ Kembali
        </a>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Sepatu</th>
                        <th>Merk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $no = 1;
                    while ($row = $result->fetch_assoc()) :
                        $total = $row['harga'] * $row['jumlah'];
                    ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['nama_sepatu']) ?></td>
                            <td><?= htmlspecialchars($row['merk']) ?></td>
                            <td>Rp <?= number_format($row['harga']) ?></td>
                            <td><?= $row['jumlah'] ?></td>
                            <td>Rp <?= number_format($total) ?></td>
                            <td><?= $row['tanggal'] ?></td>
                        </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>
        </div>

    </div>

</body>

</html>