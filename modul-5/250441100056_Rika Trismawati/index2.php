<?php

function highlight($tahun, $isi) {
    if ($tahun == 2024) {
        return "<b style='color:red'>$tahun - $isi</b>";
    }
    return "$tahun - $isi";
}


$timeline = [
    2022 => "Masuk kuliah",
    2023 => "Belajar HTML & CSS",
    2024 => "Membuat project pertama PHP",
    2025 => "Belajar Database MySQL",
    2026 => "Membuat aplikasi web sederhana"
];
?>

<h2>Timeline Perjalanan Belajar Coding</h2>

<div style="border-left:2px solid black; padding-left:10px;">
<?php
foreach ($timeline as $tahun => $isi) {
    echo "<p>" . highlight($tahun, $isi) . "</p>";
}
?>
</div>

<br>

<a href="index.php">Kembali ke Profil</a> |
<a href="index3.php">Menuju Blog Developer</a>