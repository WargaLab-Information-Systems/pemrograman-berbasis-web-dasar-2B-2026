<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../auth/login.php");
    exit;
}

require "../config/koneksi.php";

$id = $_GET["id"];

$query = mysqli_query($konek, "DELETE FROM tasks WHERE id = '$id'");

header("Location: ../dashboard.php");

?>