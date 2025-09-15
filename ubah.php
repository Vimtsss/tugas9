<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header("Location: index.php");
    exit;
}

// ambil data awal
$stmt = mysqli_prepare($conn, "SELECT nama_barang, stock, harga FROM barang WHERE id_barang = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $nama_db, $stock_db, $harga_db);
if (!mysqli_stmt_fetch($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location: index.php");
    exit;
}
mysqli_stmt_close($stmt);

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim($_POST['nama_barang'] ?? '');
    $stock = intval($_POST['stock'] ?? 0);
    $harga = intval($_POST['harga'] ?? 0);

    if ($nama === '' || $stock < 0 || $harga < 0) {
        $error = "Isi semua field dengan benar.";
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE barang SET nama_barang = ?, stock = ?, harga = ? WHERE id_barang = ?");
        mysqli_stmt_bind_param($stmt, "siii", $nama, $stock, $harga, $id);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal update: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Ubah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 min-h-screen text-white flex items-center justify-center">
  <div class="bg-gray-800 p-8 rounded-2xl shadow-xl w-full max-w-md">
    <h2 class="text-2xl font-bold mb-4 text-yellow-300">Ubah Barang</h2>

    <?php if ($error): ?>
      <div class="bg-red-600 text-white p-3 rounded mb-4"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" class="space-y-4">
      <div>
        <label class="block mb-1 text-sm text-gray-300">Nama Barang</label>
        <input type="text" name="nama_barang" required class="w-full px-3 py-2 rounded-lg bg-gray-700 border border-gray-600" value="<?php echo isset($_POST['nama_barang'])?htmlspecialchars($_POST['nama_barang']):htmlspecialchars($nama_db); ?>">
      </div>

      <div>
        <label class="block mb-1 text-sm text-gray-300">Stock</label>
        <input type="number" name="stock" min="0" required class="w-full px-3 py-2 rounded-lg bg-gray-700 border border-gray-600" value="<?php echo isset($_POST['stock'])?htmlspecialchars($_POST['stock']):htmlspecialchars($stock_db); ?>">
      </div>

      <div>
        <label class="block mb-1 text-sm text-gray-300">Harga</label>
        <input type="number" name="harga" min="0" required class="w-full px-3 py-2 rounded-lg bg-gray-700 border border-gray-600" value="<?php echo isset($_POST['harga'])?htmlspecialchars($_POST['harga']):htmlspecialchars($harga_db); ?>">
      </div>

      <div class="flex justify-between items-center">
        <a href="index.php" class="text-sm text-gray-300 hover:underline">Kembali</a>
        <button type="submit" class="bg-yellow-500 px-4 py-2 rounded-lg font-semibold hover:bg-yellow-600">Update</button>
      </div>
    </form>
  </div>
</body>
</html>
