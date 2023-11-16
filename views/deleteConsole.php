<?php
session_start();
require "../inc/function.php";

if (!isset($_SESSION["login"]) || $_SESSION["type"] != "admin") {
    alertAdmin();
}

$id = $_GET["id"];

$get_foto = mysqli_query($conn, "SELECT gambar FROM console WHERE id_console = $id");

$data_old = mysqli_fetch_array($get_foto);
unlink("../img/data/" . $data_old['gambar']);

$query = mysqli_query($conn, "DELETE FROM console WHERE id_console = $id");

if ($query) {
    echo "
    <script>
    alert('Berhasil Menghapus Console!');
    document.location.href = 'listConsole.php';
    </script>
    ";
}
