<!DOCTYPE html>
<html>
<head>
    <title>Blog Developer</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        a { text-decoration: none; color: blue; }
        a:hover { text-decoration: underline; }
        img { margin-top: 10px; border-radius: 8px; }
        blockquote { font-style: italic; color: gray; }
        .container { display: flex; gap: 40px; }
        .list { width: 30%; }
        .detail { width: 70%; }
    </style>
</head>
<body>

<h2>Blog Reflektif Developer</h2>

<?php
$artikel = [
    "html"=>[
        "judul"=>"Belajar HTML Pertama Kali",
        "tanggal"=>"Maret 2026",
        "isi"=>"Saat pertama kali belajar HTML, saya sempat bingung dengan banyaknya tag. Namun setelah mencoba membuat halaman sederhana, saya mulai memahami struktur dasar website.",
        "gambar"=>"pic1.png"
    ],
    "error"=>[
        "judul"=>"Error Pertama",
        "tanggal"=>"Maret 2026",
        "isi"=>"Saya mengalami error pertama kali karena tidak menaruk file gambar yang akan dipasang di website dalam satu folder yang sama.",
        "gambar"=>"pic2.png"
    ],
    "project"=>[
        "judul"=>"Project Pertama",
        "tanggal"=>"April 2026",
        "isi"=>"Saya berhasil membuat website pertama saya. Walaupun sederhana, pengalaman ini sangat berkesan karena saya bisa melihat hasil kerja saya tampil di browser.",
        "gambar"=>"pic3.png"
    ]
];

$quotes = [
    "MANTAPPP!",
    "ITS OKAY BELAJAR LAGI YAK.",
    "HMZZ BOLEHLAH."
];


$randomQuote = $quotes[array_rand($quotes)];
?>

<div class="container">

<div class="list">
    <h3>Daftar Artikel</h3>
    <?php
    foreach($artikel as $key=>$a){
        echo "<p><a href='?artikel=$key'>".$a['judul']."</a></p>";
    }
    ?>
</div>

<div class="detail">
<?php
if(isset($_GET['artikel']) && isset($artikel[$_GET['artikel']])){

    $data = $artikel[$_GET['artikel']];

    echo "<h3>{$data['judul']}</h3>";
    echo "<p><b>{$data['tanggal']}</b></p>";
    echo "<p>{$data['isi']}</p>";

    $pathGambar = $data['gambar'];
    if(file_exists($pathGambar)){
        echo "<img src='$pathGambar' width='250'>";
    } else {
        echo "<p style='color:red;'>Gambar tidak ditemukan </p>";
    }

    echo "<blockquote>\"$randomQuote\"</blockquote>";
    echo "<p><a href='https://www.w3schools.com' target='_blank'>Referensi Belajar</a></p>";

} else {
    echo "<p><i>Silakan pilih artikel untuk melihat detail.</i></p>";
}
?>
</div>

</div>

<br><br>
<a href="profil.php">← Kembali ke Profil</a> |
<a href="timeline.php">Ke Timeline →</a>

</body>
</html>