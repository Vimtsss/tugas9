<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'koneksi.php';

// Ambil data berdasarkan id
$id = $_GET['id'];
$sql = "SELECT * FROM barang WHERE id_barang=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Data tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_baru  = $_POST['id_barang'];
    $nama     = $_POST['nama_barang'];
    $stok     = $_POST['stok'];
    $harga    = $_POST['harga'];
    $terjual  = $_POST['terjual'];

    // Hitung subtotal otomatis
    $subtotal = ($stok - $terjual) * $harga;

    $sql = "UPDATE barang SET 
                id_barang='$id_baru',
                nama_barang='$nama',
                stok='$stok',
                harga='$harga',
                terjual='$terjual',
                subtotal='$subtotal'
            WHERE id_barang='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Query Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ubah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
  <form method="POST" class="bg-gray-800 p-8 rounded-xl w-96 shadow">
    <h1 class="text-2xl font-bold mb-6 text-indigo-400">Ubah Barang</h1>

    <label class="block mb-3">ID Barang
      <input type="text" name="id_barang" value="<?php echo $row['id_barang']; ?>" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>

    <label class="block mb-3">Na
