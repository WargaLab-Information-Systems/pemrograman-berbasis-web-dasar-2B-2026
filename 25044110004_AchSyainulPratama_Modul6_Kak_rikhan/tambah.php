<?php
include 'auth_check.php';
include 'config.php';

// Hanya admin yang bisa akses halaman ini
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama_pelanggan'];
    $layanan = $_POST['jenis_layanan'];
    $berat = $_POST['berat_kg'];
    $tgl = $_POST['tgl_selesai'];
    $status = $_POST['status_bayar'];

    $stmt = $conn->prepare("INSERT INTO pesanan (nama_pelanggan, jenis_layanan, berat_kg, tgl_selesai, status_bayar) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $nama, $layanan, $berat, $tgl, $status);

    if ($stmt->execute()) {
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pesanan — EasyWash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F8F4EE; font-family: 'DM Sans', sans-serif; }
        .card-form { border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .btn-primary-custom { background: #1A1207; color: #C8871A; border: none; font-weight: 600; }
        .btn-primary-custom:hover { background: #2D1F0C; color: #F0B429; }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-form p-4">
                <h4 class="fw-bold mb-4" style="color: #1A1207;">Tambah Pesanan Baru</h4>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" class="form-control" required placeholder="Masukkan nama...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Jenis Layanan</label>
                        <select name="jenis_layanan" class="form-select" required>
                            <option value="Cuci Kering">Cuci Kering</option>
                            <option value="Cuci Setrika">Cuci Setrika</option>
                            <option value="Setrika Saja">Setrika Saja</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Berat (Kg)</label>
                            <input type="number" step="0.1" name="berat_kg" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Tanggal Selesai</label>
                            <input type="date" name="tgl_selesai" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-medium">Status Pembayaran</label>
                        <select name="status_bayar" class="form-select">
                            <option value="0">Belum Lunas</option>
                            <option value="1">Lunas</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="submit" class="btn btn-primary-custom py-2">Simpan Pesanan</button>
                        <a href="index.php" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>