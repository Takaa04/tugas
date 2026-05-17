<?php
session_start();
include 'config/koneksi.php';
include 'proses/init_tables.php';
chickguard_init_tables($koneksi);

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$token = $_GET['token'] ?? '';
$isValidToken = false;
$username = '';

if ($token !== '') {
    $stmt = mysqli_prepare($koneksi, "SELECT users.username FROM password_resets JOIN users ON users.id=password_resets.user_id WHERE password_resets.token=? AND password_resets.expires_at >= NOW() AND password_resets.used_at IS NULL LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $isValidToken = true;
        $username = $row['username'];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link rel="icon" href="assets/images/branding/icon.png" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/reset_password.css">
</head>
<body class="login-page">
  <div class="container">
    <div class="card reset-card">
      <img class="logo" src="assets/images/branding/logo.png" alt="Logo ChickGuard">
      <div class="title">Reset Password</div>
      <div class="subtitle"><?= $isValidToken ? 'Buat password baru untuk akun ' . e($username) : 'Link reset password tidak valid atau sudah kedaluwarsa.' ?></div>

      <?php if (isset($_SESSION['reset_error'])): ?>
        <div class="login-alert error"><?= e($_SESSION['reset_error']) ?></div>
        <?php unset($_SESSION['reset_error']); ?>
      <?php endif; ?>

      <?php if ($isValidToken): ?>
        <form action="proses/proses_reset_password.php" method="POST" class="login-form">
          <input type="hidden" name="token" value="<?= e($token) ?>">

          <label class="label" for="password">Password Baru</label>
          <input id="password" type="password" name="password" class="input-box" placeholder="Masukkan password baru" required>

          <label class="label" for="confirm_password">Konfirmasi Password</label>
          <input id="confirm_password" type="password" name="confirm_password" class="input-box reset-confirm-input" placeholder="Ulangi password baru" required>

          <button type="submit" class="btn">Simpan Password</button>
        </form>
      <?php else: ?>
        <a class="btn btn-link-reset" href="login.php">Kembali ke Login</a>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
