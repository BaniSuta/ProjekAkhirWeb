<?php
session_start();
require "../inc/function.php";

if (!isset($_SESSION["login"]) || $_SESSION["type"] != "admin") {
    alertAdmin();
}

$queryConsoleDipinjam = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM `transaksi` WHERE `status` = 0");
$dataConsoleDipinjam = mysqli_fetch_assoc($queryConsoleDipinjam);

$queryConsoleKembali = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM `transaksi` WHERE `status` = 1");
$dataConsoleKembali = mysqli_fetch_assoc($queryConsoleKembali);

$queryJmlUser = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM `akun` WHERE `type` = 'user' GROUP BY `type`");
$dataJmlUser = mysqli_fetch_assoc($queryJmlUser);

$queryJmlConsole = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM console");
$dataJmlConsole = mysqli_fetch_assoc($queryJmlConsole);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Console - Admin</title>
    <link rel="icon" type="image/x-icon" href="../img/logo-atas.png">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/indexAdmin.css">
</head>

<body>
    <?php include "../inc/header.php" ?>

    <div class="container">
        <a href="listConsolePinjam.php?status=0">
            <div class="card">
                <img src="../img/console.png" alt="">
                <div class="text">
                    <h2><?= $dataConsoleDipinjam["jumlah"] ?></h2>
                    <p>Console Belum Dikembalikan</p>
                </div>
            </div>
        </a>
        <a href="listConsolePinjam.php?status=1">
            <div class="card">
                <img src="../img/console.png" alt="">
                <div class="text">
                    <h2><?= $dataConsoleKembali["jumlah"] ?></h2>
                    <p>Console Telah Dikembalikan</p>
                </div>
            </div>
        </a>
        <a href="listConsole.php">
            <div class="card">
                <img src="../img/console.png" alt="">
                <div class="text">
                    <h2><?= $dataJmlConsole["jumlah"] ?></h2>
                    <p>Console Terdaftar</p>
                </div>
            </div>
        </a>
        <a href="listUser.php">
            <div class="card">
                <img src="../img/user.png" alt="">
                <div class="text">
                    <h2><?= $dataJmlUser["jumlah"] ?></h2>
                    <p>Pelanggan Terdaftar</p>
                </div>
            </div>
        </a>
    </div>
    <script src="../js/jquery.js"></script>
    <script src="../js/script.js"></script>
    <script>
        if (localStorage.getItem('mode') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    </script>
</body>

</html>