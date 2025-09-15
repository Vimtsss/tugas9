<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
include 'koneksi.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang=$id");
$data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = $_POST['nama_barang'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];
    mysqli_query($conn, "UPDATE barang SET nama_barang='$nama', stock='$stock', harga='$harga' WHERE id_barang=$id");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ubah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 min-h-screen text-white flex items-center justify-center">
  <div class="bg-gray-800 p-8 rounded-2xl shadow-xl w-96">
    <h2 class="text-2xl font-bold text-center text-indigo-300 mb-6">Ubah Barang</h2>
    <form method="post" class="space-y-4">
      <input type="text" name="nama_barang" value="<?php echo $data['nama_barang']; ?>" required class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500">
      <input type="number" name="stock" value="<?php echo $data['stock']; ?>" required class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500">
      <input type="number" name="harga" value="<?php echo $data['harga']; ?>" required class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500">
      <button type="submit" class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 py-2 rounded-lg font-semibold">Update</button>
    </form>
  </div>
</body>
</html>
