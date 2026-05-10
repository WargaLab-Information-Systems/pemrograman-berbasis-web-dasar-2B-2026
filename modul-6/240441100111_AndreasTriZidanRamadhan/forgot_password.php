<?php
include 'config.php';

if (isset($_POST['reset'])) {
    $username = $_POST['username'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check_user = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check_user->bind_param("s", $username);
    $check_user->execute();
    $result = $check_user->get_result();

    if ($result->num_rows > 0) {
        $update = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $update->bind_param("ss", $new_password, $username);
        
        if ($update->execute()) {
            echo "<script>alert('Password berhasil diperbarui! Silakan login.'); window.location='login.php';</script>";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - FishLog</title>
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
        <h2 class="text-2xl font-bold mb-2 text-center">Reset Password</h2>
        <p class="text-gray-500 text-sm mb-6 text-center">Masukkan username dan password baru Anda.</p>
        
        <?php if(isset($error)) echo "<p class='text-red-500 text-sm mb-4'>$error</p>"; ?>
        
        <form method="POST">
            <div class="flex items-center justify-start shadow-lg rounded-full gap-4 pr-none p-4 mb-4">
                <img src="asset/icon_username.webp" alt="" class="w-8 h-8">
                <input type="text" name="username" id="" placeholder="Username Baru" class="text-start border-l border-black pl-2 w-full">
            </div>
            <div class="flex items-center justify-start shadow-lg rounded-full gap-4 pr-none p-4 mb-8">
                <img src="asset/icon_pass.webp" alt="" class="w-8 h-8">
                <input type="password" name="password" required id="" placeholder="password" class="text-start border-l border-black pl-2 w-full">
            </div>
            <button type="submit" name="reset" class="p-4 bg-3 text-white font-semibold rounded-full block mx-auto mb-4">Update Password</button>
        </form>
        <div class="mt-4 text-center">
            <a href="login.php" class="text-sm text-blue-500">Kembali ke Login</a>
        </div>
    </div>
</body>
</html>