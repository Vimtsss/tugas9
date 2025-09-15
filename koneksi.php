<?php
$host = "localhost";
$user = "xirpl1-16";
$pass = "0095372394";
$db   = "db_xirpl1-16_1";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
