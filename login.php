<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT id, username, password, role FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $u, $hash, $role);

    if (mysqli_stmt_fetch($stmt)) {
        // ✅ Verifikasi password hash
        if (password_verify($password, $hash)) {
            $_SESSION['username'] = $u;
            $_SESSION['role'] = $role;
            header("Location: index.php");
            exit;
        } else {
            $error = "Username atau password salah.";
        }
    } else {
        $error = "Username atau password salah.";
    }
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen text-white">
  <form method="post" class="bg-gray-800 p-8 rounded-xl w-96 shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-indigo-400 text-center">Login</h1>
    <?php if (!empty($error)): ?>
      <div class="bg-red-600 text-white p-2 rounded mb-4"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <label class="block mb-3">Username
      <input type="text" name="username" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>
    <label class="block mb-5">Password
      <input type="password" name="password" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>
    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 w-full py-2 rounded">Login</button>
    <p class="mt-3 text-center text-sm">Belum punya akun? <a href="register.php" class="text-indigo-400">Daftar</a></p>
  </form>
</body>
</html>
