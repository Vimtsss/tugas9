<?php
$host = "localhost";
$user = "xirpl1-16";
$pass = "0095372394";
$db   = "db_xirpl1-16_2"    ;

$result = mysqli_connect($host, $user, $pass, $db);

if (!$result) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
