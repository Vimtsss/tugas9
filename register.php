<?php
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username === '' || $password === '') {
        $error = "Username dan password wajib diisi.";
    } else {
        // Cek apakah username sudah ada
        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $error = "Username sudah digunakan.";
            mysqli_stmt_close($stmt);
        } else {
            mysqli_stmt_close($stmt);
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password, role) VALUES (?, ?, 'user')");
            mysqli_stmt_bind_param($stmt, "ss", $username, $hash);
            if (mysqli_stmt_execute($stmt)) {
                header("Location: login.php");
                exit;
            } else {
                $error = "Gagal registrasi: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        }
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
    <label class="block mb-5">Password
      <input type="password" name="password" required class="mt-1 w-full p-2 rounded bg-gray-700">
    </label>
    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 w-full py-2 rounded">Daftar</button>
    <p class="mt-3 text-center text-sm">Sudah punya akun? <a href="login.php" class="text-indigo-400">Login</a></p>
  </form>
</body>
</html>
