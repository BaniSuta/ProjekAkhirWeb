<?php
require "../inc/function.php";
$id = $_GET["id"];

$query = mysqli_query($conn, "DELETE FROM `akun` WHERE `id_user` = $id");

if ($query) {
    echo "
    <script>
    alert('Berhasil Menghapus User!');
    document.location.href = 'listUser.php';
    </script>
    ";
}
