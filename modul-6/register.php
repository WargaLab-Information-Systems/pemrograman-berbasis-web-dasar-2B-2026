<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Konfirmasi password tidak cocok!";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->fetch()) {
            $error = "Username sudah terdaftar, silakan gunakan yang lain.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = 'user'; 

            $insert = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            if ($insert->execute([$username, $hashed_password, $role])) {
                header("Location: login.php?register=success");
                exit();
            } else {
                $error = "Terjadi kesalahan saat mendaftar.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi User - Roastery</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-10 rounded-2xl shadow-xl w-full max-w-md border-t-8 border-amber-800">
        <h2 class="text-3xl font-extrabold text-stone-800 text-center mb-2">Buat Akun</h2>
        <p class="text-center text-stone-500 mb-8 text-sm">Daftar untuk melihat inventaris biji kopi</p>

        <?php if(isset($error)): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-6 text-sm">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1">Username</label>
                <input type="text" name="username" required 
                       class="w-full px-4 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1">Password</label>
                <input type="password" name="password" required minlength="5"
                       class="w-full px-4 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="confirm_password" required minlength="5"
                       class="w-full px-4 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 outline-none transition">
            </div>
            <button type="submit" 
                    class="w-full bg-amber-800 text-white font-bold py-3 rounded-lg hover:bg-amber-900 shadow-lg transition">
                DAFTAR SEKARANG
            </button>
            <div class="text-center mt-4">
                <a href="login.php" class="text-sm text-stone-500 hover:underline italic">Sudah punya akun? Login</a>
            </div>
        </form>
    </div>
</body>
</html>