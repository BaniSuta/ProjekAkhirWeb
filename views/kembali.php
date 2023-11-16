<?php
session_start();
require "../inc/function.php";

if (!isset($_SESSION["login"]) || $_SESSION["type"] != "user") {
    alertUser();
}

$idUser = $_SESSION["id"];
$idTransaksi = $_GET["id"];

$queryCheck = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi = $idTransaksi");
$dataCheck = mysqli_fetch_assoc($queryCheck);

if ($dataCheck["id_user"] == $idUser) {
    if ($dataCheck["status"] != 1) {
        $query = mysqli_query($conn, "UPDATE transaksi SET `status` = 1 WHERE id_transaksi = $idTransaksi");
        if ($query) {
            echo "
            <script>
            alert('Berhasil Melakukan Pengembalian!');
            document.location.href = 'history.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
        alert('Console Sudah Pernah Dikembalikan!');
        document.location.href = 'history.php';
        </script>
        ";
    }
}
