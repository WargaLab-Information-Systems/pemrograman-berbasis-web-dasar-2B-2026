<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-md border border-slate-200">
    <h3 class="text-2xl text-slate-800 font-bold flex items-center justify-center pb-8">Profil Interaktif Developer Pemula</h3>    
    <table class="w-full text-left">
            <tbody>
                <tr class="border-b">
                    <th class="py-3 px-4 text-slate-700 font-semibold">Nama</th>
                    <td>Andreas Tri Zidan Ramadhan</td>
                </tr>
                <tr class="border-b">
                    <th class="py-3 px-4 text-slate-700 font-semibold">ID Developer</th>
                    <td>240441100111</td>
                </tr>
                <tr class="border-b">
                    <th class="py-3 px-4 text-slate-700 font-semibold">Tgl Lahir</th>
                    <td>11, Oktober 2005</td>
                </tr>
                <tr class="border-b">
                    <th class="py-3 px-4 text-slate-700 font-semibold">Email</th>
                    <td>andreaszidan110@gmail.com</td>
                </tr>
                <tr class="border-b">
                    <th class="py-3 px-4 text-slate-700 font-semibold">No. Whatsapp</th>
                    <td>0897606756814</td>
                </tr>
            </tbody>
        </table>
    <h3 class="text-2xl text-slate-800 font-bold flex items-center justify-center py-8">Form Portofolio</h3>    
        <form action="" method="POST" class="bg-slate-100 p-6 rounded-lg border border-slate-500">
            <div>
                <label for="" class="block text-slate-700 font-semibold pb-3">Framework/Tools yang dikuasai</label>
                <input type="text" class="w-full rounded-md p-2 " placeholder="Contoh: Tailwind, Bootstrap, React" name="framework">
            </div>
            <div>
                <label for="" class="block text-slate-700 font-semibold py-3">Cerita singkat pengalaman membuat aplikasi/website</label>
                <textarea name="cerita" id="" class="w-full p-2" placeholder="Masukkan pengalamanmu pada saat membuat website"></textarea>
            </div>
            <div>
                <label for="" class="block text-slate-700 font-semibold py-3">Tools Penunjang</label>
                <div class="flex flex-wrap gap-4">
                    <label for="" class="flex items-center space-x-2">
                        <input type="checkbox" value="vscode" name="tools[]">
                        <span>VS Code</span>
                    </label>
                    <label for="" class="flex items-center space-x-2">
                        <input type="checkbox" value="github" name="tools[]">
                        <span>GitHub</span>
                    </label>
                    <label for="" class="flex items-center space-x-2">
                        <input type="checkbox" value="figma" name="tools[]">
                        <span>Figma</span>
                    </label>
                    <label for="" class="flex items-center space-x-2">
                        <input type="checkbox" value="postman" name="tools[]">
                    <span>Postman</span>
                </label>
            </div>
            <div>
                <label for="" class="block text-slate-700 font-semibold py-3">Minat Bidang</label>
                <div class="flex gap-4">
                    <label for="" class="flex items-center space-x-2">
                        <input type="radio" name="minat" id="" value="frontend">
                        <span>Frontend</span>
                    </label>
                
                    <label for="" class="flex items-center space-x-2">
                        <input type="radio" name="minat" id="" value="backend">==
                        <span>Backend</span>
                    </label>
                    <label for="" class="flex items-center space-x-2">
                        <input type="radio" name="minat" id="" value="fullstack">
                        <span>Fullstack</span>
                    </label>
                </div>
            </div>
            <div>
                <label for="" class="block text-slate-700 font-semibold py-3">Tingkat Skill Coding</label>
                <select name="skill" id="" class="w-full rounded-md px-4 py-3">
                    <option value="">--Pilih Skill--</option>
                    <option value="dasar">Dasar</option>
                    <option value="cukup">Cukup</option>
                    <option value="profesional">Profesional</option>
                </select>
            </div>
            <div class="py-3">
                <button type="submit" name="submit" class="bg-slate-600 px-6 py-2 text-white font-bold rounded-md">Simpan Profil</button>
            </div>
        </form>
    </div>
    <div class="mt-6 pt-6">
        <a href="timeline.php" class="bg-slate-800 text-white font-semibold py-2 px-6 rounded-md shadow-sm">Menuju Timeline &rAarr;</a>
    </div>
    <?php
        if (isset($_POST["submit"])) {
            if (empty($_POST["framework"]) || empty($_POST["cerita"]) || empty($_POST["tools"]) || empty($_POST["minat"]) || empty($_POST["skill"]) ) {
                echo "<div class='mt-6 bg-red-700 text-white p-4 rounded-lg flex justify-center'><span>GAGAL!!! </span>Pastikan untuk semua form diisi!</div>";
            } else {
                $framework = $_POST['framework'];
                $cerita = $_POST['cerita'];
                $tools = $_POST['tools'];
                $minat = $_POST['minat'];
                $skill = $_POST['skill'];
                
                $array_framework = explode(',', $framework);

                echo '<div class="mt-12 bg-emerald-100 p-6 rounded-lg shadow-sm">';
                echo '<h3 class="text-2xl font-bold text-emerald-900 text-center border-b-2 border-emerald-900 mb-3 pb-4">Hasil Form Portofolio</h3>';
                // echo '</div>';

                if (count($array_framework) > 2 ) {
                    echo '<p class="text-emerald-700 font-bold mb-4">Skill Anda cukup luas di bidang Development!</p>';
                }

                echo '<table class="w-full text-sm text-left bg-white rounded-lg shadow-sm">';
                // echo '</table>';

                $cetak_framework = implode(", ", $array_framework);
                $cetak_tools = implode(", ", $tools);

                echo '<tr class="border-b"><th class="bg-slate-50 py-2 px-3 w-1/3">Framework</th><td class="py-2 px-3">'.$cetak_framework.'</td></tr>';
                echo '<tr class="border-b"><th class="bg-slate-50 py-2 px-3 w-1/3">Tools Penunjang</th><td class="py-2 px-3">'.$cetak_tools.'</td></tr>';
                echo '<tr class="border-b"><th class="bg-slate-50 py-2 px-3 w-1/3">Minat</th><td class="py-2 px-3">'.$minat.'</td></tr>';
                echo '<tr class="border-b"><th class="bg-slate-50 py-2 px-3 w-1/3">Skill</th><td class="py-2 px-3">'.$skill.'</td></tr>';
                echo '</table>';
                echo '<h4 class="font-bold text-slate-800 mt-4 mb-1">Pegalaman Developer:</h4>';
                echo '<p class="text-slate-700 italic bg-white p-3 rounded-lg">'.$cerita.'</p>';
                echo '</div>';
            }
        }
    ?>
</body>
</html>