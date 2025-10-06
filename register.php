<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];
    $role     = 'user'; // default: user biasa

    // Validasi input
    if (empty($username) || empty($password) || empty($confirm)) {
        $error = "Semua kolom harus diisi.";
    } elseif ($password !== $confirm) {
        $error = "Password dan konfirmasi tidak sama.";
    } else {
        // Cek apakah username sudah ada
        $check = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ?");
        mysqli_stmt_bind_param($check, "s", $username);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {
            $error = "Username sudah digunakan.";
        } else {
            // Hash password sebelum disimpan
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sss", $username, $hash, $role);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                header("Location: index.php");
                exit;
            } else {
                $error = "Terjadi kesalahan saat mendaftar.";
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_stmt_close($check);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen text-white">
  <form method="post" class="bg-gray-800 p-8 rounded-xl w-96 shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-indigo-400 text-center">Daftar Akun</h1>

    <?php if (!empty($error)): ?>
      <div class="bg-red-600 text-white p-2 rounded mb-4"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <label class="block mb-3">Username
      <input type="text" name="username" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>

    <label class="block mb-3">Password
      <input type="password" name="password" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>

    <label class="block mb-5">Konfirmasi Password
      <input type="password" name="confirm" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>

    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 w-full py-2 rounded">Daftar</button>

    <p class="mt-3 text-center text-sm">
      Sudah punya akun? <a href="login.php" class="text-indigo-400">Login</a>
    </p>
  </form>
</body>
</html>
