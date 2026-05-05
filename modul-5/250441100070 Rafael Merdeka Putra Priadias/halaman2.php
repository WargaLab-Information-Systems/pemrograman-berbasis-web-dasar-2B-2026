<?php
date_default_timezone_set('Asia/Jakarta');
function highlightTahun($tahun, $tahun_penting)
{
    if (in_array($tahun, $tahun_penting)) {
        return 'font-bold text-blue-700';
    }
    return 'text-gray-700';
}

$timeline = array(
    array(
        'tahun' => 2025,
        'judul' => 'Masuk Kuliah',
        'cerita' => 'Mulai kuliah jurusan Sistem Informasi, kenalan pertama dengan dunia IT dan logika pemrograman.'
    ),
    array(
        'tahun' => 2026,
        'judul' => 'Belajar HTML & CSS',
        'cerita' => 'Belajar dasar-dasar web, membuat halaman statis pertama dengan HTML dan styling sederhana pakai CSS.'
    ),
    array(
        'tahun' => 2026,
        'judul' => 'Mulai Belajar PHP & MySQL',
        'cerita' => 'Belajar backend dasar, membuat CRUD sederhana dan koneksi database MySQL menggunakan PHP native.'
    ),
    array(
        'tahun' => 2026,
        'judul' => 'Proyek Pertama',
        'cerita' => 'Menyelesaikan proyek web pertama: sistem absensi sederhana untuk tugas kuliah menggunakan PHP + MySQL.'
    ),
);

$tahun_penting = array(2022, 2024);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Timeline Belajar Coding</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto space-y-6">

        <h1 class="text-xl font-bold">Timeline Perjalanan Belajar Coding</h1>
        <div class="bg-white border border-gray-300 p-5">
            <?php
            $total = count($timeline);
            $i = 0;
            foreach ($timeline as $item):
                $i++;
                $kelasWarna = highlightTahun($item['tahun'], $tahun_penting);
                $isLast = ($i == $total);
                ?>
                <div class="flex gap-4 <?php echo $isLast ? '' : 'mb-6'; ?>">
                    <div class="flex flex-col items-center">
                        <div
                            class="w-3 h-3 rounded-full mt-1 <?php echo in_array($item['tahun'], $tahun_penting) ? 'bg-blue-600' : 'bg-gray-400'; ?>">
                        </div>
                        <?php if (!$isLast): ?>
                            <div class="w-px flex-1 bg-gray-300 mt-1"></div>
                        <?php endif; ?>
                    </div>
                    <div class="pb-2">
                        <p class="text-sm <?php echo $kelasWarna; ?>">
                            <?php echo $item['tahun']; ?> — <?php echo $item['judul']; ?>
                            <?php if (in_array($item['tahun'], $tahun_penting)): ?>
                                <span class="ml-1 text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded">Penting</span>
                            <?php endif; ?>
                        </p>
                        <p class="text-xs text-gray-500 mt-1"><?php echo $item['cerita']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="flex gap-3 text-sm">
            <a href="halaman1.php" class="bg-white border border-gray-300 px-4 py-1.5 rounded hover:bg-gray-50">Profil</a>
            <a href="halaman3.php" class="bg-blue-600 text-white px-4 py-1.5 rounded hover:bg-blue-700">Blog</a>
        </div>

    </div>
</body>

</html>