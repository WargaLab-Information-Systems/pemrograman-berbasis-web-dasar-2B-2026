<?php
function highlightYear($year) {
    $currentYear = 2026;
    if ($year == $currentYear) {
        return "text-indigo-600 font-bold scale-110 inline-block transform";
    }
    return "text-gray-500 font-medium";
}

$codingJourney = [
    [
        "year" => 2025,
        "title" => "Awal Perjalanan",
        "desc" => "Memulai pendidikan sebagai Mahasiswa Sistem Informasi dan mengenal algoritma dasar.",
        "icon" => "🎓"
    ],
    [
        "year" => 2026,
        "title" => "Eksplorasi Web Dasar",
        "desc" => "Menguasai HTML, CSS, dan dasar-dasar JavaScript untuk membuat website statis.",
        "icon" => "🌐"
    ],
    [
        "year" => 2026,
        "title" => "Deep Dive Backend",
        "desc" => "Mulai mempelajari PHP dan SQL. Membangun sistem database pertama untuk proyek kampus.",
        "icon" => "💾"
    ],
    [
        "year" => 2026,
        "title" => "Framework & Proyek Nyata",
        "desc" => "Menggunakan Tailwind CSS dan Bootstrap. Terlibat dalam pengembangan aplikasi loyalitas.",
        "icon" => "🚀"
    ],
    [
        "year" => 2026,
        "title" => "Transformasi Digital",
        "desc" => "Fokus pada keamanan informasi dan integrasi AI dalam pengembangan full-stack.",
        "icon" => "🤖"
    ]
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Perjalanan Coding</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .timeline-line {
            width: 10px;
            background: linear-gradient(to bottom, #6366f1, #a855f7, #ec4899);
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen py-12 px-4">

    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-extrabold text-slate-800 mb-4">Coding Journey</h1>
            <p class="text-slate-600 text-lg">Jejak langkah pengembangan diri dalam dunia teknologi.</p>
        </div>

        <div class="relative">
            <div class="absolute left-4 md:left-1/2 transform md:-translate-x-1/2 h-full timeline-line rounded-full opacity-20"></div>

            <?php foreach ($codingJourney as $index => $event): ?>
                <div class="mb-12 flex justify-between items-center w-full <?php echo $index % 2 == 1 ? 'md:flex-row-reverse' : ''; ?> relative">
                    <div class="hidden md:block w-5/12"></div>

                    <div class="z-20 flex items-center order-1 bg-white shadow-xl w-10 h-10 rounded-full border-4 border-indigo-500 absolute left-4 md:left-1/2 transform md:-translate-x-1/2">
                        <span class="mx-auto text-sm"><?php echo $event['icon']; ?></span>
                    </div>

                    <div class="order-1 bg-white rounded-2xl shadow-sm border border-slate-100 w-10/12 md:w-5/12 px-6 py-6 transition-all duration-300 hover:shadow-md ml-12 md:ml-0">
                        <span class="<?php echo highlightYear($event['year']); ?> mb-1">
                            <?php echo $event['year']; ?>
                        </span>
                        <h3 class="font-bold text-slate-800 text-xl mb-2"><?php echo $event['title']; ?></h3>
                        <p class="text-slate-600 leading-relaxed text-sm md:text-base">
                            <?php echo $event['desc']; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-20 flex flex-col md:flex-row gap-4 justify-center items-center">
            <a href="tugas1.html" class="px-8 py-3 bg-white text-slate-700 font-semibold rounded-xl border border-slate-200 hover:bg-slate-50 transition-all shadow-sm">
                ← Kembali ke Profil
            </a>
            <a href="tugas3.php" class="px-8 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200">
                Menuju Blog Developer →
            </a>
        </div>
    </div>

</body>
</html>