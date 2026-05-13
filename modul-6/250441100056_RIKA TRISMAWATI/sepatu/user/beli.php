<?php
session_start();
if ($_SESSION['role'] != 'User') {
    header("Location: ../index.php");
    exit;
}
include 'koneksi.php';

$id = $_GET['id'];

$stmt = $conn->prepare(
    "SELECT * FROM sepatu WHERE id_sepatu=?"
);

$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();

$row = $result->fetch_assoc();

if (isset($_POST['beli'])) {

    $id_user = $_POST['id_user'];
    $id_sepatu = $_POST['id_sepatu'];
    $jumlah = $_POST['jumlah'];
    $stok = $row['stok'] - $jumlah;

    if ($row['stok'] <= $jumlah) {
        echo "<script>alert('Jumlah terlalu banyak, stok tidak mencukupi!'); window.location='index.php';</script>";
    } else {
        $beli = $conn->prepare(
            "INSERT INTO pembelian
        (id_user,id_sepatu,jumlah,tanggal)
        VALUES(?,?,?,CURDATE())"
        );

        $beli->bind_param(
            "iii",
            $id_user,
            $id_sepatu,
            $jumlah
        );

        $beli->execute();

        $update = $conn->prepare(
            "UPDATE sepatu SET
        stok=?
        WHERE id_sepatu=?"
        );

        $update->bind_param(
            "ii",
            $stok,
            $id
        );

        $update->execute();
        echo "<script>alert('Pembelian Berhasil!'); window.location='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Beli Sepatu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">

        <div class="card p-4 shadow">

            <h3>Beli Data Sepatu</h3>

            <form method="POST">
                <input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">
                <input type="hidden" name="id_sepatu" value="<?= $row['id_sepatu'] ?>">
                <input type="text" readonly name="nama_sepatu" value="<?= htmlspecialchars($row['nama_sepatu']) ?>" class="form-control mb-3" placeholder="Nama Sepatu" required>
                <input type="text" readonly name="merk" value="<?= htmlspecialchars($row['merk']) ?>" class="form-control mb-3" placeholder="Merk" required>
                <input type="number" readonly name="ukuran" value="<?= htmlspecialchars($row['ukuran']) ?>" class="form-control mb-3" placeholder="Ukuran" required>
                <input type="number" readonly name="harga" value="<?= htmlspecialchars($row['harga']) ?>" class="form-control mb-3" placeholder="Harga" required>
                <input type="number" readonly name="stok" value="<?= htmlspecialchars($row['stok']) ?>" class="form-control mb-3" placeholder="Stok" required>
                <input type="number" name="jumlah" autofocus class="form-control mb-3" placeholder="Masukkan Jumlah" required>

                <button name="beli" class="btn btn-success">Beli</button>

            </form>

        </div>
    </div>

</body>

</html>