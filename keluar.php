<?php
include 'koneksi.php';
session_start();

    if (!isset($_SESSION['sesdarUsn'])){
        header("Location: index.php");
        exit();
    }

session_start();
session_unset();
session_destroy();
$koneksi->close();
header("Location: index.php");
exit();
?>