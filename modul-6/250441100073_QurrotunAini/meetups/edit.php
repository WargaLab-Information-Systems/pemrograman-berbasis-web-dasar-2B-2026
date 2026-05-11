<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../auth/cek_login.php';
include '../config/koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $conn->prepare("
SELECT * FROM meetups
WHERE id=? AND user_id=?
");

$stmt->bind_param("ii", $id, $_SESSION['user_id']);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Jangan ganggu jadwal orang ya!");
}

if (isset($_POST['update'])) {

    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);

    $update = $conn->prepare("
    UPDATE meetups
    SET title=?, description=?
    WHERE id=?
    ");

    $update->bind_param(
        "ssi",
        $title,
        $description,
        $id
    );

    if ($update->execute()) {

        header("Location: index.php");
        exit;

    } else {

        echo "Gagal update: " . $update->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Meetup</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-dark text-white">

<div class="container mt-5">

    <div class="card p-4 bg-secondary">

        <h2>Edit Meetup</h2>

        <form method="POST">

            <input type="text"
                   name="title"
                   class="form-control mb-3"
                   value="<?= htmlspecialchars($data['title']) ?>"
                   required>

            <textarea name="description"
                      class="form-control mb-3"
                      required><?= htmlspecialchars($data['description']) ?></textarea>

            <button type="submit"
                    name="update"
                    class="btn btn-warning">

                Update Meetup

            </button>

        </form>

    </div>

</div>

</body>
</html>