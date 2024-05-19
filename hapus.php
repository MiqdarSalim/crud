<?php
include "koneksi.php";
session_start();

    if (!isset($_SESSION['sesdarUsn'])){
        header("Location: index.php");
        exit();
    }


if (isset($_GET['id'])){
    $id = $_GET['id'];
    $result = $koneksi->query("delete from siswa where id='$id'");
    if ($result){
        header("Location: read.php");
    }else{
        echo "<script>alert('Terjadi kesalahan saat menghapus data!.')</script>";
        header("Location: read.php");
    }
}

?>