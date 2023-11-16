<?php
session_start();
require "../inc/function.php";

if (isset($_SESSION["login"])) {
    header("Location:index.php");
    exit;
}

$errorName = false;
$errorAdmin = false;
$errorPass = false;

if (isset($_POST["submit"])) {
    $username = htmlspecialchars(strtolower($_POST["username"]));
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    if ($password === $cpassword) {
        $queryCheck = mysqli_query($conn, "SELECT * FROM `akun` WHERE username = '$username'");
        if ($username == "admin") {
            $errorAdmin = true;
        } else if (mysqli_fetch_assoc($queryCheck)) {
            $errorName = true;
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $queryInsert = mysqli_query($conn, "INSERT INTO `akun` VALUES (NULL, '$username', '$password', 'user')");
            if ($queryInsert) {
                echo "
                <script>
                alert('Berhasil Registrasi!');
                document.location.href = 'login.php';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('Registrasi Gagal!');
                document.location.href = 'register.php';
                </script>
                ";
            }
        }
    } else {
        $errorPass = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Console</title>
    <link rel="icon" type="image/x-icon" href="../img/logo-atas.png">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/logreg.css">
</head>

<body>
    <div class="container">
        <h1>SIGN UP</h1>
        <div class="container-form">
            <?php if ($errorName == true) : ?>
                <p class="error">Username sudah ada !</p>
            <?php endif ?>
            <?php if ($errorAdmin == true) : ?>
                <p class="error">Dilarang Menggunakan Username Admin !</p>
            <?php endif ?>
            <?php if ($errorPass == true) : ?>
                <p class="error">Password dan Konfirmasi Password Tidak sama !</p>
            <?php endif ?>
            <form action="" method="post">
                <div class="row">
                    <input type="text" name="username" placeholder="Username... (huruf kecil)" id="username" autofocus required>
                </div>
                <div class="row">
                    <input type="password" name="password" placeholder="Password..." id="password" required>
                </div>
                <div class="row">
                    <input type="password" name="cpassword" placeholder="Konfirmasi Password..." id="cpassword" required>
                </div>
                <div class="row">
                    <button type="submit" class="btn primary" name="submit">Sign Up</button>
                </div>
                <div class="row">
                    <a href="login.php" class="btn secondary back">Kembali</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        if (localStorage.getItem('mode') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    </script>
</body>

</html>