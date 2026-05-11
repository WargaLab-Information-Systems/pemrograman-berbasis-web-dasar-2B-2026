<?php
include '../auth/cek_login.php';
include '../config/koneksi.php';

if(isset($_POST['submit'])){

    $user_id = $_SESSION['user_id'];

    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $location_name = htmlspecialchars($_POST['location_name']);
    $address = htmlspecialchars($_POST['address']);
    $maps_link = htmlspecialchars($_POST['maps_link']);
    $whatsapp_link = htmlspecialchars($_POST['whatsapp_link']);
    $meetup_date = $_POST['meetup_date'];
    $max_people = $_POST['max_people'];

    $stmt = $conn->prepare("
    INSERT INTO meetups
    (user_id,title,description,location_name,address,maps_link,whatsapp_link,meetup_date,max_people)
VALUES(?,?,?,?,?,?,?,?,?)
    ");

    $stmt->bind_param(
        "isssssssi",
        $user_id,
        $title,
        $description,
        $location_name,
        $address,
        $maps_link,
        $whatsapp_link,
        $meetup_date,
        $max_people
    );

    if($stmt->execute()){

        header("Location: index.php");
        exit;

    } else {

        echo "Gagal tambah meetup";

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Buat Meetup</title>

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

        .page-title{

            text-align:center;

            margin-top:50px;

            font-size:50px;

            font-weight:700;
        }

        .subtitle{

            text-align:center;

            color:#cbd5e1;

            margin-bottom:40px;
        }

        .form-box{

            background:
            rgba(255,255,255,0.05);

            border:
            1px solid rgba(255,255,255,0.08);

            border-radius:30px;

            padding:40px;

            box-shadow:
            0 0 30px rgba(168,85,247,0.15);
        }

        .form-control,
        .form-select{

            background:
            rgba(255,255,255,0.06);

            border:none;

            color:white;

            border-radius:15px;

            padding:14px;
        }

        .form-control:focus{

            background:
            rgba(255,255,255,0.08);

            color:white;

            box-shadow:none;

            border:
            1px solid #8b5cf6;
        }

        textarea{
            min-height:120px;
        }

        label{
            margin-bottom:10px;
            font-weight:500;
        }

        .btn-main{

            background:
            linear-gradient(
                to right,
                #8b5cf6,
                #ec4899
            );

            border:none;

            padding:14px;

            border-radius:15px;

            color:white;

            font-weight:600;

            width:100%;

            margin-top:20px;
        }

        .btn-main:hover{
            opacity:0.9;
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

    <h1 class="page-title">
        Buat Meetup ✨
    </h1>

    <p class="subtitle">
        Ajak orang lain nongkrong,
        diskusi, atau cari circle baru.
    </p>

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="form-box">

                <form method="POST">

                    <div class="mb-4">

                        <label>Judul Meetup</label>

                        <input type="text"
                               name="title"
                               class="form-control"
                               required>

                    </div>

                    <div class="mb-4">

                        <label>Deskripsi</label>

                        <textarea name="description"
                                  class="form-control"
                                  required></textarea>

                    </div>

                    <div class="mb-4">

                        <label>Nama Lokasi</label>

                        <input type="text"
                               name="location_name"
                               class="form-control"
                               required>

                    </div>

                    <div class="mb-4">

                        <label>Alamat Lengkap</label>

                        <textarea name="address"
                                  class="form-control"
                                  required></textarea>

                    </div>

                    <div class="mb-4">

                        <label>Link Google Maps</label>

                        <input type="text"
                               name="maps_link"
                               class="form-control"
                               required>

                    </div>

                    <div class="mb-4">
                        <div class="mb-4">

    <label>Link Grup WhatsApp</label>

    <input type="text"
           name="whatsapp_link"
           class="form-control"
           placeholder="https://wa.me6285704483667"
           required>

</div>


                        <label>Tanggal Meetup</label>

                        <input type="datetime-local"
                               name="meetup_date"
                               class="form-control"
                               required>

                    </div>

                    <div class="mb-4">

                        <label>Max Peserta</label>

                        <input type="number"
                               name="max_people"
                               class="form-control"
                               required>

                    </div>

                    <button type="submit"
                            name="submit"
                            class="btn-main">

                        Publish Meetup

                    </button>

                </form>

                <div class="mt-4 text-center">

                    <a href="index.php"
                       class="back-link">

                        ← Kembali ke Meetup

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>