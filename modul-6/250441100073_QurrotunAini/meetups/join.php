=<?php
include '../auth/cek_login.php';
include '../config/koneksi.php';

$meetup_id = $_GET['id'];
$user_id = $_SESSION['user_id'];


$check = $conn->prepare("
SELECT *
FROM meetup_members
WHERE meetup_id = ?
AND user_id = ?
");

$check->bind_param("ii", $meetup_id, $user_id);
$check->execute();

$result = $check->get_result();

if($result->num_rows == 0){

    $stmt = $conn->prepare("
    INSERT INTO meetup_members(meetup_id,user_id)
    VALUES(?,?)
    ");

    $stmt->bind_param("ii", $meetup_id, $user_id);
    $stmt->execute();
}

header("Location: detail.php?id=$meetup_id");
exit;
?>