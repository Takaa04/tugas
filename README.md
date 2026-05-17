# ChickGuard 🐔

<p align="center">
  <img src="assets/images/branding/logo.png" alt="ChickGuard Logo" width="140">
</p>

<p align="center">
  Sistem monitoring kandang ayam berbasis PHP yang simpel, modern, dan mudah dijalankan.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-Native-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Native">
  <img src="https://img.shields.io/badge/MySQL-MariaDB-00618A?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL MariaDB">
  <img src="https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap 5">
</p>

<p align="center">
  <img src="assets/images/docs/dashboard-screenshot.png" alt="Preview Dashboard ChickGuard">
</p>

## ✨ Fitur

- 🔐 Login admin + lupa password
- 🌡️ Dashboard suhu dan kelembapan
- 💡 Manajemen jadwal pencahayaan
- 🍽️ Jadwal pakan dan minum
- 📝 Log harian dengan pencarian

## 🚀 Menjalankan Project

1. Simpan project di `C:\xampp\htdocs\chick`
2. Jalankan `Apache` dan `MySQL` di XAMPP
3. Buat database `chickguard`
4. Import `database/chickguard.sql`
5. Buka `http://localhost/chick/`

## 🔑 Akun Demo

- Username: `admin`
- Email: `admin@chickguard.local`
- Password: gunakan akun admin dari hasil import SQL

## 🧰 Tech Stack

- PHP Native
- MySQL / MariaDB
- Bootstrap 5
- Chart.js
- CSS custom

## 📁 Struktur Singkat

```text
chick/
|-- assets/
|-- components/
|-- config/
|-- database/
|-- pages/
|-- proses/
|-- login.php
`-- index.php
```

## 📌 Catatan

- Dashboard saat ini masih memakai data simulasi.
- Shared layout ada di folder `components`.
- File `proses/init_tables.php` membantu menyiapkan tabel tambahan otomatis.