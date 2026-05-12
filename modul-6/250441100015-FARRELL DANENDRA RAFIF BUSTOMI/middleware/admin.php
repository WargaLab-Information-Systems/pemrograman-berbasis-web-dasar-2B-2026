<?php

include 'auth.php';

if ($_SESSION['role'] != 'admin') {

    header("Location: ../index.php");
    exit();

}