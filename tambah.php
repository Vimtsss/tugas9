<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = $_POST['nama_barang'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];
    mysqli_query($conn, "INSERT INTO barang (nama_barang, stock, harga) VALUES ('$nama','$stock','$harga')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 min-h-screen text-white flex items-center justify-center">
  <div class="bg-gray-800 p-8 rounded-2xl shadow-xl w-96">
    <h2 class="text-2xl font-bold text-center text-indigo-300 mb-6">Tambah Barang</h2>
    <form method="post" class="space-y-4">
      <input type="text" name="nama_barang" placeholder="Nama Barang" required class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500">
      <input type="number" name="stock" placeholder="Stock" required class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500">
      <input type="number" name="harga" placeholder="Harga" required class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500">
      <button type="submit" class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 py-2 rounded-lg font-semibold">Simpan</button>
    </form>
  </div>
</body>
</html>
