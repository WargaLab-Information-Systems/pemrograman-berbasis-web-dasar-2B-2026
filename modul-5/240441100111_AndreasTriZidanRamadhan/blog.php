<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100">
    <?php
        $data_artikel = [
            "artikel1" => [
                "judul" => "Tips untuk Fokus dan Mendalami Pekerjaan sebagai Developer",
                "tgl" => "Maret 21, 2019",
                "isi" => "keahlian dalam dunia pengembangan perangkat lunak bukanlah sekadar 
                hasil dari bakat alami, melainkan buah dari kedisiplinan dalam mengelola atensi. 
                Dengan memandang kode sebagai sebuah karya seni, kita diajak untuk beralih dari jebakan 
                'kesibukan semu' menuju produktivitas yang nyata melalui praktik deep work atau kerja mendalam.",
                "gambar" => "img/1.webp",
                "link" => "https://techarea.co.id/tips-untuk-fokus-dan-mendalami-pekerjaan-sebagai-developer/"
            ],
            "artikel2" => [
                "judul" => "Rekomendasi Sumber Belajar untuk Programmer Pemula",
                "tgl" => "Maret 22, 2019",
                "isi" => "Membangun karier sebagai pengembang web dalam tiga bulan pertama bukan tentang upaya 
                menguasai setiap teknologi secara instan, melainkan tentang memahami bagaimana setiap komponen 
                saling berinteraksi untuk menciptakan solusi digital yang utuh.",
                "gambar" => "img/2.webp",
                "link" => "https://techarea.co.id/rekomendasi-resources-untuk-programmer-pemula/"
            ],
            "artikel3" => [
                "judul" => "Perbedaan Front End dan Back End (4 Aspek Utama)",
                "tgl" => "April 25, 2024",
                "isi" => "Memahami dikotomi antara front end dan back end bukan sekadar memilah bahasa pemrograman, 
                melainkan memahami bagaimana estetika visual dan stabilitas infrastruktur harus bersinergi untuk 
                menciptakan solusi digital yang utuh.",
                "gambar" => "img/3.jpg",
                "link" => "https://techarea.co.id/beda-front-end-back-end/"
            ],
        ];

        $quotes = [
            "Coding itu seperti memancing, butuh kesabaran dan umpan logika yang tepat.",
            "Kesalahan adalah cara kode memberitahumu bahwa ada hal baru yang harus dipelajari.",
            "Jangan berhenti saat lelah, berhentilah saat 'Done' dan No Error.",
            "Sistem Informasi bukan cuma soal data, tapi soal solusi untuk manusia."
        ];
        $kutipan = $quotes[array_rand($quotes)];

    ?>
    <div class="bg-emerald-100 max-w-4xl mx-auto rounded-xl shadow-sm mt-4 min-h-screen">
        <h2 class="text-3xl text-emerald-800 font-bold text-center pt-4">Blog Reflektif Mahasiswa</h2>
        <div class="bg-blue-200  ml-8 mr-auto mt-8 border-l-2 border-black rounded-r-lg shadow-sm p-4">
            <span class="font-bold text-blue-900">Motivasi Hari Ini:</span>
            <p class="text-blue-500 font-semibold italic">
                <?php echo $kutipan; ?>
            </p>
        </div>
        <div class="flex w-full px-8 gap-4 mt-12">
            <div class="w-1/4 bg-white shadow-md p-4 rounded-lg">
                <h3 class="text-lg font-bold mb-4 border-b-2 pb-2">Daftar Artikel</h3>
                <ul class="space-y-4">
                    <?php foreach($data_artikel as $key => $art)  { ?>
                    <li>
                        <a href="blog.php?id=<?php echo $key; ?>">
                            <span class="font-semibold text-slate-700 hover:text-slate-900">&rAarr; <?php echo $art['judul']; ?></span>
                        </a>
                    </li>
                <?php } ?>
                </ul>
            </div>
            <div class="w-3/4 bg-white shadow-md p-4 rounded-lg">
                <?php
                    if (isset($_GET['id']) && array_key_exists($_GET['id'], $data_artikel)) {
                        $artikel = $data_artikel[$_GET['id']];
                ?>
                <h2 class="text-2xl text-slate-900 font-bold mb-2"><?php echo $artikel['judul']; ?></h2>
                <p class="text-sm text-slate-500 mb-4">Diposting pada: <?php echo $artikel['tgl']; ?></p>
                <div class="mb-6 overflow-hidden rounded-lg border border-slate-100 shadow-inner bg-slate-50">
                    <img src="<?php echo $artikel['gambar']; ?>" class="w-full h-auto object-cover max-h-72">
                </div>
                <div class="bg-slate-100 p-4">
                    <h2 class="font-bold text-slate-800 mb-2">Refkeksi:</h2>
                    <p><?php echo $artikel['isi']; ?></p>
                </div>
                <div class="mt-10 pt-6 border-t">
                    <a href="<?php echo $artikel['link'] ?>" target="_blank" class="text-slate-600 font-semibold">Baca referensi teknis lainnya &rarr;</a>
                </div>
                <?php 
                } else {
                ?>
                    <div class="flex flex-col items-center justify-center h-full text-center py-10">
                        <h2 class="text-xl font-bold text-slate-500">Pilih Artikel</h2>
                        <p class="text-slate-400 mt-2">Silakan pilih judul artikel di menu samping untuk membaca detailnya.</p>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="flex gap-8 items-center justify-center">
            <div class="mt-6 pt-6">
                <a href="timeline.php" class="bg-slate-800 text-white font-semibold py-2 px-6 rounded-md shadow-sm">&lAarr; Menuju Timeline</a>
            </div>
            <div class="mt-6 pt-6">
                <a href="index.php" class="bg-slate-800 text-white font-semibold py-2 px-6 rounded-md shadow-sm">&lAarr; Menuju Profil</a>
            </div>
        </div>
    </div>
</body>
</html>