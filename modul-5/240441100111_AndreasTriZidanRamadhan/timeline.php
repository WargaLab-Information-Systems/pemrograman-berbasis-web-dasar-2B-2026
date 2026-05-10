<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline</title>
    <style>
    body {
    background-color: oklch(96.8% 0.007 247.896);
    padding: 24px;
    }

    .container {
        background-color: white;
        border-radius: 1rem;
        max-width: 56rem;
        margin-left: auto;
        margin-right: auto;
        padding: 32px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
    }

    h2  {
        font-family: sans-serif;
        font-weight: 700;
        text-align: center;
    }

    .contain {
        padding: 48px;
        margin-left: 32px;
        border-left: 4px solid;
        background-color: oklch(97.9% 0.021 166.113);
    }

    .tahun-teks {
        display: block;
        font-size: 1.5rem;
        font-weight: bolder;
        margin-bottom: 5px;
        color: oklch(37.8% 0.077 168.94);
    }
    .highlight {
        color: oklch(39.6% 0.141 25.723);
        font-size: 2rem;
        text-transform: uppercase;
    }

    .isi-teks {
        background-color: oklch(84.5% 0.143 164.978);
        padding: 8px;
        border-radius: 0.5rem;
        color: white;
        font-size: 18px;
    }

    .nav {
        display: flex;
        justify-content: space-between;
        padding-top: 48px;
        height: auto;
    }

    .btn {
        text-decoration: none;
        padding: 15px 20px;
        border-radius: 5px;
        margin: 0 5px;
        font-weight: bold;
        background-color: oklch(27.9% 0.041 260.031);
        color: white;
    }
    </style>
</head>
<body>
    <div class="container">
        <h2>Timeline Perjalanan Belajar Coding</h2>
        <?php
            $data_timeline = [
                "2021" => "Mulai masuk sekolah di MAN 1 Lamongan jurusan MIPA, 
                dalam MIPA terdapat penjurusan lagi yakni prodistik disana aku
                memulai belajar basic programming yakni pengenalan logika.",
                "2023" => "Pada Saat kelas 3 aku mulai belajar menggunakan Tools penunjang
                yaitu Adobe Flash yang mempelajari tentang membuat animasi, disana mulai 
                menekuni pembelajaran logika.",
                "2024" => "Resmi menjadi Mahasiswa Prodi Sistem Informasi di Universitas 
                Trunojoyo Madura, di sinilah aku mulai mempelajari basic pemrograman mulai dari 
                basic logika, dasar manajemen dll.",
                "2025" => "Disela-sela dunia perkuliahan aku juga ikut organisasi daerah yakni 
                IKAMALA(Ikatan Mahasiswa Lamongan) dan UKM-FT ITC(Information Technology Center) 
                sebagai pembelajaran softskill",
                "2026" => "Di semester 4 ini aku mulai mempelajari pemrograman web yang dimulai dari 
                basic html hingga framework CSS, pada masa ini aku sering sekali menonton youtube untuk 
                mempelajari tentang web dan terkadang belajar otoditak agar paham fundamentalnya.",
            ];
        
        function custom($a,$b){
            if ($a == $b){
                return 'highlight';
            }
        return "";
        }
        $tahun_spesial = "2024";
        ?>

        <div class="contain">
            <?php
                foreach ($data_timeline as $tahun => $isi){
                    $status_kelas = custom($tahun,$tahun_spesial);
            ?>
            <span class="tahun-teks <?php echo $status_kelas ?>">
                <?php echo $tahun; ?>
            </span>
            <p class="isi-teks">
                <?php echo $isi; ?>
            </p>

            <?php
            } ?>
        </div>
    <div class="nav">
        <a href="index.php" class="btn">← Kembali Ke Profil</a>
        <a href="blog.php" class="btn">Menuju Blog Developer →</a>
    </div>
    </div>
</body>
</html> 