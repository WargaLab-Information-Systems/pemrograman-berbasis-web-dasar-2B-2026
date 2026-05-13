<?php
// auth/login.php
require_once '../config.php';
session_start();

if (isset($_SESSION['user_id'])) {
  header('Location: /filmku/dashboard.php');
  exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';

  if (empty($username) || empty($password)) {
    $error = 'Username dan password wajib diisi!';
  } else {
    // Cari user berdasarkan username
    $stmt = $conn->prepare(
      'SELECT id, username, password, role FROM users WHERE username=?'
    );
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
      $user = $result->fetch_assoc();

      // Verifikasi password dengan hash
      if (password_verify($password, $user['password'])) {
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['username']  = $user['username'];
        $_SESSION['role']      = $user['role'];

        header('Location: /filmku/dashboard.php');
        exit();
      } else {
        $error = 'Password salah!';
      }
    } else {
      $error = 'Username tidak ditemukan!';
    }
    $stmt->close();
  }
}
?>

<!-- HTML Form Login -->
<!DOCTYPE html>
<html lang='id'>
<head>
  <meta charset='UTF-8'>
  <title>Login - FilmKu</title>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
</head>
<body class='bg-dark'>
<div class='container mt-5'>
  <div class='row justify-content-center'>
    <div class='col-md-4'>
      <div class='card shadow'>
        <div class='card-header bg-primary text-white text-center'>
          <h4>🎬 FilmKu — Login</h4>
        </div>
        <div class='card-body'>
          <?php if ($error): ?>
            <div class='alert alert-danger'><?= htmlspecialchars($error) ?></div>
          <?php endif; ?>
          <form method='POST'>
            <div class='mb-3'>
              <label class='form-label'>Username</label>
              <input type='text' name='username' class='form-control' required>
            </div>
            <div class='mb-3'>
              <label class='form-label'>Password</label>
              <input type='password' name='password' class='form-control' required>
            </div>
            <button type='submit' class='btn btn-primary w-100'>Masuk</button>
          </form>
          <div class='text-center mt-3'>
            Belum punya akun? <a href='register.php'>Daftar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body></html>
