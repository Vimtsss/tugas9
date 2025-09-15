<?php
require_once 'koneksi.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang=$id");
$data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama  = $_POST['nama_barang'];
    $stock = (int)$_POST['stock'];
    $harga = (int)$_POST['harga'];

    $sql = "UPDATE barang SET nama_barang=?, stock=?, harga=? WHERE id_barang=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "siii", $nama, $stock, $harga, $id);

    if (mysqli_stmt_execute($stmt)) {
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
  <title>Ubah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
  <form method="POST" class="bg-gray-800 p-8 rounded-xl w-96 shadow">
    <h1 class="text-2xl font-bold mb-6 text-indigo-400">Ubah Barang</h1>
    <label class="block mb-3">Nama Barang
      <input type="text" name="nama_barang" value="<?= $data['nama_barang']; ?>" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>
    <label class="block mb-3">Stock
      <input type="number" name="stock" value="<?= $data['stock']; ?>" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>
    <label class="block mb-5">Harga
      <input type="number" name="harga" value="<?= $data['harga']; ?>" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>
    <div class="flex justify-between">
      <a href="index.php" class="text-gray-400 hover:text-white">Kembali</a>
      <button type="submit" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded">Update</button>
    </div>
  </form>
</body>
</html>
