<?php

$koneksi = new mysqli("localhost", "root", "", "sekolah_miqdar");

if ($koneksi->connect_errno){
    die("Koneksi database gagal : " . connect_error);
}

?>