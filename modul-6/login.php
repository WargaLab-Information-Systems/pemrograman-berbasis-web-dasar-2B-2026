<?php
require 'db.php'; 
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user) {
        $error = "User tidak ditemukan!";
    } else {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Roastery Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-100 flex items-center justify-center min-h-screen font-sans">
    <div class="bg-white p-10 rounded-2xl shadow-xl w-full max-w-md border-t-8 border-amber-800">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-stone-800">Selamat Datang</h2>
            <p class="text-stone-500 mt-2">Silakan masuk ke sistem inventaris</p>
        </div>

        <?php if(!empty($error)): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-6 text-sm flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-5">
            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1">Username</label>
                <input type="text" name="username" required 
                       placeholder="Masukkan username"
                       class="w-full px-4 py-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1">Password</label>
                <input type="password" name="password" required 
                       minlength="5"
                       placeholder="Masukkan password"
                       class="w-full px-4 py-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
            </div>
            <button type="submit" 
                    class="w-full bg-amber-800 text-white font-bold py-3 rounded-lg hover:bg-amber-900 shadow-lg transform hover:scale-[1.02] transition duration-200">
                MASUK KE SISTEM
            </button>
            <div class="mt-6 text-center">
                <p class="text-sm text-stone-500">Belum punya akun? 
                    <a href="register.php" class="text-amber-800 font-bold hover:underline">Daftar di sini</a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>