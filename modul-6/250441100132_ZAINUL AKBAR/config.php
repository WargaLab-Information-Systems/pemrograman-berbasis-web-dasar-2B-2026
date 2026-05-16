<?php
session_start(); // Tambahkan ini BARIS PERTAMA

// Koneksi Database Laragon
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'turnamen_ff';

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>