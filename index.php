<?php
    session_start();
    
    if( !isset($_SESSION["login"])){
        header("location: login.php");
        exit;
    }
    require 'functions.php';

  $baju = query("SELECT * FROM inventory");

  
//   apabila tombol cari ditekan, maka yang ditampilkan hasil yang dicari
 if( isset($_POST["cari"]) ) {
    $baju = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/indexx.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="img/x-icon">
    <link rel="icon" href="img/favicon.ico" type="img/x-icon">
    <title>halaman admin</title>
    <style>
        .loader{
            width: 100px; 
            position: absolute;
            left: 240px;
            top: 103px;
            z-index: -1;
            display: none;
        }

        @media print{
            .logout, .tambah, .cari, .aksi{
                display: none;
            }
        }

    </style>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <div class="fcontainer">
        <nav class="wrapper">
            <div class="judul">
                <h1>Inventory</h1>
            </div>            
                    <ul class="navigation">

                    <li><a href="tambah.php" class="tambah">Tambah Data</a></li>   
                    <li><a href="cetak.php">Cetak</a></li>           
                    <li><a href="logout.php"  class ="active" class="logout">Logout</a></li> 
                              
                    </ul>                            
        </nav>
    </div>
        <nav class="wrapper2">
            <div class="cari" >
                <form action="" method="post" class="cari">
                <input type="text" name="keyword" size="30" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off"> 
                <button type="submit" name="cari">Cari</button>
                <img src="img/loader.gif" class="loader">
                </form>
            </div>
        </nav>
 
    <div class="container" id="container">
        <div class="tabel ">
            <table border="1" cellpadding="10" cellspacing="0" >
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th class="aksi">Aksi</th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach( $baju as $row ): ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><img src="img/<?php echo $row["gambar"];?>"></td>
                    <td><?php echo $row["kode"];?></td>
                    <td><?php echo $row["nama"];?></td>
                    <td><?php echo $row["harga"];?></td>
                    <td class="aksi">
                        <a href="ubah.php?id=<?= $row["id"];?>">ubah</a> |
                        <a href="hapus.php?id=<?php echo $row["id"];?>" onclick="return confirm('yakin ingin menghapus data?');">hapus</a>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
   
</body>
</html>