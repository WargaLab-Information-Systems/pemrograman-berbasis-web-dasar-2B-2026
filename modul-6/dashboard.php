<?php
require 'db.php';
require 'auth.php';

if (isset($_GET['delete']) && $_SESSION['role'] === 'admin') {
    $stmt = $pdo->prepare("DELETE FROM coffee_beans WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: dashboard.php");
    exit();
}

$beans = $pdo->query("SELECT MAX(id) AS id, origin, SUM(stock_kg) AS stock_kg, roast_level, MAX(arrival_date) AS arrival_date, is_organic FROM coffee_beans GROUP BY origin, roast_level, is_organic ORDER BY arrival_date DESC, id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Roastery Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-50 min-h-screen">
    <nav class="bg-stone-900 text-white p-4 shadow-xl">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-2xl">☕</span>
                <h1 class="text-xl font-bold tracking-widest text-amber-500">COFFEE.ID</h1>
            </div>
            <div class="flex items-center gap-6">
                <div class="text-right">
                    <p class="text-sm font-medium leading-none"><?= htmlspecialchars($_SESSION['username']) ?></p>
                    <p class="text-[10px] text-amber-400 uppercase tracking-tighter"><?= $_SESSION['role'] ?></p>
                </div>
                <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-xs font-bold transition">LOGOUT</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-10 p-8 bg-white rounded-2xl shadow-sm border border-stone-200">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-stone-800">Manajemen Stok</h2>
                <p class="text-stone-500 text-sm">Kelola data biji kopi yang tersedia di gudang.</p>
            </div>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="create.php" class="bg-stone-800 hover:bg-stone-700 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-md transition">+ DATA BARU</a>
            <?php endif; ?>
        </div>

        <div class="overflow-hidden rounded-xl border border-stone-200">
            <table class="w-full text-left">
                <thead class="bg-stone-100 text-stone-600">
                    <tr>
                        <th class="p-4 font-semibold italic text-sm">Origin</th>
                        <th class="p-4 font-semibold italic text-sm">Stok</th>
                        <th class="p-4 font-semibold italic text-sm">Level</th>
                        <th class="p-4 font-semibold italic text-sm">Tanggal Masuk</th>
                        <th class="p-4 font-semibold italic text-sm text-center">Status</th>
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <th class="p-4 font-semibold italic text-sm text-center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    <?php foreach ($beans as $row): ?>
                        <tr class="hover:bg-amber-50/30 transition">
                        <td class="p-4 font-bold text-stone-700"><?= htmlspecialchars($row['origin']) ?></td>
                        <td class="p-4 text-stone-600 font-mono"><?= number_format($row['stock_kg'], 1) ?> kg</td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase border 
                                <?= $row['roast_level'] === 'Dark' ? 'border-stone-800 text-stone-800' : 'border-amber-600 text-amber-700' ?>">
                                <?= $row['roast_level'] ?>
                            </span>
                        </td>
                        <td class="p-4 text-stone-500 text-sm">
                            <?= !empty($row['arrival_date']) ? date('d M Y', strtotime($row['arrival_date'])) : '-' ?>
                        </td>
                        <td class="p-4 text-center">
                            <?= $row['is_organic'] ? '<span class="text-green-600 text-sm">🌿 Organic</span>' : '<span class="text-stone-400 text-xs">Reguler</span>' ?>
                        </td>
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-4">
                                    <a href="edit.php?id=<?= $row['id'] ?>" class="text-blue-500 hover:text-blue-700 font-bold text-xs uppercase tracking-widest">Edit</a>
                                    <a href="?delete=<?= $row['id'] ?>" class="text-red-400 hover:text-red-600 font-bold text-xs uppercase tracking-widest" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                                </div>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>