<?php
    include "service/database.php";
    session_start();

    $loginMassage = "";
    if(isset($_SESSION['isLogin'])){
        header ('location: dashboard.php');
    }

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if( $username!="" && $password!="" ){
            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' ";

            $result = $db->query($sql);

            if ($result-> num_rows > 0){
                $data = $result->fetch_assoc();
                $_SESSION['username'] = $data['username'];
                $_SESSION['isLogin'] = true;
                header("location: dashboard.php");
            } else {
                $loginMassage = "Akun tidak ditemukan, regist dulu dong:3";
            }
            $db->close();
        } else {
            $loginMassage = "Username dan password kosong, isi form login dengan baik!";
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
    <h3>Masuk akun sekarang</h3>
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Username"><br><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <button type="submit" name="login">Masuk</button><br><br>
        <i>
            <?=$loginMassage?>
        </i>

    </form>
    <?php include "layout/footer.html"?>
</body>
</html>