<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass_raw = $_POST['password']; // Simpan teks asli untuk pengecekan jika perlu
    $role = $_POST['role'];

    // 1. CEK APAKAH USERNAME SUDAH ADA DI DATABASE
    $check_stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $check_stmt->bind_param("s", $user);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika username sudah ada, tampilkan pesan peringatan
        $error_msg = "Username '$user' sudah digunakan! Silakan pilih nama lain.";
    } else {
        // 2. JIKA USERNAME BELUM ADA, BARU LAKUKAN INSERT
        $pass_hashed = password_hash($pass_raw, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user, $pass_hashed, $role);

        if ($stmt->execute()) {
            echo "<script>alert('Registrasi Berhasil! Silakan Login.'); window.location='login.php';</script>";
            exit();
        } else {
            $error_msg = "Terjadi kesalahan saat mendaftar.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Registrasi - Maritim Inventory</title>
</head>

<body class="bg-slate-800 flex justify-center items-center h-screen">
    <div class="w-96">
        <form method="POST" class="bg-white p-8 rounded-lg shadow-xl border-t-4 border-blue-500">
            <h2 class="text-2xl font-bold mb-6 text-center text-slate-800">Daftar Akun Baru</h2>

            <?php if (isset($error_msg)): ?>
                <div class="bg-amber-100 border-l-4 border-amber-500 text-amber-700 p-3 mb-4 text-sm">
                    ⚠️ <?= htmlspecialchars($error_msg) ?>
                </div>
            <?php endif; ?>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Username</label>
                <input type="text" name="username" required
                    class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 outline-none transition"
                    value="<?= isset($user) ? htmlspecialchars($user) : '' ?>">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold mb-1">Role</label>
                <select name="role" class="w-full border p-2 rounded bg-gray-50">
                    <option value="user">User Biasa</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button
                class="w-full bg-blue-600 text-white p-2 rounded font-bold hover:bg-blue-700 transition duration-300">
                DAFTAR SEKARANG
            </button>

            <p class="text-center mt-4 text-sm text-gray-600">
                Sudah punya akun? <a href="login.php" class="text-blue-500 hover:underline">Login di sini</a>
            </p>
        </form>
    </div>
</body>

</html>