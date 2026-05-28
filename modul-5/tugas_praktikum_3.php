<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Blog Developer — Sekar</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  body { font-family: 'Plus Jakarta Sans', sans-serif; }
  .gradient-text { background: linear-gradient(135deg, #db2777, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
  .detail-wrap { animation: fadeUp .4s ease; }
  @keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
</style>
</head>
<body class="bg-pink-50 min-h-screen">

<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-pink-100 px-6 py-3 flex items-center gap-2">
  <span class="font-bold text-pink-600 text-lg mr-auto"> </span>
  <a href="tugas_praktikum_1.php" class="text-sm px-4 py-2 rounded-full text-gray-500 hover:bg-pink-100 transition">📋 Profil</a>
  <a href="tugas_praktikum_2.php" class="text-sm px-4 py-2 rounded-full text-gray-500 hover:bg-pink-100 transition">📅 Timeline</a>
  <a href="tugas_praktikum_3.php" class="text-sm px-4 py-2 rounded-full bg-pink-500 text-white font-medium">📝 Blog</a>
</nav>

<div class="text-center pt-12 pb-6 px-4">
  <span class="inline-block text-xs font-semibold tracking-widest text-pink-500 uppercase bg-pink-100 px-4 py-1 rounded-full mb-4">Dev Reflections</span>
  <h1 class="text-4xl font-bold text-gray-900 mb-1">Blog <span class="gradient-text">Reflektif</span><br>Developer</h1>
  <p class="text-gray-400 text-sm mt-2">Catatan jujur dari perjalanan coding yang penuh kejutan 📝</p>
</div>

<div class="max-w-4xl mx-auto px-4 pb-16">

<?php
$artikel = [
  'html' => [
    'judul'   => 'Belajar HTML Pertama Kali',
    'tanggal' => '9 Maret 2026',
    'tag'     => 'Frontend',
    'emoji'   => '🌐',
    'isi'     => 'Hari itu saya mengetik tag HTML pertama. Rasanya aneh tapi ajaib — ketika browser menampilkan "Halo Dunia!" dari kode sendiri, ada kepuasan luar biasa. Saya menghabiskan tiga malam hanya bermain dengan heading, tabel, dan list. Tanpa sadar, perjalanan panjang sebagai developer baru saja dimulai. HTML memang terlihat sederhana, tapi memahami semantiknya butuh waktu lebih dari yang saya kira.',
    'ref'     => 'https://developer.mozilla.org/en-US/docs/Learn/HTML',
    'ref_lbl' => 'MDN Web Docs — Belajar HTML',
  ],
  'error' => [
    'judul'   => 'Error Pertama yang Mengajarkan Banyak',
    'tanggal' => '3 September 2025',
    'tag'     => 'Debugging',
    'emoji'   => '🐛',
    'isi'     => 'Satu titik koma yang hilang membuat saya menghabiskan dua jam mencari bug. Waktu itu belum mengenal DevTools — hanya baca kode berulang sambil geleng kepala. Tapi ketika ketemu penyebabnya, rasanya hampir seperti menang lomba. Sejak itu saya belajar membaca pesan error dengan teliti, bukan panik. Pelajaran terbesar: error message adalah teman, bukan musuh.',
    'ref'     => 'https://developer.mozilla.org/en-US/docs/Tools',
    'ref_lbl' => 'MDN — Browser DevTools',
  ],
  'proyek' => [
    'judul'   => 'Proyek Pertama: Sistem Reservasi',
    'tanggal' => '18 Desember 2025',
    'tag'     => 'Project',
    'emoji'   => '🚀',
    'isi'     => 'Proyek kelompok pertama: membuat sistem reservasi pakai PHP dan MySQL. Database crash di hari deadline, tampilan berantakan di mobile — tapi dosen memberi nilai B+ dan berkata "solid untuk pemula". Proyek pertama tidak harus sempurna, yang penting selesai dan mengajarkan sesuatu. Dari sini saya belajar pentingnya testing lebih awal dan komunikasi tim yang baik.',
    'ref'     => 'https://www.php.net/manual/en/',
    'ref_lbl' => 'PHP Manual Resmi',
  ],
  'git' => [
    'judul'   => 'Mengenal Git dan GitHub',
    'tanggal' => '10 September 2025',
    'tag'     => 'Tools',
    'emoji'   => '🌿',
    'isi'     => 'Sebelum Git, file saya bernama index_FINAL_BENERAN_v3.php. Berantakan sekali. Ketika seorang senior memperkenalkan Git, dunia berubah. Commit, branch, merge — semua terasa asing tapi segera jadi rutinitas harian yang tidak bisa ditinggalkan. Pull request pertama saya penuh comment dari senior, tapi dari situ saya belajar lebih banyak daripada seminggu belajar sendiri.',
    'ref'     => 'https://docs.github.com/en/get-started',
    'ref_lbl' => 'GitHub Docs — Memulai dengan Git',
  ],
  'react' => [
    'judul'   => 'Jatuh Cinta pada React.js',
    'tanggal' => '5 Mei 2026',
    'tag'     => ' Milestone',
    'emoji'   => '⚛️',
    'isi'     => 'React adalah cinta pertama di dunia Frontend modern. Komponen yang reusable, state reaktif — semuanya terasa seperti sihir yang masuk akal. Minggu pertama belajar hooks memang berat: useState, useEffect, useContext — semua terasa membingungkan. Tapi begitu "klik", segalanya mengalir. Saya sadar inilah jalur yang ingin saya tekuni. Next.js sudah menunggu di cakrawala.',
    'ref'     => 'https://react.dev/learn',
    'ref_lbl' => 'React — Dokumentasi Resmi',
  ],
];

$kutipan = [
  ['"Code is like humor. When you have to explain it, it\'s bad."', 'Cory House'],
  ['"First, solve the problem. Then, write the code."', 'John Johnson'],
  ['"Talk is cheap. Show me the code."', 'Linus Torvalds'],
  ['"Any fool can write code a computer understands."', 'Martin Fowler'],
  ['"Simplicity is the soul of efficiency."', 'Austin Freeman'],
];

function readTime($text) {
  $words = str_word_count(strip_tags($text));
  return max(1, ceil($words / 200)) . " menit baca";
}

$slugAktif = $_GET['artikel'] ?? '';
$q = $kutipan[array_rand($kutipan)];
?>

<div class="bg-pink-100 border-l-4 border-pink-400 rounded-r-xl px-5 py-4 mb-6 italic text-gray-600 text-sm leading-relaxed">
  💬 <?= $q[0] ?>
  <div class="mt-1 not-italic text-xs text-pink-400 font-semibold uppercase tracking-wider">— <?= $q[1] ?></div>
</div>

<div class="grid grid-cols-1 md:grid-cols-[260px_1fr] gap-6 items-start">

  <aside class="md:sticky md:top-20">
    <div class="text-xs font-semibold text-pink-300 uppercase tracking-widest mb-3">📚 Artikel (<?= count($artikel) ?>)</div>
    <div class="flex flex-col gap-2">
      <?php foreach ($artikel as $slug => $d):
        $active = ($slug === $slugAktif);
        $cls = $active
          ? 'border-pink-400 bg-pink-50 text-pink-700'
          : 'border-pink-100 bg-white text-gray-600 hover:border-pink-200 hover:bg-pink-50';
      ?>
      <a href="tugas_praktikum_3.php?artikel=<?= $slug ?>"
         class="block px-4 py-3 border rounded-xl text-sm transition <?= $cls ?>">
        <span class="font-semibold block mb-0.5"><?= $d['emoji'] ?> <?= $d['judul'] ?></span>
        <span class="text-xs text-gray-400">📅 <?= $d['tanggal'] ?></span><br>
        <span class="inline-block mt-1.5 text-xs bg-pink-100 text-pink-500 font-semibold px-2 py-0.5 rounded-lg uppercase tracking-wider"><?= $d['tag'] ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </aside>

  <main>
    <?php if ($slugAktif !== '' && isset($artikel[$slugAktif])): ?>
      <?php
      $art      = $artikel[$slugAktif];
      $slugList = array_keys($artikel);
      $idx      = array_search($slugAktif, $slugList);
      $prev     = ($idx > 0) ? $slugList[$idx - 1] : null;
      $next     = ($idx < count($slugList) - 1) ? $slugList[$idx + 1] : null;
      $rt       = readTime($art['isi']);
      $prog     = round(($idx + 1) / count($slugList) * 100);
      ?>
      <div class="detail-wrap">
        <div class="bg-white rounded-2xl border border-pink-100 shadow-sm overflow-hidden">
          <div class="h-1 bg-gradient-to-r from-pink-300 to-pink-500" style="width:<?= $prog ?>%"></div>
          <div class="bg-gradient-to-r from-pink-600 to-pink-400 px-6 py-6">
            <h3 class="text-white font-bold text-xl mb-3"><?= $art['emoji'] ?> <?= htmlspecialchars($art['judul']) ?></h3>
            <div class="flex items-center gap-3 flex-wrap">
              <span class="text-pink-100 text-xs">📅 <?= $art['tanggal'] ?></span>
              <span class="text-pink-100 text-xs">⏱ <?= $rt ?></span>
              <span class="bg-white/20 text-white text-xs font-semibold px-3 py-0.5 rounded-full uppercase tracking-wider"><?= htmlspecialchars($art['tag']) ?></span>
            </div>
          </div>
          <div class="px-6 py-6">
            <p class="text-gray-600 leading-relaxed text-[15px] mb-5"><?= htmlspecialchars($art['isi']) ?></p>
            <a href="<?= $art['ref'] ?>" target="_blank"
               class="inline-flex items-center gap-3 bg-pink-50 border border-pink-200 rounded-xl px-4 py-3 text-pink-600 text-sm font-medium hover:bg-pink-100 hover:-translate-y-0.5 transition-all">
              <span class="text-xl">🔗</span>
              <div>
                <div class="text-xs text-pink-300 uppercase tracking-wider mb-0.5">Referensi</div>
                <?= htmlspecialchars($art['ref_lbl']) ?>
              </div>
            </a>
          </div>
          <div class="px-6 pb-6 flex gap-2 flex-wrap">
            <?php if ($prev): ?>
              <a href="tugas_praktikum_3.php?artikel=<?= $prev ?>"
                 class="px-4 py-2 border border-pink-100 text-gray-500 rounded-xl text-sm font-medium hover:bg-pink-500 hover:text-white hover:border-pink-500 transition">
                ← <?= $artikel[$prev]['judul'] ?>
              </a>
            <?php endif; ?>
            <?php if ($next): ?>
              <a href="tugas_praktikum_3.php?artikel=<?= $next ?>"
                 class="px-4 py-2 border border-pink-100 text-gray-500 rounded-xl text-sm font-medium hover:bg-pink-500 hover:text-white hover:border-pink-500 transition">
                <?= $artikel[$next]['judul'] ?> →
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="text-center py-16 px-6 bg-white border-2 border-dashed border-pink-200 rounded-2xl">
        <div class="text-5xl mb-4">📖</div>
        <h3 class="font-bold text-pink-600 text-lg mb-1">Pilih Artikel</h3>
        <p class="text-gray-400 text-sm">Klik salah satu artikel di daftar kiri untuk membacanya.</p>
      </div>
    <?php endif; ?>
  </main>

</div>

<div class="flex gap-3 mt-8">
  <a href="tugas_praktikum_1.php" class="px-5 py-2.5 rounded-xl border border-pink-200 text-pink-600 text-sm font-semibold hover:bg-pink-50 transition">← Profil</a>
  <a href="tugas_praktikum_2.php" class="px-5 py-2.5 rounded-xl border border-pink-200 text-pink-600 text-sm font-semibold hover:bg-pink-50 transition">← Timeline</a>
</div>

</div>
</body>
</html>