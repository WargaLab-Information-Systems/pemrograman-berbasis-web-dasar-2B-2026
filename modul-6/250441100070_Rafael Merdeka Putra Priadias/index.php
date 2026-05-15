<?php
include 'auth.php';
include 'config.php';

// Proteksi: Pastikan tabel ada, jika tidak tampilkan error yang jelas
$result = mysqli_query($conn, "SELECT * FROM inventaris");
if (!$result) {
    die("Error Database: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard Maritim</title>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <nav class="bg-blue-800 text-white p-4 flex justify-between shadow-lg">
        <h1 class="text-xl font-bold">⚓ Inventaris Alat Madura</h1>
        <div class="flex items-center gap-4">
            <span class="text-sm opacity-80">Halo, <?= htmlspecialchars($_SESSION['username']) ?>
                (<?= htmlspecialchars($_SESSION['role']) ?>)</span>
            <a href="logout.php"
                class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm transition font-bold">Logout</a>
        </div>
    </nav>

    <main class="p-8 flex-grow">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Daftar Alat Tangkap</h2>
                <a href="tambah.php"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 shadow-sm transition">+ Tambah
                    Data</a>
            </div>

            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md bg-white">
                <table class="w-full text-left text-sm text-gray-500">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 font-bold text-gray-900">ID</th>
                            <th class="px-6 py-4 font-bold text-gray-900">Nama Alat</th>
                            <th class="px-6 py-4 font-bold text-gray-900">Kategori</th>
                            <th class="px-6 py-4 font-bold text-gray-900 text-center">Stok</th>
                            <th class="px-6 py-4 font-bold text-gray-900">Harga Sewa</th>
                            <th class="px-6 py-4 font-bold text-gray-900 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-400 font-mono"><?= $row['id'] ?></td>

                                <td class="px-6 py-4 font-medium text-gray-900"><?= htmlspecialchars($row['nama_alat']) ?>
                                </td>
                                <td class="px-6 py-4 text-xs">
                                    <span
                                        class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full uppercase font-bold"><?= htmlspecialchars($row['kategori']) ?></span>
                                </td>
                                <td class="px-6 py-4 text-center"><?= htmlspecialchars($row['stok']) ?></td>
                                <td class="px-6 py-4 text-green-600 font-bold">Rp
                                    <?= number_format($row['harga_sewa'], 0, ',', '.') ?>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="edit.php?id=<?= $row['id'] ?>"
                                        class="text-blue-600 hover:underline font-medium">Edit</a>
                                    <span class="mx-2 text-gray-300">|</span>
                                    <a href="hapus.php?id=<?= $row['id'] ?>"
                                        class="text-red-600 hover:underline font-medium"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="bg-blue-900 text-white py-8 border-t-4 border-blue-700">
        <div class="container mx-auto px-6 text-center">
            <p class="font-medium text-lg">⚓ Maritim Inventory</p>
            <p class="text-sm text-blue-300 mt-1">Sistem Manajemen Alat Tangkap Nelayan Tradisional</p>
            <div class="mt-4 pt-4 border-t border-blue-800 text-xs text-blue-400">
                &copy; <?= date('Y') ?> Maritim Inventory - Rafael Merdeka Putra Priadias. All rights reserved.
            </div>
        </div>
    </footer>
</body>

</html>