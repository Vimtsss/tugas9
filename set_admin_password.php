<?php
require_once 'koneksi.php';

// Update password admin
$username1 = 'admin';
$password1 = '12345'; // password baru
$hashed1 = password_hash($password1, PASSWORD_DEFAULT);

// Update password adis
$username2 = 'adis';
$password2 = 'adis';
$hashed2 = password_hash($password2, PASSWORD_DEFAULT);

$stmt1 = mysqli_prepare($conn, "UPDATE users SET password=? WHERE username=?");
mysqli_stmt_bind_param($stmt1, "ss", $hashed1, $username1);
mysqli_stmt_execute($stmt1);

$stmt2 = mysqli_prepare($conn, "UPDATE users SET password=? WHERE username=?");
mysqli_stmt_bind_param($stmt2, "ss", $hashed2, $username2);
mysqli_stmt_execute($stmt2);

echo "✅ Password berhasil diubah menjadi hashed.<br>";
echo "Admin → username: admin | password: 12345<br>";
echo "Adis → username: adis | password: adis<br>";
?>
