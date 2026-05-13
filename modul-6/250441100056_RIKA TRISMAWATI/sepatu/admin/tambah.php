<?php
session_start();
if ($_SESSION['role'] != 'Admin') {
    header("Location: ../index.php");
    exit;
}
include 'koneksi.php';

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama_sepatu'];
    $merk = $_POST['merk'];
    $ukuran = $_POST['ukuran'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    if ($ukuran < 10) {
        echo "<script>alert('Ukuran ga masuk akal, terlalu kecil!'); window.location='tambah.php';</script>";
    } else if ($ukuran > 50) {
        echo "<script>alert('Ukuran ga masuk akal, terlalu Besar!'); window.location='tambah.php';</script>";
    } else if ($harga <= 0) {
        echo "<script>alert('Harga tidak boleh minus!'); window.location='tambah.php';</script>";
    } else if ($stok <= 0) {
        echo "<script>alert('Stok tidak boleh minus!'); window.location='tambah.php';</script>";
    } else {
        
        $stmt = $conn->prepare(
            "INSERT INTO sepatu
        (nama_sepatu,merk,ukuran,harga,stok)
        VALUES(?,?,?,?,?)"
        );

        $stmt->bind_param(
            "ssiii",
            $nama,
            $merk,
            $ukuran,
            $harga,
            $stok
        );

        $stmt->execute();

        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Sepatu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="card p-4 shadow">
            <h3>Tambah Data Sepatu</h3>

            <form method="POST">

                <input type="text" name="nama_sepatu" class="form-control mb-3" placeholder="Nama Sepatu" required>
                <input type="text" name="merk" class="form-control mb-3" placeholder="Merk" required>
                <input type="number" name="ukuran" class="form-control mb-3" placeholder="Ukuran" required>
                <input type="number" name="harga" class="form-control mb-3" placeholder="Harga" required>
                <input type="number" name="stok" class="form-control mb-3" placeholder="Stok" required>

                <button name="simpan" class="btn btn-primary">Simpan</button>

            </form>
        </div>
    </div>
</body>

</html>