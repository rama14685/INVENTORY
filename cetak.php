<?php

session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php?pesan=belum_login");
    exit;
}

include 'functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="img/x-icon">
    <link rel="icon" href="img/favicon.ico" type="img/x-icon">
    <title>cetak</title>
</head>
<body>
<div class="container">
    <div class="back">
        <a href="index.php">Kembali</a>
    </div>
        <center>
            <h2>LAPORAN DATA BARANG</h2>
            <h3>Rama Eka Saputra - A12.2022.14685</h3>
            
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_tampil = "SELECT * FROM inventory";
                    $query_tampil = mysqli_query($conn, $sql_tampil);
                    $no = 1;
                    while ($data = mysqli_fetch_array($query_tampil, MYSQLI_BOTH)) {
                    ?>
                        <tr border=1;>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['kode']; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td>
                                <?php
                                echo $harga = $data['harga'];
                                ?>
                            </td>
                            <td><img src="<?php echo "img/" . $data['gambar']; ?>" width="200" height="100"></td>
                        </tr>
                        <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </center>
        <div class="container mx-3">
            <b pb-3 mb-3>Semarang, <?php echo date("d-m-Y"); ?></b>
            <br>
            <u>Program by Rama Eka Saputra - A12.2022.14685</u>
                <div>
                    <script>
                        //perintah untuk cetak di browser
                        window.print();
                    </script>
                </div>
        </div>

    </div>
</body>
</html>