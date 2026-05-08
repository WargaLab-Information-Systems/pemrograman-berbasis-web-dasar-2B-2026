<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Reflektif Developer</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 750px;
            margin: 0 auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #9b59b6;
            padding-bottom: 8px;
        }
        .article-list ul {
            list-style-type: none;
            padding-left: 0;
        }
        .article-list li {
            padding: 8px 0;
            border-bottom: 1px dashed #ccc;
        }
        .article-list a {
            text-decoration: none;
            color: #9b59b6;
            font-weight: 600;
        }
        .article-list a:hover {
            color: #8e44ad;
        }
        .post-box {
            background-color: #faf7fc;
            padding: 20px;
            margin-top: 20px;
            border-left: 4px solid #9b59b6;
            border-radius: 4px;
        }
        .quote {
            font-style: italic;
            color: #555;
            background: #eee;
            padding: 10px;
            border-radius: 4px;
            margin-top: 15px;
        }
        .navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btn-link {
            text-decoration: none;
            background-color: #3498db;
            color: #fff;
            padding: 8px 12px;
            border-radius: 4px;
        }
        .btn-link:hover {
            background-color: #2980b9;
        }
        .back-nav {
            margin-top: 20px;
        }
        img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>3. Blog Reflektif Developer</h2>

    <?php
    // Array Artikel
    $articles = [
        0 => [
            "title" => "Belajar HTML dan CSS Pertama Kali",
            "date" => "10 Maret 2026",
            "reflection" => "Pengalaman pertama mempraktikkan struktur dasar web. Tantangan terbesar adalah memahami konsep layout dan CSS Flexbox yang awalnya terasa membingungkan, namun sangat puas saat berhasil.",
            "image" => "img/html_css.jpg",
            "link" => "https://developer.mozilla.org/en-US/docs/Learn"
        ],
        1 => [
            "title" => "Error Pertama: Debugging PHP",
            "date" => "05 April 2026",
            "reflection" => "Pernah mendapat error White Screen of Death akibat kesalahan penulisan fungsi. Pengalaman tersebut mengajarkan saya untuk membaca log dengan teliti dan menjadi developer yang lebih sabar.",
            "image" => "img/php_error.jpg",
            "link" => "https://www.php.net/manual/en/tutorial.firstpage.php"
        ],
        2 => [
            "title" => "Implementasi Database pada Projek BzMe",
            "date" => "22 April 2026",
            "reflection" => "Menerapkan kueri relasi dan agregasi pada tabel. Tantangan utama saat mengelola data adalah memastikan DDL dan DML berjalan efisien serta aman dari kesalahan input.",
            "image" => "img/database.jpg",
            "link" => "https://www.w3schools.com/sql/"
        ]
    ];

    // Daftar Kutipan Motivasi Acak
    $quotes = [
        "Setiap baris kode yang Anda tulis adalah investasi pada diri Anda sendiri.",
        "Programmer yang baik adalah programmer yang terus belajar, bahkan dari error-nya.",
        "Kompleksitas adalah musuh dari eksekusi yang baik.",
        "Kopi dan kesabaran adalah bahan bakar utama seorang developer."
    ];
    $random_quote = $quotes[array_rand($quotes)];
    ?>

    <div class="article-list">
        <h3>Daftar Artikel</h3>
        <ul>
            <?php foreach ($articles as $id => $artikel): ?>
                <li>
                    <a href="blog.php?id=<?php echo $id; ?>">
                        <?php echo $artikel["title"]; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php
    // Menampilkan detail artikel jika id tersedia pada URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id_artikel = (int)$_GET['id'];

        if (array_key_exists($id_artikel, $articles)) {
            $artikel_aktif = $articles[$id_artikel];
            ?>
            <div class="post-box">
                <h3><?php echo $artikel_aktif["title"]; ?></h3>
                <p><small>Diposting pada: <?php echo $artikel_aktif["date"]; ?></small></p>
                <p><strong>Refleksi Pengalaman:</strong> <?php echo $artikel_aktif["reflection"]; ?></p>
                
                <div>
                    <strong>Ilustrasi:</strong>
                    <br>
                    <img src="<?php echo $artikel_aktif["image"]; ?>" alt="Ilustrasi" onerror="this.src='https://via.placeholder.com/600x250?text=Gambar+Artikel'">
                </div>

                <div class="quote">
                    <strong>Motivasi Hari Ini:</strong><br>
                    "<?php echo $random_quote; ?>"
                </div>

                <p style="margin-top:15px;">
                    <a href="<?php echo $artikel_aktif["link"]; ?>" target="_blank">Baca Referensi Tambahan</a>
                </p>

                <div class="navigation">
                    <div>
                        <?php if ($id_artikel > 0): ?>
                            <a href="blog.php?id=<?php echo $id_artikel - 1; ?>" class="btn-link">&laquo; Sebelumnya</a>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?php if ($id_artikel < count($articles) - 1): ?>
                            <a href="blog.php?id=<?php echo $id_artikel + 1; ?>" class="btn-link">Selanjutnya &raquo;</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <div class="back-nav">
        <a href="index.php" class="btn-link" style="background:#7f8c8d;">Kembali ke Profil Utama</a>
    </div>
</div>

</body>
</html>