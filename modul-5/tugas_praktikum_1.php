<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil Developer — Sekar</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  body { font-family: 'Plus Jakarta Sans', sans-serif; }
  .gradient-text { background: linear-gradient(135deg, #db2777, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
  .skill-fill { transition: width 1s ease; }
</style>
</head>
<body class="bg-pink-50 min-h-screen">

<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-pink-100 px-6 py-3 flex items-center gap-2">
  <span class="font-bold text-pink-600 text-lg mr-auto"></span>
  <a href="tugas_praktikum_1.php" class="text-sm px-4 py-2 rounded-full bg-pink-500 text-white font-medium">📋 Profil</a>
  <a href="tugas_praktikum_2.php" class="text-sm px-4 py-2 rounded-full text-gray-500 hover:bg-pink-100 transition">📅 Timeline</a>
  <a href="tugas_praktikum_3.php" class="text-sm px-4 py-2 rounded-full text-gray-500 hover:bg-pink-100 transition">📝 Blog</a>
</nav>

<div class="text-center pt-12 pb-6 px-4">
  <span class="inline-block text-xs font-semibold tracking-widest text-pink-500 uppercase bg-pink-100 px-4 py-1 rounded-full mb-4">Developer Portfolio</span>
  <h1 class="text-4xl font-bold text-gray-900 mb-2">Profil <span class="gradient-text">Interaktif</span><br>Developer Pemula</h1>
</div>

<div class="max-w-2xl mx-auto px-4 pb-16">

  <div class="bg-white rounded-2xl shadow-sm border border-pink-100 overflow-hidden mb-6">
    <div class="bg-gradient-to-r from-pink-600 to-pink-400 px-6 py-5 flex items-center gap-4">
      <div class="w-14 h-14 rounded-full bg-white/20 border-2 border-white/40 flex items-center justify-center text-2xl">👩‍💻</div>
      <div>
        <h3 class="text-white font-bold text-lg">Sekar Rengganis Virginia Putri Wijaya</h3>
        <p class="text-pink-100 text-sm">DEV-250-075 · Sistem Informasi</p>
      </div>
    </div>
    <div class="grid grid-cols-2">
      <?php
      $data = [
        'Kota Lahir'     => 'Surabaya',
        'Tanggal Lahir'  => '29 Januari 2007',
        'Email'          => 'sekarrengganis@email.com',
        'WhatsApp'       => '+62 896-4366-4045',
        'Status'         => '🎓 Mahasiswa Aktif',
        'Angkatan'       => '2025',
      ];
      $i = 0;
      foreach ($data as $k => $v) {
        $border = ($i % 2 === 0) ? 'border-r' : '';
        echo "<div class='p-4 border-b border-pink-50 $border border-pink-50'>
                <span class='text-xs font-semibold text-pink-300 uppercase tracking-wider'>$k</span>
                <span class='block text-sm font-medium text-gray-800 mt-1'>$v</span>
              </div>";
        $i++;
      }
      ?>
    </div>
  </div>

  <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-6">
    <h2 class="text-xl font-bold text-pink-600 mb-6 pb-4 border-b border-pink-100">✏️ Update Skill Developer</h2>

    <?php
    function cekKosong($v) { return trim($v) === ''; }
    function prosesFramework($input) {
      return array_filter(array_map('trim', explode(',', $input)), fn($x) => $x !== '');
    }
    function skillLevel($s) {
      return match($s) {
        'Dasar'       => ['width' => '30%', 'label' => 'Pemula (30%)'],
        'Cukup'       => ['width' => '65%', 'label' => 'Cukup (65%)'],
        'Profesional' => ['width' => '95%', 'label' => 'Profesional (95%)'],
        default       => ['width' => '0%',  'label' => '-'],
      };
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $framework  = $_POST['framework']  ?? '';
      $pengalaman = $_POST['pengalaman'] ?? '';
      $tools      = $_POST['tools']      ?? [];
      $minat      = $_POST['minat']      ?? '';
      $skill      = $_POST['skill']      ?? '';
      $goals      = $_POST['goals']      ?? '';

      $errors = [];
      if (cekKosong($framework))  $errors[] = 'Framework wajib diisi!';
      if (cekKosong($pengalaman)) $errors[] = 'Pengalaman wajib diisi!';
      if (empty($tools))          $errors[] = 'Pilih minimal 1 tools!';
      if (cekKosong($minat))      $errors[] = 'Minat bidang wajib dipilih!';
      if (cekKosong($skill))      $errors[] = 'Tingkat skill wajib dipilih!';

      if (!empty($errors)) {
        echo "<div class='bg-pink-50 border border-pink-200 rounded-xl p-4 mb-5'>";
        foreach ($errors as $e) echo "<p class='text-pink-600 text-sm py-0.5'>⚠ $e</p>";
        echo "</div>";
      } else {
        $fwArray   = prosesFramework($framework);
        $levelInfo = skillLevel($skill);
        echo "<div class='bg-gradient-to-br from-pink-50 to-white border-2 border-pink-200 rounded-xl p-5 mb-5'>";
        echo "<div class='text-green-600 font-semibold mb-4'>✅ Data Tersimpan</div>";
        echo "<div class='grid grid-cols-2 gap-3 mb-4'>";
        $items = [
          'Framework'    => implode(', ', $fwArray),
          'Jumlah FW'    => count($fwArray) . ' item',
          'Tools'        => implode(', ', $tools),
          'Minat Bidang' => $minat,
        ];
        foreach ($items as $lbl => $val) {
          echo "<div class='bg-white rounded-lg p-3 border border-pink-100'>
                  <span class='text-xs text-pink-300 uppercase tracking-wider font-semibold'>$lbl</span>
                  <span class='block text-sm font-medium text-gray-800 mt-1'>" . htmlspecialchars($val) . "</span>
                </div>";
        }
        echo "</div>";
        echo "<div class='mb-3'>
                <span class='text-xs font-semibold text-pink-500 uppercase tracking-wider'>Tingkat Skill: " . $levelInfo['label'] . "</span>
                <div class='bg-pink-100 rounded-full h-2 mt-2 overflow-hidden'>
                  <div class='skill-fill h-full bg-gradient-to-r from-pink-400 to-pink-600 rounded-full' style='width:" . $levelInfo['width'] . "'></div>
                </div>
              </div>";
        if (count($fwArray) > 2)
          echo "<span class='inline-flex items-center gap-1 bg-pink-500 text-white text-xs font-bold px-3 py-1.5 rounded-full'>⭐ Skill Luas — " . $fwArray[0] . " & " . (count($fwArray) - 1) . " lainnya!</span>";
        echo "<div class='bg-white border-l-4 border-pink-400 rounded-r-xl p-4 mt-3 text-sm text-gray-600 leading-relaxed'>📖 " . htmlspecialchars($pengalaman) . "</div>";
        if (!cekKosong($goals))
          echo "<div class='bg-white border-l-4 border-pink-200 rounded-r-xl p-4 mt-2 text-sm text-gray-600 leading-relaxed'>🎯 <strong>Goals:</strong> " . htmlspecialchars($goals) . "</div>";
        echo "</div>";
      }
    }
    ?>

    <form method="POST" action="tugas_praktikum_1.php" class="space-y-5">

      <div>
        <label class="block text-xs font-semibold text-pink-500 uppercase tracking-wider mb-2">Framework / Library *</label>
        <input type="text" name="framework" value="<?= htmlspecialchars($_POST['framework'] ?? '') ?>"
          placeholder="Contoh: Laravel, React, Vue"
          class="w-full px-4 py-3 rounded-xl border border-pink-100 bg-pink-50 text-sm focus:outline-none focus:border-pink-400 focus:ring-2 focus:ring-pink-100 transition">
      </div>

      <div>
        <label class="block text-xs font-semibold text-pink-500 uppercase tracking-wider mb-2">Cerita Pengalaman Coding *</label>
        <textarea name="pengalaman" placeholder="Ceritakan momen coding paling berkesan..."
          class="w-full px-4 py-3 rounded-xl border border-pink-100 bg-pink-50 text-sm focus:outline-none focus:border-pink-400 focus:ring-2 focus:ring-pink-100 transition resize-none min-h-24"><?= htmlspecialchars($_POST['pengalaman'] ?? '') ?></textarea>
      </div>

      <div>
        <label class="block text-xs font-semibold text-pink-500 uppercase tracking-wider mb-2">Tools Penunjang * (boleh lebih dari satu)</label>
        <div class="grid grid-cols-2 gap-2">
          <?php
          $toolsList    = ['VS Code', 'GitHub', 'Figma', 'Postman', 'Docker', 'Notion'];
          $checkedTools = $_POST['tools'] ?? [];
          foreach ($toolsList as $t) {
            $chk = in_array($t, $checkedTools) ? 'checked' : '';
            $bg  = in_array($t, $checkedTools) ? 'bg-pink-100 border-pink-400 text-pink-700 font-semibold' : 'bg-pink-50 border-pink-100 text-gray-600';
            echo "<label class='flex items-center gap-2 px-3 py-2.5 border rounded-xl cursor-pointer text-sm $bg hover:bg-pink-100 transition'>
                    <input type='checkbox' name='tools[]' value='$t' $chk class='accent-pink-500'> $t
                  </label>";
          }
          ?>
        </div>
      </div>

      <div>
        <label class="block text-xs font-semibold text-pink-500 uppercase tracking-wider mb-2">Minat Bidang *</label>
        <div class="flex gap-2 flex-wrap">
          <?php
          $minatList     = ['Frontend', 'Backend', 'Fullstack', 'UI/UX', 'DevOps'];
          $selectedMinat = $_POST['minat'] ?? '';
          foreach ($minatList as $m) {
            $chk = ($selectedMinat == $m) ? 'checked' : '';
            $bg  = ($selectedMinat == $m) ? 'bg-pink-100 border-pink-400 text-pink-700 font-semibold' : 'bg-pink-50 border-pink-100 text-gray-600';
            echo "<label class='flex items-center gap-2 px-4 py-2 border rounded-xl cursor-pointer text-sm $bg hover:bg-pink-100 transition'>
                    <input type='radio' name='minat' value='$m' $chk class='accent-pink-500'> $m
                  </label>";
          }
          ?>
        </div>
      </div>

      <div>
        <label class="block text-xs font-semibold text-pink-500 uppercase tracking-wider mb-2">Tingkat Skill Coding *</label>
        <select name="skill" class="w-full px-4 py-3 rounded-xl border border-pink-100 bg-pink-50 text-sm focus:outline-none focus:border-pink-400 focus:ring-2 focus:ring-pink-100 transition">
          <option value="">-- Pilih Tingkat Skill --</option>
          <?php
          $skillList     = ['Dasar', 'Cukup', 'Profesional'];
          $selectedSkill = $_POST['skill'] ?? '';
          foreach ($skillList as $s) {
            $sel = ($selectedSkill == $s) ? 'selected' : '';
            echo "<option value='$s' $sel>$s</option>";
          }
          ?>
        </select>
      </div>

      <div>
        <label class="block text-xs font-semibold text-pink-500 uppercase tracking-wider mb-2">Goals (Opsional)</label>
        <textarea name="goals" placeholder="Apa tujuan kamu ke depannya?"
          class="w-full px-4 py-3 rounded-xl border border-pink-100 bg-pink-50 text-sm focus:outline-none focus:border-pink-400 focus:ring-2 focus:ring-pink-100 transition resize-none min-h-20"><?= htmlspecialchars($_POST['goals'] ?? '') ?></textarea>
      </div>

      <button type="submit" class="w-full py-3 bg-gradient-to-r from-pink-600 to-pink-400 text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all text-sm">
        Simpan Data ✦
      </button>
    </form>
  </div>
</div>
</body>
</html>