<?php

require 'functions.php';


    if( isset($_POST["register"])){
        if ( registrasi($_POST) > 0){
            echo "<script>
            
                    alert('user baru berhasil ditambahkan!');

                  </script>";
        }else{
            echo mysqli_error($conn);
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman registrasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" href="css/registrasii.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="img/x-icon">
    <link rel="icon" href="img/favicon.ico" type="img/x-icon">

    <style>
        label{
            display: block;
        }
    </style>
</head>
<body class="registrasi">
    <div class="container">

        <form action="" method="post" class="registrasi_admin">
            <p class="text">Registrasi Akun</p>
            <div>
                <div class="input_admin">
                    <label for="username">username :</label>
                    <input type="text" name="username" id="username" placeholder="username">
                </div>
                <div class="input_admin">
                    <label for="password">password :</label>
                    <input type="password" name="password" id="password" placeholder="password">
                </div>
                <div class="input_admin">
                    <label for="password2">konfirmasi password :</label>
                    <input type="password" name="password2" id="password2" placeholder="konfirmasi password">
                </div>
                <div class="input_admin" align="center">
                    <button  type="submit" name="register">register!</button>
                </div>
             </div>
             <p style="color: black;" align="center">Sudah punya akun? <a href="login.php" style="color: yellow; font-weight: bold;">Login</a> </p>

        </form>
    </div>
</body>
</html>