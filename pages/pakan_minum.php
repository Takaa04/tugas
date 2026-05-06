<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$activePage = 'pakan_minum';
$topbarTitle = 'Pakan Minum';
$topbarSubtitle = 'Pantau stok, aksi cepat, dan jadwal pemberian pakan minum';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChickGuard - Pakan Minum</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<<<<<<< HEAD
  <link rel="stylesheet" href="../assets/dashboard.css">
  <style>
    .status-overview {
      padding: 1.1rem 1.5rem;
    }

    .supply-group {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .supply-icon {
      font-size: 2rem;
      line-height: 1;
    }

    .supply-icon.feed {
      color: #22c59e;
    }

    .supply-icon.water {
      color: #2cabed;
    }

    .supply-title {
      font-size: 1rem;
      font-weight: 700;
      margin-bottom: 0.1rem;
    }

    .supply-value {
      font-size: 1.9rem;
      line-height: 1.05;
      font-weight: 800;
      margin-bottom: 0.75rem;
    }

    .progress-slim {
      height: 0.5rem;
      background: #d9d9d9;
      border-radius: 999px;
      overflow: hidden;
      width: 140px;
    }

    .progress-slim .progress-bar {
      border-radius: 999px;
    }

    .overview-divider {
      width: 4px;
      align-self: stretch;
      background: #d9d9d9;
      border-radius: 999px;
      min-height: 96px;
    }

    .action-btn {
      min-width: 215px;
      border: 0;
      border-radius: 999px;
      color: #fff;
      font-size: 1rem;
      font-weight: 700;
      padding: 0.85rem 1.5rem;
      box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
    }

    .action-btn.feed {
      background: #23c39c;
    }

    .action-btn.water {
      background: #28acef;
    }

    .section-title {
      font-size: 1.25rem;
      font-weight: 800;
      margin: 0;
    }

    .add-btn {
      border: 0;
      border-radius: 999px;
      background: #23c39c;
      color: #fff;
      font-weight: 700;
      padding: 0.8rem 1.25rem;
      box-shadow: 0 8px 18px rgba(35, 195, 156, 0.3);
    }

    .schedule-card {
      padding: 1.2rem;
    }

    .schedule-table {
      margin: 0;
      overflow: hidden;
      border-radius: 18px;
    }

    .schedule-table thead th {
      background: #7fa1a5;
      color: #fff;
      font-size: 0.95rem;
      font-weight: 700;
      border: 0;
      padding: 1rem;
      vertical-align: middle;
    }

    .schedule-table thead th:first-child {
      border-top-left-radius: 18px;
      border-bottom-left-radius: 18px;
    }

    .schedule-table thead th:last-child {
      border-top-right-radius: 18px;
      border-bottom-right-radius: 18px;
    }

    .schedule-table tbody td {
      padding: 1.15rem 1rem;
      border-color: #e6ecef;
      vertical-align: middle;
      font-size: 0.98rem;
    }

    .action-icons {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .action-icons .edit {
      color: #6b7280;
    }

    .action-icons .delete {
      color: #ff4d1f;
    }

    @media (max-width: 991.98px) {
      .overview-divider {
        display: none;
      }
    }

    @media (max-width: 767.98px) {
      .status-overview {
        padding: 1rem;
      }

      .action-btn {
        min-width: 100%;
      }

      .schedule-table {
        min-width: 720px;
      }
    }

    @media (max-width: 575.98px) {
      .supply-value {
        font-size: 1.55rem;
      }
    }
  </style>
</head>
<body>
  <div class="dashboard-shell d-lg-flex">
    <?php include '../componets/sidebar.php'; ?>
=======

  <!-- CSS EXTERNAL -->
  <link rel="stylesheet" href="../assets/pakan.css">
</head>
<body>
  <div class="dashboard-shell d-lg-flex">
    <aside class="sidebar">
      <div class="sidebar-panel">
        <div class="brand-wrap">
          <img src="../assets/logo.png" alt="ChickGuard" class="brand-image">
        </div>

        <div class="sidebar-nav-wrap">
          <ul class="nav nav-pills flex-column gap-2 sidebar-menu">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <i class="bi bi-house-fill"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="pakan_minum.php">
                <i class="fa-solid fa-bowl-food"></i>
                <span>Pakan Minum</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="bi bi-lightbulb-fill"></i>
                <span>Pencahayaan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fa-solid fa-note-sticky"></i>
                <span>Log Harian</span>
              </a>
            </li>
          </ul>

          <div class="sidebar-logout">
            <a class="nav-link logout-link" href="#">
              <i class="bi bi-power"></i>
              <span>Logout</span>
            </a>
          </div>
        </div>
      </div>
    </aside>
>>>>>>> 02f013c534453e8c87b540a2763b651cffbfce16

    <main class="main-content">
      <?php include '../componets/topbar.php'; ?>

      <section class="content-section">
        <div class="container-fluid px-0">
          <div class="card-soft status-overview mb-4">
            <div class="row align-items-center g-4">
              <div class="col-12 col-lg-3">
                <div class="supply-group">
                  <div class="supply-icon feed">
                    <i class="fa-solid fa-bowl-food"></i>
                  </div>
                  <div>
                    <div class="supply-title">Pakan</div>
                    <div class="supply-value">75%</div>
                    <div class="progress-slim">
                      <div class="progress-bar bg-success" style="width: 75%"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-auto d-none d-lg-flex">
                <div class="overview-divider"></div>
              </div>

              <div class="col-12 col-lg-3">
                <div class="supply-group">
                  <div class="supply-icon water">
                    <i class="bi bi-droplet-fill"></i>
                  </div>
                  <div>
                    <div class="supply-title">Air</div>
                    <div class="supply-value">60%</div>
                    <div class="progress-slim">
                      <div class="progress-bar bg-info" style="width: 60%"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-lg">
                <div class="d-flex flex-column flex-md-row justify-content-lg-end gap-3">
                  <button type="button" class="action-btn feed">Beri Pakan</button>
                  <button type="button" class="action-btn water">Beri Minum</button>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
            <h2 class="section-title">Jadwal Pemberian</h2>
            <button type="button" class="add-btn">+ Tambah Jadwal</button>
          </div>

          <div class="card-soft schedule-card">
            <div class="table-responsive">
              <table class="table schedule-table align-middle">
                <thead>
                  <tr>
                    <th>Jenis</th>
                    <th>Waktu</th>
                    <th>Jumlah<br>Pakan</th>
                    <th>Hari</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Pakan</td>
                    <td>06:00</td>
                    <td>3.0 kg</td>
                    <td>Senin, Rabu, Jumat</td>
                    <td>
                      <div class="action-icons justify-content-center">
                        <i class="bi bi-pencil-square edit"></i>
                        <i class="bi bi-trash3 delete"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Minum</td>
                    <td>07:00</td>
                    <td>2.0 L</td>
                    <td>Semua Hari</td>
                    <td>
                      <div class="action-icons justify-content-center">
                        <i class="bi bi-pencil-square edit"></i>
                        <i class="bi bi-trash3 delete"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Pakan</td>
                    <td>12:00</td>
                    <td>2.0 kg</td>
                    <td>Semua Hari</td>
                    <td>
                      <div class="action-icons justify-content-center">
                        <i class="bi bi-pencil-square edit"></i>
                        <i class="bi bi-trash3 delete"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Minum</td>
                    <td>13:00</td>
                    <td>1.5 L</td>
                    <td>Selasa, Kamis</td>
                    <td>
                      <div class="action-icons justify-content-center">
                        <i class="bi bi-pencil-square edit"></i>
                        <i class="bi bi-trash3 delete"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Pakan</td>
                    <td>19:00</td>
                    <td>2.8 kg</td>
                    <td>Sabtu, Minggu</td>
                    <td>
                      <div class="action-icons justify-content-center">
                        <i class="bi bi-pencil-square edit"></i>
                        <i class="bi bi-trash3 delete"></i>
                      </div>
                    </td>
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
