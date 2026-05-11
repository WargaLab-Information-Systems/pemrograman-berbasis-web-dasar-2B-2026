<?php
include '../auth/cek_login.php';
include '../config/koneksi.php';

$query = $conn->query("
SELECT meetups.*, users.name
FROM meetups
JOIN users ON meetups.user_id = users.id
ORDER BY meetup_date ASC
");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Meetups</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>
        .btn-edit{

    background:
    linear-gradient(
        to right,
        #8b5cf6,
        #a855f7
    );

    color:white;

    padding:8px 18px;

    border-radius:12px;

    text-decoration:none;

    border:none;

    font-size:14px;

    margin-right:8px;

    transition:0.3s;
}

.btn-edit:hover{

    opacity:0.85;

    color:white;
}

.btn-delete{

    background:
    linear-gradient(
        to right,
        #ec4899,
        #f43f5e
    );

    color:white;

    padding:8px 18px;

    border-radius:12px;

    text-decoration:none;

    border:none;

    font-size:14px;

    transition:0.3s;
}

.btn-delete:hover{

    opacity:0.85;

    color:white;
}

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

        .navbar{

            background:rgba(0,0,0,0.3);

            backdrop-filter:blur(10px);

            border-bottom:
            1px solid rgba(255,255,255,0.1);
        }

        .navbar-brand{
            font-size:30px;
            font-weight:700;
        }

        .purple{
            color:#a855f7;
        }

        .page-title{

            font-size:55px;
            font-weight:700;

            margin-top:60px;
        }

        .subtitle{
            color:#cbd5e1;
            margin-top:10px;
        }

        .btn-main{

            background:
            linear-gradient(
                to right,
                #8b5cf6,
                #ec4899
            );

            border:none;

            color:white;

            padding:12px 24px;

            border-radius:14px;

            font-weight:600;
        }

        .meetup-card{

            background:
            rgba(255,255,255,0.05);

            border-radius:25px;

            padding:30px;

            margin-top:30px;

            border:
            1px solid rgba(255,255,255,0.08);

            transition:0.3s;
        }

        .meetup-card:hover{

            transform:translateY(-5px);

            border:
            1px solid rgba(168,85,247,0.5);
        }

        .meetup-title{
            font-size:28px;
            font-weight:600;
        }

        .meetup-info{
            color:#cbd5e1;
            margin-top:10px;
        }

        .creator{
            color:#a855f7;
            font-size:14px;
            margin-top:15px;
        }

        .btn-detail{

            margin-top:20px;

            background:#8b5cf6;

            border:none;

            border-radius:12px;

            color:white;

            padding:10px 20px;

            text-decoration:none;

            display:inline-block;
        }

        .btn-detail:hover{
            background:#7c3aed;
        }

    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark py-3">

    <div class="container">

        <a class="navbar-brand" href="../dashboard.php">
            Social<span class="purple">Finder</span>
        </a>

        <div>

            <a href="../dashboard.php"
               class="text-white text-decoration-none me-4">
                Dashboard
            </a>

            <a href="../auth/logout.php"
               class="text-danger text-decoration-none">
                Logout
            </a>

        </div>

    </div>

</nav>

<div class="container">

    <div class="d-flex
                justify-content-between
                align-items-center">

        <div>

            <h1 class="page-title">
                Explore Meetup ✨
            </h1>

            <p class="subtitle">
                Cari tongkrongan, event,
                dan circle baru yang cocok buat kamu.
            </p>

        </div>

        <div>

            <a href="tambah.php"
               class="btn btn-main">
                + Buat Meetup
            </a>

        </div>

    </div>

    <?php while($row = $query->fetch_assoc()) { ?>

        <div class="meetup-card">

            <div class="meetup-title">
                <?= htmlspecialchars($row['title']) ?>
            </div>

            <div class="meetup-info">

                📍
                <?= htmlspecialchars($row['location_name']) ?>

                <br><br>

                🗓️
                <?= htmlspecialchars($row['meetup_date']) ?>

                <br><br>

                👥 Max:
                <?= htmlspecialchars($row['max_people']) ?> orang

            </div>

            <div class="creator">

                Dibuat oleh
                <?= htmlspecialchars($row['name']) ?>

            </div>

            <a href="detail.php?id=<?= $row['id'] ?>"
               class="btn-detail">

                Lihat Detail

            </a>
            <a href="edit.php?id=<?= $row['id'] ?>"
                class="btn-edit">

            Edit

            </a>

            <a href="hapus.php?id=<?= $row['id'] ?>"
                class="btn-delete"
                onclick="return confirm('Yakin hapus meetup?')">

                Hapus

            </a>

        </div>

    <?php } ?>

</div>

</body>
</html>