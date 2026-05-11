<?php
include '../auth/cek_login.php';
include '../config/koneksi.php';

$id = $_GET['id'];

$stmt = $conn->prepare("
SELECT meetups.*, users.name
FROM meetups
JOIN users ON meetups.user_id = users.id
WHERE meetups.id = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();


$member = $conn->prepare("
SELECT users.name
FROM meetup_members
JOIN users ON meetup_members.user_id = users.id
WHERE meetup_members.meetup_id = ?
");

$member->bind_param("i", $id);
$member->execute();

$members = $member->get_result();



$count = $conn->prepare("
SELECT COUNT(*) as total
FROM meetup_members
WHERE meetup_id = ?
");

$count->bind_param("i", $id);
$count->execute();

$totalMember = $count->get_result()->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Detail Meetup</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet">

<style>

*{
    font-family:'Poppins', sans-serif;
}

body{

    background:
    linear-gradient(
        to right,
        #020617,
        #0f172a,
        #111827
    );

    color:white;
}

.detail-box{

    background:
    rgba(255,255,255,0.05);

    border:
    1px solid rgba(255,255,255,0.08);

    border-radius:30px;

    padding:40px;

    margin-top:50px;
}

.title{

    font-size:50px;

    font-weight:700;
}

.info{

    color:#cbd5e1;

    margin-top:25px;

    line-height:2;
}

.creator{

    margin-top:20px;

    color:#a855f7;
}

.btn-join{

    margin-top:30px;

    background:
    linear-gradient(
        to right,
        #8b5cf6,
        #ec4899
    );

    border:none;

    padding:14px 28px;

    border-radius:14px;

    color:white;

    text-decoration:none;

    display:inline-block;

    font-weight:600;
}

.btn-join:hover{
    opacity:0.9;
}

.member-box{

    margin-top:40px;

    background:
    rgba(255,255,255,0.04);

    border-radius:20px;

    padding:25px;
}

.member-item{

    padding:12px 0;

    border-bottom:
    1px solid rgba(255,255,255,0.05);
}

.back-link{

    color:#cbd5e1;

    text-decoration:none;
}

.back-link:hover{
    color:white;
}

</style>

</head>

<body>

<div class="container">

    <div class="detail-box">

        <a href="index.php"
           class="back-link">

           ← Kembali

        </a>

        <h1 class="title mt-4">
            <?= htmlspecialchars($data['title']) ?>
        </h1>

        <div class="creator">

            Dibuat oleh
            <?= htmlspecialchars($data['name']) ?>

        </div>

        <div class="info">

            📝
            <?= htmlspecialchars($data['description']) ?>

            <br><br>

            📍
            <?= htmlspecialchars($data['location_name']) ?>

            <br><br>

            🏠
            <?= htmlspecialchars($data['address']) ?>

            <br><br>

            🗓️
            <?= htmlspecialchars($data['meetup_date']) ?>

            <br><br>

            👥 Max Peserta:
            <?= htmlspecialchars($data['max_people']) ?>

            <br><br>

            📌 Maps:
            <a href="<?= htmlspecialchars($data['maps_link']) ?>"
               target="_blank"
               class="text-info">

               Lihat Lokasi

            </a>

        </div>

        <a href="join.php?id=<?= $data['id'] ?>"
           class="btn-join">

           Join Grup

        </a>

        <div class="member-box">

            <h4>
                Member Join
                (<?= $totalMember['total'] ?>)
            </h4>

            <?php while($m = $members->fetch_assoc()) { ?>

                <div class="member-item">

                    👤
                    <?= htmlspecialchars($m['name']) ?>

                </div>

            <?php } ?>

        </div>

    </div>

</div>

</body>
</html>