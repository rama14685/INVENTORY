<?php
session_start();
require 'functions.php';

// // cek cookie
if(isset($_COOKIE["id"]) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result =mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);


    if( $key === hash('sha256' , $row['username'])){
        $_SESSION['login'] = true;
    }
     
   
}

 if(isset($_SESSION["login"])){
    header("location: index.php");
    exit;
 }



    if( isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

      $result =  mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

        // cek username
        if( mysqli_num_rows($result) === 1 ){
            // cek password
            $row = mysqli_fetch_assoc($result);
            if( password_verify($password, $row["password"])){
                // cek session
                $_SESSION["login"] = true;
                // cek remember me

                if( isset($_POST['remember'])){


                    setcookie('id', $row['id'], time()+60);
                     setcookie('key', hash('sha256', $row['username']),time()+60);
                }

                header("location: index.php");
                exit;
            }
        }

        $error = true;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" href="css/loginn.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="img/x-icon">
    <link rel="icon" href="img/favicon.ico" type="img/x-icon">


</head>
<body class="login">
    

    <div class="container">


        <form action="" method="post" class="login_admin">
            <div>
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
                <div class="inputt">
                    <label for="username" >username :</label>
                    <input type="text" placeholder="username" name="username" id="username">
                </div>
                <br>
                
                <div class="inputt">
                    <label for="password">password :</label>
                    <input type="password" placeholder="password" name="password" id="password">
                </div>
                <br>

                <div class="inputt">
                    <input type="checkbox" name="remember" id="remember"> 
                    <label for="remember">Remember Me :</label>

                </div>


                <?php  if(isset($error)) :?>
                    <p style ="color: white; font-style: italic;">username / password salah</p>
                <?php endif ; ?>


                <div class="inputt" align="center">
                    <button  type="submit" name="login">Login</button>
                </div>
            </div>

            <p style="color: white;" align="center"> Belum punya akun? <a href="registrasi.php" style="color: yellow; font-weight: bold;">Registrasi</a></p>


        </form>
    </div>
</body>
</html>