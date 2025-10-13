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

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Tambah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 min-h-screen flex items-center justify-center text-white">
  <div class="bg-gray-800 p-8 rounded-2xl shadow-2xl w-full max-w-md">
    <h1 class="text-3xl font-bold mb-6 text-center text-indigo-300">Tambah Barang</h1>
    <form method="POST" class="space-y-4">
      <div>
        <label class="block text-sm font-medium mb-1">Nama Barang</label>
        <input type="text" name="nama_barang" required class="w-full rounded-lg bg-gray-700 p-2 text-white focus:ring-2 focus:ring-indigo-500">
      </div>
      <div>
        <label class="block text-sm font-medium mb-1">Harga</label>
        <input type="number" name="harga" required class="w-full rounded-lg bg-gray-700 p-2 text-white focus:ring-2 focus:ring-indigo-500">
      </div>
      <div>
        <label class="block text-sm font-medium mb-1">Stok</label>
        <input type="number" name="stok" required class="w-full rounded-lg bg-gray-700 p-2 text-white focus:ring-2 focus:ring-indigo-500">
      </div>
      <div class="flex justify-between items-center mt-6">
        <a href="index.php" class="text-gray-300 hover:text-white">← Kembali</a>
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-lg transition">Simpan</button>
      </div>
    </form>
  </div>
</body>
</html>
