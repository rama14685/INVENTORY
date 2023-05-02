<?php
session_start();
if( !isset($_SESSION["login"])){
    header("location: login.php");
    exit;
}
    require 'functions.php';
    if( isset($_POST["submit"])) {

       
       if( tambah($_POST) > 0){
        echo "
            <script>

            alert ('data berhasil ditambahkan!');
            document.location.href = 'index.php';
            </script>

        ";
       }else{
        echo "
            <script>

            alert ('data gagal ditambahkan!');
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
    <link rel="stylesheet" href="css/tambahh.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="img/x-icon">
    <link rel="icon" href="img/favicon.ico" type="img/x-icon">

    <title>tambah data</title>
</head>
<body>
    <div class="l-form">
       
        <form action="" method="post" enctype="multipart/form-data" class="form">
        <h1 class="judul" align="center">Tambah Data</h1>
            <div>
            
                <div class="form_div">
                    <label for="gambar">GAMBAR :</label>
                    <input type="file" name="gambar" id="gambar" >
                </div>

                <div>
                    <label for="kode" >KODE:<br></label>
                    <input type="text" name="kode" id="kode" required >
                </div>

                <div>
                    <label for="nama" >NAMA:<br></label>
                    <input type="text" name="nama" id="nama" required >
                </div>

                <div>
                    <label for="harga" >HARGA:<br></label>
                    <input type="text" name="harga" id="harga" required  >
                </div>
                <br>
                <div>
                    <button type="submit" name="submit" class="form_btn">Tambah Data</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>         