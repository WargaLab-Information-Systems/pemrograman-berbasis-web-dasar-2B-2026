<?php
date_default_timezone_set('Asia/Jakarta');

$artikel = [
    [
        "id" => "html",
        "judul" => "Belajar HTML Pertama Kali",
        "tanggal" => "10 Februari 2026",
        "isi" => "Pertama kali membuka Notepad dan mengetik tag <html>, rasanya seperti membuka pintu ke dunia baru. Saya masih ingat betapa senangnya ketika tulisan 'Hello World' muncul di browser. Dari situ saya mulai paham bahwa web hanyalah teks yang diberi makna oleh tag-tag HTML. Perjalanan panjang dimulai dari satu baris sederhana.",
        "gambar" => "img/gambar_html.jpg",
        "referensi" => [
            "label" => "MDN Web Docs - HTML",
            "url" => "https://developer.mozilla.org/id/docs/Web/HTML"
        ]
    ],
    [
        "id" => "error",
        "judul" => "Error Pertama yang Bikin Panik",
        "tanggal" => "15 Februari 2026",
        "isi" => "Waktu itu saya lupa menutup tag div dan seluruh layout berantakan. Saya sudah mencari-cari kesalahan selama dua jam, sampai akhirnya teman satu kelas menunjuk satu baris kode yang hilang. Momen itu mengajarkan saya untuk selalu teliti dan rajin membaca pesan error karena di situlah kuncinya.",
        "gambar" => "img/eror.jpg",
        "referensi" => [
            "label" => "W3Schools - HTML Debugging",
            "url" => "https://www.w3schools.com/html/html_debugging.asp"
        ]
    ],
    [
        "id" => "php",
        "judul" => "Pertama Kali Pakai PHP",
        "tanggal" => "29 April 2026",
        "isi" => "Belajar PHP terasa seperti melompat dari menggambar ke membangun mesin. Saya bingung kenapa kode saya tidak muncul di browser, sampai sadar bahwa PHP harus dijalankan lewat server bukan langsung dibuka dari file. Sejak itu Laragon jadi teman setia saya setiap hari.",
        "gambar" => "img/belajar_php.jpg",
        "referensi" => [
            "label" => "PHP Manual - Getting Started",
            "url" => "https://www.php.net/manual/en/getting-started.php"
        ]
    ],
];

$kutipan = [
    '"Hidup seperti Lary." – Lary Spongebob',
];
$kutipan_acak = $kutipan[array_rand($kutipan)];

$slug = isset($_GET['artikel']) ? $_GET['artikel'] : '';

$dipilih = null;
foreach ($artikel as $a) {
    if ($a['id'] === $slug) {
        $dipilih = $a;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Blog Developer</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 p-6">

    <div class="max-w-xl mx-auto space-y-6">

        <h1 class="text-xl font-bold">Blog Developer</h1>

        <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded text-sm italic">
            <?php echo $kutipan_acak; ?>
        </div>

        <div class="bg-white border border-gray-300 p-4">
            <h2 class="font-semibold text-sm mb-3">Daftar Artikel</h2>
            <ul class="space-y-2 text-sm">
                <?php foreach ($artikel as $a): ?>
                    <li>
                        <a href="halaman3.php?artikel=<?php echo $a['id']; ?>"
                            class="<?php echo ($slug == $a['id']) ? 'text-blue-700 font-bold' : 'text-blue-600'; ?> hover:underline">
                            → <?php echo $a['judul']; ?>
                        </a>
                        <span class="text-gray-400 text-xs ml-2"><?php echo $a['tanggal']; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <?php if ($dipilih): ?>

            <div class="bg-white border border-gray-300 p-5 space-y-3">

                <h2 class="font-bold text-lg"><?php echo $dipilih['judul']; ?></h2>
                <p class="text-xs text-gray-400">Diposting: <?php echo $dipilih['tanggal']; ?></p>

                <div
                    class="bg-gray-100 border border-gray-200 rounded h-40 flex items-center justify-center overflow-hidden">
                    <img src="<?php echo $dipilih['gambar']; ?>" alt="<?php echo $dipilih['judul']; ?>"
                        onerror="this.style.display='none'; this.nextSibling.style.display='block';"
                        class="h-full w-full object-cover">
                    <span style="display:none;" class="text-xs text-gray-400">
                        [ Gambar: <?php echo $dipilih['gambar']; ?> ]
                    </span>
                </div>

                <p class="text-sm text-gray-700 leading-relaxed">
                    <?php echo $dipilih['isi']; ?>
                </p>

                <p class="text-sm">
                    Referensi:
                    <a href="<?php echo $dipilih['referensi']['url']; ?>" target="_blank"
                        class="text-blue-600 hover:underline">
                        <?php echo $dipilih['referensi']['label']; ?>
                    </a>
                </p>

            </div>

        <?php elseif ($slug != ''): ?>
            <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded text-sm">
                Artikel tidak ditemukan.
            </div>
        <?php else: ?>
            <div class="bg-gray-50 border border-gray-200 text-gray-500 px-4 py-3 rounded text-sm">
                Klik salah satu judul artikel di atas untuk membaca isinya.
            </div>
        <?php endif; ?>

        <div class="flex gap-3 text-sm">
            <a href="halaman2.php" class="bg-white border border-gray-300 px-4 py-1.5 rounded hover:bg-gray-50">
                Timeline
            </a>
        </div>

    </div>
</body>

</html>