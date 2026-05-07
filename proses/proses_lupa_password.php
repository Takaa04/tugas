<?php
session_start();
include '../config/koneksi.php';
include 'init_tables.php';
chickguard_init_tables($koneksi);

$email = trim($_POST['email'] ?? '');

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['forgot_error'] = 'Masukkan email yang valid.';
    header('Location: ../login.php?forgot=1');
    exit;
}

$stmt = mysqli_prepare($koneksi, "SELECT id, username FROM users WHERE email=? LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    $_SESSION['forgot_error'] = 'Email tidak ditemukan di data pengguna.';
    header('Location: ../login.php?forgot=1');
    exit;
}

$userId = (int) $user['id'];
$token = bin2hex(random_bytes(32));

$deleteStmt = mysqli_prepare($koneksi, "DELETE FROM password_resets WHERE user_id=? OR expires_at < NOW() OR used_at IS NOT NULL");
mysqli_stmt_bind_param($deleteStmt, "i", $userId);
mysqli_stmt_execute($deleteStmt);

$insertStmt = mysqli_prepare($koneksi, "INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))");
mysqli_stmt_bind_param($insertStmt, "is", $userId, $token);
mysqli_stmt_execute($insertStmt);

$_SESSION['forgot_success'] = 'Link reset password berhasil dibuat. Silakan buat password baru.';
header('Location: ../reset_password.php?token=' . urlencode($token));
exit;
?>
