<?php
// includes/koneksi.php
// File koneksi database - pisahkan dari file lain

$DB_HOST ='localhost';
$DB_USER ='root';
$DB_PASS='123123';
$DB_NAME='perpustakaan_mini';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>