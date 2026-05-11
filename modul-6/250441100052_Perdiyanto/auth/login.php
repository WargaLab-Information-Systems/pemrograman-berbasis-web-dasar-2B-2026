<?php 

session_start();

require "../config/koneksi.php";

if (isset($_POST["submit"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = mysqli_prepare($konek,
    "SELECT * FROM users WHERE nama = ?");

    mysqli_stmt_bind_param($query,  "s", $username);

    mysqli_stmt_execute($query);

    $result = mysqli_stmt_get_result($query);

    if (mysqli_num_rows($result) === 1) {

        $data = mysqli_fetch_assoc($result);

        if (password_verify($password, $data["password"])) {

            $_SESSION["login"] = true;
            $_SESSION["user_id"] = $data["id"];
            $_SESSION["nama"] = $data["nama"];

            echo "<script>
                  alert('Berhasil Login');
                  </script>";
            header("location: ../dashboard.php");
        } else {

            echo "<script>
                  alert('Password tidak sesuai')
                  </script>";
        }

    } else {

        echo "<script>
              alert('Username tidak ditemukan')
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
                    <h1 class="text-2xl font-bold text-center text-sky-500 mb-10"> LOGIN </h1>
                    <label for="username" class="block mb-2 text-slate-600 font-semibold">Username:</label>
                    <input type="text" id="username" name="username" placeholder="username" required class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-500 mb-5">

                    <label for="password" class="block mb-2 text-slate-600 font-semibold">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Password" required class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-500 mb-5">

                    <button type="submit" name="submit" class="w-full bg-sky-500 p-3 rounded-full text-white font-bold text-lg mb-5">Submit</button>
                </form>
                <p class="inline mr-15 mt-10">Belum Punya Akun?</p>
                <a href="register.php" class=" text-blue-700">Gabung Di Sini</a>
            </div>
        </div>
    </body>
</html>
