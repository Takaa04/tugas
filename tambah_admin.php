<?php
include 'config/koneksi.php';

$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT);
$role = "admin";

$stmt = mysqli_prepare($koneksi, "INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sss", $username, $password, $role);

if (mysqli_stmt_execute($stmt)) {
    echo "Admin berhasil ditambahkan!";
} else {
    echo "Gagal: " . mysqli_error($koneksi);
}
