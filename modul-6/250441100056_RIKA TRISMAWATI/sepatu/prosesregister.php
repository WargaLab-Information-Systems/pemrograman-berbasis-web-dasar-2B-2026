<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

$cek = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
if (mysqli_num_rows($cek) > 0) {
    echo "Username sudah terdaftar!";
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$query = mysqli_query($conn, "INSERT INTO user (nama, username, password, role)
VALUES ('$nama','$username','$hash','$role')");

if ($query) {
    header("Location: index.php");
} else {
    echo "Registrasi gagal!";
}
