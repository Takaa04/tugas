<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$activePage = 'log_harian';
$topbarTitle = 'Log Harian Kandang';
$topbarSubtitle = 'Catatan aktivitas dan kondisi penting setiap hari';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChickGuard - Log Harian</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/dashboard.css">
  <style>
    .page-card {
      padding: 1.5rem;
    }

    .log-table thead th {
      background: #7fa1a5;
      color: #fff;
      border: 0;
      padding: 1rem;
    }

    .log-table tbody td {
      padding: 1rem;
      vertical-align: middle;
    }

    .badge-soft {
      display: inline-block;
      padding: 0.35rem 0.75rem;
      border-radius: 999px;
      background: #dcfce7;
      color: #166534;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <div class="dashboard-shell d-lg-flex">
    <?php include '../componets/sidebar.php'; ?>

    <main class="main-content">
      <?php include '../componets/topbar.php'; ?>

      <section class="content-section">
        <div class="container-fluid px-0">
          <div class="card-soft page-card">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
              <div>
                <h2 class="metric-title text-start mb-2">Riwayat Monitoring</h2>
                <p class="metric-subtitle">Template ini bisa langsung kamu sambungkan ke database saat data log sudah siap.</p>
              </div>
              <span class="badge-soft">3 Catatan Hari Ini</span>
            </div>

            <div class="table-responsive">
              <table class="table log-table align-middle mb-0">
                <thead>
                  <tr>
                    <th>Waktu</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>06:00</td>
                    <td>Pakan</td>
                    <td>Pemberian pakan pagi berhasil dijalankan sesuai jadwal.</td>
                    <td><span class="badge-soft">Normal</span></td>
                  </tr>
                  <tr>
                    <td>07:15</td>
                    <td>Pencahayaan</td>
                    <td>Lampu kandang menyala otomatis sesuai pengaturan sistem.</td>
                    <td><span class="badge-soft">Normal</span></td>
                  </tr>
                  <tr>
                    <td>12:30</td>
                    <td>Lingkungan</td>
                    <td>Suhu kandang naik ringan, perlu dipantau pada sesi berikutnya.</td>
                    <td><span class="badge-soft">Dipantau</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function updateWaktu() {
      const now = new Date();
      const jam = now.toLocaleTimeString("id-ID", {
        hour: "2-digit",
        minute: "2-digit",
      });
      const tanggal = now.toLocaleDateString("id-ID", {
        weekday: "long",
        day: "numeric",
        month: "long",
        year: "numeric"
      });

      document.getElementById("jam").textContent = jam;
      document.getElementById("tanggal").textContent = tanggal;
    }

    setInterval(updateWaktu, 1000);
    updateWaktu();
  </script>
</body>
</html>
