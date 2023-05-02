<?php
    // koneksi database
    $conn = mysqli_connect("localhost","root","","baju1");

    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }


    function tambah($data){
        global $conn;

        $gambar = upload();
        if(!$gambar){
            return false;
        }
        $kode = htmlspecialchars($data["kode"]);
        $nama = htmlspecialchars($data["nama"]);
        $harga = htmlspecialchars($data["harga"]);

        $query = "INSERT INTO inventory 
        VALUES 
        ('', '$gambar' , '$kode' , '$nama' , '$harga')";
        mysqli_query($conn, $query);


        return mysqli_affected_rows($conn);
    }

    function upload(){

        $namafile = $_FILES['gambar']['name'];
        $ukuranfile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpname = $_FILES['gambar']['tmp_name'];

        if($error === 4){
            echo "<script>

                    alert('pilih gambar terlebih dahulu!');

                 </script>";

                 return false;
        }

        // cek apakah yg dikirim itu gambar
        $ekstensigambarvalid = ['jpg' , 'png' , 'jpeg'];
        $ekstensigambar = explode('.', $namafile);
        $ekstensigambar = strtolower(end($ekstensigambar));

        if( !in_array($ekstensigambar , $ekstensigambarvalid)) {
            echo "<script>

                    alert('yang anda upload bukan gambar!');

                 </script>";

                 return false;
        }

       // cek ukuran gambar 
       if($ukuranfile > 1000000) {
            echo "<script>

                    alert('ukuran gambar terlalu besar!');

                  </script>";

     return false;   
       }
    

    //    apabila gambar sesuai
    //    generate nama gambar
      
       $namafilebaru = uniqid();
       $namafilebaru .= '.' ;
       $namafilebaru .= $ekstensigambar;


    move_uploaded_file($tmpname , 'img/' . $namafilebaru);
    return $namafilebaru;


    }

    function hapus($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM inventory WHERE id = $id");
        
        return mysqli_affected_rows($conn); 
    }


    function ubah($data){
        global $conn;
        $id = $data["id"];

        
        $gambarlama = htmlspecialchars($data["gambarlama"]);

        // apakah user sudah memilih gambar

        if($_FILES['gambar'] ['error'] === 4){
            $gambar = $gambarlama;
        }else{
            $gambar = upload();
        }
      

        $kode = htmlspecialchars($data["kode"]);
        $nama = htmlspecialchars($data["nama"]);
        $harga = htmlspecialchars($data["harga"]);

        $query = "UPDATE inventory SET 
                        gambar = '$gambar',
                        kode = '$kode',
                        nama = '$nama',
                        harga = '$harga'
                        WHERE id= $id
                         ";
        mysqli_query($conn, $query);


        return mysqli_affected_rows($conn);
    }

    function cari($keyword){
        $query = "SELECT * FROM inventory
                        WHERE
                      nama LIKE '%$keyword%' OR
                      kode LIKE '%$keyword%' OR
                      harga LIKE '%$keyword%' 
                      ";  
        return query($query);
    }


    function registrasi($data){
        global $conn;

        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string( $conn, $data["password"]);
        $password2 = mysqli_real_escape_string( $conn, $data["password2"]);

        // mengecek username udah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

        if(mysqli_fetch_assoc($result)){
            echo "<script>
            
                    alert('username yang dipilih sudah terdaftar!')

                  </script>"; 
                  return false;
        }

        if( $password !== $password2 ) {
            echo "<script>
            
                    alert('konfirmasi password tidak sesuai!');

                  </script>";

                  return false;

        }

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
        // tambah ke database
        mysqli_query($conn, "INSERT INTO user  VALUES('', '$username' , '$password')");

        return mysqli_affected_rows($conn);

    }

?>