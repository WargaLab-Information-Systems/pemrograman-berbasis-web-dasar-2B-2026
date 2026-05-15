<?php
include 'auth.php';
include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $kat = $_POST['kategori'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $kondisi = $_POST['kondisi'];

    if ($stok <= 0 || $harga <= 0) {
        echo "<script>
                alert('Gagal! Stok dan Harga tidak boleh nol atau negatif.');
                window.history.back();
              </script>";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO inventaris (nama_alat, kategori, stok, harga_sewa, status_kondisi) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssids", $nama, $kat, $stok, $harga, $kondisi);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Tambah Data</title>
</head>

<body class="bg-gray-100 p-10">
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <h2 class="text-xl font-bold mb-6 text-blue-800">Tambah Alat Baru</h2>
        <form method="POST">
            <label class="block text-sm font-semibold mb-1">Nama Alat</label>
            <input type="text" name="nama" placeholder="Contoh: Jaring" required class="w-full border p-2 mb-4 rounded">

            <label class="block text-sm font-semibold mb-1">Kategori</label>
            <input type="text" name="kategori" placeholder="Contoh: Alat Tangkap" required
                class="w-full border p-2 mb-4 rounded">

            <label class="block text-sm font-semibold mb-1">Jumlah Stok</label>
            <input type="number" name="stok" min="1" placeholder="Minimal 1" required
                class="w-full border p-2 mb-4 rounded">

            <label class="block text-sm font-semibold mb-1">Harga Sewa</label>
            <input type="number" name="harga" min="1" placeholder="Minimal 1" required
                class="w-full border p-2 mb-4 rounded">

            <label class="block text-sm font-semibold mb-1">Kondisi</label>
            <select name="kondisi" class="w-full border p-2 mb-6 rounded">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="Perbaikan">Perbaikan</option>
            </select>

            <div class="flex justify-between items-center">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded font-bold hover:bg-blue-700">Simpan</button>
                <a href="index.php" class="text-gray-500 hover:text-red-500 transition">Batal</a>
            </div>
        </form>
    </div>
</body>

</html>