<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role'];
$sql = "SELECT * FROM barang ORDER BY id_barang DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 min-h-screen text-white">
  <div class="container mx-auto px-6 py-10">
    <div class="flex justify-between items-center mb-10">
      <h1 class="text-4xl font-extrabold text-indigo-300 drop-shadow-lg">Manajemen Barang</h1>
      <div class="flex items-center gap-4">
        <span class="text-gray-300">Halo, <b><?= $_SESSION['username'] ?></b> (<?= $role ?>)</span>
        <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg font-semibold transition">Logout</a>
      </div>
    </div>

    <?php if ($role === 'admin'): ?>
      <div class="mb-6 flex justify-end">
        <a href="tambah.php" class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:opacity-90 px-5 py-2 rounded-lg shadow font-semibold">+ Tambah Barang</a>
      </div>
    <?php endif; ?>

    <div class="overflow-hidden rounded-xl shadow-xl border border-gray-700">
      <table class="w-full text-left text-sm">
        <thead class="bg-gradient-to-r from-indigo-600 to-purple-700">
          <tr>
            <th class="py-3 px-4">ID</th>
            <th class="py-3 px-4">Nama Barang</th>
            <th class="py-3 px-4">Stok</th>
            <th class="py-3 px-4">Terjual</th>
            <th class="py-3 px-4">Harga</th>
            <th class="py-3 px-4">Subtotal</th>
            <?php if ($role === 'admin'): ?><th class="py-3 px-4 text-center">Aksi</th><?php endif; ?>
          </tr>
        </thead>
        <tbody class="bg-gray-800">
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr class="hover:bg-gray-700 transition">
              <td class="py-3 px-4"><?= $row['id_barang'] ?></td>
              <td class="py-3 px-4"><?= htmlspecialchars($row['nama_barang']) ?></td>
              <td class="py-3 px-4"><?= $row['stok'] ?></td>
              <td class="py-3 px-4"><?= $row['terjual'] ?></td>
              <td class="py-3 px-4">Rp <?= number_format($row['harga'],0,',','.') ?></td>
              <td class="py-3 px-4">Rp <?= number_format($row['subtotal'],0,',','.') ?></td>
              <?php if ($role === 'admin'): ?>
              <td class="py-3 px-4 text-center space-x-2">
                <a href="ubah.php?id=<?= $row['id_barang'] ?>" class="bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded">Ubah</a>
                <a href="hapus.php?id=<?= $row['id_barang'] ?>" onclick="return confirm('Yakin ingin hapus?')" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded">Hapus</a>
              </td>
              <?php endif; ?>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
