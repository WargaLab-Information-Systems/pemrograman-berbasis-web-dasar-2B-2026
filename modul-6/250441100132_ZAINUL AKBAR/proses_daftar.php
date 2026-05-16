<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_tim     = mysqli_real_escape_string($koneksi, $_POST['nama_tim']);
    $nama_kapten  = mysqli_real_escape_string($koneksi, $_POST['nama_kapten']);
    $no_hp        = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $id_ff        = mysqli_real_escape_string($koneksi, $_POST['id_ff']);
    $anggota      = mysqli_real_escape_string($koneksi, $_POST['anggota']);

    $query = "INSERT INTO tim (nama_tim, nama_kapten, no_hp, id_ff, anggota) 
              VALUES ('$nama_tim', '$nama_kapten', '$no_hp', '$id_ff', '$anggota')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php?pesan=berhasil");
    } else {
        echo "Gagal mendaftar: " . mysqli_error($koneksi);
    }
}
?>