<?php
session_start();
require "../inc/function.php";

if (isset($_SESSION["login"])) {
    header("Location:index.php");
    exit;
}

$errorName = false;
$errorPass = false;

if (isset($_POST["submit"])) {
    $username = htmlspecialchars(strtolower($_POST["username"]));
    $password = $_POST["password"];

    $queryCheck = mysqli_query($conn, "SELECT * FROM `akun` WHERE username = '$username'");

    if (mysqli_num_rows($queryCheck) == 1) {
        $data = mysqli_fetch_assoc($queryCheck);
        if ($data["username"] == "admin") {
            if (password_verify($password, $data["password"])) {
                $username = strtoupper($username);
                $_SESSION["login"] = true;
                $_SESSION["type"] = "admin";
                echo "
                <script>
                alert('Selamat Datang $username!');
                document.location.href = 'index.php';
                </script>";
            } else {
                $errorPass = true;
            }
        } else {
            if (password_verify($password, $data["password"])) {
                $username = strtoupper($username);
                $_SESSION["id"] = $data["id_user"];
                $_SESSION["login"] = true;
                $_SESSION["type"] = "user";
                echo "
                <script>
                alert('Selamat Datang $username!');
                document.location.href = 'index.php';
                </script>";
            } else {
                $errorPass = true;
            }
        }
    } else {
        $errorName = true;
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
        <h1>SIGN IN</h1>
        <div class="container-form">
            <?php if ($errorName == true) : ?>
                <p class="error">Username Yang Anda Inputkan Salah !</p>
            <?php endif ?>
            <?php if ($errorPass == true) : ?>
                <p class="error">Password Yang Anda Inputkan Salah !</p>
            <?php endif ?>
            <form action="" method="post">
                <div class="row">
                    <input type="text" name="username" placeholder="Username... (huruf kecil)" id="username" autofocus required>
                </div>
                <div class="row">
                    <input type="password" name="password" placeholder="Password..." id="password" required>
                </div>
                <div class="row">
                    <button type="submit" class="btn primary" name="submit">Sign In</button>
                </div>
                <div class="login-with-title">
                    <div>
                        <hr>
                    </div>
                    <p>Or Continue With</p>
                    <div>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <p>Don't Have An Account? <a href="register.php">Click Here</a></p>
                </div>
                <div class="row">
                    <a href="index.php" class="btn secondary back">Kembali</a>
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