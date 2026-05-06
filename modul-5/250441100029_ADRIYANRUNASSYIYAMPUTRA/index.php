<?php
function tampilkanData($data) {
    echo "<table border='1' cellpadding='10'>";
    foreach ($data as $key => $value) {
        echo "<tr><td>$key</td><td>$value</td></tr>";
    }
    echo "</table>";
}
?>

<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

body {
  font-family: sans-serif;
  background: #f5f5f5;
  display: flex;
  justify-content: center;
  padding: 2rem 1rem;
}

.container {
  background: white;
  border-radius: 10px;
  padding: 2rem;
  width: 100%;
  height: 1100px;
  max-width: 520px;
  border: 1px solid #ddd;
  margin-top: 1rem;
}

h2 {
  font-size: 18px;
  font-weight: 500;
  margin-bottom: 1.5rem;
  color: #222;
}

form label,
form br + br {
  font-size: 14px;
  color: #555;
}

input[type="text"],
textarea,
select {
  width: 100%;
  padding: 8px 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 14px;
  margin-bottom: 1rem;
  background: #fafafa;
  display: block;
}

textarea { height: 80px; resize: vertical; }

input[type="checkbox"],
input[type="radio"] {
  margin-right: 4px;
}

button[type="submit"] {
  background: #4f46e5;
  color: white;
  border: none;
  padding: 9px 20px;
  border-radius: 6px;
  font-size: 14px;
  cursor: pointer;
}

button[type="submit"]:hover { background: #4338ca; }

table {
  border-collapse: collapse;
  width: 100%;
  margin-top: 1rem;
}

table td {
  padding: 8px 10px;
  border: 1px solid #ddd;
  font-size: 14px;
}

table tr:nth-child(even) td { background: #f9f9f9; }

p { font-size: 14px; margin-top: 8px; }

/* Tabel profil statis */
.profil-table th {
  background-color: #4f46e5;
  color: white;
  width: 35%;
  padding: 8px 10px;
  border: 1px solid #ddd;
  font-size: 14px;
  font-weight: 500;
  text-align: left;
}

.profil-table td {
  background: #fff;
}

.profil-table tr:nth-child(even) td {
  background: #f9f9f9;
}

.section-divider {
  border: none;
  border-top: 1px solid #eee;
  margin: 1.5rem 0;
}
</style>

<div class="container">

<h2>1. Profil Interaktif Developer Pemula</h2>

<table class="profil-table">
    <tr>
        <th>Nama</th>
        <td>Adriyan Runassyiyam Putra</td>
    </tr>
    <tr>
        <th>ID Developer (NIM)</th>
        <td>250441100029</td>
    </tr>
    <tr>
        <th>Kota/Tgl Lahir</th>
        <td>Sidoarjo, 07 September 2006</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>a.adriyan gmail.com</td>
    </tr>
    <tr>
        <th>No. WhatsApp</th>
        <td>08128973241</td>
    </tr>
</table>


<hr class="section-divider">
<h2>Form Isian Dinamis</h2>

<form method="POST">
    Framework (pisahkan koma): <br>
    <input type="text" name="framework"><br><br>

    Pengalaman:<br>
    <textarea name="pengalaman"></textarea><br><br>

    Tools:<br>
    <input type="checkbox" name="tools[]" value="VS Code">VS Code
    <input type="checkbox" name="tools[]" value="GitHub">GitHub
    <input type="checkbox" name="tools[]" value="Figma">Figma
    <br><br>

    Minat:
    <input type="radio" name="minat" value="Frontend">Frontend
    <input type="radio" name="minat" value="Backend">Backend
    <input type="radio" name="minat" value="Fullstack">Fullstack
    <br><br>

    Skill:
    <select name="skill">
        <option value="">--Pilih--</option>
        <option value="Dasar">Dasar</option>
        <option value="Cukup">Cukup</option>
        <option value="Profesional">Profesional</option>
    </select><br><br>

    <button type="submit" name="submit">Kirim</button>
        <a href="timeline.php">
          <button type="button">Ke Timeline</button>
        </a>
</form>

<?php
if (isset($_POST['submit'])) {

    if (
        empty($_POST['framework']) ||
        empty($_POST['pengalaman']) ||
        empty($_POST['minat']) ||
        empty($_POST['skill']) ||
        empty($_POST['tools'])
    ) {
        echo "<p style='color:red;'>Semua field wajib diisi!</p>";
    } else {

        $framework = explode(",", $_POST['framework']);
        $data = [
            "Framework" => implode(", ", $framework),
            "Minat" => $_POST['minat'],
            "Skill" => $_POST['skill'],
            "Tools" => isset($_POST['tools']) ? implode(", ", $_POST['tools']) : "kosong"
        ];

        tampilkanData($data);

        echo "<p><b>Pengalaman:</b> " . $_POST['pengalaman'] . "</p>";

        if (count($framework) > 2) {
            echo "<p style='color:green;'>Skill Anda cukup luas di bidang development!</p>";
        }
    }
}
?>

</div>