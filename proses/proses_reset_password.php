<?php
session_start();
include '../config/koneksi.php';
include 'init_tables.php';
chickguard_init_tables($koneksi);

$token = $_POST['token'] ?? '';
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

function redirect_reset(string $token): void
{
    header('Location: ../reset_password.php?token=' . urlencode($token));
    exit;
}

if ($token === '') {
    $_SESSION['reset_error'] = 'Token reset tidak valid.';
    header('Location: ../login.php');
    exit;
}

if (strlen($password) < 6) {
    $_SESSION['reset_error'] = 'Password minimal 6 karakter.';
    redirect_reset($token);
}

if ($password !== $confirmPassword) {
    $_SESSION['reset_error'] = 'Konfirmasi password tidak sama.';
    redirect_reset($token);
}

$stmt = mysqli_prepare($koneksi, "SELECT user_id FROM password_resets WHERE token=? AND expires_at >= NOW() AND used_at IS NULL LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $token);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$reset = mysqli_fetch_assoc($result);

if (!$reset) {
    $_SESSION['reset_error'] = 'Link reset sudah tidak berlaku.';
    redirect_reset($token);
}

$userId = (int) $reset['user_id'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$updateStmt = mysqli_prepare($koneksi, "UPDATE users SET password=? WHERE id=?");
mysqli_stmt_bind_param($updateStmt, "si", $hashedPassword, $userId);
mysqli_stmt_execute($updateStmt);

$usedStmt = mysqli_prepare($koneksi, "UPDATE password_resets SET used_at=NOW() WHERE token=?");
mysqli_stmt_bind_param($usedStmt, "s", $token);
mysqli_stmt_execute($usedStmt);

$_SESSION['login_success'] = 'Password berhasil direset. Silakan login dengan password baru.';
header('Location: ../login.php');
exit;
?>
