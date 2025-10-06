<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register - Manajemen Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 flex items-center justify-center min-h-screen text-white">
  <div class="bg-gray-800/70 backdrop-blur-lg p-8 rounded-2xl w-96 shadow-2xl">
    <h1 class="text-3xl font-bold text-center text-indigo-400 mb-6">Daftar Akun</h1>
    <form method="post" class="space-y-4">
      <div>
        <label class="block text-sm font-medium">Username</label>
        <input type="text" name="username" required class="w-full p-2 mt-1 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>
      <div>
        <label class="block text-sm font-medium">Password</label>
        <input type="password" name="password" required class="w-full p-2 mt-1 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>
      <button type="submit" class="w-full py-2 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg font-semibold hover:opacity-90 transition">Daftar</button>
    </form>
    <p class="text-center mt-4 text-sm text-gray-300">Sudah punya akun? <a href="login.php" class="text-indigo-400 hover:text-indigo-300">Login</a></p>
  </div>
</body>
</html>
