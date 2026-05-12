<?php

session_start();

include '../config/koneksi.php';

/** @var mysqli $conn */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password_user = $_POST['password_user'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        if (password_verify($password_user, $user['password_user'])) {

            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama_user'] = $user['nama_user'];
            $_SESSION['role'] = $user['role'];

            header("Location: ../index.php");
            exit();

        } else {
            echo "<script>alert('Password salah!');</script>";

        }

    } else {
        echo "<script>alert('Email tidak ditemukan!');</script>";
    }

    if (isset($_GET['register'])) {
        echo "Registrasi berhasil, silakan login!";
    }
    $stmt->close();
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bengkel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width: 400px;">
            <h2 class="text-center mb-4">Login</h2>
            <?php if (isset($_GET['register']) && $_GET['register'] == 'success'): ?>
                <div class="alert alert-success">
                    Registrasi berhasil, silakan login!
                </div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password_user" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Login</button>
            </form>
            <p class="text-center mt-3">Belum punya akun?<a href="register.php">Register</a></p>
        </div>
    </div>
</body>

</html>