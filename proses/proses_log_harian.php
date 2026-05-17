<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: ../login.php');
    exit;
}

include '../config/koneksi.php';

$action = $_POST['action'] ?? '';
$selectedLogs = $_POST['selected_logs'] ?? [];

if ($action !== 'delete_selected' || !is_array($selectedLogs) || count($selectedLogs) === 0) {
    header('Location: ../pages/log_harian.php?status=invalid');
    exit;
}

$ids = array_values(array_unique(array_filter(array_map('intval', $selectedLogs), static function ($id) {
    return $id > 0;
})));

if (count($ids) === 0) {
    header('Location: ../pages/log_harian.php?status=invalid');
    exit;
}

$placeholders = implode(',', array_fill(0, count($ids), '?'));
$types = str_repeat('i', count($ids));
$sql = "DELETE FROM log_harian WHERE id IN ($placeholders)";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, $types, ...$ids);
mysqli_stmt_execute($stmt);

header('Location: ../pages/log_harian.php?status=deleted');
exit;
