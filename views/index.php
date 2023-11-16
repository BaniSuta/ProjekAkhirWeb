<?php
session_start();
require "../inc/function.php";
$query = mysqli_query($conn, "SELECT * FROM console");

while ($row = mysqli_fetch_assoc($query)) {
    $consoles[] = $row;
}

if (isset($_SESSION["type"])) {
    if ($_SESSION["type"] == "user") {
        $idUser = $_SESSION["id"];
        $now = date("Y-m-d");
        $queryCheck = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM transaksi WHERE id_user = $idUser AND  `status` = 0 AND tgl_akhir < '$now'");
        $hasilCheck = mysqli_fetch_assoc($queryCheck);
        if ($hasilCheck["jumlah"] > 0) {
            $jumlah = $hasilCheck["jumlah"];
            echo "
            <script>
            alert('Terdapat $jumlah Pinjaman Belum Dikembalikan!');
            </script>
            ";
        }
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
    <link rel="stylesheet" href="../style/index.css">
</head>

<body>
    <?php include "../inc/header.php" ?>
    <section class="hero">
        <img src="../img/hero.jpg" alt="">
        <div class="hero-title">
            <h1>Boss Console</h1>
            <hr>
            <p>Rental Console Terbaik di Asia Tenggara</p>
        </div>
    </section>

    <div class="search">
        <input type="search" class="keyword" name="keyword" id="keyword" placeholder="Search" autofocus autocomplete="off">
        <button type="submit" id="tombol-cari" name="cari">Cari!</button>
    </div>

    <div class="container" id="product">
        <?php if (!empty($consoles)) : ?>
            <?php foreach ($consoles as $console) : ?>
                <a href="pesan.php?id=<?= $console["id_console"] ?>">
                    <div class="card">
                        <div class="card-image">
                            <img src="../img/data/<?= $console["gambar"] ?>" alt="">
                        </div>
                        <div class="card-text">
                            <p><?= $console["nama_console"] ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
        <?php endif ?>
    </div>


    <?php include "../inc/footer.php" ?>
    <script>
        if (localStorage.getItem('mode') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    </script>
    <script src="../js/jquery.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>