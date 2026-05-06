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
  <link rel="icon" href="../assets/icon.png" type="image/png">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="page-pakan-minum">
  <div class="dashboard-shell d-lg-flex">
    <?php include '../componets/sidebar.php'; ?>
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
                  <button type="button" class="pill-button action-btn feed">Beri Pakan</button>
                  <button type="button" class="pill-button action-btn water">Beri Minum</button>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
            <h2 class="section-title">Jadwal Pemberian</h2>
            <button type="button" class="pill-button add-btn">+ Tambah Jadwal</button>
          </div>

          <div class="card-soft table-card schedule-card">
            <div class="table-responsive">
              <table class="table data-table schedule-table align-middle">
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
