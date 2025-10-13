<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'koneksi.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan!");
}

$id = $_GET['id'];

if (mysqli_query($result, "DELETE FROM barang WHERE id_barang = $id")) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>
