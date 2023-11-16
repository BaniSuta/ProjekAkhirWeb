<?php
require "../inc/function.php";
$keyword = $_GET["keyword"];
$query = mysqli_query($conn, "SELECT * FROM `akun` WHERE `type` = 'user' AND `username` LIKE '%$keyword%'");

$nomor = 1;

while ($user = mysqli_fetch_assoc($query)) : ?>
    <tr>
        <td><?= $nomor ?>.</td>
        <td><?= $user["username"] ?></td>
        <td><a href="deleteUser.php?id=<?= $user["id_user"] ?>" class="btn danger">Hapus</a></td>
    </tr>
<?php $nomor++;
endwhile ?>