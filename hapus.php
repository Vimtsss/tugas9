<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM barang WHERE id_barang=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Query Error: " . mysqli_error($conn);
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
