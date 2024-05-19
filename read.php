<?php
include "koneksi.php";
session_start();

if (!isset($_SESSION['sesdarUsn'])){
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Data Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Selamat Datang <?php echo $_SESSION['sesdarUsn'] ?></h1>
    <table>
        <tr>
            <th>NISN</th>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th colspan="2">Aksi</th>
        </tr>
        <?php
        $query = "select * from siswa";
        $hasil = $koneksi->query($query);
        while ($d = $hasil->fetch_array()){
        ?>
        <tr>
            <td><?php echo $d['nisn']; ?></td>
            <td><?php echo $d['nama_lengkap']; ?></td>
            <td><?php if ($d['jenis_kelamin'] == "L") echo "Laki - Laki"; else echo "Perempuan"; ?></td>
            <td><?php echo $d['tanggal_lahir']; ?></td>
            <td><?php echo $d['alamat']; ?></td>
            <td><a href="ubah.php?id=<?= $d['id'] ?>">Ubah</a></td>
            <td><a href="hapus.php?id=<?= $d['id'] ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <a href="tambah.php">Tambah Data</a>
    <a href="keluar.php">Keluar</a>
</body>
</html>
