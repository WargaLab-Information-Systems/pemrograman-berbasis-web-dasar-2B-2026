<?php
include 'auth.php';
include 'config.php';


$id = $_GET['id'];

$stmt_get = $conn->prepare("SELECT * FROM inventaris WHERE id = ?");
$stmt_get->bind_param("i", $id);
$stmt_get->execute();
$data = $stmt_get->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $kat = $_POST['kategori'];
    $stok = $_POST['stok'];
    $hrg = $_POST['harga'];
    $kon = $_POST['kondisi'];

    if ($stok <= 0 || $hrg <= 0) {
        echo "<script>
                alert('Peringatan! Nilai Stok atau Harga tidak valid.');
                window.history.back();
              </script>";
        exit();
    }

    $stmt = $conn->prepare("UPDATE inventaris SET nama_alat=?, kategori=?, stok=?, harga_sewa=?, status_kondisi=?, tgl_update=NOW() WHERE id=?");
    $stmt->bind_param("ssidsi", $nama, $kat, $stok, $hrg, $kon, $id);

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
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Edit Data - Maritim</title>
</head>

<body class="bg-slate-100 p-10">
    <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-lg border-t-4 border-blue-600">
        <h2 class="text-2xl font-bold mb-6 text-slate-800 text-center">Edit Data Alat</h2>

        <form method="POST">
            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-600 mb-1">Nama Alat</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($data['nama_alat']) ?>" required
                    class="w-full border border-slate-300 p-2 rounded focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-slate-600 mb-1">Kategori</label>
                <input type="text" name="kategori" value="<?= htmlspecialchars($data['kategori']) ?>" required
                    class="w-full border border-slate-300 p-2 rounded focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1">Stok</label>
                    <input type="number" name="stok" min="1" value="<?= htmlspecialchars($data['stok']) ?>" required
                        class="w-full border border-slate-300 p-2 rounded focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-1">Harga Sewa</label>
                    <input type="number" name="harga" min="1" value="<?= htmlspecialchars($data['harga_sewa']) ?>"
                        required
                        class="w-full border border-slate-300 p-2 rounded focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-slate-600 mb-1">Kondisi Saat Ini</label>
                <select name="kondisi"
                    class="w-full border border-slate-300 p-2 rounded focus:ring-2 focus:ring-blue-500">
                    <option value="Baik" <?= $data['status_kondisi'] == 'Baik' ? 'selected' : '' ?>>Baik</option>
                    <option value="Rusak" <?= $data['status_kondisi'] == 'Rusak' ? 'selected' : '' ?>>Rusak</option>
                    <option value="Perbaikan" <?= $data['status_kondisi'] == 'Perbaikan' ? 'selected' : '' ?>>Perbaikan
                    </option>
                </select>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition shadow-md">
                    Update Barang
                </button>
                <a href="index.php" class="text-slate-500 hover:text-red-500 font-medium">Batal</a>
            </div>
        </form>
    </div>
</body>

</html>