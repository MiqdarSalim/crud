<?php
    include "koneksi.php";
    session_start();

    if (!isset($_SESSION['sesdarUsn'])){
        header("Location: index.php");
        exit();
    }


    if (isset($_POST['batal'])){
        header("Location: index.php");
        exit();
    }

    $id = $_GET['id'];

    if (isset($_POST['ubah'])){
        $nisn = $_POST['nisn'];
        $nama = $_POST['nama'];
        $jk = $_POST['jenis-kelamin'];
        $tanggal = $_POST['tanggal'];
        $alamat = $_POST['alamat'];
        if (isset($nisn) && isset($nama) && isset($jk) && isset($tanggal) && isset($alamat)){
            if (strlen($nisn) > 8){
                echo "<script>alert('NISN tidak boleh lebih dari 8 angka !')</script>";
                header("Refresh:0.5");
                exit();
            }

            $query = "update siswa set nisn='$nisn',nama_lengkap='$nama',jenis_kelamin='$jk',tanggal_lahir='$tanggal',alamat='$alamat' where id='$id'";
            $hasil = $koneksi->query($query);
            if ($hasil){
                echo "<script>alert('Berhasil Ubah Data !')</script>";
                header("refresh:0.5;url=index.php");
                exit();
            }else{
                echo "<script>alert('Gagal Mengubah Data !')</script>";
                header("Refresh:0.5");
                exit();
            }
        }else{
            echo "<script>alert('NISN/Nama Lengkap/Jenis Kelamin/Tanggal Lahir/Alamat tidak boleh Kosong !')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        .ubah-data {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .ubah-data h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        
        .ubah-data label {
            display: block;
            margin-bottom: 10px;
        }
        
        .ubah-data input[type="number"],
        .ubah-data input[type="text"],
        .ubah-data input[type="date"],
        .ubah-data textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        
        .ubah-data input[type="radio"] {
            margin-right: 10px;
        }
        
        .ubah-data button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 10px;
        }
        
        .ubah-data button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="ubah-data">
        <h1>Ubah Data</h1>
        <form method="POST" action=""> 
                <?php
                    if (isset($_GET['id'])) {
                        $data = $koneksi->query("select * from siswa where id='$id'");
                        while($d = $data->fetch_array()){
                ?>
                <div class="nisn">
                    NISN : 
                    <input type="number" name="nisn" id="nisn" value="<?php echo $d['nisn']; ?>">
                </div>
                <div class="nama">
                    Nama Lengkap : 
                    <input type="text" name="nama" id="nama" value="<?php echo $d['nama_lengkap']; ?>">
                </div>
                <div class="jenis-kelamin">
                    Jenis Kelamin : 
                    <?php
                    if ($d['jenis_kelamin'] == "L"){
                    ?>
                    <input type="radio" name="jenis-kelamin" id="laki-laki" value="L" checked>Laki-Laki
                    <input type="radio" name="jenis-kelamin" id="perempuan" value="P">Perempuan
                    <?php
                    }else{
                    ?>
                    <input type="radio" name="jenis-kelamin" id="laki-laki" value="L">Laki-Laki
                    <input type="radio" name="jenis-kelamin" id="perempuan" value="P" checked>Perempuan
                    <?php } ?>
                    <br>
                    <br>
                </div>
                <div class="tanggal">
                    Tanggal Lahir : 
                    <input type="date" name="tanggal" id="tanggal" value="<?php echo $d['tanggal_lahir']; ?>">
                </div>
                <div class="alamat">
                    Alamat : 
                    <textarea name="alamat" id="alamat"><?php echo $d['alamat']; ?></textarea>
                </div>
                <button name="ubah">Ubah</button>
                <button name="batal">Batal</button>
                <?php            
                        }
                    }
                ?>
        </form>
    </div>
</body>
</html>