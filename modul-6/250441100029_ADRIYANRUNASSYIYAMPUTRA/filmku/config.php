<?php
// config.php
// File ini TIDAK boleh diakses langsung dari browser

$DB_HOST ='localhost';
$DB_USER ='root';
$DB_PASS ='AdriyanPDB_25';          // Kosong untuk XAMPP default
$DB_NAME ='filmku_db';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Cek koneksi — kalau gagal, hentikan program
if ($conn->connect_error) {
  die('Koneksi gagal: ' . $conn->connect_error);
}


// Set charset untuk mendukung karakter Indonesia
$conn->set_charset('utf8mb4');
?>
