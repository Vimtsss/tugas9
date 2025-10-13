<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'koneksi.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $res = mysqli_query($result, "SELECT * FROM barang WHERE id_barang='$id'");
    $data = mysqli_fetch_assoc($res);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama_barang = $_POST['nama_barang'] ?? '';
        $harga       = $_POST['harga'] ?? 0;
        $stok        = $_POST['stok'] ?? 0;
        $terjual     = $_POST['terjual'] ?? 0;
        $subtotal    = $harga * $terjual;

        $update = "UPDATE barang 
                   SET nama_barang='$nama_barang', harga='$harga', stok='$stok', terjual='$terjual', subtotal='$subtotal'
                   WHERE id_barang='$id'";

        if (mysqli_query($result, $update)) {
            header("Location: index.php");
            exit;
        } else {
            echo "Gagal mengubah data: " . mysqli_error($result);
        }
    }
} else {
    echo "ID tidak ditemukan!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ubah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 min-h-screen text-white">
  <div class="container mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold text-center text-indigo-300 mb-6">Ubah Data Barang</h1>

    <form method="POST" class="max-w-lg mx-auto bg-gray-800 p-6 rounded-2xl shadow-lg space-y-4">
      <div>
        <label class="block mb-1 text-sm text-gray-300">Nama Barang</label>
        <input type="text" name="nama_barang" value="<?= $data['nama_barang'] ?>" required class="w-full px-3 py-2 rounded-lg text-black">
      </div>

      <div>
        <label class="block mb-1 text-sm text-gray-300">Harga</label>
        <input type="number" name="harga" value="<?= $data['harga'] ?>" required class="w-full px-3 py-2 rounded-lg text-black">
      </div>

      <div>
        <label class="block mb-1 text-sm text-gray-300">Stok</label>
        <input type="number" name="stok" value="<?= $data['stok'] ?>" required class="w-full px-3 py-2 rounded-lg text-black">
      </div>

      <div>
        <label class="block mb-1 text-sm text-gray-300">Terjual</label>
        <input type="number" name="terjual" value="<?= $data['terjual'] ?>" required class="w-full px-3 py-2 rounded-lg text-black">
      </div>

      <div class="flex justify-between items-center">
        <a href="index.php" class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-lg">Kembali</a>
        <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 px-4 py-2 rounded-lg font-semibold">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</body>
</html>
