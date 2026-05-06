<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Perjalanan Belajar</title>
    <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: sans-serif;
      background: #f5f5f5;
      display: flex;
      justify-content: center;
      padding: 2rem 1rem;
    }

    .container {
      background: white;
      border-radius: 10px;
      padding: 2rem;
      width: 100%;
      max-width: 520px;
      border: 1px solid #ddd;
      margin-top: 1rem;
    }

    h2 {
      font-size: 18px;
      font-weight: 500;
      color: #222;
      margin-bottom: 1.5rem;
    }

    .timeline {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-bottom: 1.5rem;
    }

    .timeline-item {
      padding: 10px 14px;
      border-left: 3px solid #4f46e5;
      background: #f9f9ff;
      border-radius: 0 6px 6px 0;
      font-size: 14px;
      color: #333;
    }

    .nav-links {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .btn-link {
      text-decoration: none;
      background: #4f46e5;
      color: white;
      padding: 8px 14px;
      border-radius: 6px;
      font-size: 13px;
    }

    .btn-link:hover { background: #4338ca; }
    </style>
</head>
<body>

<div class="container">
    <h2>2. Timeline Perjalanan Belajar Coding</h2>

    <?php
    // Struktur Data: Array Asosiatif
    $riwayat_belajar = [
        2022 => "Mulai belajar hardware komputer.",
        2023 => "Mempelajari bahasa pemrograman c++.",
        2024 => "Mengikuti seminar web developer bangkalan.",
        2025 => "Membuat aplikasi game sederhana menggunakan scrath",
        2026 => "Mengerjakan proyek web 'BzMe' menggunakan JavaScript & CSS."
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