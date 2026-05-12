<?php

session_start();

include '../config/koneksi.php';

/** @var mysqli $conn */

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_user = trim($_POST['nama_user']);
    $email = trim($_POST['email']);
    $password_user = $_POST['password_user'];
    $cek = $conn->prepare("SELECT id_user FROM users WHERE email = ?");
    $cek->bind_param("s", $email);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {

        echo "<script>alert('Email sudah digunakan, silakan gunakan email lain.');</script>";

    } else {

        $hash_password = password_hash($password_user, PASSWORD_DEFAULT);
        $role = "user";

        $stmt = $conn->prepare("
            INSERT INTO users (nama_user, email, password_user, role)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "ssss",
            $nama_user,
            $email,
            $hash_password,
            $role
        );

        if ($stmt->execute()) {

            header("Location: login.php?register=success");
            exit();

        } else {

            $error = "Registrasi gagal, coba lagi.";

        }

        $stmt->close();
    }

    $cek->close();
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Bengkel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width: 400px;">
            <h2 class="text-center mb-4">Register</h2>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="nama_user" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password_user" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <p class="text-center mt-3"> Sudah punya akun?<a href="login.php">Login</a></p>
        </div>
    </div>
</body>

</html>