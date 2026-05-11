<?php
include '../auth/cek_login.php';
include '../config/koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$user_id = $_SESSION['user_id'];

// cek apakah meetup milik user login
$cek = $conn->prepare("
SELECT * FROM meetups
WHERE id=? AND user_id=?
");

$cek->bind_param("ii", $id, $user_id);
$cek->execute();

$result = $cek->get_result();

if ($result->num_rows === 0) {
    die("Eits gak boleh!");
}

$stmt1 = $conn->prepare("
DELETE FROM meetup_members
WHERE meetup_id=?
");

$stmt1->bind_param("i", $id);
$stmt1->execute();


$stmt2 = $conn->prepare("
DELETE FROM meetups
WHERE id=?
");

$stmt2->bind_param("i", $id);
$stmt2->execute();

header("Location: index.php");
exit;
?>