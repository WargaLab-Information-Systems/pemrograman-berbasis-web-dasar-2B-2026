<?php
date_default_timezone_set('Asia/Jakarta');

function prosesFrameworks($input)
{
    return array_filter(array_map('trim', explode(',', $input)));
}

function validasi($data)
{
    $errors = array();
    $fw = trim($data['frameworks']);
    $exp = trim($data['pengalaman']);
    if ($fw == '')
        $errors[] = 'Framework wajib diisi.';
    if ($exp == '')
        $errors[] = 'Pengalaman wajib diisi.';
    if (empty($data['tools']))
        $errors[] = 'Tools penunjang wajib dipilih.';
    if ($data['minat'] == '')
        $errors[] = 'Minat bidang wajib dipilih.';
    if ($data['skill_level'] == '')
        $errors[] = 'Tingkat skill wajib dipilih.';
    return $errors;
}

$profil = array(
    'Nama' => 'Rafael Merdeka Putra Priadias',
    'ID Developer' => 'DEV-2026-0001',
    'Kota/Tgl Lahir' => 'Jombang / 17 Agustus 2006',
    'Email' => 'rafael@gmail.com',
    'No. WhatsApp' => '085747848239'
);

$submitted = false;
$errors = array();
$hasil = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['frameworks']))
        $_POST['frameworks'] = '';
    if (!isset($_POST['pengalaman']))
        $_POST['pengalaman'] = '';
    if (!isset($_POST['tools']))
        $_POST['tools'] = array();
    if (!isset($_POST['minat']))
        $_POST['minat'] = '';
    if (!isset($_POST['skill_level']))
        $_POST['skill_level'] = '';

    $errors = validasi($_POST);

    if (empty($errors)) {
        $submitted = true;
        $hasil = array(
            'frameworks' => prosesFrameworks($_POST['frameworks']),
            'pengalaman' => trim($_POST['pengalaman']),
            'tools' => $_POST['tools'],
            'minat' => $_POST['minat'],
            'skill_level' => $_POST['skill_level']
        );
    }
}

$old_fw = isset($_POST['frameworks']) ? htmlspecialchars($_POST['frameworks']) : '';
$old_exp = isset($_POST['pengalaman']) ? htmlspecialchars($_POST['pengalaman']) : '';
$old_tools = isset($_POST['tools']) ? $_POST['tools'] : array();
$old_minat = isset($_POST['minat']) ? $_POST['minat'] : '';
$old_skill = isset($_POST['skill_level']) ? $_POST['skill_level'] : '';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Profil Developer</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto space-y-6">

        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold">Profil Interaktif Developer Pemula</h1>
        </div>

        <table class="w-full text-sm border border-gray-300 bg-white">
            <tbody>
                <?php foreach ($profil as $k => $v): ?>
                    <tr class="border-b border-gray-200">
                        <td class="px-3 py-2 font-semibold bg-gray-50 w-40"><?php echo $k; ?></td>
                        <td class="px-3 py-2"><?php echo $v; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (!$submitted): ?>

            <?php if (!empty($errors)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded text-sm">
                    <?php foreach ($errors as $e): ?>
                        <p>• <?php echo $e; ?></p><?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="bg-white border border-gray-300 p-4 space-y-4 text-sm">
                <div>
                    <label class="font-semibold block mb-1">Framework/Tools yang Dikuasai<span class="text-gray-400">(pisah
                            koma)</span></label>
                    <input type="text" name="frameworks" value="<?php echo $old_fw; ?>" placeholder="Laravel, tailwind, dll"
                        class="w-full border border-gray-300 rounded px-3 py-1.5">
                </div>
                <div>
                    <label class="font-semibold block mb-1">Cerita Pengalaman *</label>
                    <textarea name="pengalaman" rows="3"
                        class="w-full border border-gray-300 rounded px-3 py-1.5"><?php echo $old_exp; ?></textarea>
                </div>
                <div>
                    <label class="font-semibold block mb-1">Tools Penunjang *</label>
                    <?php
                    $tools_list = array('VS Code', 'GitHub', 'Figma', 'Postman');
                    foreach ($tools_list as $t):
                        $checked = in_array($t, $old_tools) ? 'checked' : '';
                        ?>
                        <label class="inline-flex items-center gap-1 mr-3">
                            <input type="checkbox" name="tools[]" value="<?php echo $t; ?>" <?php echo $checked; ?>>
                            <?php echo $t; ?>
                        </label>
                    <?php endforeach; ?>
                </div>
                <div>
                    <label class="font-semibold block mb-1">Minat Bidang *</label>
                    <?php
                    $minat_list = array('Frontend', 'Backend', 'Fullstack');
                    foreach ($minat_list as $m):
                        $checked = ($old_minat == $m) ? 'checked' : '';
                        ?>
                        <label class="inline-flex items-center gap-1 mr-3">
                            <input type="radio" name="minat" value="<?php echo $m; ?>" <?php echo $checked; ?>>
                            <?php echo $m; ?>
                        </label>
                    <?php endforeach; ?>
                </div>
                <div>
                    <label class="font-semibold block mb-1">Tingkat Skill Coding</label>
                    <select name="skill_level" class="border border-gray-300 rounded px-3 py-1.5">
                        <option value="">-- Pilih --</option>
                        <?php
                        $skill_list = array('Dasar', 'Cukup', 'Profesional');
                        foreach ($skill_list as $s):
                            $selected = ($old_skill == $s) ? 'selected' : '';
                            ?>
                            <option value="<?php echo $s; ?>" <?php echo $selected; ?>><?php echo $s; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Proses</button>
            </form>

        <?php else: ?>

            <?php if (count($hasil['frameworks']) > 2): ?>
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-2 rounded text-sm">
                    ★ Skill Anda cukup luas di bidang development!
                </div>
            <?php endif; ?>

            <table class="w-full text-sm border border-gray-300 bg-white">
                <tbody>
                    <tr class="border-b border-gray-200">
                        <td class="px-3 py-2 font-semibold bg-gray-50 w-40">Framework</td>
                        <td class="px-3 py-2">
                            <?php echo implode(', ', array_map('htmlspecialchars', $hasil['frameworks'])); ?>
                            <span class="text-gray-400">(<?php echo count($hasil['frameworks']); ?> item)</span>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="px-3 py-2 font-semibold bg-gray-50">Tools</td>
                        <td class="px-3 py-2"><?php echo implode(', ', array_map('htmlspecialchars', $hasil['tools'])); ?>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200">
                        <td class="px-3 py-2 font-semibold bg-gray-50">Minat Bidang</td>
                        <td class="px-3 py-2"><?php echo htmlspecialchars($hasil['minat']); ?></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 font-semibold bg-gray-50">Tingkat Skill</td>
                        <td class="px-3 py-2"><?php echo htmlspecialchars($hasil['skill_level']); ?></td>
                    </tr>
                </tbody>
            </table>

            <div class="bg-white border border-gray-300 p-4 text-sm">
                <p class="font-semibold mb-1">Pengalaman:</p>
                <p><?php echo nl2br(htmlspecialchars($hasil['pengalaman'])); ?></p>
            </div>

            <div class="flex gap-3 text-sm">
                <form method="GET">
                    <button type="submit" class="bg-white border px-4 py-2 rounded hover:bg-gray-100">
                        Isi ulang form
                    </button>
                </form>

                <a href="halaman2.php" class="bg-blue-600 text-white px-4 py-1.5 rounded hover:bg-blue-700">Timeline</a>
            </div>

        <?php endif; ?>

    </div>
</body>

</html>