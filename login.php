<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - Manajemen Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 flex items-center justify-center min-h-screen text-white">
  <div class="bg-gray-800/70 backdrop-blur-lg p-8 rounded-2xl w-96 shadow-2xl">
    <h1 class="text-3xl font-bold text-center text-indigo-400 mb-6">Login</h1>
    <?php if (isset($error)): ?>
      <div class="bg-red-600 text-white p-2 rounded mb-4 text-center"><?= $error ?></div>
    <?php endif; ?>
    <form method="post" class="space-y-4">
      <div>
        <label class="block text-sm font-medium">Username</label>
        <input type="text" name="username" required class="w-full p-2 mt-1 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>
      <div>
        <label class="block text-sm font-medium">Password</label>
        <input type="password" name="password" required class="w-full p-2 mt-1 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>
      <button type="submit" class="w-full py-2 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg font-semibold hover:opacity-90 transition">Masuk</button>
    </form>
    <p class="text-center mt-4 text-sm text-gray-300">Belum punya akun? <a href="register.php" class="text-indigo-400 hover:text-indigo-300">Daftar</a></p>
  </div>
</body>
</html>
