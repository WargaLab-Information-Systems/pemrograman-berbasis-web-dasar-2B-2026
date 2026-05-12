<?php
include 'config.php';

$user = 'admin';
$pass = password_hash('admin123', PASSWORD_DEFAULT);
$role = 'admin';

mysqli_query($conn, "DELETE FROM users WHERE username='admin'");

$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $user, $pass, $role);

if ($stmt->execute()) {
    echo "Akun Admin Berhasil Direset! <br> Username: admin <br> Password: admin123";
    echo "<br><a href='login.php'>Klik di sini untuk Login</a>";
} else {
    echo "Gagal reset: " . $conn->error;
}
?>