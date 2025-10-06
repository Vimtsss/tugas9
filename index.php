<?php
session_start();
include 'koneksi.php';

// kalau belum login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role'];

// ambil data barang
$sql = "SELECT * FROM barang ORDER BY id_barang DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
</head>
<body>
<h2>Selamat datang, <?= $_SESSION['username'] ?> (<?= $role ?>)</h2>
<a href="logout.php">Logout</a>

<h3>Daftar Barang</h3>
<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Nama Barang</th>
    <th>Stok</th>
    <th>Harga</th>
    <th>Terjual</th>
    <th>Subtotal</th>
    <?php if ($role === 'admin'): ?>
        <th>Aksi</th>
    <?php endif; ?>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) : ?>
<tr>
    <td><?= $row['id_barang'] ?></td>
    <td><?= $row['nama_barang'] ?></td>
    <td><?= $row['stok'] ?></td>
    <td><?= $row['harga'] ?></td>
    <td><?= $row['terjual'] ?></td>
    <td><?= $row['subtotal'] ?></td>

    <?php if ($role === 'admin'): ?>
    <td>
        <a href="ubah.php?id=<?= $row['id_barang'] ?>">Ubah</a> |
        <a href="hapus.php?id=<?= $row['id_barang'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
    </td>
    <?php endif; ?>
</tr>
<?php endwhile; ?>
</table>

<?php if ($role === 'admin'): ?>
    <br><a href="tambah.php">+ Tambah Barang</a>
<?php endif; ?>
</body>
</html>
