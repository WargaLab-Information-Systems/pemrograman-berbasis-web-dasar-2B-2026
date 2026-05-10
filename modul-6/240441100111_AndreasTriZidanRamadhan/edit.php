<?php
include 'config.php';
include 'auth.php';

if ($_SESSION['role'] !== 'admin') {
    die("Akses Ditolak: Anda bukan admin!");
}

$data = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM data_mancing WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        die("Data tidak ditemukan!");
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $spesies = $_POST['spesies'];
    $berat = $_POST['berat'];
    $lokasi = $_POST['lokasi'];
    $tgl = $_POST['tgl_tangkap'];
    $catatan = $_POST['catatan'];

    $stmt = $conn->prepare("UPDATE data_mancing SET spesies=?, berat=?, lokasi=?, tgl_tangkap=?, catatan=? WHERE id=?");
    $stmt->bind_param("sdsssi", $spesies, $berat, $lokasi, $tgl, $catatan, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data - FishLog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-10">
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow border-t-4 border-blue-500">
        <h2 class="text-xl font-bold mb-4 text-blue-600">Edit Log Memancing</h2>
        
        <form method="POST">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">

            <label class="block mb-1 text-sm font-medium">Nama Ikan</label>
            <input type="text" name="spesies" value="<?= htmlspecialchars($data['spesies']) ?>" required 
                class="w-full p-2 mb-4 border rounded focus:ring-2 focus:ring-blue-500 outline-none">
            
            <label class="block mb-1 text-sm font-medium">Berat (kg)</label>
            <input type="number" step="0.1" name="berat" value="<?= htmlspecialchars($data['berat']) ?>" required 
                class="w-full p-2 mb-4 border rounded focus:ring-2 focus:ring-blue-500 outline-none">
            
            <label class="block mb-1 text-sm font-medium">Lokasi</label>
            <input type="text" name="lokasi" value="<?= htmlspecialchars($data['lokasi']) ?>" required 
                class="w-full p-2 mb-4 border rounded focus:ring-2 focus:ring-blue-500 outline-none">
            
            <label class="block mb-1 text-sm font-medium">Tanggal</label>
            <input type="date" name="tgl_tangkap" value="<?= htmlspecialchars($data['tgl_tangkap']) ?>" required 
                class="w-full p-2 mb-4 border rounded focus:ring-2 focus:ring-blue-500 outline-none">
            
            <label class="block mb-1 text-sm font-medium">Catatan</label>
            <textarea name="catatan" class="w-full p-2 mb-4 border rounded focus:ring-2 focus:ring-blue-500 outline-none"><?= htmlspecialchars($data['catatan']) ?></textarea>
            
            <div class="flex justify-between items-center mt-4">
                <a href="index.php" class="text-gray-500 hover:underline text-sm">Batal</a>
                <button type="submit" name="update" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</body>
</html>