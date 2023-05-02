<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: login.php");
    exit;
}
    require 'functions.php';

    $id = $_GET["id"];
    $bj = query("SELECT * FROM  inventory WHERE id = $id")["0"];


    if( isset($_POST["submit"])) {

       if( ubah($_POST) > 0){
        echo "
            <script>

            alert ('data berhasil diubah!');
            document.location.href = 'index.php';
            </script>

        ";
       }else{
        echo "
            <script>

            alert ('data gagal diubah!');
            document.location.href = 'index.php';
            </script>

        "; 
       }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ubahh.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="img/x-icon">
    <link rel="icon" href="img/favicon.ico" type="img/x-icon">

    <title>ubah data</title>
</head>
<body>
   <div class="l-form">
        <form action="" method="post" enctype="multipart/form-data" class="form">
        <h1 align="center" class="judul">ubah data</h1>
            <input type="hidden" name="id" value="<?= $bj["id"];?>">
            <input type="hidden" name="gambarlama" value="<?= $bj["gambar"];?>">
                        
                <div >
                    <label for="gambar">GAMBAR:</label><br>
                    <img src="img/<?= $bj['gambar']; ?>" width="70"><br>
                    <input type="file" name="gambar" id="gambar">
                </div>
                <br>
                <div class="form_div">
                    <label for="kode">KODE :</label>
                    <input type="text" name="kode" id="kode" required value="<?= $bj["kode"]; ?>">
                </div>
                <div class="form_div">
                    <label for="nama">NAMA :</label>
                    <input type="text" name="nama" id="nama" required value="<?= $bj["nama"]; ?>">
                </div>
                <div class="form_div">
                    <label for="harga">HARGA :</label>
                    <input type="text" name="harga" id="harga" required value="<?= $bj["harga"]; ?>">
                </div>
                <div>
                    <button class="form_btn" type="submit" name="submit">ubah Data</button>
                </div>
            
        </form>
    </div>
</body>
</html>