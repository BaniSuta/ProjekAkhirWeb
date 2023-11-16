<?php
session_start();

require "../inc/function.php";

if (!isset($_SESSION["login"]) || $_SESSION["type"] != "user") {
    alertUser();
}


$idConsole = $_GET["id"];
$idUser = $_SESSION["id"];

$queryUser = mysqli_query($conn, "SELECT username FROM `akun` WHERE id_user = $idUser");
$dataUser = mysqli_fetch_assoc($queryUser);

$queryConsole = mysqli_query($conn, "SELECT nama_console FROM console WHERE id_console = $idConsole");
$dataConsole = mysqli_fetch_assoc($queryConsole);

$now = time();


$dateNow = date("d-m-Y", $now);
$dateKembali = date("d-m-Y", strtotime("+1 month", $now));

if (isset($_POST["submit"])) {
    $id_user = $_POST["id_user"];
    $id_console = $_POST["id_console"];
    $tgl_pinjam = date("Y-m-d", strtotime($_POST["tgl_pinjam"]));
    $tgl_kembali = date("Y-m-d", strtotime($_POST["tgl_kembali"]));

    $queryInsert = mysqli_query($conn, "INSERT INTO transaksi VALUES (NULL, $id_user, $id_console, '$tgl_pinjam', '$tgl_kembali', '0')");
    if ($queryInsert) {
        echo "
        <script>
        alert('Berhasil Melakukan Peminjaman!');
        document.location.href = 'index.php';
        </script>
        ";
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
    <link rel="stylesheet" href="../style/pesan.css">
</head>

<body>
    <div class="container">
        <h1>Informasi Peminjaman</h1>
        <form action="" method="post">
            <div class="row">
                <label for="nama">Nama Peminjam</label>
                <input type="text" value="<?= $dataUser["username"] ?>" readonly>
                <input type="hidden" name="id_user" value="<?= $idUser ?>">
            </div>
            <div class="row">
                <label for="nama_console">Nama Console</label>
                <input type="text" value="<?= $dataConsole["nama_console"] ?>" readonly>
                <input type="hidden" name="id_console" value="<?= $idConsole ?>">
            </div>
            <div class="row">
                <label for="tgl_pinjam">Tanggal Peminjaman</label>
                <input type="text" name="tgl_pinjam" id="tgl_pinjam" value="<?= $dateNow ?>" readonly>
            </div>
            <div class="row">
                <label for="tgl_kembali">Tanggal Pengembalian</label>
                <input type="text" name="tgl_kembali" id="tgl_kembali" value="<?= $dateKembali ?>" readonly>
            </div>
            <div class="row">
                <button type="submit" name="submit" class="btn primary">Pinjam</button>
                <a href="index.php" class="btn secondary">Kembali</a>
            </div>
        </form>
    </div>
    <script>
        if (localStorage.getItem('mode') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    </script>
</body>

</html>