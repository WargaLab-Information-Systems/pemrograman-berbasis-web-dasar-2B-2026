<?php

require 'db.php';  
require 'auth.php'; 

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    header("Location: dashboard.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM coffee_beans WHERE id = ?");
$stmt->execute([$id]);
$bean = $stmt->fetch();

if (!$bean) {
    die("Data tidak ditemukan di sistem.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $origin = trim($_POST['origin']);
    $stock  = $_POST['stock_kg'];
    $roast  = $_POST['roast_level'];
    $date   = $_POST['arrival_date'];
    $organic = isset($_POST['is_organic']) ? 1 : 0;

    try {
        $update = $pdo->prepare("UPDATE coffee_beans SET origin=?, stock_kg=?, roast_level=?, arrival_date=?, is_organic=? WHERE id=?");
        $update->execute([$origin, $stock, $roast, $date, $organic, $id]);

        header("Location: dashboard.php?msg=update_success");
        exit();
    } catch (PDOException $e) {
        $error = "Gagal mengupdate data: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Inventaris Kopi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-100 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden border-t-8 border-amber-800">
        <div class="p-8">
            <h2 class="text-2xl font-bold text-stone-800 mb-2">Edit Stok Biji Kopi</h2>
            <p class="text-stone-500 text-sm mb-6">Perbarui informasi ketersediaan green beans di gudang.</p>

            <?php if(isset($error)): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-6 text-sm italic">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-stone-700">Asal Biji (Origin)</label>
                    <input type="text" name="origin" required 
                           value="<?= htmlspecialchars($bean['origin'] ?? '') ?>"
                           class="w-full mt-1 px-4 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 outline-none transition">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-stone-700">Stok (kg)</label>
                        <input type="number" step="0.1" name="stock_kg" required 
                               value="<?= htmlspecialchars($bean['stock_kg'] ?? '0') ?>"
                               class="w-full mt-1 px-4 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-stone-700">Roast Level</label>
                        <select name="roast_level" class="w-full mt-1 px-4 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 outline-none transition">
                            <option value="Light" <?= ($bean['roast_level'] ?? '') == 'Light' ? 'selected' : '' ?>>Light</option>
                            <option value="Medium" <?= ($bean['roast_level'] ?? '') == 'Medium' ? 'selected' : '' ?>>Medium</option>
                            <option value="Dark" <?= ($bean['roast_level'] ?? '') == 'Dark' ? 'selected' : '' ?>>Dark</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-stone-700">Tanggal Datang</label>
                    <input type="date" name="arrival_date" required 
                           value="<?= htmlspecialchars($bean['arrival_date'] ?? '') ?>"
                           class="w-full mt-1 px-4 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 outline-none transition">
                </div>

                <div class="flex items-center gap-2 py-2">
                    <input type="checkbox" name="is_organic" id="org" <?= ($bean['is_organic'] ?? 0) ? 'checked' : '' ?>
                           class="w-4 h-4 text-amber-800 border-stone-300 rounded focus:ring-amber-500">
                    <label for="org" class="text-sm text-stone-700 font-medium cursor-pointer">Sertifikasi Biji Organik</label>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" 
                            class="flex-1 bg-amber-800 text-white font-bold py-3 rounded-xl hover:bg-amber-900 shadow-lg transform hover:scale-[1.02] transition">
                        SIMPAN PERUBAHAN
                    </button>
                    <a href="dashboard.php" 
                       class="flex-1 bg-stone-200 text-stone-700 font-bold py-3 text-center rounded-xl hover:bg-stone-300 transition">
                        BATAL
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>