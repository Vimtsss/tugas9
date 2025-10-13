<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'koneksi.php';

// ambil data
$sql = "SELECT * FROM barang ORDER BY id_barang DESC";
$result = mysqli_query($result, $sql);
if ($result === false) {
    die("Query error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Daftar Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 min-h-screen text-white">
  <div class="container mx-auto px-6 py-10">
    <h1 class="text-4xl font-extrabold text-center text-indigo-300 drop-shadow-lg mb-8">Manajemen Barang</h1>

    <div class="flex justify-between items-center mb-6">
      <div class="text-sm text-gray-300">Database: <span class="font-medium text-white">db_xirpl1-16_1</span></div>
      <a href="tambah.php" class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold py-2 px-4 rounded-xl shadow hover:opacity-95 transition">
        + Tambah Barang
      </a>
    </div>

    <div class="overflow-hidden rounded-xl shadow-xl border border-gray-700">
      <table class="w-full text-left">
        <thead class="bg-gradient-to-r from-indigo-600 to-purple-700">
          <tr>
            <th class="py-3 px-4">ID</th>
            <th class="py-3 px-4">Nama Barang</th>
            <th class="py-3 px-4">Stok</th>
            <th class="py-3 px-4">Harga</th>
            <th class="py-3 px-4">Terjual</th>
            <th class="py-3 px-4">Subtotal</th>
            <th class="py-3 px-4 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-gray-800">
          <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <tr class="hover:bg-gray-700 transition">
                <td class="py-3 px-4 font-medium text-gray-200"><?= $row['id_barang']; ?></td>
                <td class="py-3 px-4"><?= htmlspecialchars($row['nama_barang']); ?></td>
                <td class="py-3 px-4"><?= (int)$row['stock']; ?></td>
                <td class="py-3 px-4">Rp <?= number_format((int)$row['harga'],0,',','.'); ?></td>
                <td class="py-3 px-4"><?= (int)$row['terjual']; ?></td>
                <td class="py-3 px-4">Rp <?= number_format((int)$row['subtotal'],0,',','.'); ?></td>
                <td class="py-3 px-4 text-center space-x-2">
                  <a href="ubah.php?id=<?= $row['id_barang']; ?>" class="inline-block bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded-lg text-sm">Ubah</a>
                  <a href="hapus.php?id=<?= $row['id_barang']; ?>" onclick="return confirm('Yakin ingin hapus?')" class="inline-block bg-red-500 hover:bg-red-600 px-3 py-1 rounded-lg text-sm">Hapus</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="py-6 px-4 text-center text-gray-400">Belum ada data.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
