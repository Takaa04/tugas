# ChickGuard

<p align="center">
  <img src="assets/images/branding/logo.png" alt="ChickGuard Logo" width="140">
</p>

<p align="center">
  Sistem monitoring kandang ayam berbasis PHP dengan dashboard admin, jadwal pencahayaan, jadwal pakan-minum, dan log harian dalam satu antarmuka.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-Native-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Native">
  <img src="https://img.shields.io/badge/MySQL-MariaDB-00618A?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL MariaDB">
  <img src="https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap 5">
  <img src="https://img.shields.io/badge/Chart.js-4-FF6384?style=for-the-badge&logo=chartdotjs&logoColor=white" alt="Chart.js">
</p>

<p align="center">
  <img src="assets/images/docs/dashboard-screenshot.png" alt="Preview Dashboard ChickGuard">
</p>

## Overview

ChickGuard dibuat untuk membantu monitoring operasional kandang ayam melalui panel admin yang sederhana, cepat, dan mudah dipakai. Project ini saat ini berfokus pada kebutuhan inti: autentikasi admin, visualisasi kondisi kandang, pengelolaan jadwal, dan pencatatan log harian.

## Why ChickGuard

- Dashboard ringkas untuk melihat suhu, kelembapan, dan status kandang.
- Pengelolaan jadwal lampu, pakan, dan minum langsung dari panel admin.
- Log harian dengan pencarian, pagination, dan hapus massal.
- Reset password berbasis token untuk alur admin yang lebih aman.
- Struktur project sederhana, cocok untuk tugas, demo, atau pengembangan lanjutan.

## Feature Highlights

### Dashboard Monitoring
- Menampilkan metrik suhu kandang, kelembapan, dan status kandang.
- Grafik mingguan menggunakan Chart.js.
- Nilai monitoring saat ini masih berupa simulasi frontend.

### Jadwal Pencahayaan
- Tambah, edit, dan hapus jadwal lampu.
- Pengaturan waktu, durasi, hari aktif, dan catatan.
- Pagination data untuk tampilan yang tetap rapi.

### Jadwal Pakan dan Minum
- Kelola jadwal pemberian pakan dan minum dari satu halaman.
- Mendukung jenis jadwal, jumlah, hari aktif, dan catatan.
- Tersedia aksi cepat simulasi stok pakan dan air di UI.

### Log Harian
- Menampilkan riwayat suhu, kelembapan, lampu, pakan, dan minum.
- Mendukung pencarian data log.
- Mendukung pilihan jumlah baris per halaman dan hapus massal.

### Akses Admin
- Login berbasis session.
- Fitur lupa password dan reset password.
- Tersedia utilitas `tambah_admin.php` untuk menambahkan admin manual.

## Tech Stack

| Layer | Digunakan |
| --- | --- |
| Backend | PHP native |
| Database | MySQL / MariaDB |
| UI | Bootstrap 5 |
| Chart | Chart.js |
| Icons | Bootstrap Icons, Font Awesome |
| Styling | CSS custom |

## Quick Start

### 1. Jalankan di XAMPP

Letakkan project di:

```text
C:\xampp\htdocs\chick
```

Lalu nyalakan `Apache` dan `MySQL` dari XAMPP Control Panel.

### 2. Siapkan Database

1. Buka `http://localhost/phpmyadmin`
2. Buat database `chickguard`
3. Import file `database/chickguard.sql`

### 3. Cek Konfigurasi

Sesuaikan koneksi database pada file:

```text
config/koneksi.php
```

Terutama jika username, password, atau host MySQL Anda berbeda dari konfigurasi lokal default.

### 4. Akses Aplikasi

Buka:

```text
http://localhost/chick/
```

## Demo Account

| Field | Value |
| --- | --- |
| Username | `admin` |
| Email | `admin@chickguard.local` |
| Password | gunakan akun admin dari hasil import SQL |

Jika perlu menambahkan akun admin baru secara manual, gunakan:

```text
tambah_admin.php
```

## Project Structure

```text
chick/
|-- index.php
|-- login.php
|-- reset_password.php
|-- tambah_admin.php
|-- config/
|   `-- koneksi.php
|-- database/
|   `-- chickguard.sql
|-- pages/
|   |-- dashboard.php
|   |-- pencahayaan.php
|   |-- pakan_minum.php
|   `-- log_harian.php
|-- proses/
|   |-- init_tables.php
|   |-- proses_login.php
|   |-- proses_lupa_password.php
|   |-- proses_reset_password.php
|   |-- proses_pencahayaan.php
|   |-- proses_pakan_minum.php
|   |-- proses_log_harian.php
|   |-- filter_log_harian.php
|   `-- logout.php
|-- componets/
|   |-- sidebar.php
|   `-- topbar.php
`-- assets/
    |-- css/
    |-- images/
    `-- vendor/
```

Catatan: nama folder shared layout di repo ini memang `componets`.

## Main Pages

| Halaman | Fungsi |
| --- | --- |
| `index.php` | Redirect awal aplikasi |
| `login.php` | Login admin dan lupa password |
| `reset_password.php` | Form reset password dari token |
| `pages/dashboard.php` | Ringkasan monitoring kandang |
| `pages/pencahayaan.php` | Manajemen jadwal lampu |
| `pages/pakan_minum.php` | Manajemen jadwal pakan dan minum |
| `pages/log_harian.php` | Riwayat log harian |

## Implementation Notes

- Dashboard saat ini menggunakan data simulasi di sisi frontend, belum terhubung ke sensor fisik.
- File `proses/init_tables.php` membantu memastikan tabel tambahan tersedia dan seed data awal terisi.
- Beberapa aset vendor tersedia lokal di `assets/vendor`, tetapi halaman utama saat ini masih memuat sebagian dependency dari CDN.
- Project ini cocok dijadikan dasar sebelum integrasi IoT atau automasi perangkat kandang.

## Next Improvements

- Integrasi sensor suhu dan kelembapan real-time.
- Sinkronisasi aksi lampu, pakan, dan minum ke perangkat fisik.
- Notifikasi otomatis ketika kondisi kandang berada di luar ambang aman.
- Penambahan role pengguna selain admin.
- Pemisahan layer backend agar lebih mudah dikembangkan.

## License

Repo ini belum menyertakan file lisensi khusus. Jika project akan dipublikasikan atau dibagikan lebih luas, sebaiknya tambahkan lisensi yang sesuai.
