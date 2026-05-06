<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$activePage = 'log_harian';
$topbarTitle = 'Selamat datang, ' . ($_SESSION['username'] ?? 'Admin') . ' 👋';
$topbarSubtitle = 'Pantau kondisi kandang dan sistem secara real-time';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ChickGuard - Log Harian</title>
  <link rel="icon" href="../assets/icon.png" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="page-log-harian">
  <div class="dashboard-shell d-lg-flex">
    <?php include '../componets/sidebar.php'; ?>

    <main class="main-content">
      <?php include '../componets/topbar.php'; ?>

      <section class="content-section">
        <div class="container-fluid px-0">
          <div class="card-soft log-card">
            <div class="log-toolbar">
              <div>
                <h2 class="log-title">Log Harian Kandang</h2>
                <p class="log-subtitle">Data pencatatan harian suhu, kelembaban, pakan, minum & lampu</p>
              </div>

              <div class="toolbar-actions">
                <div class="search-box">
                  <i class="bi bi-search"></i>
                  <input type="text" class="search-input" placeholder="Cari waktu, status, lampu...">
                </div>

                <div class="rows-box">
                  <span>Baris:</span>
                  <select class="rows-select">
                    <option selected>10</option>
                    <option>25</option>
                    <option>50</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="table-wrap">
              <div class="table-responsive">
                <table class="table data-table log-table align-middle">
                  <thead>
                    <tr>
                      <th class="check-col"><span class="fake-check"></span></th>
                      <th>Waktu</th>
                      <th>Suhu (°C)</th>
                      <th>Kelembaban (%)</th>
                      <th>Pakan (kg)</th>
                      <th>Minum (L)</th>
                      <th class="text-center">Lampu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="check-col"><span class="fake-check"></span></td>
                      <td>00:00</td>
                      <td class="cell-strong">26°C</td>
                      <td class="cell-strong">65%</td>
                      <td>-</td>
                      <td>-</td>
                      <td class="text-center"><span class="lamp-badge off">Mati</span></td>
                    </tr>
                    <tr>
                      <td class="check-col"><span class="fake-check"></span></td>
                      <td>01:00</td>
                      <td class="cell-strong">25°C</td>
                      <td class="cell-strong">67%</td>
                      <td>-</td>
                      <td>-</td>
                      <td class="text-center"><span class="lamp-badge off">Mati</span></td>
                    </tr>
                    <tr>
                      <td class="check-col"><span class="fake-check"></span></td>
                      <td>02:00</td>
                      <td class="cell-strong">25°C</td>
                      <td class="cell-strong">68%</td>
                      <td>-</td>
                      <td>-</td>
                      <td class="text-center"><span class="lamp-badge off">Mati</span></td>
                    </tr>
                    <tr>
                      <td class="check-col"><span class="fake-check"></span></td>
                      <td>03:00</td>
                      <td class="cell-strong">24°C</td>
                      <td class="cell-strong">69%</td>
                      <td>-</td>
                      <td>-</td>
                      <td class="text-center"><span class="lamp-badge off">Mati</span></td>
                    </tr>
                    <tr>
                      <td class="check-col"><span class="fake-check"></span></td>
                      <td>04:00</td>
                      <td class="cell-strong">24°C</td>
                      <td class="cell-strong">70%</td>
                      <td>-</td>
                      <td>-</td>
                      <td class="text-center"><span class="lamp-badge off">Mati</span></td>
                    </tr>
                    <tr>
                      <td class="check-col"><span class="fake-check"></span></td>
                      <td>05:00</td>
                      <td class="cell-strong">24°C</td>
                      <td class="cell-strong">71%</td>
                      <td>-</td>
                      <td>-</td>
                      <td class="text-center"><span class="lamp-badge off">Mati</span></td>
                    </tr>
                    <tr>
                      <td class="check-col"><span class="fake-check"></span></td>
                      <td>06:00</td>
                      <td class="cell-strong">25°C</td>
                      <td class="cell-strong">70%</td>
                      <td>2.5 kg</td>
                      <td>5.2 L</td>
                      <td class="text-center"><span class="lamp-badge on">Hidup</span></td>
                    </tr>
                    <tr>
                      <td class="check-col"><span class="fake-check"></span></td>
                      <td>07:00</td>
                      <td class="cell-strong">26°C</td>
                      <td class="cell-strong">68%</td>
                      <td>-</td>
                      <td>3.1 L</td>
                      <td class="text-center"><span class="lamp-badge on">Hidup</span></td>
                    </tr>
                    <tr>
                      <td class="check-col"><span class="fake-check"></span></td>
                      <td>08:00</td>
                      <td class="cell-strong">27°C</td>
                      <td class="cell-strong">66%</td>
                      <td>-</td>
                      <td>2.8 L</td>
                      <td class="text-center"><span class="lamp-badge on">Hidup</span></td>
                    </tr>
                    <tr>
                      <td class="check-col"><span class="fake-check"></span></td>
                      <td>09:00</td>
                      <td class="cell-strong">28°C</td>
                      <td class="cell-strong">64%</td>
                      <td>-</td>
                      <td>3.5 L</td>
                      <td class="text-center"><span class="lamp-badge on">Hidup</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="table-footer">
              <div class="footer-left">
                <i class="bi bi-trash3-fill trash-mini"></i>
                <span>Menampilkan <strong>1 - 10</strong> dari <strong>24</strong> entri</span>
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
