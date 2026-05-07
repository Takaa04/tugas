<?php
$koneksi = mysqli_connect("localhost", "root", "", "chickguard");

if (!$koneksi) {
    $koneksi = mysqli_connect("localhost", "root", "", "kelompok2");
}

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
