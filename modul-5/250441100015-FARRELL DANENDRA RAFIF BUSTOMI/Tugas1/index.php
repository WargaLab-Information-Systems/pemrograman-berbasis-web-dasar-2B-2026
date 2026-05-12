<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Interaktif Developer</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0f172a;
            color: #e2e8f0;
        }

        .form {
            background-color: #28375a;
            padding: 20px;
            width: 90%;
            margin: 30px auto;
            border-radius: 5px;
        }

        table {
            margin: 0 auto;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-top: 20px;
            background-color: #4c5994;
            border-radius: 5px;
            overflow: hidden;
        }

        th {
            padding: 5px;
            background-color: #1e293b;
            font-size: 14px;
            color: #38bdf8;
        }

        td {
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }

        input,
        textarea,
        select {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            border: none;
            box-sizing: border-box;
            border-radius: 5px;
            background-color: #1e293b;
            color: #e2e8f0;
            outline: none;
        }

        textarea {
            height: 100px;
            resize: none;
        }

        label {
            font-size: 14px;
        }

        input[type="checkbox"],
        input[type="radio"] {
            width: auto;
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #1bb134;
            border-radius: 5px;
            cursor: pointer;
            font-size: medium;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #1e8c2b;
            transition: 0.3s;
        }

        .tombol {
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 10px;
            margin-top: 10px;
        }

        .tombol a {
            text-decoration: none;
            color: white;
        }

        .timeline {
            background-color: #3082fc;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .timeline:hover {
            background-color: #1e57c8;
            transition: 0.3s;
        }

        .blog {
            background-color: #e2960a;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .blog:hover {
            background-color: #9e6c10;
            transition: 0.3s;
        }
    </style>
</head>

<body>
    <div class="form">
        <table border="2">
            <tr>
                <th colspan="5">Profil Interaktif Developer Pemula</th>
            </tr>
            <tr>
                <th>Nama</th>
                <th>ID Developer</th>
                <th>Kota/Tgl Lahir</th>
                <th>Email</th>
                <th>No. WhatsApp</th>
            </tr>
            <tr>
                <td>Farrell Danendra</td>
                <td>DEV-25-15</td>
                <td>Malang, 01-05-2007</td>
                <td>farrell@gmail.com</td>
                <td>0812345678</td>
            </tr>
        </table>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $framework = $_POST['framework'];
            $pengalaman = $_POST['pengalaman'];
            $tools = $_POST['tools'] ?? [];
            $minat = $_POST['minat'] ?? '';
            $skill = $_POST['skill'];

            function dataDeveloper(array $framework, string $pengalaman, array $tools, string $minat, string $skill)
            {
                echo "<table border='1'>
            <tr>
                <th colspan='4'>Data Interaktif Developer Pemula</th>
            </tr>
            <tr>
                <th>Framework</th>
                <th>Tools Penunjang</th>
                <th>Minat Bidang</th>
                <th>Tingkat Skill Coding</th>
            </tr>
            <tr>
                <td>" . implode(", ", $framework) . "</td>
                <td>" . implode(", ", $tools) . "</td>
                <td>$minat</td>
                <td>$skill</td>
            </tr>
            </table>";
                echo "<p>Pengalaman: $pengalaman</p>";
                if (count($framework) > 2) {
                    echo "<p>Catatan: Skill Anda cukup luas di bidang development!</p>";
                }
            }

            if ($framework == "" || $pengalaman == "" || empty($tools) || $minat == "" || $skill == "") {
                echo "<p style='color: red;'>Semua Inputan Wajib Diisi!!</p>";
            } else {
                $frameworkArray = explode(",", $framework);
                dataDeveloper($frameworkArray, $pengalaman, $tools, $minat, $skill);
            }
        }
        ?>

        <form action="" method="post">
            <label>Framework/Tools: </label>
            <input type="text" id="framework" name="framework" placeholder="Laravel, React, Vue, dll">
            <br><br>
            <label>Pengalaman: </label>
            <textarea name="pengalaman" id="pengalaman"
                placeholder="Ceritakan pengalaman selama membuat aplikasi/website"></textarea>
            <br><br>
            <label>Tools Penunjang</label>
            <br>
            <input type="checkbox" value="VS Code" name="tools[]">VS Code
            <br>
            <input type="checkbox" value="GitHub" name="tools[]">GitHub
            <br>
            <input type="checkbox" value="Figma" name="tools[]">Figma
            <br>
            <input type="checkbox" value="Postman" name="tools[]">Postman
            <br><br>
            <label>Minat Bidang</label>
            <br>
            <input type="radio" name="minat" value="Frontend Developer">Frontend Developer
            <br>
            <input type="radio" name="minat" value="Backend Developer">Backend Developer
            <br>
            <input type="radio" name="minat" value="Fullstack Developer">Fullstack Developer
            <br><br>
            <select name="skill">
                <option value="">--Tingkat Skill Coding--</option>
                <option value="Dasar">Dasar</option>
                <option value="Cukup">Cukup</option>
                <option value="Profesional">Profesional</option>
            </select>
            <br><br>
            <input type="submit" class="tampil" value="Tampilkan Data">
        </form>

        <div class="tombol">
            <a href="../Tugas2/timeline.php" class="timeline">Halaman Timeline</a>
            <a href="../Tugas3/blog.php" class="blog">Halaman Blog</a>
        </div>
    </div>
</body>

</html>