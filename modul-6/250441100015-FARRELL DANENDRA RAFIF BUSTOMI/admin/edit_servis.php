<?php

include '../middleware/admin.php';
include '../config/koneksi.php';

/** @var mysqli $conn */

$id_servis = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM servis WHERE id_servis = ?");
$stmt->bind_param("i", $id_servis);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_servis = $_POST['id_servis'];
    $status_pengerjaan = $_POST['status_pengerjaan'];
    $biaya = $_POST['biaya'];
    $tanggal_selesai = $_POST['tanggal_selesai'];

    $stmt = $conn->prepare("
    UPDATE servis
    SET
        status_pengerjaan = ?,
        biaya = ?,
        tanggal_selesai = ?
    WHERE id_servis = ?");

    $stmt->bind_param(
        "sisi",
        $status_pengerjaan,
        $biaya,
        $tanggal_selesai,
        $id_servis
    );

    if ($stmt->execute()) {

        header("Location: dashboard.php");

    } else {

        echo "Gagal update data!";

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
    <title>Edit Data Servis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Admin Bengkel</a>
            <div class="ms-auto">
                <span class="text-white me-3"><?= htmlspecialchars($_SESSION['nama_user']); ?></span>
                <a href="../auth/logout.php" class="btn btn-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card shadow p-4" style="width: 600px;">
            <h2 class="text-center mb-4">Edit Data Servis</h2>
            <form method="POST">
                <input type="hidden" name="id_servis" value="<?= $data['id_servis']; ?>">
                <div class="mb-3">
                    <label class="form-label">Status Pengerjaan</label>
                    <select name="status_pengerjaan" class="form-select" required>
                        <option value="pending" <?= $data['status_pengerjaan'] == 'pending' ? 'selected' : ''; ?>>Pending
                        </option>
                        <option value="diproses" <?= $data['status_pengerjaan'] == 'diproses' ? 'selected' : ''; ?>>
                            Diproses</option>
                        <option value="selesai" <?= $data['status_pengerjaan'] == 'selesai' ? 'selected' : ''; ?>>Selesai
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Biaya</label>
                    <input type="number" name="biaya" class="form-control" value="<?= $data['biaya']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control"
                        value="<?= $data['tanggal_selesai']; ?>">
                </div>
                <button type="submit" class="btn btn-success w-100">Update Data</button>
            </form>
            <a href="dashboard.php" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</body>

</html>