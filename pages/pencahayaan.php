<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$activePage = 'pencahayaan';
$topbarTitle = 'Pengaturan Pencahayaan';
$topbarSubtitle = 'Kontrol lampu kandang dan jadwal pencahayaan harian';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChickGuard - Pencahayaan</title>
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

    .status-chip {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.45rem 0.9rem;
      border-radius: 999px;
      background: #fef3c7;
      color: #92400e;
      font-weight: 600;
    }

    .info-tile {
      padding: 1.2rem;
      min-height: 150px;
    }

    .info-tile i {
      font-size: 2rem;
      color: var(--cg-accent-dark);
    }

    .info-tile h3 {
      font-size: 1.1rem;
      margin: 0.9rem 0 0.25rem;
      font-weight: 700;
    }

    .info-tile p {
      margin: 0;
      color: var(--cg-muted);
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
          <div class="card-soft page-card mb-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
              <div>
                <h2 class="metric-title text-start mb-2">Status Sistem Lampu</h2>
                <p class="metric-subtitle">Halaman ini sudah siap dipakai sebagai dasar pengembangan fitur pencahayaan.</p>
              </div>
              <div class="status-chip">
                <i class="bi bi-lightbulb-fill"></i>
                <span>Mode Otomatis Aktif</span>
              </div>
            </div>
          </div>

          <div class="row g-4">
            <div class="col-12 col-md-6 col-xl-4">
              <div class="card-soft info-tile">
                <i class="bi bi-brightness-high-fill"></i>
                <h3>Intensitas Lampu</h3>
                <p>Atur tingkat terang lampu berdasarkan usia ayam atau waktu tertentu.</p>
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
              <div class="card-soft info-tile">
                <i class="bi bi-clock-history"></i>
                <h3>Jadwal Otomatis</h3>
                <p>Tambahkan jam nyala dan mati untuk menjaga ritme kandang tetap konsisten.</p>
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
              <div class="card-soft info-tile">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <h3>Notifikasi</h3>
                <p>Pasang peringatan saat lampu gagal menyala atau kondisi cahaya di luar target.</p>
              </div>
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
