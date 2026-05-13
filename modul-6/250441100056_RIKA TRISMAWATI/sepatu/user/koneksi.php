<?php
$conn = mysqli_connect("localhost", "root", "", "sepatu");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
