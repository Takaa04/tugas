<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChickGuard - Pakan Minum</title>

  <link href="../assets/vendor/poppins/poppins.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/vendor/fontawesome/all.min.css">

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
              <a class="nav-link" href="pencahayaan.php">
                <i class="bi bi-lightbulb-fill"></i>
                <span>Pencahayaan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="log_harian.php">
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

    <main class="main-content">
      <header class="topbar">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
          <div>
            <h1>Selamat datang, Admin</h1>
            <p>Pantau kondisi kandang dan sistem secara real-time</p>
          </div>
          <div class="d-flex align-items-center gap-3 ms-md-auto">
            <div class="text-end meta-text">
              <div class="fw-semibold" id="jam"></div>
              <div id="tanggal"></div>
            </div>
            <div class="avatar">
              <i class="bi bi-person-fill"></i>
            </div>
          </div>
        </div>
      </header>

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

  <script src="../assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>
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
