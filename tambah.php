<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama_barang = $_POST['nama_barang'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];

    $query = "INSERT INTO barang (nama_barang, stock, harga) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sii", $nama_barang, $stock, $harga);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menambah data: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 min-h-screen flex items-center justify-center text-white">

  <div class="bg-gray-800 p-8 rounded-2xl shadow-xl w-full max-w-md">
    <h1 class="text-3xl font-bold text-center text-indigo-300 mb-6">Tambah Barang</h1>
    
    <form method="post" class="space-y-5">
      <div>
        <label class="block mb-2 font-medium">Nama Barang</label>
        <input type="text" name="nama_barang" required class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
      </div>
      <div>
        <label class="block mb-2 font-medium">Stock</label>
        <input type="number" name="stock" required class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
      </div>
      <div>
        <label class="block mb-2 font-medium">Harga</label>
        <input type="number" name="harga" required class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
      </div>
      <div class="flex justify-between">
        <a href="index.php" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg">Kembali</a>
        <button type="submit" name="simpan" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg">Simpan</button>
      </div>
    </form>
  </div>

</body>
</html>
