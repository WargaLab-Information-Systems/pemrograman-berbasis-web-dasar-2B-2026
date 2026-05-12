<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_input = $_POST['username'];
    $pass_input = $_POST['password']; 

    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $user_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($data = $result->fetch_assoc()) {
        if (password_verify($pass_input, $data['password'])) {
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Password salah! Pastikan password di database sudah di-hash.";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Login - Maritim Inventory</title>
</head>
<body class="bg-slate-900 flex justify-center items-center h-screen">
    <div class="w-96">
        <form method="POST" class="bg-white p-8 rounded-t-lg shadow-2xl border-t-4 border-blue-600">
            <h2 class="text-3xl font-bold mb-6 text-center text-slate-800">⚓ Log In</h2>
            
            <?php if (isset($error)): ?>
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 mb-4 text-sm">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-1">Username</label>
                <input type="text" name="username" required class="w-full border p-2.5 rounded outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-1">Password</label>
                <input type="password" name="password" required class="w-full border p-2.5 rounded outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-bold hover:bg-blue-700 transition">MASUK</button>
        </form>

        <div class="bg-slate-50 p-4 rounded-b-lg text-center text-sm border-t">
            Belum punya akun? <a href="registrasi.php" class="text-blue-600 font-bold hover:underline">Registrasi</a>
        </div>
    </div>
</body>
</html>