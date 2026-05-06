<?php
$artikel = [
    [
        "judul" => "Belajar boleh, tapi.....",
        "tanggal" => "2025-07-09",
        "isi" => "jangan lupa makan ya , nanti di suapin monyet",
        "gambar" => "gambar2.png"
    ],
    [
        "judul" => "Error Pertama",
        "tanggal" => "2023-07-06",
        "isi" => "Banyak error bikin pusing tapi belajar.",
        "gambar" => "bacabuku.png"
    ]
];

$quotes = [
    "Jangan menyerah!",
    "Coding itu proses.",
    "Error itu guru terbaik."
];

$randomQuote = $quotes[array_rand($quotes)];
?>

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
  margin-bottom: 1.5rem;
  color: #222;
}

h3 {
  font-size: 16px;
  font-weight: 500;
  color: #222;
  margin-bottom: 6px;
}

ul {
  list-style: none;
  margin-bottom: 1rem;
}

ul li {
  padding: 6px 0;
  border-bottom: 1px solid #f0f0f0;
}

ul li a {
  text-decoration: none;
  color: #4f46e5;
  font-size: 14px;
}

ul li a:hover { text-decoration: underline; }

hr {
  border: none;
  border-top: 1px solid #eee;
  margin: 1.2rem 0;
}

p {
  font-size: 14px;
  color: #444;
  margin-top: 6px;
  line-height: 1.6;
}

img {
  margin-top: 10px;
  border-radius: 6px;
  border: 1px solid #ddd;
}

.quote {
  font-size: 14px;
  color: #777;
  font-style: italic;
}

.btn-link {
  display: inline-block;
  margin-top: 1rem;
  text-decoration: none;
  background: #4f46e5;
  color: white;
  padding: 8px 14px;
  border-radius: 6px;
  font-size: 13px;
}

.btn-link:hover { background: #4338ca; }
</style>

<div class="container">

<h2>Blog Developer</h2>

<ul>
<?php foreach ($artikel as $key => $a): ?>
    <li>
        <a href="?id=<?= $key ?>"><?= $a['judul']; ?></a>
    </li>
<?php endforeach; ?>
</ul>

<hr>

<?php
if (isset($_GET['id'])) {
    $data = $artikel[$_GET['id']];
    echo "<h3>{$data['judul']}</h3>";
    echo "<p>{$data['tanggal']}</p>";
    echo "<p>{$data['isi']}</p>";
    echo "<img src='{$data['gambar']}' width='200'>";
}
?>

<hr>
<p class="quote"><i><?= $randomQuote; ?></i></p>

<br>
<a href="timeline.php" class="btn-link">Kembali ke Timeline</a>

</div>