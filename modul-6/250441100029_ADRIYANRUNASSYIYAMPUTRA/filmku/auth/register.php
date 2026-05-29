<?php
// auth/register.php
require_once '../config.php';
session_start();

// Kalau sudah login, tidak perlu register lagi
if (isset($_SESSION['user_id'])) {
  header('Location: /filmku/dashboard.php');
  exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $email    = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';
  $confirm  = $_POST['confirm_password'] ?? '';

  // Validasi sisi server
  if (empty($username) || empty($email) || empty($password)) {
    $error = 'Semua field wajib diisi!';
  } elseif ($password !== $confirm) {
    $error = 'Password dan konfirmasi tidak cocok!';
  } elseif (strlen($password) < 6) {
    $error = 'Password minimal 6 karakter!';
  } else {
    // Cek apakah username/email sudah ada
    $stmt = $conn->prepare(
      'SELECT id FROM users WHERE username=? OR email=?'
    );
    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $error = 'Username atau email sudah digunakan!';
    } else {
      // Hash password sebelum disimpan
      $hashed = password_hash($password, PASSWORD_BCRYPT);

      $stmt2 = $conn->prepare(
        'INSERT INTO users (username, email, password) VALUES (?, ?, ?)'
      );
      $stmt2->bind_param('sss', $username, $email, $hashed);

      if ($stmt2->execute()) {
        $success = 'Akun berhasil dibuat! Silakan login.';
      } else {
        $error = 'Gagal menyimpan data!';
      }
    }
    $stmt->close();
  }
}
?>

<!-- HTML bagian register.php (lanjutan) -->
<!DOCTYPE html>
<html lang='id'>
<head>
  <meta charset='UTF-8'>
  <title>Register - FilmKu</title>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
</head>
<body class='bg-dark'>
<div class='container mt-5'>
  <div class='row justify-content-center'>
    <div class='col-md-5'>
      <div class='card shadow'>
        <div class='card-header bg-primary text-white text-center'>
          <h4>Daftar Akun Baru</h4>
        </div>
        <div class='card-body'>

          <?php if ($error): ?>
            <div class='alert alert-danger'><?= htmlspecialchars($error) ?></div>
          <?php endif; ?>
          <?php if ($success): ?>
            <div class='alert alert-success'><?= htmlspecialchars($success) ?></div>
          <?php endif; ?>

          <form method='POST' id='formRegister'>
            <div class='mb-3'>
              <label class='form-label'>Username</label>
              <input type='text' name='username' class='form-control' required minlength='3'>
            </div>
            <div class='mb-3'>
              <label class='form-label'>Email</label>
              <input type='email' name='email' class='form-control' required>
            </div>
            <div class='mb-3'>
              <label class='form-label'>Password</label>
              <input type='password' name='password' id='pwd' class='form-control' required minlength='6'>
            </div>
            <div class='mb-3'>
              <label class='form-label'>Konfirmasi Password</label>
              <input type='password' name='confirm_password' id='cpwd' class='form-control' required>
            </div>
            <button type='submit' class='btn btn-primary w-100'>Daftar</button>
          </form>
          <div class='text-center mt-3'>
            Sudah punya akun? <a href='login.php'>Login di sini</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Validasi browser: cek password sama
document.getElementById('formRegister').addEventListener('submit', function(e) {
  const pwd  = document.getElementById('pwd').value;
  const cpwd = document.getElementById('cpwd').value;
  if (pwd !== cpwd) {
    e.preventDefault();
    alert('Password dan konfirmasi tidak cocok!');
  }
});
</script>
</body></html>
