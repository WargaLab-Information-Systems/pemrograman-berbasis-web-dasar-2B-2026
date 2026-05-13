<?php
function tampil($data) {
    return implode(", ", $data);
}

$hasil = "";
$error = "";

if (isset($_POST['submit'])) {
    $framework = $_POST['framework'];
    $pengalaman = $_POST['pengalaman'];
    $tools = isset($_POST['tools']) ? $_POST['tools'] : [];
    $minat = $_POST['minat'];
    $skill = $_POST['skill'];

    if ($framework == "" || $pengalaman == "" || empty($tools) || $minat == "" || $skill == "") {
        $error = "Semua harus diisi!";
    } else {
        $fw = explode(",", $framework);
        $pesan = "";
        if (count($fw) > 2) {
            $pesan = "Skill Anda cukup luas di bidang development!";
        }

        $hasil = "
        <center>
        <table border='1' cellpadding='5'>
            <tr><td>Framework</td><td>" . tampil($fw) . "</td></tr>
            <tr><td>Tools</td><td>" . tampil($tools) . "</td></tr>
            <tr><td>Minat</td><td>$minat</td></tr>
            <tr><td>Skill</td><td>$skill</td></tr>
        </table>
        <h3>Pengalaman</h3>
        <p>$pengalaman</p>
        <b>$pesan</b>
        </center>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Profil Developer</title>
</head>


<body >
    <center>
        <h3>Profil Interaktif Developer Pemula</h3>
        <table border="1" cellpadding="5">
            <tr>
                <td>Nama</td>
                <td>Rika Trismawati</td>
            </tr>
            <tr>
                <td>ID</td>
                <td>25041100056</td>
            </tr>
            <tr>
                <td>Kota/Tgl Lahir</td>
                <td>Sampang, 24 September 2006</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>rikatrisma@gmail.com</td>
            </tr>
            <tr>
                <td>WA</td>
                <td>085954085650</td>
            </tr>
        </table>
        <br>

        <?php
        if ($error != "") echo "<p style='color:red'>$error</p>";
        echo $hasil;
        ?>

        <br>
        <form method="POST">
            <table cellpadding="5">
                <tr>
                    <th>Framework (Pisah koma)</th>
                    <td><input type="text" name="framework"></td>
                </tr>
                <tr>
                    <th>Pengalaman</th>
                    <td><textarea name="pengalaman"></textarea></td>
                </tr>
                <tr>
                    <th>Tools</th>
                    <td>
                        <input type="checkbox" name="tools[]" value="VS Code"> VS Code <br>
                        <input type="checkbox" name="tools[]" value="GitHub"> GitHub<br>
                        <input type="checkbox" name="tools[]" value="Figma"> Figma<br>
                        <input type="checkbox" name="tools[]" value="Postman"> Postman
                    </td>
                </tr>
                <tr>
                    <th>Minat</th>
                    <td>
                        <input type="radio" name="minat" value="Frontend"> Frontend<br>
                        <input type="radio" name="minat" value="Backend"> Backend<br>
                        <input type="radio" name="minat" value="Fullstack"> Fullstack<br>
                    </td>
                </tr>
                <tr>
                    <th>Skill</th>
                    <td>
                        <select name="skill">
                            <option value="">Pilih</option>
                            <option>Dasar</option>
                            <option>Cukup</option>
                            <option>Profesional</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><button type="submit" name="submit">Kirim</button></td>
                </tr>
            </table>

        </form>
        <div class="div">
            <a href="index2.php">Timeline</a>
            <a href="index3.php">Blog</a>
        </div>
    </center>
</body>

</html>