<!DOCTYPE html>
<html>
<head>
    <title>Timeline</title>
    <style>
        .timeline {border-left: 3px solid black; margin:20px; padding:10px;}
        .item {margin:10px 0;}
        .highlight {color:red; font-weight:bold;}
    </style>
</head>
<body>

<h2>Timeline Belajar Coding</h2>

<?php
$timeline = [
    "2025"=>"Masuk Kuliah",
    "Maret 2026"=>"Belajar HTML",
    "April 2026"=>"Belajar CSS & JS",
    "Mei 2026"=>"Proyek Website Pertama",
    "Sekarang"=>"Belajar Backend"
];

function highlightYear($year, $target){
    return $year == $target ? "highlight" : "";
}
?>

<div class="timeline">
<?php foreach($timeline as $year=>$event){ ?>
    <div class="item <?php echo highlightYear($year, "2025"); ?>">
        <strong><?php echo $year; ?></strong> - <?php echo $event; ?>
    </div>
<?php } ?>
</div>

<a href="profil.php">Kembali ke Profil</a> |
<a href="blog.php">Menuju Blog</a>

</body>
</html>
