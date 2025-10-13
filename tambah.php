<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_barang = $_POST['nama_barang'] ?? '';
    $harga       = $_POST['harga'] ?? 0;
    $stok        = $_POST['stok'] ?? 0;
    $terjual     = $_POST['terjual'] ?? 0;

    // Hitung subtotal otomatis
    $subtotal = ($harga * $terjual);

    // Query simpan data ke database
    $query = "INSERT INTO barang (nama_barang, harga, stok, terjual, subtotal)
              VALUES ('$nama_barang', '$harga', '$stok', '$terjual', '$subtotal')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
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
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 min-h-screen text-white">
  <div class="container mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold text-center text-indigo-300 mb-6">Tambah Barang</h1>

    <form method="POST" class="max-w-lg mx-auto bg-gray-800 p-6 rounded-2xl shadow-lg space-y-4">
      <div>
        <label class="block mb-1 text-sm text-gray-300">Nama Barang</label>
        <input type="text" name="nama_barang" required class="w-full px-3 py-2 rounded-lg text-black">
      </div>

      <div>
        <label class="block mb-1 text-sm text-gray-300">Harga</label>
        <input type="number" name="harga" required class="w-full px-3 py-2 rounded-lg text-black">
      </div>

      <div>
        <label class="block mb-1 text-sm text-gray-300">Stok</label>
        <input type="number" name="stok" required class="w-full px-3 py-2 rounded-lg text-black">
      </div>

      <div>
        <label class="block mb-1 text-sm text-gray-300">Terjual</label>
        <input type="number" name="terjual" value="0" class="w-full px-3 py-2 rounded-lg text-black">
      </div>

      <div class="flex justify-between items-center">
        <a href="index.php" class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-lg">Kembali</a>
        <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 px-4 py-2 rounded-lg font-semibold">Simpan</button>
      </div>
    </form>
  </div>
</body>
</html>
