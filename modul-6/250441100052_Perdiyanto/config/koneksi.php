<?php 
    $konek = mysqli_connect("localhost", "root", "", "todolist");

    if (!$konek) {
        die("Koneksi gagal: " . mysqli_connect_error());
    } 
?>