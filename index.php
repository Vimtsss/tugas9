<?php
require_once 'koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM barang ORDER BY id_barang DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen">
  <div class="container mx-auto px-6 py-10">
    <h1 class="text-4xl font-bold text-center text-indigo-400 mb-8">Manajemen Barang</h1>

    <div class="flex justify-between items-center mb-6">
      <span class="text-sm text-gray-400">Database: xirpl1-16_1</span>
      <a href="tambah.php" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg">+ Tambah Barang</a>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-700 shadow">
      <table class="w-full text-left">
        <thead class="bg-indigo-700">
          <tr>
            <th class="py-3 px-4">ID</th>
            <th class="py-3 px-4">Nama Barang</th>
            <th class="py-3 px-4">Stock</th>
            <th class="py-3 px-4">Harga</th>
            <th class="py-3 px-4 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-gray-800">
          <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <tr class="hover:bg-gray-700">
                <td class="py-3 px-4"><?= $row['id_barang']; ?></td>
                <td class="py-3 px-4"><?= htmlspecialchars($row['nama_barang']); ?></td>
                <td class="py-3 px-4"><?= (int)$row['stock']; ?></td>
                <td class="py-3 px-4">Rp <?= number_format($row['harga'],0,',','.'); ?></td>
                <td class="py-3 px-4 text-center space-x-2">
                  <a href="ubah.php?id=<?= $row['id_barang']; ?>" class="bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded">Ubah</a>
                  <a href="hapus.php?id=<?= $row['id_barang']; ?>" onclick="return confirm('Yakin hapus?')" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded">Hapus</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="5" class="py-6 text-center text-gray-400">Belum ada data.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
