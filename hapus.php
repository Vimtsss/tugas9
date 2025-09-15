<?php
include "koneksi.php";

$id = $_GET['id'];
$sql = "DELETE FROM barang WHERE id_barang='$id'";

if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Data berhasil dihapus'); window.location='index.php';</script>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
