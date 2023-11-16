<?php
session_start();
require "../inc/function.php";

if (!isset($_SESSION["login"]) || $_SESSION["type"] != "admin") {
    alertAdmin();
}

$query = mysqli_query($conn, "SELECT * FROM console");

$nomor = 1;
while ($row = mysqli_fetch_assoc($query)) {
    $consoles[] = $row;
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
            <h1>LIST CONSOLE</h1>
            <div class="btn-group back-group">
                <a href="addConsole.php" class="btn primary">Tambah</a>
                <a href="indexAdmin.php" class="btn secondary">Kembali</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($consoles)) : ?>
                        <?php foreach ($consoles as $console) : ?>
                            <tr>
                                <td><?= $nomor ?>.</td>
                                <td><img src="../img/data/<?= $console["gambar"] ?>" alt=""></td>
                                <td><?= $console["nama_console"] ?></td>
                                <td>Rp. <?= $console["harga"] ?></td>
                                <td><a href="editConsole.php?id=<?= $console["id_console"] ?>" class="btn success">Ubah</a> <a href="deleteConsole.php?id=<?= $console["id_console"] ?>" class="btn danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data : <?= $console['nama_console'] ?>')">Hapus</a></td>
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
</body>

</html>