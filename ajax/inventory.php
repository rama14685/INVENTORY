<?php
// sleep(1);
    require '../functions.php';
    $keyword = $_GET["keyword"];

    $query = "SELECT * FROM inventory
                        WHERE
                      nama LIKE '%$keyword%' OR
                      kode LIKE '%$keyword%' OR
                      harga LIKE '%$keyword%' 
                      ";
    $inventory = query($query);
?>

<table style="position: relative;" border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>gambar</th>
        <th>kode</th>
        <th>nama</th>
        <th>harga</th>
        <th>aksi</th>
    </tr>

    <?php $i = 1; ?>
    <?php foreach( $inventory as $row ): ?>
    <tr>
        <td><?= $i; ?></td>
        <td><img src="img/<?php echo $row["gambar"];?>"></td>
        <td><?php echo $row["kode"];?></td>
        <td><?php echo $row["nama"];?></td>
        <td><?php echo $row["harga"];?></td>
        <td>
            <a href="ubah.php?id=<?= $row["id"];?>">ubah</a> |
            <a href="hapus.php?id=<?php echo $row["id"];?>" onclick="return confirm('yakin ingin menghapus data?');">hapus</a>
        </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
</table>