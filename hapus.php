<?php
require_once 'koneksi.php';

$id = $_GET['id'];
$sql = "DELETE FROM barang WHERE id_barang=$id";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
