<?php
include 'auth_check.php';
include 'config.php';

if ($_SESSION['role'] != 'admin') { header("Location: index.php"); exit(); }

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM pesanan WHERE id=$id");
$d = mysqli_fetch_array($res);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $layanan = $_POST['layanan'];
    $berat = $_POST['berat'];
    $tgl = $_POST['tgl'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE pesanan SET nama_pelanggan=?, jenis_layanan=?, berat_kg=?, tgl_selesai=?, status_bayar=? WHERE id=?");
    $stmt->bind_param("ssdssi", $nama, $layanan, $berat, $tgl, $status, $id);
    
    if ($stmt->execute()) { header("Location: index.php"); }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container card shadow p-4" style="max-width: 500px;">
        <h3>Edit Data Laundry</h3>
        <form method="POST">
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $d['nama_pelanggan'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Layanan</label>
                <select name="layanan" class="form-select">
                    <option value="Cuci Kering" <?= $d['jenis_layanan'] == 'Cuci Kering' ? 'selected' : '' ?>>Cuci Kering</option>
                    <option value="Cuci Setrika" <?= $d['jenis_layanan'] == 'Cuci Setrika' ? 'selected' : '' ?>>Cuci Setrika</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Berat (Kg)</label>
                <input type="number" step="0.1" name="berat" class="form-control" value="<?= $d['berat_kg'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Tgl Selesai</label>
                <input type="date" name="tgl" class="form-control" value="<?= $d['tgl_selesai'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option value="0" <?= $d['status_bayar'] == 0 ? 'selected' : '' ?>>Belum Lunas</option>
                    <option value="1" <?= $d['status_bayar'] == 1 ? 'selected' : '' ?>>Lunas</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-warning">Update Data</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>