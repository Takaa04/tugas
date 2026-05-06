<?php
include 'config/koneksi.php';

$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT); // 🔥 hash
$role = "admin";

$query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

if (mysqli_query($koneksi, $query)) {
    echo "Admin berhasil ditambahkan!";
} else {
    echo "Gagal: " . mysqli_error($koneksi);
}