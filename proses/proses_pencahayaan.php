<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include '../config/koneksi.php';
include 'init_tables.php';
chickguard_init_tables($koneksi);

$action = $_POST['action'] ?? $_GET['action'] ?? '';

function redirect_pencahayaan(string $status): void
{
    header("Location: ../pages/pencahayaan.php?status=" . urlencode($status));
    exit;
}

if ($action === 'delete') {
    $id = (int) ($_GET['id'] ?? 0);
    if ($id <= 0) {
        redirect_pencahayaan('invalid');
    }

    $stmt = mysqli_prepare($koneksi, "DELETE FROM jadwal_pencahayaan WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    redirect_pencahayaan('deleted');
}

if ($action === 'delete_selected') {
    $selectedSchedules = $_POST['selected_schedules'] ?? [];
    if (!is_array($selectedSchedules) || count($selectedSchedules) === 0) {
        redirect_pencahayaan('none_selected');
    }

    $ids = array_values(array_unique(array_filter(array_map('intval', $selectedSchedules), static function ($id) {
        return $id > 0;
    })));

    if (count($ids) === 0) {
        redirect_pencahayaan('none_selected');
    }

    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $types = str_repeat('i', count($ids));
    $stmt = mysqli_prepare($koneksi, "DELETE FROM jadwal_pencahayaan WHERE id IN ($placeholders)");
    mysqli_stmt_bind_param($stmt, $types, ...$ids);
    mysqli_stmt_execute($stmt);
    redirect_pencahayaan('deleted');
}

$id = (int) ($_POST['id'] ?? 0);
$jenis = trim($_POST['jenis'] ?? '');
$waktu = $_POST['waktu'] ?? '';
$durasi = (float) ($_POST['durasi'] ?? 0);
$catatan = trim($_POST['catatan'] ?? '');
$hariInput = $_POST['hari'] ?? [];
$hari = in_array('Semua Hari', $hariInput, true) ? 'Semua Hari' : implode(', ', $hariInput);

if ($jenis === '' || $waktu === '' || $durasi <= 0 || $hari === '') {
    redirect_pencahayaan('invalid');
}

if ($action === 'update' && $id > 0) {
    $stmt = mysqli_prepare($koneksi, "UPDATE jadwal_pencahayaan SET jenis=?, waktu=?, durasi=?, hari=?, catatan=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssdssi", $jenis, $waktu, $durasi, $hari, $catatan, $id);
    mysqli_stmt_execute($stmt);
    redirect_pencahayaan('updated');
}

$stmt = mysqli_prepare($koneksi, "INSERT INTO jadwal_pencahayaan (jenis, waktu, durasi, hari, catatan) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssdss", $jenis, $waktu, $durasi, $hari, $catatan);
mysqli_stmt_execute($stmt);
redirect_pencahayaan('created');
?>
