<?php
include 'config.php';

// Cek sudah login atau belum
if (!isset($_SESSION['admin_login'])) {
    header("Location: login.php");
    exit;
}

// Logika CRUD (sama seperti sebelumnya, tapi ada di sini)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id           = $_POST['id'] ?? '';
    $nama_tim     = mysqli_real_escape_string($koneksi, $_POST['nama_tim']);
    $nama_kapten  = mysqli_real_escape_string($koneksi, $_POST['nama_kapten']);
    $no_hp        = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $id_ff        = mysqli_real_escape_string($koneksi, $_POST['id_ff']);
    $anggota      = mysqli_real_escape_string($koneksi, $_POST['anggota']);

    if (!empty($id)) {
        $query = "UPDATE tim SET nama_tim='$nama_tim', nama_kapten='$nama_kapten', no_hp='$no_hp', id_ff='$id_ff', anggota='$anggota' WHERE id='$id'";
    } else {
        $query = "INSERT INTO tim (nama_tim, nama_kapten, no_hp, id_ff, anggota) VALUES ('$nama_tim', '$nama_kapten', '$no_hp', '$id_ff', '$anggota')";
    }
    mysqli_query($koneksi, $query);
    header("Location: admin.php?pesan=sukses");
}

if (isset($_GET['hapus'])) {
    mysqli_query($koneksi, "DELETE FROM tim WHERE id='$_GET[hapus]'");
    header("Location: admin.php?pesan=hapus");
}

$editData = null;
if (isset($_GET['edit'])) {
    $editData = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tim WHERE id='$_GET[edit]'"));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Turnamen FF</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <header class="bg-gray-800 text-white py-4 shadow">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <h1 class="text-xl font-bold"><i class="fa fa-fire text-red-500"></i> ADMIN PANEL - TURNAMEN FF</h1>
            <div>
                <a href="index.php" target="_blank" class="text-blue-300 hover:underline mr-4">Lihat Halaman Depan</a>
                <a href="logout.php" class="text-red-400 hover:underline">Keluar</a>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-6">
        <?php if (isset($_GET['pesan'])): ?>
        <div class="mb-4 p-3 rounded <?= $_GET['pesan']=='sukses' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
            <?= $_GET['pesan']=='sukses' ? '✅ Data tersimpan!' : '🗑️ Data dihapus!' ?>
        </div>
        <?php endif; ?>

        <!-- FORM TAMBAH / UBAH -->
        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h3 class="text-xl font-bold mb-4"><?= $editData ? 'Ubah Data Tim' : 'Tambah Tim Baru' ?></h3>
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1">Nama Tim</label>
                        <input type="text" name="nama_tim" value="<?= $editData['nama_tim'] ?? '' ?>" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Nama Kapten</label>
                        <input type="text" name="nama_kapten" value="<?= $editData['nama_kapten'] ?? '' ?>" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">No HP / WA</label>
                        <input type="tel" name="no_hp" value="<?= $editData['no_hp'] ?? '' ?>" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">ID Free Fire</label>
                        <input type="text" name="id_ff" value="<?= $editData['id_ff'] ?? '' ?>" class="w-full border px-3 py-2 rounded" required>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-semibold mb-1">Daftar Anggota</label>
                    <textarea name="anggota" rows="3" class="w-full border px-3 py-2 rounded" required><?= $editData['anggota'] ?? '' ?></textarea>
                </div>
                <div class="mt-4">
                    <button type="submit" class="bg-red-600 text-white px-5 py-2 rounded font-bold">💾 Simpan</button>
                    <?php if ($editData): ?>
                    <a href="admin.php" class="bg-gray-500 text-white px-5 py-2 rounded font-bold ml-2">Batal</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- TABEL DATA & AKSI CRUD -->
        <div class="bg-white p-6 rounded-lg shadow overflow-x-auto">
            <h3 class="text-xl font-bold mb-4">Daftar Semua Tim Terdaftar</h3>
            <table class="w-full text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2">#</th>
                        <th class="px-3 py-2">Nama Tim</th>
                        <th class="px-3 py-2">Kapten</th>
                        <th class="px-3 py-2">Kontak</th>
                        <th class="px-3 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ambilSemua = mysqli_query($koneksi, "SELECT * FROM tim ORDER BY tanggal_daftar DESC");
                    $no = 1;
                    while ($d = mysqli_fetch_assoc($ambilSemua)):
                    ?>
                    <tr class="border-t">
                        <td class="px-3 py-2"><?= $no++ ?></td>
                        <td class="px-3 py-2 font-semibold"><?= $d['nama_tim'] ?></td>
                        <td class="px-3 py-2"><?= $d['nama_kapten'] ?></td>
                        <td class="px-3 py-2"><?= $d['no_hp'] ?></td>
                        <td class="px-3 py-2 text-center">
                            <a href="admin.php?edit=<?= $d['id'] ?>" class="text-blue-600 hover:underline mr-3">✏️ Edit</a>
                            <a href="admin.php?hapus=<?= $d['id'] ?>" onclick="return confirm('Hapus data ini?')" class="text-red-600 hover:underline">🗑️ Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if (mysqli_num_rows($ambilSemua) == 0): ?>
                    <tr><td colspan="5" class="text-center py-4 text-gray-500">Belum ada data tim.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>