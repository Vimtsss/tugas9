<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ubah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-indigo-100 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-xl shadow-lg w-96">
    <h2 class="text-2xl font-bold mb-6 text-yellow-600">Ubah Barang</h2>
    <?php
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id'");
    $data = mysqli_fetch_assoc($query);
    ?>
    <form method="POST" class="space-y-4">
      <div>
        <label class="block mb-1">Nama Barang</label>
        <input type="text" name="nama_barang" value="<?= $data['nama_barang']; ?>" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-yellow-400" required>
      </div>
      <div>
        <label class="block mb-1">Stock</label>
        <input type="number" name="stock" value="<?= $data['stock']; ?>" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-yellow-400" required>
      </div>
      <div>
        <label class="block mb-1">Harga</label>
        <input type="number" name="harga" value="<?= $data['harga']; ?>" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-yellow-400" required>
      </div>
      <div class="flex justify-between items-center">
        <a href="index.php" class="text-gray-500 hover:underline">Kembali</a>
        <button type="submit" name="update" class="bg-yellow-500 text-white px-5 py-2 rounded-lg hover:bg-yellow-600 shadow">
          Update
        </button>
      </div>
    </form>
    <?php
    if (isset($_POST['update'])) {
      $nama  = $_POST['nama_barang'];
      $stock = $_POST['stock'];
      $harga = $_POST['harga'];
      $sql = "UPDATE barang SET nama_barang='$nama', stock='$stock', harga='$harga' WHERE id_barang='$id'";
      if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diubah'); window.location='index.php';</script>";
      } else {
        echo "Error: " . mysqli_error($koneksi);
      }
    }
    ?>
  </div>
</body>
</html>
