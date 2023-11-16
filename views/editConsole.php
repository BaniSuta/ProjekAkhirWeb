<?php
session_start();
require "../inc/function.php";

if (!isset($_SESSION["login"]) || $_SESSION["type"] != "admin") {
    alertAdmin();
}

$id = $_GET["id"];

$querySelect = mysqli_query($conn, "SELECT * FROM console WHERE id_console = $id");
$get_foto = mysqli_query($conn, "SELECT gambar FROM console WHERE id_console = $id");
$data = mysqli_fetch_assoc($querySelect);

if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $nama = htmlspecialchars($_POST["nama"]);
    $harga = $_POST["harga"];
    if ($_FILES["gambar"]["name"] != "") {
        if ($ekstensigmbr == "jpg" || $ekstensigmbr == "jpeg" || $ekstensigmbr == "png") {
            $gambar = $_FILES["gambar"]["name"];
            $tmpName = $_FILES["gambar"]["tmp_name"];

            $ekstensigmbr = explode(".", $gambar);
            $ekstensigmbr = strtolower(end($ekstensigmbr));
            $nm_gambar = date('Y-m-d');
            $nm_gambar .= ".";
            $nm_gambar .= strtolower($nama) . "-file";
            $nm_gambar .= ".";
            $nm_gambar .= $ekstensigmbr;

            $data_old = mysqli_fetch_array($get_foto);
            unlink("../img/data/" . $data_old['gambar']);

            // menyimpan gambar yang diupload pada folder img/data/
            move_uploaded_file($tmpName, '../img/data/' . $nm_gambar);

            $query = "UPDATE console SET nama_console = '$nama', harga = $harga , gambar = '$nm_gambar' WHERE id_console = $id";
            $result = mysqli_query($conn, $query);
            if ($result) {
                echo "
                <script>
                alert('Berhasil Mengubah Console!');
                document.location.href='listConsole.php';
                </script>";
            }
        } else {
            echo "
            <script>
            alert('Yang Anda Upload Bukan Gambar!');
            document.location.href='addConsole.php';
            </script>";
            exit;
        }
    } else {
        $query = "UPDATE console SET nama_console = '$nama', harga = $harga WHERE id_console = $id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "
        <script>
        alert('Berhasil Mengubah Console!');
        document.location.href='listConsole.php';
        </script>";
        }
    }
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
    <link rel="stylesheet" href="../style/addConsole.css">
</head>

<body>
    <div class="container">
        <h1>FORM EDIT CONSOLE</h1>
        <div class="container-form">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="row">
                    <label for="nama">Nama Console</label>
                    <input type="text" value="<?= $data["nama_console"] ?>" name="nama" id="nama" autofocus required>
                </div>
                <div class="row">
                    <label for="harga">Harga Console</label>
                    <input type="number" value="<?= $data["harga"] ?>" name="harga" id="harga" min="10000" required>
                </div>
                <div class="row">
                    <label for="gambar">Gambar Console</label>
                    <input type="file" name="gambar" id="gambar">
                </div>
                <div class="row">
                    <button type="submit" class="btn primary" name="submit">Submit</button>
                </div>
                <div class="row">
                    <a href="listConsole.php" class="btn secondary back">Kembali</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        if (localStorage.getItem('mode') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    </script>
</body>

</html>