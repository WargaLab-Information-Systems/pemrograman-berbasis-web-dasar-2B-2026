<?php
include 'auth/cek_login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>SocialFinder</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">

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

            overflow-x:hidden;
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

        .hero{
            min-height:90vh;

            display:flex;
            align-items:center;
        }

        .hero-title{
            font-size:70px;
            font-weight:700;
            line-height:1.1;
        }

        .gradient-text{
            background:
            linear-gradient(
                to right,
                #8b5cf6,
                #ec4899
            );

            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }

        .hero-desc{
            color:#cbd5e1;
            margin-top:20px;
            font-size:20px;
        }

        .btn-main{

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

            font-weight:600;

            margin-right:15px;

            transition:0.3s;
        }

        .btn-main:hover{
            transform:translateY(-3px);
        }

        .btn-outline-custom{

            border:1px solid #8b5cf6;

            padding:14px 28px;

            border-radius:14px;

            color:white;

            text-decoration:none;

            transition:0.3s;
        }

        .btn-outline-custom:hover{
            background:#8b5cf6;
            color:white;
        }

        .hero-image{

            width:100%;

            border-radius:30px;

            box-shadow:
            0 0 40px rgba(168,85,247,0.3);
        }

        .section-title{
            text-align:center;
            margin-top:100px;
            margin-bottom:70px;

            font-size:45px;
            font-weight:700;
        }

        .feature-box{
            text-align:center;
        }

        .feature-icon{
            font-size:70px;
            margin-bottom:20px;
        }

        .feature-title{
            font-size:30px;
            font-weight:600;
        }

        .feature-desc{
            color:#cbd5e1;
            margin-top:15px;
            font-size:18px;
        }

        .footer-box{

            margin-top:100px;

            background:
            rgba(255,255,255,0.05);

            border-radius:30px;

            padding:50px;
        }

        .footer-title{
            font-size:35px;
            font-weight:700;
        }

        .footer-desc{
            color:#cbd5e1;
            margin-top:10px;
        }

        footer{
            text-align:center;
            margin-top:50px;
            margin-bottom:20px;
            color:#94a3b8;
        }

    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark py-3">

    <div class="container">

        <a class="navbar-brand" href="#">
            Social<span class="purple">Finder</span>
        </a>

        <div>

            <a href="meetups/index.php"
               class="text-white text-decoration-none me-4">
                Meetup
            </a>

            <a href="auth/logout.php"
               class="text-danger text-decoration-none">
                Logout
            </a>

        </div>

    </div>

</nav>

<div class="container hero">

    <div class="row align-items-center">

        <div class="col-lg-6">

            <h5 class="purple">
                Hey, welcome back 👋
            </h5>

            <h1 class="hero-title mt-3">

                Good people.
                <br>

                Good vibes.
                <br>

                <span class="gradient-text">
                    Great memories.
                </span>

            </h1>

            <p class="hero-desc">

                Temukan meetup seru,
                perluas circle,
                dan ciptakan momen berharga
                bersama orang baru.

            </p>

            <div class="mt-5">

                <a href="meetups/index.php"
                   class="btn btn-main">
                    Explore Meetup
                </a>

                <a href="meetups/tambah.php"
                   class="btn-outline-custom">
                    Buat Meetup
                </a>

            </div>

        </div>

        <div class="col-lg-6">

            <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?q=80&w=1200&auto=format&fit=crop"
                 class="hero-image">

        </div>

    </div>

</div>

<div class="container">

    <h2 class="section-title">
        Kenapa
        <span class="gradient-text">
            SocialFinder?
        </span>
    </h2>

    <div class="row">

        <div class="col-md-4 feature-box">

            <div class="feature-icon">
                ☕
            </div>

            <div class="feature-title">
                Nongkrong
            </div>

            <div class="feature-desc">
                Temukan meetup santai
                dari komunitas lokal.
            </div>

        </div>

        <div class="col-md-4 feature-box">

            <div class="feature-icon">
                🎵
            </div>

            <div class="feature-title">
                Event
            </div>

            <div class="feature-desc">
                Cari acara musik,
                gigs, dan event skena.
            </div>

        </div>

        <div class="col-md-4 feature-box">

            <div class="feature-icon">
                👥
            </div>

            <div class="feature-title">
                Circle Baru
            </div>

            <div class="feature-desc">
                Kenalan dengan orang baru
                tanpa awkward berlebihan.
            </div>

        </div>

    </div>

    <div class="footer-box">

        <div class="row align-items-center">

            <div class="col-md-8">

                <div class="footer-title">
                    Yuk, mulai petualangan sosialmu!
                </div>

                <div class="footer-desc">
                    Dunia lebih seru kalau dijalani bareng-bareng.
                </div>

            </div>

            <div class="col-md-4 text-end">

                <a href="meetups/index.php"
                   class="btn btn-main">
                    Explore Sekarang
                </a>

            </div>

        </div>

    </div>

</div>

<footer>
    © 2025 SocialFinder. All rights reserved.
</footer>

</body>
</html>