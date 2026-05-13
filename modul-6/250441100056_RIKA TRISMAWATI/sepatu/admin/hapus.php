<?php
session_start();
if ($_SESSION['role'] != 'Admin') {
    header("Location: ../index.php");
    exit;
}
include 'koneksi.php';

$id = $_GET['id'];

$stmt = $conn->prepare(
    "DELETE FROM sepatu WHERE id_sepatu=?"
);

$stmt->bind_param("i", $id);

$stmt->execute();

header("Location: index.php");
