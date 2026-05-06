<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Perjalanan Belajar Coding </title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0f172a;
            font-size: small;
            color: #e2e8f0;
        }

        .form {
            background-color: #28375a;
            padding: 20px;
            border-radius: 5px;
            width: 500px;
            margin: 50px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .timeline {
            border-left: 3px solid black;
            padding-left: 20px;
        }

        .item {
            position: relative;
            margin-bottom: 20px;
            border-radius: 5px;
            padding: 10px;
            background-color: #1e293b;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
            transition: 0.5s;
        }

        .item:hover {
            transform: translateY(10px);
        }

        .item::before {
            content: "";
            position: absolute;
            left: -29px;
            top: 5px;
            width: 15px;
            height: 15px;
            background: red;
            border-radius: 50%;
        }

        .hijau {
            color: #27f527;
            font-weight: bold;
        }

        .biru {
            color: #1335f8;
            font-weight: bold;
        }

        .kuning {
            color: #fbff06;
            font-weight: bold;
        }

        .putih {
            color: #ffffff;
            font-weight: bold;
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

        .blog {
            background-color: #e2960a;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .blog:hover {
            background-color: #9e6c10;
            transition: 0.3s;
        }
    </style>
</head>

<body>
    <div class="form">
        <h1>Timeline Perjalanan Belajar Coding</h1>
        <div class="timeline">
            <?php
            $data = [
                2022 => "Mengenal HTML dan CSS",
                2023 => "Mengenal bahasa pemrograman PHP dan Framework Laravel",
                2024 => "Projek besar pertama menggunakan Framework Laravel",
                2025 => "Masuk Kuliah dan Mengenal bahasa pemrograman Python",
                2026 => "Mengenal Framework Tailwind CSS"
            ];

            function highlight(int $tahun)
            {
                if ($tahun == 2022) {
                    return "hijau";
                } elseif ($tahun == 2024) {
                    return "biru";
                } elseif ($tahun == 2026) {
                    return "kuning";
                } else {
                    return "putih";
                }
            }

            foreach ($data as $tahun => $kegiatan) {
                echo "<div class='item " . highlight($tahun) . "'>";
                echo "<h3>$tahun</h3>";
                echo "<p>$kegiatan</p>";
                echo "</div>";
            }
            ?>
        </div>
        <div class="tombol">
            <a href="../Tugas1/index.php" class="profil">Halaman Profil</a>
            <a href="../Tugas3/blog.php" class="blog">Halaman Blog</a>
        </div>
    </div>
</body>

</html>