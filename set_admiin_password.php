<?php
require_once 'koneksi.php';

$admin_username = 'admin';
$new_password = '12345'; // password admin baru

$hashed = password_hash($new_password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($conn, "UPDATE users SET password = ? WHERE username = ?");
mysqli_stmt_bind_param($stmt, "ss", $hashed, $admin_username);
if (mysqli_stmt_execute($stmt)) {
    echo "✅ Password admin berhasil diperbarui.<br>";
    echo "Username: {$admin_username}<br>Password baru: {$new_password}";
} else {
    echo "❌ Gagal memperbarui: " . mysqli_error($conn);
}
mysqli_stmt_close($stmt);
?>
