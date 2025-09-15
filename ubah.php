<?php
include 'koneksi.php';

// Ambil data lama
$id = $_GET['id'];
$query = "SELECT * FROM barang WHERE id_barang = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$barang = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama_barang = $_POST['nama_barang'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];

    $update = "UPDATE barang SET nama_barang=?, stock=?, harga=? WHERE id_barang=?";
    $stmt = mysqli_prepare($conn, $update);
    mysqli_stmt_bind_param($stmt, "siii", $nama_barang, $stock, $harga, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal update data: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ubah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 min-h-screen flex items-center justify-center text-white">

  <div class="bg-gray-800 p-8 rounded-2xl shadow-xl w-full max-w-md">
    <h1 class="text-3xl font-bold text-center text-indigo-300 mb-6">Ubah Barang</h1>
    
    <form method="post" class="space-y-5">
      <div>
        <label class="block mb-2 font-medium">Nama Barang</label>
        <input type="text" name="nama_barang" value="<?php echo $barang['nama_barang']; ?>" required class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
      </div>
      <div>
        <label class="block mb-2 font-medium">Stock</label>
        <input type="number" name="stock" value="<?php echo $barang['stock']; ?>" required class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
      </div>
      <div>
        <label class="block mb-2 font-medium">Harga</label>
        <input type="number" name="harga" value="<?php echo $barang['harga']; ?>" required class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
      </div>
      <div class="flex justify-between">
        <a href="index.php" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg">Kembali</a>
        <button type="submit" name="update" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg">Update</button>
      </div>
    </form>
  </div>

</body>
</html>
