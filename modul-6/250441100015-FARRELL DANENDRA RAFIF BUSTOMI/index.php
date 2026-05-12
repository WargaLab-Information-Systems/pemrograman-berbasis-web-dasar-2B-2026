<?php

session_start();

if (!isset($_SESSION['role'])) {

    header("Location: auth/login.php");
    exit();

}

if ($_SESSION['role'] == 'admin') {

    header("Location: admin/dashboard.php");
    exit();

} elseif ($_SESSION['role'] == 'user') {

    header("Location: user/dashboard.php");
    exit();

}