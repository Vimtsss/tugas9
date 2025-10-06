<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = $_POST['nama_barang'];
    $stock    = $_POST['stock'];  // ubah dari stok → stock
    $harga    = $_POST['harga'];
    $terjual  = $_POST['terjual'];

    // hitung stock akhir & subtotal
    $stock_akhir = $stock - $terjual;   // stock berkurang setelah terjual
    $subtotal    = $terjual * $harga;   // total pemasukan

    $sql = "INSERT INTO barang (nama_barang, stock, harga, terjual, subtotal)
            VALUES ('$nama', '$stock_akhir', '$harga', '$terjual', '$subtotal')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
  <form method="POST" class="bg-gray-800 p-8 rounded-xl w-96 shadow">
    <h1 class="text-2xl font-bold mb-6 text-indigo-400">Tambah Barang</h1>
    <label class="block mb-3">Nama Barang
      <input type="text" name="nama_barang" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>
    <label class="block mb-3">Stock
      <input type="number" name="stock" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>
    <label class="block mb-3">Harga
      <input type="number" name="harga" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>
    <label class="block mb-5">Terjual
      <input type="number" name="terjual" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>
    <div class="flex justify-between">
      <a href="index.php" class="text-gray-400 hover:text-white">Kembali</a>
      <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded">Simpan</button>
    </div>
  </form>
</body>
</html>
