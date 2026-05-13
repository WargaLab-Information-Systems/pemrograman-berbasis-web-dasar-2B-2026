<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");  
$data = mysqli_fetch_assoc($query);

if ($data) {
    if (password_verify($password, $data['password'])) {

        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role'];

        if ($data['role'] == 'Admin') {
            header("Location: admin/index.php");
        } else {
            header("Location: user/index.php");
        }
    } else {
        echo "<script>alert('Password Salah!'); window.location='index.php';</script>";
    }
} else {
    echo "<script>alert('Username Tidak Ditemukan!'); window.location='index.php';</script>";
}
