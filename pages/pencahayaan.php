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
      padding: 1rem 1.35rem 1.4rem;
    }

    .hero-card {
      padding: 1.7rem 1.8rem;
      border-radius: 22px;
    }

    .hero-grid {
      display: grid;
      grid-template-columns: 1.15fr 1fr 0.9fr 0.9fr;
      gap: 1rem;
      align-items: center;
    }

    .hero-block {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .hero-block.centered {
      justify-content: center;
    }

    .hero-icon {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      display: grid;
      place-items: center;
      font-size: 2rem;
      color: #f2bf4d;
      background: #fff8e7;
      flex-shrink: 0;
    }

    .hero-title {
      font-size: 1rem;
      font-weight: 700;
      color: #111827;
      margin-bottom: 0.35rem;
      line-height: 1.25;
    }

    .toggle-pill {
      width: 56px;
      height: 28px;
      border-radius: 999px;
      background: #4ea3ea;
      position: relative;
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .toggle-pill::after {
      content: "";
      position: absolute;
      top: 4px;
      right: 4px;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #fff;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12);
    }

    .status-pill-large {
      min-width: 110px;
      text-align: center;
      border-radius: 999px;
      padding: 0.8rem 1.25rem;
      color: #fff;
      font-size: 1.05rem;
      font-weight: 700;
      background: linear-gradient(180deg, #4ea8ee, #2f8ddf);
      box-shadow: 0 8px 18px rgba(59, 130, 246, 0.25);
    }

    .action-btn {
      width: 100%;
      border: 0;
      border-radius: 999px;
      color: #fff;
      font-size: 1rem;
      font-weight: 700;
      padding: 0.9rem 1rem;
      box-shadow: 0 10px 22px rgba(0, 0, 0, 0.12);
    }

    .action-btn.green {
      background: linear-gradient(180deg, #27c9a4, #1db690);
    }

    .action-btn.orange {
      background: linear-gradient(180deg, #ff6b2b, #ff4d10);
    }

    .section-head {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
      margin: 1.85rem 0 1rem;
    }

    .section-title {
      font-size: 1.9rem;
      font-weight: 800;
      margin: 0;
      color: #111827;
    }

    .add-btn {
      border: 0;
      border-radius: 999px;
      background: linear-gradient(180deg, #2ac8a3, #18b48d);
      color: #fff;
      font-weight: 700;
      padding: 0.85rem 1.35rem;
      box-shadow: 0 10px 22px rgba(35, 195, 156, 0.28);
    }

    .schedule-card {
      padding: 0.85rem 0 0;
      border-radius: 24px;
      overflow: hidden;
    }

    .schedule-table {
      margin: 0;
    }

    .schedule-table thead th {
      background: #7e9ea3;
      color: #fff;
      font-size: 0.95rem;
      font-weight: 700;
      border: 0;
      padding: 1.2rem 1.25rem;
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
      padding: 1.25rem 1.25rem;
      border-color: #e9eef0;
      vertical-align: middle;
      font-size: 0.97rem;
      color: #111827;
    }

    .schedule-table tbody tr:last-child td {
      border-bottom: 0;
    }

    .table-wrap {
      padding: 0 0.45rem 0.35rem;
    }

    .action-icons {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 1rem;
      font-size: 1rem;
    }

    .action-icons .edit {
      color: #6b7280;
    }

    .action-icons .delete {
      color: #ff5a1f;
    }

    .pagination-wrap {
      display: flex;
      justify-content: flex-end;
      gap: 0.35rem;
      padding: 0.7rem 1rem 1rem;
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

    @media (max-width: 1200px) {
      .hero-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    @media (max-width: 768px) {
      .content-section {
        padding: 1rem 0.8rem 1.3rem;
      }

      .hero-card {
        padding: 1.2rem;
      }

      .hero-grid {
        grid-template-columns: 1fr;
      }

      .hero-block,
      .hero-block.centered {
        justify-content: flex-start;
      }

      .section-head {
        flex-direction: column;
        align-items: stretch;
      }

      .add-btn {
        width: 100%;
      }

      .schedule-table {
        min-width: 760px;
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
                <button type="button" class="action-btn green">Nyalakan</button>
              </div>

              <div class="hero-block centered">
                <button type="button" class="action-btn orange">Matikan</button>
              </div>
            </div>
          </div>

          <div class="section-head">
            <h2 class="section-title">Jadwal Nyala Lampu</h2>
            <button type="button" class="add-btn">+ Tambah Jadwal</button>
          </div>

          <div class="card-soft schedule-card">
            <div class="table-wrap">
              <div class="table-responsive">
                <table class="table schedule-table align-middle">
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
