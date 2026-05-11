
<!DOCTYPE html>
<html>
<head>
    <title>Profil Developer</title>
</head>
<body>

<h2>Profil Interaktif Developer Pemula</h2>
<table border="1">
<tr><td>Nama</td><td>Login User</td></tr>
<tr><td>ID Developer</td><td>AINI123</td></tr>
<tr><td>Kota/Tgl Lahir</td><td>Bangkalan, 13 April 2007</td></tr>
<tr><td>Email</td><td>chanaini@mail.com</td></tr>
<tr><td>WhatsApp</td><td>08123456789</td></tr>
</table>

<h3>Form Input</h3>
<form method="POST">
    Framework/Tools:<br>
    <input type="text" name="framework"><br><br>

    Pengalaman:<br>
    <textarea name="pengalaman"></textarea><br><br>

    Tools:<br>
    <input type="checkbox" name="tools[]" value="VS Code">VS Code
    <input type="checkbox" name="tools[]" value="GitHub">GitHub
    <input type="checkbox" name="tools[]" value="Figma">Figma
    <input type="checkbox" name="tools[]" value="Postman">Postman<br><br>

    Minat:<br>
    <input type="radio" name="minat" value="Frontend">Frontend
    <input type="radio" name="minat" value="Backend">Backend
    <input type="radio" name="minat" value="Fullstack">Fullstack<br><br>

    Skill:<br>
    <select name="skill">
        <option value="">Pilih</option>
        <option>Dasar</option>
        <option>Cukup</option>
        <option>Profesional</option>
    </select><br><br>

    <input type="submit" name="submit" value="Kirim">
</form>

<?php
function tampilData($frameworkArr, $pengalaman, $tools, $minat, $skill){
    echo "<h3>Hasil Input</h3>";
    echo "<table border='1'>";
    echo "<tr><td>Framework</td><td>".implode(", ",$frameworkArr)."</td></tr>";
    echo "<tr><td>Tools</td><td>".implode(", ",$tools)."</td></tr>";
    echo "<tr><td>Minat</td><td>$minat</td></tr>";
    echo "<tr><td>Skill</td><td>$skill</td></tr>";
    echo "</table>";
    echo "<p><b>Pengalaman:</b> $pengalaman</p>";
}

if(isset($_POST['submit'])){
    $framework = $_POST['framework'];
    $pengalaman = $_POST['pengalaman'];
    $tools = $_POST['tools'];
    $minat = $_POST['minat'];
    $skill = $_POST['skill'];

    if($framework=="" || $pengalaman=="" || empty($tools) || $minat=="" || $skill==""){
        echo "<p style='color:red;'>Semua field wajib diisi!</p>";
    } else {
        $frameworkArr = explode(" ", $framework);

        if(count($frameworkArr) > 2){
            echo "<p>Skill Anda cukup luas di bidang development!</p>";
        }

        tampilData($frameworkArr, $pengalaman, $tools, $minat, $skill);
    }
}
?>

<a href="timeline.php">Ke Timeline</a>

</body>
</html>




