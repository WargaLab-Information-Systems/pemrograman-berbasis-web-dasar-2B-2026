<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Perjalanan Belajar</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 650px;
            margin: 0 auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #e74c3c;
            padding-bottom: 8px;
        }
        .timeline {
            position: relative;
            margin: 30px 0;
            padding-left: 20px;
            border-left: 4px solid #e74c3c;
        }
        .timeline-item {
            margin-bottom: 25px;
            position: relative;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -27px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #e74c3c;
            border: 2px solid #fff;
        }
        .highlight {
            font-weight: bold;
            color: #e74c3c;
        }
        .nav-links {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
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
    </style>
</head>
<body>

<div class="container">
    <h2>2. Timeline Perjalanan Belajar Coding</h2>

    <?php
    // Struktur Data: Array Asosiatif
    $riwayat_belajar = [
        2022 => "Mulai belajar dasar-dasar pemrograman Python dan logika.",
        2023 => "Mempelajari web dasar (HTML, CSS) di SMKN 2 Bangkalan.",
        2024 => "Mulai Magang di PT Pelindo Marine Service, fokus pada pengembangan web.",
        2025 => "Menjalani IT Internship di PT Pelindo Marine Service.",
        2026 => "Mengerjakan proyek web 'BzMe' menggunakan HTML & CSS."
    ];

    ?>

    <div class="timeline">
        <?php foreach ($riwayat_belajar as $tahun => $deskripsi): ?>
            <div class="timeline-item">
                <?php echo $tahun . " - " . $deskripsi; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="nav-links">
        <a href="index.php" class="btn-link">&laquo; Kembali ke Profil</a>
        <a href="blog.php" class="btn-link">Menuju Blog Developer &raquo;</a>
    </div>
</div>

</body>
</html>