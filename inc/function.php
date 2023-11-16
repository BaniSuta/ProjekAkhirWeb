<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "db_console";

$conn = mysqli_connect($host, $username, $password, $db_name);

function alertAdmin()
{
    echo "
    <script>
    alert('Harap Login Sebagai Admin');
    document.location.href = 'login.php';
    </script>
    ";
    exit;
}

function alertUser()
{
    echo "
    <script>
    alert('Harap Login Sebagai User');
    document.location.href = 'login.php';
    </script>
    ";
    exit;
}
