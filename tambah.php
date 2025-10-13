<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama_barang = $_POST['nama_barang'];
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];
    $terjual     = $_POST['terjual'];

    // Hitung subtotal
    $subtotal = $harga * $terjual;

    // Hitung stok akhir (opsional)
    $stok_akhir = $stok - $terjual;

    // Query ke database (TIDAK menyertakan id_barang)
    $sql = "INSERT INTO barang (nama_barang, harga, stok, terjual, subtotal)
            VALUES ('$nama_barang', '$harga', '$stok_akhir', '$terjual', '$subtotal')";

    if (mysqli_query($koneksi, $sql)) {
        echo "Data berhasil ditambahkan!";
        header('Location: index.php');
        exit;
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($koneksi);
    }
}
?>
