<?php 

require "../config/koneksi.php";

function registrasi($data) {
    global $konek;
    $username = strtolower($data["username"]);
    $email = $data["email"];
    $password = $data["password"]; 
    $password2 = $data["password2"]; 

    if ($password !== $password2) {
        echo "<script>
              alert('konfirmasi password tidak sesuai')
              </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $cek = mysqli_prepare($konek, "SELECT * FROM users WHERE nama = ?");

    mysqli_stmt_bind_param($cek, "s", $username);

    mysqli_stmt_execute($cek);

    $result = mysqli_stmt_get_result($cek);


    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('User sudah terdaftar')
            </script>";
        return false;
    }

    $stmt = mysqli_prepare($konek,
        "INSERT INTO users (nama, email, password)
        VALUES (?, ?, ?)");
    
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);

    mysqli_stmt_execute($stmt);

    return mysqli_affected_rows($konek);
} 


if (isset($_POST["submit"])) {

    if (registrasi($_POST) > 0) {
        echo "<script>
              alert('User baru berhasil ditambahkan')
              </script>";
        header("Location: login.php");
    exit;
    } else {
        echo "<script>
              alert('User baru gagal ditambahkan')
              </script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body class=" bg-slate-100">
        <div class="w-full md:w-2/3 md:mx-auto flex justify-center items-center p-10 h-screen">
            <div class="bg-white w-full md:w-1/2 p-8 rounded-lg shadow-lg">
                <form action="" method="post">
                    <h1 class="text-2xl font-bold text-center text-sky-500 mb-10"> REGISTER </h1>
                    <label for="username" class="block mb-2 text-slate-600 font-semibold">Username:</label>
                    <input type="text" id="username" name="username" placeholder="username" required class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-500 mb-5">

                    <label for="email" class="block mb-2 text-slate-600 font-semibold">Gmail:</label>
                    <input type="email" id="email" name="email" placeholder="email" required class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-500 mb-5">

                    <label for="password" class="block mb-2 text-slate-600 font-semibold">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Password" required class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-500 mb-5">

                    <label for="password2" class="block mb-2 text-slate-600 font-semibold">Konfirmasi Password:</label>
                    <input type="password" id="password2" name="password2" placeholder="Password" required class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-500 mb-5">

                    <button type="submit" name="submit" class="w-full bg-sky-500 p-3 rounded-full text-white font-bold text-lg">Submit</button>
                </form>
            </div>
        </div>
    </body>
</html>