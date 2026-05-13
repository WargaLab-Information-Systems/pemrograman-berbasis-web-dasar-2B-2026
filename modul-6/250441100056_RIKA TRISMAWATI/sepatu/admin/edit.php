<?php
session_start();
if ($_SESSION['role'] != 'Admin') {
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

if (isset($_POST['update'])) {

    $nama = $_POST['nama_sepatu'];
    $merk = $_POST['merk'];
    $ukuran = $_POST['ukuran'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    if ($ukuran < 10) {
        echo "<script>alert('Ukuran ga masuk akal, terlalu kecil!');</script>";
    } else if ($ukuran > 50) {
        echo "<script>alert('Ukuran ga masuk akal, terlalu Besar!');</script>";
    } else if ($harga <= 0) {
        echo "<script>alert('Harga tidak boleh minus!');</script>";
    } else if ($stok <= 0) {
        echo "<script>alert('Stok tidak boleh minus!');</script>";
    } else {

        $update = $conn->prepare(
            "UPDATE sepatu SET
        nama_sepatu=?,
        merk=?,
        ukuran=?,
        harga=?,
        stok=?
        WHERE id_sepatu=?"
        );

        $update->bind_param(
            "ssiiii",
            $nama,
            $merk,
            $ukuran,
            $harga,
            $stok,
            $id
        );

        $update->execute();
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Sepatu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">

        <div class="card p-4 shadow">

            <h3>Edit Data Sepatu</h3>

            <form method="POST">

                <input type="text" name="nama_sepatu" value="<?= htmlspecialchars($row['nama_sepatu']) ?>" class="form-control mb-3" placeholder="Nama Sepatu" required>
                <input type="text" name="merk" value="<?= htmlspecialchars($row['merk']) ?>" class="form-control mb-3" placeholder="Merk" required>
                <input type="number" name="ukuran" value="<?= htmlspecialchars($row['ukuran']) ?>" class="form-control mb-3" placeholder="Ukuran" required>
                <input type="number" name="harga" value="<?= htmlspecialchars($row['harga']) ?>" class="form-control mb-3" placeholder="Harga" required>
                <input type="number" name="stok" value="<?= htmlspecialchars($row['stok']) ?>" class="form-control mb-3" placeholder="Stok" required>

                <button name="update" class="btn btn-success">Update</button>

            </form>

        </div>
    </div>

</body>

</html>