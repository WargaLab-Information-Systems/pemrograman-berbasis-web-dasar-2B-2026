<?php
$articles = [
    "html-dasar" => [
        "title" => "Belajar HTML Pertama Kali",
        "date" => "14 Februari 2026",
        "content" => "Masih teringat jelas antusiasme saat pertama kali mengetik <code>&lt;h1&gt;Hello World&lt;/h1&gt;</code> dan melihatnya muncul di browser. Itu adalah momen 'sihir' yang membuat saya jatuh cinta pada dunia web development. Meskipun awalnya bingung dengan struktur tag, namun ini adalah fondasi terpenting perjalanan saya.",
        "img" => "https://images.unsplash.com/photo-1516321318423-f06f70d504d0?auto=format&fit=crop&w=500&q=60",
        "link" => "https://www.w3schools.com/html/"
    ],
    "error-syntax" => [
        "title" => "Drama Error Pertama & Semicolon",
        "date" => "29 April 2026",
        "content" => "Pernah menghabiskan waktu 2 jam hanya karena lupa satu tanda titik koma (;) di PHP? Saya pernah. Kejadian itu mengajarkan saya bahwa ketelitian adalah kunci. Error bukan musuh, melainkan guru yang paling jujur dalam memberitahu di mana letak kekurangan logika kita.",
        "img" => "https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=500&q=60",
        "link" => "https://www.php.net/manual/en/language.errors.php"
    ],
    "mastering-css" => [
        "title" => "Menjinakkan CSS Layouting",
        "date" => "05 April 2026",
        "content" => "Memindahkan sebuah div ke tengah layar (centering div) terasa seperti pencapaian besar kala itu. Dari Float, ke Flexbox, hingga akhirnya jatuh cinta pada Tailwind CSS. Proses ini menyadarkan saya bahwa tampilan yang indah harus dibarengi dengan struktur kode yang bersih.",
        "img" => "https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=500&q=60",
        "link" => "https://tailwindcss.com/"
    ]
];

$quotes = [
    "“First, solve the problem. Then, write the code.” – John Johnson",
    "“Code is like humor. When you have to explain it, it’s bad.” – Cory House",
    "“Don’t write better code, write code that is easier to understand.”",
    "“Programmer adalah mesin yang mengubah kafein menjadi baris kode.”",
    "“Jangan berhenti saat lelah, berhentilah saat selesai.”"
];
$randomQuote = $quotes[array_rand($quotes)];

$slug = $_GET['id'] ?? null;
$selectedArticle = $articles[$slug] ?? null;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Reflektif Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .active-article { border-left: 4px solid #6366f1; background-color: #f8fafc; }
    </style>
</head>
<body class="bg-white text-slate-800 min-h-screen">

    <div class="max-w-6xl mx-auto px-4 py-12">

        <header class="text-center mb-16">
            <h1 class="text-4xl font-bold mb-4">Blog Reflektif</h1>
            <div class="inline-block px-6 py-3 bg-indigo-50 border-l-4 border-indigo-500 italic text-indigo-700">
                <?php echo $randomQuote; ?>
            </div>
        </header>

        <div class="flex flex-col md:flex-row gap-12">
            <aside class="md:w-1/3">
                <h2 class="text-xl font-bold mb-6 flex items-center">
                    <span class="mr-2">📚</span> Daftar Artikel
                </h2>
                <div class="space-y-3">
                    <?php foreach ($articles as $id => $item): ?>
                        <a href="?id=<?php echo $id; ?>" 
                           class="block rounded-xl border border-transparent hover:border-slate-200 overflow-hidden transition-all <?php echo ($slug === $id) ? 'active-article shadow-lg border-slate-200' : 'hover:shadow-md'; ?>">
                            <img src="<?php echo $item['img']; ?>" alt="<?php echo $item['title']; ?>" 
                                 class="w-full h-40 object-cover bg-slate-200"
                                 onerror="this.src='https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=400&q=80'">
                            <div class="p-4">
                                <h3 class="font-semibold text-slate-700 line-clamp-2"><?php echo $item['title']; ?></h3>
                                <span class="text-xs text-slate-400"><?php echo $item['date']; ?></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="mt-12 pt-8 border-t border-slate-100">
                    <a href="tugas2.php" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center gap-2">
                        ← Kembali ke Timeline Belajar
                    </a>
                </div>
            </aside>
            <main class="md:w-2/3 border-t md:border-t-0 md:border-l border-slate-100 md:pl-12 pt-8 md:pt-0">
                <?php if ($selectedArticle): ?>
                    <article class="animate-in fade-in duration-500">
                        <img src="<?php echo $selectedArticle['img']; ?>" alt="Ilustrasi" 
                             class="w-full h-64 object-cover rounded-2xl mb-8 bg-slate-200" 
                             onerror="this.src='https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80'">
                        
                        <span class="text-indigo-600 font-semibold tracking-wider text-sm uppercase"><?php echo $selectedArticle['date']; ?></span>
                        <h2 class="text-3xl font-bold mt-2 mb-6"><?php echo $selectedArticle['title']; ?></h2>
                        
                        <div class="prose prose-slate lg:prose-lg text-slate-600 leading-relaxed mb-8">
                            <p><?php echo $selectedArticle['content']; ?></p>
                        </div>

                        <a href="<?php echo $selectedArticle['link']; ?>" target="_blank" 
                           class="inline-flex items-center text-indigo-600 font-bold hover:underline">
                            Baca Referensi Tambahan 
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    </article>
                <?php else: ?>
                    <div class="h-full flex flex-col items-center justify-center text-center py-20 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                        <span class="text-6xl mb-4">👈</span>
                        <h3 class="text-xl font-bold text-slate-400">Pilih artikel di samping<br>untuk membaca refleksi.</h3>
                    </div>
                <?php endif; ?>
            </main>
        </div>
    </div>

</body>
</html>