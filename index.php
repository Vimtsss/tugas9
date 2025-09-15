<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
include 'koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM barang");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 min-h-screen text-white">

  <div class="container mx-auto px-6 py-10">
    <h1 class="text-4xl font-bold text-center text-indigo-300 drop-shadow-lg mb-10">Manajemen Barang</h1>
    
    <div class="flex justify-end mb-6">
      <a href="tambah.php" class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold py-2 px-5 rounded-xl shadow-md transition-all duration-300">
        + Tambah Barang
      </a>
    </div>

    <div class="overflow-hidden rounded-xl shadow-xl border border-gray-700">
      <table class="w-full text-left text-white">
        <thead class="bg-gradient-to-r from-indigo-600 to-purple-700">
          <tr>
            <th class="py-3 px-4">ID Barang</th>
            <th class="py-3 px-4">Nama Barang</th>
            <th class="py-3 px-4">Stock</th>
            <th class="py-3 px-4">Harga</th>
            <th class="py-3 px-4 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-gray-800">
          <?php while($row = mysqli_fetch_assoc($result)) { ?>
          <tr class="hover:bg-gray-700 transition duration-200">
            <td class="py-3 px-4"><?php echo $row['id_barang']; ?></td>
            <td class="py-3 px-4"><?php echo $row['nama_barang']; ?></td>
            <td class="py-3 px-4"><?php echo $row['stock']; ?></td>
            <td class="py-3 px-4">Rp <?php echo number_format($row['harga'],0,',','.'); ?></td>
            <td class="py-3 px-4 flex justify-center space-x-3">
              <a href="ubah.php?id=<?php echo $row['id_barang']; ?>" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium">Ubah</a>
              <a href="hapus.php?id=<?php echo $row['id_barang']; ?>" onclick="return confirm('Yakin ingin hapus?')" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg text-sm font-medium">Hapus</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
