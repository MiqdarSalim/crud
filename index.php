<?php
include "koneksi.php";
session_start();

    if (isset($_SESSION['sesdarUsn'])){
        header("Location: read.php");
        exit();
    }

    $pesan_salah;

    if (isset($_POST['masuk'])){
           $nama = $koneksi->real_escape_string($_POST['nama']);
           $sandi = $koneksi->real_escape_string($_POST['sandi']);
           if (!empty($nama) && !empty($sandi)){
                $query = "select * from pengguna where binary nama='$nama' and binary kata_sandi='$sandi'";
                $hasil = $koneksi->query($query);
                if ($hasil->num_rows > 0){
                    while ($h = $hasil->fetch_assoc()){
                        $_SESSION['sesdarUsn'] = $h['nama'];
                        header("Location: read.php");
                        exit();
                    }
                }else{
                    //munculkan jika username atau password salah atau benar
                    $pesan_salah = "Nama Pengguna atau Kata Sandi Anda Salah !";
                }
           }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        .form-login {
            max-width: 300px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-login h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        
        .form-login label {
            display: block;
            margin-bottom: 10px;
            color: red;
        }
        
        .form-login input[type="text"],
        .form-login input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        
        .form-login button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        
        .form-login button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-login">
        <h1>Data Siswa</h1>
        <form action="" method="post">
            <?php if (!empty($pesan_salah)){?>
                <label for="form-login">Nama Pengguna atau Kata Sandi Anda Salah !</label>
            <?php }?>
            <div class="nama">
                 Nama Pengguna :    
                <input type="text" name="nama" id="nama" required>
            </div>
            <div class="sandi">
                Kata Sandi :
                <input type="password" name="sandi" id="sandi" required>
            </div>
            <button name="masuk">Masuk</button>
        </form>
    </div>
</body>
</html>