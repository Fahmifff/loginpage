<?php
    include "service/database.php";

    $registMassage="";
    session_start();

    $loginMassage = "";
    if(isset($_SESSION['isLogin'])){
        header ('location: dashboard.php');
    }

    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if( $username!="" && $password!="" ){           
            try{
                $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

                if ($db->query($sql)){
                    $registMassage = "Data berhasil masuk, silahkan login";
                } else {
                    $registMassage = "Data gagal masuk, coba lagi";
                }
            } catch (mysqli_sql_exception){
                $registMassage = "Username sudah digunakan";
            }
            $db->close(); 
        } else {
            $registMassage ="Username atau password kosong, harap diisi dengan baik";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "layout/header.html"?>
    <h3>Daftar akun sekarang</h3>
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Username"><br><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <button type="submit" name="register">Daftar</button><br><br>
        <i>
            <?= $registMassage ?>
        </i>
    </form>
    <?php include "layout/footer.html"?>
</body>
</html>