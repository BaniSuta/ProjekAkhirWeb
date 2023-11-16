<?php
session_start();
require "../inc/function.php";

if (!isset($_SESSION["login"]) || $_SESSION["type"] != "admin") {
    alertAdmin();
}

$status = $_GET["status"];
$queryTransaksi = mysqli_query($conn, "SELECT * FROM transaksi JOIN console ON transaksi.id_console = console.id_console JOIN akun ON transaksi.id_user = akun.id_user WHERE transaksi.status = $status");

while ($row = mysqli_fetch_assoc($queryTransaksi)) {
    $trans[] = $row;
}

date_default_timezone_set("Asia/Makassar");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Console</title>
    <link rel="icon" type="image/x-icon" href="../img/logo-atas.png">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/listConsole.css">
</head>

<body>
    <div class="box">
        <div class="container">
            <h1>LIST CONSOLE DIPINJAM</h1>
            <div class="btn-group">
                <a href="indexAdmin.php" class="btn secondary back">Kembali</a>
            </div>
            <?php if ($status == 0) {
                include "../inc/tablePinjam.php";
            } else {
                include "../inc/tableKembali.php";
            } ?>
        </div>
    </div>
    <script>
        if (localStorage.getItem('mode') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    </script>
</body>

</html>