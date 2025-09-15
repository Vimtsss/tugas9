<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-indigo-100 min-h-screen">
  <div class="container mx-auto px-6 py-10">
    <h1 class="text-4xl font-extrabold text-center text-indigo-700 mb-8">📦 Data Barang</h1>
    
    <div class="flex justify-end mb-5">
      <a href="tambah.php" class="bg-indigo-600 text-white px-5 py-2 rounded-lg shadow hover:bg-indigo-700 transition duration-300">
        + Tambah Barang
      </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-lg rounded-xl">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-indigo-600 text-white">
            <th class="px-6 py-4">ID</th>
            <th class="px-6 py-4">Nama Barang</th>
            <th class="px-6 py-4">Stock</th>
            <th class="px-6 py-4">Harga</th>
            <th class="px-6 py-4 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result = mysqli_query($koneksi, "SELECT * FROM barang");
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr class='border-b hover:bg-indigo-50 transition'>
                      <td class='px-6 py-4 font-medium text-gray-700'>".$row['id_barang']."</td>
                      <td class='px-6 py-4'>".$row['nama_barang']."</td>
                      <td class='px-6 py-4'>".$row['stock']."</td>
                      <td class='px-6 py-4'>Rp ".number_format($row['harga'],0,',','.')."</td>
                      <td class='px-6 py-4 text-center space-x-2'>
                        <a href='ubah.php?id=".$row['id_barang']."' class='bg-yellow-500 text-white px-3 py-1 rounded-lg shadow hover:bg-yellow-600 transition'>Ubah</a>
                        <a href='hapus.php?id=".$row['id_barang']."' onclick=\"return confirm('Yakin hapus?')\" class='bg-red-600 text-white px-3 py-1 rounded-lg shadow hover:bg-red-700 transition'>Hapus</a>
                      </td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='5' class='px-6 py-4 text-center text-gray-500'>Belum ada data</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
