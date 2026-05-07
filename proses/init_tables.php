<?php
function chickguard_init_tables(mysqli $koneksi): void
{
    ensure_users_email_column($koneksi);

    mysqli_query($koneksi, "CREATE TABLE IF NOT EXISTS password_resets (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        token VARCHAR(64) NOT NULL UNIQUE,
        expires_at DATETIME NOT NULL,
        used_at DATETIME DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX (user_id),
        INDEX (token)
    )");

    mysqli_query($koneksi, "CREATE TABLE IF NOT EXISTS jadwal_pakan_minum (
        id INT AUTO_INCREMENT PRIMARY KEY,
        jenis ENUM('Pakan','Minum') NOT NULL,
        waktu TIME NOT NULL,
        jumlah DECIMAL(8,2) NOT NULL,
        hari VARCHAR(120) NOT NULL,
        catatan VARCHAR(255) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    mysqli_query($koneksi, "CREATE TABLE IF NOT EXISTS jadwal_pencahayaan (
        id INT AUTO_INCREMENT PRIMARY KEY,
        jenis VARCHAR(50) NOT NULL,
        waktu TIME NOT NULL,
        durasi DECIMAL(8,2) NOT NULL,
        hari VARCHAR(120) NOT NULL,
        catatan VARCHAR(255) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    mysqli_query($koneksi, "CREATE TABLE IF NOT EXISTS log_harian (
        id INT AUTO_INCREMENT PRIMARY KEY,
        waktu TIME NOT NULL,
        suhu DECIMAL(5,2) NOT NULL,
        kelembaban DECIMAL(5,2) NOT NULL,
        pakan DECIMAL(8,2) DEFAULT NULL,
        minum DECIMAL(8,2) DEFAULT NULL,
        lampu ENUM('Hidup','Mati') NOT NULL DEFAULT 'Mati',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    seed_jadwal_pakan_minum($koneksi);
    seed_jadwal_pencahayaan($koneksi);
    seed_log_harian($koneksi);
}

function ensure_users_email_column(mysqli $koneksi): void
{
    $result = mysqli_query($koneksi, "SHOW COLUMNS FROM users LIKE 'email'");
    if ($result && mysqli_num_rows($result) === 0) {
        mysqli_query($koneksi, "ALTER TABLE users ADD email VARCHAR(100) NULL UNIQUE AFTER username");
    }

    mysqli_query($koneksi, "UPDATE users SET email='admin@chickguard.local' WHERE username='admin' AND (email IS NULL OR email='')");
}

function seed_jadwal_pakan_minum(mysqli $koneksi): void
{
    $result = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM jadwal_pakan_minum");
    $row = mysqli_fetch_assoc($result);
    if ((int) ($row['total'] ?? 0) > 0) {
        return;
    }

    $data = [
        ['Pakan', '06:00:00', 3.0, 'Senin, Rabu, Jumat', 'Pakan pagi untuk awal aktivitas'],
        ['Minum', '07:00:00', 2.0, 'Semua Hari', 'Isi air minum setelah pakan pagi'],
        ['Pakan', '12:00:00', 2.0, 'Semua Hari', 'Tambahan pakan siang secukupnya'],
        ['Minum', '13:00:00', 1.5, 'Selasa, Kamis', 'Pengecekan dan isi ulang wadah air'],
        ['Pakan', '19:00:00', 2.8, 'Sabtu, Minggu', 'Pakan malam untuk akhir pekan'],
    ];

    $stmt = mysqli_prepare($koneksi, "INSERT INTO jadwal_pakan_minum (jenis, waktu, jumlah, hari, catatan) VALUES (?, ?, ?, ?, ?)");
    foreach ($data as $item) {
        [$jenis, $waktu, $jumlah, $hari, $catatan] = $item;
        mysqli_stmt_bind_param($stmt, "ssdss", $jenis, $waktu, $jumlah, $hari, $catatan);
        mysqli_stmt_execute($stmt);
    }
}

function seed_jadwal_pencahayaan(mysqli $koneksi): void
{
    $result = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM jadwal_pencahayaan");
    $row = mysqli_fetch_assoc($result);
    if ((int) ($row['total'] ?? 0) > 0) {
        return;
    }

    $data = [
        ['Lampu Utama', '06:00:00', 3.0, 'Senin, Rabu, Jumat', 'Pencahayaan pagi untuk awal aktivitas kandang'],
        ['Lampu Pemanas', '07:00:00', 2.0, 'Semua Hari', 'Menjaga suhu kandang tetap hangat di pagi hari'],
        ['Lampu Utama', '12:00:00', 2.0, 'Semua Hari', 'Pencahayaan siang untuk menjaga visibilitas area'],
        ['Lampu Cadangan', '13:00:00', 1.5, 'Selasa, Kamis', 'Lampu tambahan saat cuaca redup atau mendung'],
        ['Lampu Utama', '19:00:00', 2.8, 'Sabtu, Minggu', 'Pencahayaan malam untuk akhir pekan'],
    ];

    $stmt = mysqli_prepare($koneksi, "INSERT INTO jadwal_pencahayaan (jenis, waktu, durasi, hari, catatan) VALUES (?, ?, ?, ?, ?)");
    foreach ($data as $item) {
        [$jenis, $waktu, $durasi, $hari, $catatan] = $item;
        mysqli_stmt_bind_param($stmt, "ssdss", $jenis, $waktu, $durasi, $hari, $catatan);
        mysqli_stmt_execute($stmt);
    }
}

function seed_log_harian(mysqli $koneksi): void
{
    $result = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM log_harian");
    $row = mysqli_fetch_assoc($result);
    if ((int) ($row['total'] ?? 0) > 0) {
        return;
    }

    $data = [
        ['00:00:00', 26, 65, null, null, 'Mati'],
        ['01:00:00', 25, 67, null, null, 'Mati'],
        ['02:00:00', 25, 68, null, null, 'Mati'],
        ['03:00:00', 24, 69, null, null, 'Mati'],
        ['04:00:00', 24, 70, null, null, 'Mati'],
        ['05:00:00', 24, 71, null, null, 'Mati'],
        ['06:00:00', 25, 70, 2.5, 5.2, 'Hidup'],
        ['07:00:00', 26, 68, null, 3.1, 'Hidup'],
        ['08:00:00', 27, 66, null, 2.8, 'Hidup'],
        ['09:00:00', 28, 64, null, 3.5, 'Hidup'],
        ['10:00:00', 29, 63, null, null, 'Hidup'],
        ['11:00:00', 30, 61, null, null, 'Hidup'],
        ['12:00:00', 30, 60, 2.0, null, 'Hidup'],
        ['13:00:00', 31, 59, null, 1.5, 'Hidup'],
        ['14:00:00', 31, 58, null, null, 'Hidup'],
        ['15:00:00', 30, 60, null, null, 'Hidup'],
        ['16:00:00', 29, 62, null, null, 'Hidup'],
        ['17:00:00', 28, 64, null, null, 'Hidup'],
        ['18:00:00', 27, 66, null, null, 'Hidup'],
        ['19:00:00', 27, 67, 2.8, null, 'Hidup'],
        ['20:00:00', 26, 68, null, null, 'Mati'],
        ['21:00:00', 26, 69, null, null, 'Mati'],
        ['22:00:00', 25, 70, null, null, 'Mati'],
        ['23:00:00', 25, 71, null, null, 'Mati'],
    ];

    $stmt = mysqli_prepare($koneksi, "INSERT INTO log_harian (waktu, suhu, kelembaban, pakan, minum, lampu) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($data as $item) {
        [$waktu, $suhu, $kelembaban, $pakan, $minum, $lampu] = $item;
        mysqli_stmt_bind_param($stmt, "sdddds", $waktu, $suhu, $kelembaban, $pakan, $minum, $lampu);
        mysqli_stmt_execute($stmt);
    }
}
?>
