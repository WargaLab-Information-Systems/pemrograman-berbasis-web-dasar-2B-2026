<?php
include 'config.php';

if (isset($_POST['register'])){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user';

    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);
    if ($stmt->execute()) {

        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
    } else {
        $error = "Username sudah digunakan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
<body class="bg-4 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold text-center mb-4">Daftar</h2>
        <form method="POST">
            <div class="flex items-center justify-start shadow-lg rounded-full gap-4 pr-none p-4 mb-4">
                <img src="asset/icon_username.webp" alt="" class="w-8 h-8">
                <input type="text" name="username" id="" required placeholder="Username Baru" class="text-start border-l border-black pl-2 w-full">
            </div>
            <div class="flex items-center justify-start shadow-lg rounded-full gap-4 pr-none p-4 mb-8">
                <img src="asset/icon_pass.webp" alt="" class="w-8 h-8">
                <input type="password" name="password" required id="" placeholder="password" class="text-start border-l border-black pl-2 w-full">
            </div>
            <button type="submit" name="register" class="p-4 bg-3 text-white font-semibold rounded-full block mx-auto mb-4">Daftar Sekarang</button>
            <a href="login.php">Sudah Punya <span class="text-3 underline">Akun?</span></a>
        </form>
    </div>
</body>
</html>