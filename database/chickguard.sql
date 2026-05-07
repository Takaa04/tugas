CREATE DATABASE IF NOT EXISTS chickguard;
USE chickguard;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(30) NOT NULL DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password, role)
SELECT 'admin', '$2y$10$7nCEmPAREKTHm3VLGFnjoOAZJ9Ie/YdAosqopACP.IT29iV9aDgBK', 'admin'
WHERE NOT EXISTS (
    SELECT 1 FROM users WHERE username = 'admin'
);

CREATE TABLE IF NOT EXISTS jadwal_pakan_minum (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis ENUM('Pakan','Minum') NOT NULL,
    waktu TIME NOT NULL,
    jumlah DECIMAL(8,2) NOT NULL,
    hari VARCHAR(120) NOT NULL,
    catatan VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO jadwal_pakan_minum (jenis, waktu, jumlah, hari, catatan)
SELECT 'Pakan', '06:00:00', 3.0, 'Senin, Rabu, Jumat', 'Pakan pagi untuk awal aktivitas'
WHERE NOT EXISTS (SELECT 1 FROM jadwal_pakan_minum);

INSERT INTO jadwal_pakan_minum (jenis, waktu, jumlah, hari, catatan)
SELECT 'Minum', '07:00:00', 2.0, 'Semua Hari', 'Isi air minum setelah pakan pagi'
WHERE (SELECT COUNT(*) FROM jadwal_pakan_minum) = 1;

INSERT INTO jadwal_pakan_minum (jenis, waktu, jumlah, hari, catatan)
SELECT 'Pakan', '12:00:00', 2.0, 'Semua Hari', 'Tambahan pakan siang secukupnya'
WHERE (SELECT COUNT(*) FROM jadwal_pakan_minum) = 2;

INSERT INTO jadwal_pakan_minum (jenis, waktu, jumlah, hari, catatan)
SELECT 'Minum', '13:00:00', 1.5, 'Selasa, Kamis', 'Pengecekan dan isi ulang wadah air'
WHERE (SELECT COUNT(*) FROM jadwal_pakan_minum) = 3;

INSERT INTO jadwal_pakan_minum (jenis, waktu, jumlah, hari, catatan)
SELECT 'Pakan', '19:00:00', 2.8, 'Sabtu, Minggu', 'Pakan malam untuk akhir pekan'
WHERE (SELECT COUNT(*) FROM jadwal_pakan_minum) = 4;

CREATE TABLE IF NOT EXISTS jadwal_pencahayaan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis VARCHAR(50) NOT NULL,
    waktu TIME NOT NULL,
    durasi DECIMAL(8,2) NOT NULL,
    hari VARCHAR(120) NOT NULL,
    catatan VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO jadwal_pencahayaan (jenis, waktu, durasi, hari, catatan)
SELECT 'Lampu Utama', '06:00:00', 3.0, 'Senin, Rabu, Jumat', 'Pencahayaan pagi untuk awal aktivitas kandang'
WHERE NOT EXISTS (SELECT 1 FROM jadwal_pencahayaan);

INSERT INTO jadwal_pencahayaan (jenis, waktu, durasi, hari, catatan)
SELECT 'Lampu Pemanas', '07:00:00', 2.0, 'Semua Hari', 'Menjaga suhu kandang tetap hangat di pagi hari'
WHERE (SELECT COUNT(*) FROM jadwal_pencahayaan) = 1;

INSERT INTO jadwal_pencahayaan (jenis, waktu, durasi, hari, catatan)
SELECT 'Lampu Utama', '12:00:00', 2.0, 'Semua Hari', 'Pencahayaan siang untuk menjaga visibilitas area'
WHERE (SELECT COUNT(*) FROM jadwal_pencahayaan) = 2;

INSERT INTO jadwal_pencahayaan (jenis, waktu, durasi, hari, catatan)
SELECT 'Lampu Cadangan', '13:00:00', 1.5, 'Selasa, Kamis', 'Lampu tambahan saat cuaca redup atau mendung'
WHERE (SELECT COUNT(*) FROM jadwal_pencahayaan) = 3;

INSERT INTO jadwal_pencahayaan (jenis, waktu, durasi, hari, catatan)
SELECT 'Lampu Utama', '19:00:00', 2.8, 'Sabtu, Minggu', 'Pencahayaan malam untuk akhir pekan'
WHERE (SELECT COUNT(*) FROM jadwal_pencahayaan) = 4;

CREATE TABLE IF NOT EXISTS log_harian (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu TIME NOT NULL,
    suhu DECIMAL(5,2) NOT NULL,
    kelembaban DECIMAL(5,2) NOT NULL,
    pakan DECIMAL(8,2) DEFAULT NULL,
    minum DECIMAL(8,2) DEFAULT NULL,
    lampu ENUM('Hidup','Mati') NOT NULL DEFAULT 'Mati',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO log_harian (waktu, suhu, kelembaban, pakan, minum, lampu)
SELECT '00:00:00', 26, 65, NULL, NULL, 'Mati'
WHERE NOT EXISTS (SELECT 1 FROM log_harian);

INSERT INTO log_harian (waktu, suhu, kelembaban, pakan, minum, lampu)
SELECT '01:00:00', 25, 67, NULL, NULL, 'Mati'
WHERE (SELECT COUNT(*) FROM log_harian) = 1;

INSERT INTO log_harian (waktu, suhu, kelembaban, pakan, minum, lampu)
SELECT '02:00:00', 25, 68, NULL, NULL, 'Mati'
WHERE (SELECT COUNT(*) FROM log_harian) = 2;

INSERT INTO log_harian (waktu, suhu, kelembaban, pakan, minum, lampu)
SELECT '03:00:00', 24, 69, NULL, NULL, 'Mati'
WHERE (SELECT COUNT(*) FROM log_harian) = 3;

INSERT INTO log_harian (waktu, suhu, kelembaban, pakan, minum, lampu)
SELECT '04:00:00', 24, 70, NULL, NULL, 'Mati'
WHERE (SELECT COUNT(*) FROM log_harian) = 4;

INSERT INTO log_harian (waktu, suhu, kelembaban, pakan, minum, lampu)
SELECT '05:00:00', 24, 71, NULL, NULL, 'Mati'
WHERE (SELECT COUNT(*) FROM log_harian) = 5;

INSERT INTO log_harian (waktu, suhu, kelembaban, pakan, minum, lampu)
SELECT '06:00:00', 25, 70, 2.5, 5.2, 'Hidup'
WHERE (SELECT COUNT(*) FROM log_harian) = 6;

INSERT INTO log_harian (waktu, suhu, kelembaban, pakan, minum, lampu)
SELECT '07:00:00', 26, 68, NULL, 3.1, 'Hidup'
WHERE (SELECT COUNT(*) FROM log_harian) = 7;

INSERT INTO log_harian (waktu, suhu, kelembaban, pakan, minum, lampu)
SELECT '08:00:00', 27, 66, NULL, 2.8, 'Hidup'
WHERE (SELECT COUNT(*) FROM log_harian) = 8;

INSERT INTO log_harian (waktu, suhu, kelembaban, pakan, minum, lampu)
SELECT '09:00:00', 28, 64, NULL, 3.5, 'Hidup'
WHERE (SELECT COUNT(*) FROM log_harian) = 9;
