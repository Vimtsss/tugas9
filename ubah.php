<?php
require_once 'koneksi.php';

$id = $_GET['id'];
$sql = "SELECT * FROM barang WHERE id_barang=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_baru = $_POST['id_barang']; // ID yang diubah
    $nama    = $_POST['nama_barang'];
    $stok    = $_POST['stok'];
    $harga   = $_POST['harga'];

    // Update termasuk id_barang
    $update = "UPDATE barang 
               SET id_barang='$id_baru', nama_barang='$nama', stok='$stok', harga='$harga' 
               WHERE id_barang=$id";

    if (mysqli_query($conn, $update)) {
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

    <label class="block mb-3">ID Barang
      <input type="number" name="id_barang" value="<?php echo $row['id_barang']; ?>" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>

    <label class="block mb-3">Nama Barang
      <input type="text" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>

    <label class="block mb-3">Stok
      <input type="number" name="stok" value="<?php echo $row['stok']; ?>" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>

    <label class="block mb-5">Harga
      <input type="number" name="harga" value="<?php echo $row['harga']; ?>" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>

    <div class="flex justify-between">
      <a href="index.php" class="text-gray-400 hover:text-white">Kembali</a>
      <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded">Update</button>
    </div>
  </form>
</body>
</html>
