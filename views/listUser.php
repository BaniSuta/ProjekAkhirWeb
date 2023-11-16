<?php
session_start();
require "../inc/function.php";

if (!isset($_SESSION["login"]) || $_SESSION["type"] != "admin") {
    alertAdmin();
}

$query = mysqli_query($conn, "SELECT * FROM `akun` WHERE `type` = 'user' ");
$nomor = 1;

while ($row = mysqli_fetch_assoc($query)) {
    $users[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Console - Admin</title>
    <link rel="icon" type="image/x-icon" href="../img/logo-atas.png">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/listConsole.css">
</head>

<body>
    <div class="box">
        <div class="container">
            <h1>LIST USER</h1>
            <div class="btn-group">
                <a href="indexAdmin.php" class="btn secondary back">Kembali</a>
            </div>
            <div class="search">
                <input type="search" class="keyword" name="keyword" id="keyword" placeholder="Search" autofocus autocomplete="off">
                <button type="submit" id="tombol-cari" name="cari">Cari!</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody id="cont">
                    <?php if (!empty($users)) : ?>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?= $nomor ?>.</td>
                                <td><?= $user["username"] ?></td>
                                <td><a href="deleteUser.php?id=<?= $user["id_user"] ?>" class="btn danger">Hapus</a></td>
                            </tr>
                        <?php $nomor++;
                        endforeach ?>
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
    <script src="../js/jquery.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>