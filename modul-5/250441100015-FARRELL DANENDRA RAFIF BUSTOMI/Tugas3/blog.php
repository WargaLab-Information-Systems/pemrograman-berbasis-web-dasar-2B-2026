<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Reflektif Developer</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #04183b;
            font-size: medium;
        }

        .blog {
            padding: 20px 10px;
        }

        .judul-link {
            border-radius: 5px;
            background-color: #07baf0;
            padding: 10px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .judul-link:hover {
            text-decoration: underline;
            background-color: #068eb8;
        }

        h2 {
            color: white;
            text-align: center;
            padding: 10px;
        }

        img {
            width: 500px;
            margin-left: 10px;
            border-radius: 5px;
        }

        .tanggalPosting {
            color: white;
            font-size: small;
            margin-left: 10px;
        }

        p {
            color: white;
            text-align: justify;
            margin-left: 10px;
            margin-bottom: 20px;
        }

        .bacaLink {
            margin-left: 10px;
            text-decoration: none;
            color: white;
            font-size: small;
            padding: 6px;
            background-color: #07baf0;
            border-radius: 3px;
            transition: 0.3s;
        }

        .bacaLink:hover {
            text-decoration: underline;
            background-color: #068eb8;
        }

        blockquote {
            margin-left: 10px;
            margin-top: 35px;
            color: white;
            padding: 15px;
            background-color: #1e293b;
            width: 50%;
            font-style: italic;
            border-radius: 5px;
            border-left: 7px solid #07baf0;
        }

        .tombol {
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 10px;
            margin-top: 10px;
        }

        .tombol a {
            text-decoration: none;
            color: white;
        }

        .timeline {
            background-color: #e2960a;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .timeline:hover {
            background-color: #9e6c10;
            transition: 0.3s;
        }

        .profil {
            background-color: #3082fc;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .profil:hover {
            background-color: #1e57c8;
            transition: 0.3s;
        }
    </style>
</head>

<body>
    <?php
    $blog = [
        "html" => [
            "judul" => "Apa itu koding?",
            "tanggalPosting" => "30 September 2020",
            "isi" => "Coding adalah salah satu tindakan dari langkah-langkah pemrograman dengan menuliskan kode atau skrip dalam bahasa pemrograman. Supaya skrip tersebut dapat dipahami oleh komputer, maka saat proses coding kamu harus mengikuti aturan sintaks yang berlaku. Aturan sintaks sangat tergantung dari bahasa pemrograman apa yang kamu gunakan saat menuliskan skrip.",
            "gambar" => "img/coding.jpg",
            "link" => "https://www.dicoding.com/blog/apa-itu-coding/"
        ],
        "error" => [
            "judul" => "Error: Pengertian, Jenis, dan Dampaknya",
            "tanggalPosting" => "20 February 2025",
            "isi" => "Secara umum, error adalah kesalahan atau penyimpangan dari suatu standar atau aturan yang telah ditetapkan. Kesalahan ini bisa terjadi secara tidak disengaja akibat faktor teknis, kesalahan manusia, atau ketidaksempurnaan sistem.Dalam ilmu komputer, error sering dikaitkan dengan kegagalan program dalam menjalankan perintah yang telah ditentukan. Sementara dalam hukum, error bisa terjadi dalam bentuk kesalahan penulisan atau interpretasi suatu pasal.",
            "gambar" => "img/error.jpg",
            "link" => "https://pekerja.com/info/error-pengertian-jenis-dan-dampaknya/"
        ]
    ];
    foreach ($blog as $key => $data) {
        echo "<div class='blog'>";
        ;
        echo "<a class='judul-link' href='?blog=$key'>" . $data['judul'] . "</a> <br>";
        echo "</div>";
    }
    if (isset($_GET['blog']) && array_key_exists($_GET['blog'], $blog)) {
        $key = $_GET['blog'];
        $data = $blog[$key];
    }
    if (isset($data)) {
        echo "<h2>" . $data['judul'] . "</h2>";
        echo "<img src='" . $data['gambar'] . "' width='200'><br>";
        echo "<p class='tanggalPosting'>" . $data['tanggalPosting'] . "</p>";
        echo "<p>" . $data['isi'] . "</p>";
        echo "<a class='bacaLink' href='" . $data['link'] . "' target='_blank'>Baca selengkapnya...</a>";
    }
    $quotes = [
        "Coding itu latihan, bukan bakat",
        "Error adalah guru terbaik",
        "Ngoding pelan asal paham lebih baik daripada cepat tapi bingung",
        "Pemrograman bukan tentang apa yang kamu ketahui, tetapi tentang apa yang dapat kamu cari tahu.",
        "Kode lebih sering dibaca daripada ditulis.",
        "Kode itu seperti humor. Saat Anda harus menjelaskannya, itu berarti humornya buruk."
    ];

    $randomQuote = $quotes[array_rand($quotes)];

    echo "<blockquote>$randomQuote</blockquote>";
    ?>
    <div class="tombol">
        <a href="../Tugas1/index.php" class="profil">Halaman Profil</a>
        <a href="../Tugas2/timeline.php" class="timeline">Halaman Timeline</a>
    </div>
</body>

</html>