<?php
session_start();
include '../config/koneksi.php';

if(isset($_POST['login'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("
    SELECT * FROM users
    WHERE email = ?
    ");

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            header("Location: ../dashboard.php");
            exit;

        } else {

            echo "
            <script>
                alert('Password salah!');
            </script>
            ";
        }

    } else {

        echo "
        <script>
            alert('Email tidak ditemukan!');
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet">

<style>

*{
    font-family:'Poppins', sans-serif;
}

body{

    background:
    linear-gradient(
        to right,
        #020617,
        #0f172a,
        #111827
    );

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    color:white;
}

.login-box{

    background:
    rgba(255,255,255,0.05);

    border:
    1px solid rgba(255,255,255,0.08);

    border-radius:30px;

    padding:50px;

    width:100%;

    max-width:500px;

    box-shadow:
    0 0 30px rgba(168,85,247,0.15);
}

.title{

    text-align:center;

    font-size:45px;

    font-weight:700;
}

.gradient{

    background:
    linear-gradient(
        to right,
        #8b5cf6,
        #ec4899
    );

    -webkit-background-clip:text;

    -webkit-text-fill-color:transparent;
}

.subtitle{

    text-align:center;

    color:#cbd5e1;

    margin-top:10px;

    margin-bottom:40px;
}

.form-control{

    background:
    rgba(255,255,255,0.06);

    border:none;

    color:white;

    border-radius:15px;

    padding:14px;
}

.form-control:focus{

    background:
    rgba(255,255,255,0.08);

    color:white;

    box-shadow:none;

    border:
    1px solid #8b5cf6;
}

label{
    margin-bottom:10px;
}

.btn-login{

    width:100%;

    padding:14px;

    border:none;

    border-radius:15px;

    background:
    linear-gradient(
        to right,
        #8b5cf6,
        #ec4899
    );

    color:white;

    font-weight:600;

    margin-top:20px;
}

.btn-login:hover{
    opacity:0.9;
}

.register-link{

    text-align:center;

    margin-top:25px;
}

.register-link a{

    color:#a855f7;

    text-decoration:none;
}

.register-link a:hover{
    color:#ec4899;
}

</style>

</head>

<body>

<div class="login-box">

    <h1 class="title">

        Social<span class="gradient">Finder</span>

    </h1>

    <p class="subtitle">

        Welcome back.
        Temukan circle terbaikmu ✨

    </p>

    <form method="POST">

        <div class="mb-4">

            <label>Email</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   required>

        </div>

        <div class="mb-4">

            <label>Password</label>

            <input type="password"
                   name="password"
                   class="form-control"
                   required>

        </div>

        <button type="submit"
                name="login"
                class="btn-login">

            Login

        </button>

    </form>

    <div class="register-link">

        Belum punya akun?

        <a href="register.php">

            Register di sini

        </a>

    </div>

</div>

</body>
</html>