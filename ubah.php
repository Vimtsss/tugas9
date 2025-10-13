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
    $id       = $_POST['id_barang'];
    $nama     = $_POST['nama_barang'];
    $stock     = $_POST['stock'];
    $harga    = $_POST['harga'];
    $terjual  = $_POST['terjual'];

  
    $stock_akhir = $stock - $terjual;
    $subtotal   = $terjual * $harga;

    $sql = "UPDATE barang 
            SET nama_barang='$nama', stok='$stock_akhir', harga='$harga', 
                terjual='$terjual', subtotal='$subtotal'
            WHERE id_barang='$id'";

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
  <title>Ubah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
  <form method="POST" class="bg-gray-800 p-8 rounded-xl w-96 shadow">
    <h1 class="text-2xl font-bold mb-6 text-indigo-400">Ubah Barang</h1>

    <label class="block mb-3">ID Barang
      <input type="text" name="id_barang" value="<?php echo $row['id_barang']; ?>" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>

    <label class="block mb-3">Nama Barang
      <input type="text" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>

    <label class="block mb-3">Stok
      <input type="number" name="stok" value="<?php echo $row['stok']; ?>" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>

    <label class="block mb-3">Harga
      <input type="number" name="harga" value="<?php echo $row['harga']; ?>" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>

    <label class="block mb-5">Terjual
      <input type="number" name="terjual" value="<?php echo $row['terjual']; ?>" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>

    <div class="flex justify-between">
      <a href="index.php" class="text-gray-400 hover:text-white">Kembali</a>
      <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded">Simpan</button>
    </div>
  </form>
</body>
</html>
