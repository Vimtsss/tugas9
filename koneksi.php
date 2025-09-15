<?php
$host = "localhost";
$user = "xirpl1-16";
$pass = "0095372394";
$db   = "db_xirpl1-16_1";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
