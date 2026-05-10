<?php 
include 'config.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $username;
            header("Location: index.php");
        }
    }
    $error = "Username atau password salah!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode:'class',
            theme: {
                extend: {
                    colors:{
                        1:'#011f4b',
                        2:'#03396c',
                        3:'#005b96',
                        4:'#6497b1',
                        5:'#b3cde0',
                    }
                },
            },
        }
    </script>
</head>
<body class="bg-4">
    <div class="bg-white max-w-2xl mx-auto h-auto my-20 rounded-xl shadow-sm">
        <div class="py-16 flex flex-col items-center justify-center">
            <h2 class="text-center text-4xl font-semibold pb-4">Login</h2>
            <p class="text-center text-lg pb-10">Selamat Datang di Sistem Log Memancing</p>
            <?php if(isset($error)) echo "<p class='text-red-500 text-sm mb-8'>$error</p>"; ?>
            <form action="" method="POST">
                <div class="flex items-center justify-start bg-white w-96 h-12 rounded-full shadow-xl gap-4 pl-4">
                    <img src="asset/icon_username.webp" alt="" class="w-8 h-8">
                    <input required type="text" placeholder="Username" name="username" class="py-1 pl-4 text-left border-l border-black w-full mr-3">
                </div>
                <div class="flex items-center justify-start bg-white w-96 h-12 rounded-full shadow-xl gap-4 pl-4 mt-10">
                    <img src="asset/icon_pass.webp" alt="" class="w-8 h-8">
                    <input required type="password" placeholder="Password" name="password" class="py-1 pl-4 text-left border-l border-black w-full mr-3">
                </div>
                <div class="flex items-center justify-center gap-12 mt-6">
                    <a href="register.php">Belum Punya Akun? <span class="text-4 underline">Daftar</span></a>
                    <a href="forgot_password.php">Lupa Password?</a>
                </div>
                <div class="flex items-center justify-center">
                    <button class="bg-3 w-72 h-12 mt-8 rounded-full " type="submit" name="login">
                        <span class="text-xl text-white font-semibold">Login</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>