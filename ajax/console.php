<?php
require "../inc/function.php";
$keyword = $_GET["keyword"];
$query = mysqli_query($conn, "SELECT * FROM console WHERE nama_console LIKE '%$keyword%'");

while ($console = mysqli_fetch_assoc($query)) : ?>
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
<?php endwhile ?>