<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Timeline Belajar — Sekar</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  body { font-family: 'Plus Jakarta Sans', sans-serif; }
  .gradient-text { background: linear-gradient(135deg, #db2777, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
  .titem { opacity: 0; transform: translateX(-16px); animation: slideIn .4s ease forwards; }
  @keyframes slideIn { to { opacity: 1; transform: translateX(0); } }
</style>
</head>
<body class="bg-pink-50 min-h-screen">

<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-pink-100 px-6 py-3 flex items-center gap-2">
  <span class="font-bold text-pink-600 text-lg mr-auto"></span>
  <a href="tugas_praktikum_1.php" class="text-sm px-4 py-2 rounded-full text-gray-500 hover:bg-pink-100 transition">📋 Profil</a>
  <a href="tugas_praktikum_2.php" class="text-sm px-4 py-2 rounded-full bg-pink-500 text-white font-medium">📅 Timeline</a>
  <a href="tugas_praktikum_3.php" class="text-sm px-4 py-2 rounded-full text-gray-500 hover:bg-pink-100 transition">📝 Blog</a>
</nav>

<div class="text-center pt-12 pb-6 px-4">
  <span class="inline-block text-xs font-semibold tracking-widest text-pink-500 uppercase bg-pink-100 px-4 py-1 rounded-full mb-4">Learning Journey</span>
  <h1 class="text-4xl font-bold text-gray-900 mb-1">Timeline <span class="gradient-text">Perjalanan</span><br>Belajar Coding</h1>
  <p class="text-gray-400 text-sm mt-2">Setiap langkah tertulis di sini</p>
</div>

<div class="max-w-2xl mx-auto px-4 pb-16">

<?php
$riwayat = [
  ['tahun'=>2025,'bulan'=>'Agustus','judul'=>'Masuk Kuliah Sistem Informasi','desk'=>'Resmi jadi mahasiswa SI dan mulai mengenal dunia pemrograman dari nol.','tag'=>'Milestone','highlight'=>false],
  ['tahun'=>2025,'bulan'=>'September','judul'=>'Berkenalan dengan Git & GitHub','desk'=>'Belajar version control pertama kali. Bye-bye file index_FINAL_v3_beneran.php!','tag'=>'Tools','highlight'=>false],
  ['tahun'=>2025,'bulan'=>'Desember','judul'=>'Proyek Pertama: Sistem Reservasi','desk'=>'Proyek kelompok pakai Python. Database crash pas deadline, tapi dapat B+ juga!','tag'=>'Project','highlight'=>false],
  ['tahun'=>2026,'bulan'=>'Maret','judul'=>'Belajar HTML & CSS Pertama Kali','desk'=>'Melihat halaman web sendiri muncul di browser — ada rasa ajaib yang tidak terlupakan!','tag'=>'Frontend','highlight'=>false],
  ['tahun'=>2026,'bulan'=>'April','judul'=>'Mulai Belajar JavaScript & DOM','desk'=>'Validasi form, manipulasi DOM — JavaScript bikin pusing sekaligus ketagihan.','tag'=>'Frontend','highlight'=>false],
  ['tahun'=>2026,'bulan'=>'April','judul'=>'Bootstrap & Tailwind CSS','desk'=>'Kenalan sama utility-first CSS. Landing page jadi rapi tanpa ribet nulis CSS dari nol.','tag'=>'Frontend','highlight'=>false],
  ['tahun'=>2026,'bulan'=>'April','judul'=>'Jatuh Cinta pada React.js','desk'=>'Komponen reusable & state reaktif — seperti sihir yang masuk akal. Ini jalurku!','tag'=>' Milestone','highlight'=>true],
];

$total = count($riwayat);
$tahunList = array_unique(array_column($riwayat, 'tahun'));
$highlight = count(array_filter($riwayat, fn($r) => $r['highlight']));
?>


<div class="relative pl-10">
  <div class="absolute left-3.5 top-0 bottom-0 w-0.5 bg-gradient-to-b from-pink-200 to-transparent"></div>

  <?php foreach ($riwayat as $i => $item):
    $hl  = $item['highlight'];
    $del = $i * 80;
    $tag = htmlspecialchars($item['tag']);
    $dotClass  = $hl ? 'bg-pink-500 border-pink-500 shadow-pink-200 shadow-md' : 'bg-white border-pink-200';
    $cardClass = $hl ? 'border-pink-300 bg-gradient-to-br from-pink-50 to-white' : 'border-pink-100 bg-white';
  ?>
  <div class="titem mb-5" style="animation-delay:<?= $del ?>ms">
    <div class="absolute left-1.5 mt-4 w-4 h-4 rounded-full border-2 <?= $dotClass ?>"></div>
    <div class="<?= $cardClass ?> border rounded-2xl px-5 py-4 hover:border-pink-300 hover:translate-x-1 transition-all">
      <div class="flex items-center gap-2 mb-2 flex-wrap">
        <span class="<?= $hl ? 'bg-pink-500 text-white' : 'bg-pink-100 text-pink-600' ?> text-xs font-bold px-3 py-0.5 rounded-full"><?= $item['tahun'] ?></span>
        <span class="text-xs text-gray-400">📅 <?= $item['bulan'] ?></span>
        <span class="text-xs bg-pink-50 text-pink-400 px-2 py-0.5 rounded-lg"><?= $tag ?></span>
      </div>
      <h3 class="font-semibold text-gray-800 mb-1"><?= $item['judul'] ?></h3>
      <p class="text-sm text-gray-500 leading-relaxed"><?= $item['desk'] ?></p>
      <?php if ($hl): ?>
        <span class="inline-flex items-center gap-1 mt-2 bg-pink-500 text-white text-xs font-bold px-3 py-1 rounded-full"> Major Milestone</span>
      <?php endif; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<div class="flex gap-3 mt-8">
  <a href="tugas_praktikum_1.php" class="px-5 py-2.5 rounded-xl border border-pink-200 text-pink-600 text-sm font-semibold hover:bg-pink-50 transition">← Kembali ke Profil</a>
  <a href="tugas_praktikum_3.php" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-pink-600 to-pink-400 text-white text-sm font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all">Menuju Blog Developer →</a>
</div>

</div>

</body>
</html>