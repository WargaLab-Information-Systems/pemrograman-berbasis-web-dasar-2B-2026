<?php include 'config.php';

if (isset($_POST['masuk'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $cek = mysqli_query($koneksi, "SELECT * FROM admin WHERE username = '$user'");
    $data = mysqli_fetch_assoc($cek);

    // Cek langsung tanpa enkripsi (biar pasti cocok)
if ($data && $pass == $data['password']) {
        $_SESSION['admin_login'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $pesan = "❌ Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Turnamen FF</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="text-center mb-6">
            <i class="fa fa-fire text-red-600 text-5xl"></i>
            <h2 class="text-2xl font-bold mt-2">LOGIN ADMIN</h2>
            <p class="text-gray-600">Sistem Turnamen Free Fire</p>
        </div>

        <?php if (isset($pesan)): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?= $pesan ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Username</label>
                <input type="text" name="username" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-1">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <button type="submit" name="masuk" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-bold">
                MASUK
            </button>
        </form>
        <div class="text-center mt-4">
            <a href="index.php" class="text-blue-600 hover:underline">← Kembali ke Halaman Utama</a>
        </div>
    </div>
</body>
</html>