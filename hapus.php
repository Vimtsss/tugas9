<?php
require_once 'koneksi.php';

$id = $_GET['id'];
$sql = "DELETE FROM barang WHERE id_barang=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
