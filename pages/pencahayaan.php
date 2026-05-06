<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$activePage = 'pencahayaan';
$topbarTitle = 'Selamat datang, ' . ($_SESSION['username'] ?? 'Admin') . ' 👋';
$topbarSubtitle = 'Pantau kondisi kandang dan sistem secara real-time';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ChickGuard - Pencahayaan</title>
  <link rel="icon" href="../assets/icon.png" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="page-pencahayaan">
  <div class="dashboard-shell d-lg-flex">
    <?php include '../componets/sidebar.php'; ?>

    <main class="main-content">
      <?php include '../componets/topbar.php'; ?>

      <section class="content-section">
        <div class="container-fluid px-0">
          <div class="card-soft hero-card">
            <div class="hero-grid">
              <div class="hero-block centered">
                <div>
                  <div class="hero-title text-center">Mode Lampu<br>otomatis</div>
                  <div class="toggle-pill mx-auto"></div>
                </div>
              </div>

              <div class="hero-block centered">
                <div class="hero-icon">
                  <i class="bi bi-lightbulb"></i>
                </div>
                <div>
                  <div class="hero-title">Status Lampu</div>
                  <div class="status-pill-large">Nyala</div>
                </div>
              </div>

              <div class="hero-block centered">
                <button type="button" class="pill-button action-btn green">Nyalakan</button>
              </div>

              <div class="hero-block centered">
                <button type="button" class="pill-button action-btn orange">Matikan</button>
              </div>
            </div>
          </div>

          <div class="section-head">
            <h2 class="page-title">Jadwal Nyala Lampu</h2>
            <button type="button" class="pill-button add-btn">+ Tambah Jadwal</button>
          </div>

          <div class="card-soft table-card schedule-card">
            <div class="table-shell table-wrap">
              <div class="table-responsive">
                <table class="table data-table schedule-table align-middle">
                  <thead>
                    <tr>
                      <th>Jenis</th>
                      <th>Waktu</th>
                      <th>Durasi</th>
                      <th>Hari</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Lampu Utama</td>
                      <td>06:00</td>
                      <td>3 Jam</td>
                      <td>Senin, Rabu,<br>Jumat</td>
                      <td>
                        <div class="action-icons">
                          <i class="bi bi-pencil-square edit"></i>
                          <i class="bi bi-trash3 delete"></i>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Lampu Pemanas</td>
                      <td>07:00</td>
                      <td>2 Jam</td>
                      <td>Semua Hari</td>
                      <td>
                        <div class="action-icons">
                          <i class="bi bi-pencil-square edit"></i>
                          <i class="bi bi-trash3 delete"></i>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Lampu Utama</td>
                      <td>12:00</td>
                      <td>2 Jam</td>
                      <td>Semua Hari</td>
                      <td>
                        <div class="action-icons">
                          <i class="bi bi-pencil-square edit"></i>
                          <i class="bi bi-trash3 delete"></i>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Lampu Cadangan</td>
                      <td>13:00</td>
                      <td>1.5 Jam</td>
                      <td>Selasa, Kamis</td>
                      <td>
                        <div class="action-icons">
                          <i class="bi bi-pencil-square edit"></i>
                          <i class="bi bi-trash3 delete"></i>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Lampu Utama</td>
                      <td>19:00</td>
                      <td>2.8 Jam</td>
                      <td>Sabtu, Minggu</td>
                      <td>
                        <div class="action-icons">
                          <i class="bi bi-pencil-square edit"></i>
                          <i class="bi bi-trash3 delete"></i>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="pagination-wrap">
              <div class="page-chip muted">&laquo;</div>
              <div class="page-chip muted">&lsaquo;</div>
              <div class="page-chip active">1</div>
              <div class="page-chip">2</div>
              <div class="page-chip">3</div>
              <div class="page-chip">&rsaquo;</div>
              <div class="page-chip">&raquo;</div>
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
