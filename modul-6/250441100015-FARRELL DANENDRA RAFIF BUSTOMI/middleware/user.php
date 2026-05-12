<?php

include 'auth.php';

if ($_SESSION['role'] != 'user') {

    header("Location: ../index.php");
    exit();

}