<?php

$artikel = [
    "html" => [
        "judul" => "Belajar HTML Pertama Kali",
        "tanggal" => "2024-01-10",
        "isi" => "Saya pertama kali belajar HTML dan sangat bingung dengan tag.",
        "gambar" => "error.jpg"
    ],
    "error" => [
        "judul" => "Error Pertama di PHP",
        "tanggal" => "2024-02-15",
        "isi" => "Saya mengalami error saat pertama kali mencoba PHP.",
        "gambar" => "error.jpg"
    ]
];


$quotes = [
    "Coding adalah proses belajar tanpa akhir",
    "Error adalah teman terbaik programmer",
    "Semua programmer pernah jadi pemula"
];

$randomQuote = $quotes[array_rand($quotes)];
?>

<h2>Blog Developer</h2>


<ul>
    <li><a href="?post=html">Belajar HTML Pertama Kali</a></li>
    <li><a href="?post=error">Error Pertama di PHP</a></li>
</ul>

<hr>

<?php
if (isset($_GET['post'])) {
    $post = $_GET['post'];

    if (isset($artikel[$post])) {
        $data = $artikel[$post];

        echo "<h3>" . $data['judul'] . "</h3>";
        echo "<p><b>Tanggal:</b> " . $data['tanggal'] . "</p>";
        echo "<p>" . $data['isi'] . "</p>";

        echo "<img src='" . $data['gambar'] . "' width='200'><br><br>";

        echo "<p><i>Kutipan: $randomQuote</i></p>";

        echo "<a href='https://www.w3schools.com' target='_blank'>Referensi Belajar</a>";
    }
}
?>

<br><br>

<a href="index.php">Kembali Profil</a> |
<a href="index2.php">Timeline</a>