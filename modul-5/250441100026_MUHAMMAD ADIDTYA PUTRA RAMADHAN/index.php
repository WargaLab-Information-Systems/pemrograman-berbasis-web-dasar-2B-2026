<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Interaktif Developer</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            max-width: 800px;
            width: 100%;
            margin: 0 auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 1rem;
        }
        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 8px;
            font-size: 20px;
            margin-bottom: 1rem;
        }
        h3, h4 {
            color: #2c3e50;
            margin-top: 1rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dcdcdc;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: #3498db;
            color: #fff;
            width: 30%;
        }
        table tr:nth-child(even) td {
            background: #f9f9f9;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
            background: #fafafa;
            margin-bottom: 5px;
        }
        textarea {
            height: 80px;
            resize: vertical;
        }
        input[type="checkbox"],
        input[type="radio"] {
            margin-right: 4px;
        }
        input[type="submit"] {
            background-color: #2ecc71;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #27ae60;
        }
        .output-box {
            background-color: #e8f4f8;
            padding: 15px;
            border-left: 4px solid #3498db;
            margin-top: 20px;
        }
        .error-msg {
            color: #e74c3c;
            font-weight: bold;
        }
        .btn-link {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            background-color: #3498db;
            color: #fff;
            padding: 8px 12px;
            border-radius: 4px;
        }
        .btn-link:hover {
            background-color: #2980b9;
        }
        p {
            font-size: 14px;
            margin-top: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>1. Profil Interaktif Developer Pemula</h2>
    <table>
        <tr>
            <th>Nama</th>
            <td>Muhammad Adidtya Putra Ramadhan</td>
        </tr>
        <tr>
            <th>ID Developer (NIM)</th>
            <td>250441100026</td>
        </tr>
        <tr>
            <th>Kota/Tgl Lahir</th>
            <td>Surabaya, 05 Oktober 2006</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>m.adidtya.pr@gmail.com</td>
        </tr>
        <tr>
            <th>No. WhatsApp</th>
            <td>081217225301</td>
        </tr>
    </table>

    <h2>Form Isian Dinamis</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label>Framework/Tools yang Dikuasai (pisahkan dengan koma):</label>
            <input type="text" name="frameworks" placeholder="Contoh: Tailwind, Bootstrap, Laravel" required>
        </div>

        <div class="form-group">
            <label>Cerita Singkat Pengalaman Membuat Aplikasi/Website:</label>
            <textarea name="cerita" rows="4" placeholder="Ceritakan pengalaman Anda di sini..." required></textarea>
        </div>

        <div class="form-group">
            <label>Tools Penunjang:</label><br>
            <input type="checkbox" name="tools[]" value="VS Code"> VS Code 
            <input type="checkbox" name="tools[]" value="GitHub"> GitHub 
            <input type="checkbox" name="tools[]" value="Figma"> Figma 
            <input type="checkbox" name="tools[]" value="Postman"> Postman
        </div>

        <div class="form-group">
            <label>Minat Bidang:</label>
            <input type="radio" name="minat" value="Frontend" required> Frontend
            <input type="radio" name="minat" value="Backend"> Backend
            <input type="radio" name="minat" value="Fullstack"> Fullstack
        </div>

        <div class="form-group">
            <label>Tingkat Skill Coding:</label>
            <select name="skill" required>
                <option value="">Pilih Tingkat</option>
                <option value="Dasar">Dasar</option>
                <option value="Cukup">Cukup</option>
                <option value="Profesional">Profesional</option>
            </select>
        </div>

        <input type="submit" name="submit_form" value="Proses Data">
    </form>

    <?php
    // Fungsi untuk menampilkan output data dalam bentuk tabel
    function tampilkanData($data) {
        echo "<table>";
        foreach ($data as $key => $value) {
            echo "<tr><th>$key</th><td>$value</td></tr>";
        }
        echo "</table>";
    }

    if (isset($_POST['submit_form'])) {
        $frameworks = $_POST['frameworks'];
        $cerita = $_POST['cerita'];
        $tools = isset($_POST['tools']) ? implode(', ', $_POST['tools']) : 'Tidak ada tools dipilih';
        $minat = $_POST['minat'];
        $skill = $_POST['skill'];

        if (empty($frameworks) || empty($cerita) || empty($minat) || empty($skill)) {
            echo "<p class='error-msg'>Semua form isian wajib diisi!</p>";
        } else {
            // Memproses inputan framework
            $framework_arr = explode(',', $frameworks);
            $framework_arr = array_map('trim', $framework_arr);

            echo "<div class='output-box'>";
            echo "<h3>Data Input Anda</h3>";

            // Data yang akan dimasukkan ke dalam tabel
            $data = [
                "Framework/Tools" => implode(", ", $framework_arr),
                "Tools Penunjang" => $tools,
                "Minat Bidang" => $minat,
                "Tingkat Skill" => $skill
            ];

            tampilkanData($data);

            echo "<h4>Pengalaman Singkat</h4>";
            echo "<p>$cerita</p>";

            // Kondisi tambahan jika jumlah framework > 2
            if (count($framework_arr) > 2) {
                echo "<p style='color: #27ae60; font-weight: bold;'>Skill Anda cukup luas di bidang development!</p>";
            }
            echo "</div>";
        }
    }
    ?>

    <a href="timeline.php" class="btn-link">Menuju Timeline</a>
</div>

</body>
</html>