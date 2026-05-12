<?php
require 'db.php';
require 'auth.php';

if ($_SESSION['role'] !== 'admin') { header("Location: dashboard.php"); exit(); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $origin = $_POST['origin'];
    $stock = $_POST['stock_kg'];
    $roast = $_POST['roast_level'];
    $arrival = $_POST['arrival_date'];
    $organic = isset($_POST['is_organic']) ? 1 : 0;

    $stmt = $pdo->prepare("INSERT INTO coffee_beans (origin, stock_kg, roast_level, arrival_date, is_organic) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$origin, $stock, $roast, $arrival, $organic]);
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md border-t-4 border-amber-700">
        <h2 class="text-xl font-bold mb-6 text-slate-700">Tambah Inventaris Kopi</h2>
        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm mb-1">Asal Biji (Origin)</label>
                <input type="text" name="origin" required placeholder="Gayo, Aceh" class="w-full border p-2 rounded focus:ring-2 focus:ring-amber-500 outline-none">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm mb-1">Stok (kg)</label>
                    <input type="number" step="0.01" name="stock_kg" min="0" required class="w-full border p-2 rounded focus:ring-2 focus:ring-amber-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm mb-1">Roast Level</label>
                    <select name="roast_level" class="w-full border p-2 rounded">
                        <option value="Light">Light</option>
                        <option value="Medium">Medium</option>
                        <option value="Dark">Dark</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm mb-1">Tanggal Datang</label>
                <input type="date" name="arrival_date" required class="w-full border p-2 rounded">
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="is_organic" id="org" class="mr-2">
                <label for="org" class="text-sm">Biji Kopi Organik</label>
            </div>
            <div class="flex gap-2 pt-4">
                <button type="submit" class="bg-amber-700 text-white flex-1 py-2 rounded hover:bg-amber-800 transition">Simpan</button>
                <a href="dashboard.php" class="bg-slate-200 text-slate-700 flex-1 py-2 text-center rounded hover:bg-slate-300">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>