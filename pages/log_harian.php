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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/dashboard.css">
  <style>
    .topbar {
      padding: 0.7rem 1rem;
    }

    .topbar h1 {
      font-size: 1.7rem;
      margin-bottom: 0.1rem;
    }

    .topbar p {
      font-size: 0.95rem;
    }

    .content-section {
      padding: 1.15rem 1.35rem 1.4rem;
    }

    .log-card {
      padding: 1rem 1rem 0;
      border-radius: 22px;
      overflow: hidden;
    }

    .log-toolbar {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 1rem;
      padding: 0.45rem 0.6rem 1rem;
    }

    .log-title {
      font-size: 2rem;
      font-weight: 800;
      color: #111827;
      margin: 0 0 0.3rem;
    }

    .log-subtitle {
      margin: 0;
      font-size: 0.9rem;
      color: #8b96a1;
    }

    .toolbar-actions {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      flex-wrap: wrap;
    }

    .search-box {
      position: relative;
      width: 280px;
      max-width: 100%;
    }

    .search-box i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #8ba1a8;
      font-size: 0.95rem;
    }

    .search-input {
      width: 100%;
      height: 40px;
      padding: 0 14px 0 36px;
      border-radius: 8px;
      border: 2px solid #8db2b8;
      font-size: 0.9rem;
      outline: none;
    }

    .rows-box {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: #4b5563;
      font-size: 0.9rem;
    }

    .rows-select {
      width: 50px;
      height: 40px;
      border: 0;
      border-radius: 8px;
      background: #e5e7eb;
      color: #111827;
      font-weight: 600;
      padding: 0 8px;
      outline: none;
    }

    .table-wrap {
      padding: 0 0.2rem;
    }

    .log-table {
      margin: 0;
    }

    .log-table thead th {
      background: #7e9ea3;
      color: #fff;
      font-size: 0.95rem;
      font-weight: 700;
      border: 0;
      padding: 1rem 1rem;
      vertical-align: middle;
    }

    .log-table thead th:first-child {
      width: 52px;
      border-top-left-radius: 14px;
      border-bottom-left-radius: 14px;
      text-align: center;
    }

    .log-table thead th:last-child {
      border-top-right-radius: 14px;
      border-bottom-right-radius: 14px;
      text-align: center;
    }

    .log-table tbody td {
      padding: 1rem 1rem;
      border-color: #edf1f2;
      vertical-align: middle;
      font-size: 0.95rem;
    }

    .check-col {
      text-align: center;
    }

    .fake-check {
      width: 16px;
      height: 16px;
      display: inline-block;
      border: 2px solid #8db2b8;
      border-radius: 2px;
      background: #fff;
    }

    .cell-strong {
      font-weight: 700;
      color: #111827;
    }

    .lamp-badge {
      min-width: 44px;
      display: inline-block;
      text-align: center;
      padding: 0.42rem 0.7rem;
      border-radius: 6px;
      font-size: 0.82rem;
      font-weight: 700;
    }

    .lamp-badge.off {
      background: #e5e5e5;
      color: #6b7280;
    }

    .lamp-badge.on {
      background: #57d9de;
      color: #fff;
    }

    .table-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
      padding: 0.85rem 1rem 1rem;
      flex-wrap: wrap;
    }

    .footer-left {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      color: #6b7280;
      font-size: 0.86rem;
    }

    .trash-mini {
      color: #ff5a1f;
      font-size: 1.45rem;
      line-height: 1;
    }

    .footer-left strong {
      color: #111827;
    }

    .pagination-wrap {
      display: flex;
      justify-content: flex-end;
      gap: 0.35rem;
    }

    .page-chip {
      min-width: 28px;
      height: 28px;
      border: 1px solid #7f9fa5;
      border-radius: 7px;
      background: #fff;
      color: #577980;
      font-size: 0.8rem;
      display: grid;
      place-items: center;
    }

    .page-chip.active {
      background: #7f9fa5;
      color: #fff;
    }

    .page-chip.muted {
      border-color: #d7e0e3;
      color: #bcc8cc;
    }

    @media (max-width: 992px) {
      .log-toolbar {
        flex-direction: column;
        align-items: stretch;
      }

      .toolbar-actions {
        justify-content: space-between;
      }
    }

    @media (max-width: 768px) {
      .content-section {
        padding: 1rem 0.8rem 1.3rem;
      }

      .log-title {
        font-size: 1.6rem;
      }

      .search-box {
        width: 100%;
      }

      .log-table {
        min-width: 920px;
      }

      .table-footer {
        flex-direction: column;
        align-items: flex-start;
      }
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
                <table class="table log-table align-middle">
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
