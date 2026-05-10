<?php
include 'config.php';
include 'auth.php';

if (isset($_POST['submit'])) {
    $spesies = $_POST['spesies'];
    $berat = $_POST['berat'];
    $lokasi = $_POST['lokasi'];
    $tgl = $_POST['tgl_tangkap'];
    $catatan = $_POST['catatan'];

    $stmt = $conn->prepare("INSERT INTO data_mancing (spesies, berat, lokasi, tgl_tangkap, catatan) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsss", $spesies, $berat, $lokasi, $tgl, $catatan);

    if ($stmt->execute()) {
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data - FishLog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-10">
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Tambah Log Memancing</h2>
        <form method="POST">
            <label class="block mb-2 text-sm">Nama Ikan</label>
            <input type="text" name="spesies" required placeholder="Contoh: Ikan Mujair" class="w-full p-2 mb-4 border rounded">
            
            <label class="block mb-2 text-sm">Berat (kg)</label>
            <input type="number" step="0.1" name="berat" required placeholder="15.5" class="w-full p-2 mb-4 border rounded">
            
            <label class="block mb-2 text-sm">Lokasi</label>
            <input type="text" name="lokasi" required placeholder="Contoh: Sungai Bengawan Solo" class="w-full p-2 mb-4 border rounded">
            
            <label class="block mb-2 text-sm">Tanggal</label>
            <input type="date" name="tgl_tangkap" required class="w-full p-2 mb-4 border rounded">
            
            <label class="block mb-2 text-sm">Catatan</label>
            <textarea name="catatan" placeholder="Ceritakan Pengalamanmu" class="w-full p-2 mb-4 border rounded"></textarea>
            
            <div class="flex justify-between">
                <a href="index.php" class="text-gray-500 py-2 hover:underline-">Kembali</a>
                <button type="submit" name="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>