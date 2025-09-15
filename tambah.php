<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'koneksi.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim($_POST['nama_barang'] ?? '');
    $stock = intval($_POST['stock'] ?? 0);
    $harga = intval($_POST['harga'] ?? 0);

    if ($nama === '' || $stock < 0 || $harga < 0) {
        $error = "Isi semua field dengan benar.";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO barang (nama_barang, stock, harga) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sii", $nama, $stock, $harga);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal menyimpan: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Tambah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 min-h-screen text-white flex items-center justify-center">
  <div class="bg-gray-800 p-8 rounded-2xl shadow-xl w-full max-w-md">
    <h2 class="text-2xl font-bold mb-4 text-indigo-300">Tambah Barang</h2>

    <?php if ($error): ?>
      <div class="bg-red-600 text-white p-3 rounded mb-4"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" class="space-y-4">
      <div>
        <label class="block mb-1 text-sm text-gray-300">Nama Barang</label>
        <input type="text" name="nama_barang" required class="w-full px-3 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500" value="<?php echo isset($_POST['nama_barang'])?htmlspecialchars($_POST['nama_barang']):''; ?>">
      </div>

      <div>
        <label class="block mb-1 text-sm text-gray-300">Stock</label>
        <input type="number" name="stock" min="0" required class="w-full px-3 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500" value="<?php echo isset($_POST['stock'])?htmlspecialchars($_POST['stock']):'0'; ?>">
      </div>

      <div>
        <label class="block mb-1 text-sm text-gray-300">Harga</label>
        <input type="number" name="harga" min="0" required class="w-full px-3 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500" value="<?php echo isset($_POST['harga'])?htmlspecialchars($_POST['harga']):'0'; ?>">
      </div>

      <div class="flex justify-between items-center">
        <a href="index.php" class="text-sm text-gray-300 hover:underline">Kembali</a>
        <button type="submit" class="bg-gradient-to-r from-indigo-500 to-purple-600 px-4 py-2 rounded-lg font-semibold">Simpan</button>
      </div>
    </form>
  </div>
</body>
</html>
