<?php
session_start();
require "../inc/function.php";

if (!isset($_SESSION["login"]) || $_SESSION["type"] != "user") {
    alertUser();
}

$idUser = $_SESSION["id"];
$queryTransaksi = mysqli_query($conn, "SELECT * FROM transaksi JOIN console ON transaksi.id_console = console.id_console WHERE transaksi.id_user = $idUser");

while ($row = mysqli_fetch_assoc($queryTransaksi)) {
    $trans[] = $row;
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
    <link rel="stylesheet" href="../style/listConsole.css">
</head>

<body>
    <div class="box">
        <div class="container">
            <h1>HISTORY PEMINJAMAN</h1>
            <div class="btn-group">
                <a href="index.php" class="btn secondary back">Kembali</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nomor Peminjaman</th>
                        <th>Nama Console</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($trans)) : ?>
                        <?php foreach ($trans as $transaksi) : ?>
                            <tr>
                                <td><?= $transaksi["id_transaksi"] ?></td>
                                <td><?= $transaksi["nama_console"] ?></td>
                                <td><?= date("d-m-Y", strtotime($transaksi["tgl_awal"])) ?></td>
                                <td><?= date("d-m-Y", strtotime($transaksi["tgl_akhir"])) ?></td>
                                <td>
                                    <?php if (strtotime("now") < strtotime($transaksi["tgl_akhir"]) && $transaksi["status"] == 0) {
                                        echo "<p style='background-color: skyblue; border-radius: 5px; padding: 4px; color: #efefef;'>Belum Jatuh Tempo</p>";
                                    } else if (strtotime("now") > strtotime($transaksi["tgl_akhir"]) && $transaksi["status"] == 0) {
                                        echo "<p style='background-color: red; border-radius: 5px; padding: 4px; color: #efefef;'>Sudah Jatuh Tempo</p>";
                                    } else {
                                        echo "<p style='background-color: green; border-radius: 5px; padding: 4px; color: #efefef;'>Console Sudah Dikembalikan</p>";
                                    } ?>
                                </td>
                                <td><a href="kembali.php?id=<?= $transaksi["id_transaksi"] ?>" class="btn success">Kembalikan</a></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        if (localStorage.getItem('mode') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    </script>
</body>

</html>