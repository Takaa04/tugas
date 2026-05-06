<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChickGuard - Pencahayaan</title>

  <link href="../assets/vendor/poppins/poppins.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/vendor/fontawesome/all.min.css">
  <link rel="stylesheet" href="../assets/pencahayaan.css">
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
              <a class="nav-link" href="pakan_minum.php">
                <i class="fa-solid fa-bowl-food"></i>
                <span>Pakan Minum</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="pencahayaan.php">
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
          <div class="card-soft lamp-status mb-4">
            <div class="row align-items-center g-4">
              <div class="col-12 col-lg-3">
                <div class="mode-box">
                  <div class="mode-title">Mode Lampu<br>otomatis</div>
                  <label class="switch" aria-label="Mode lampu otomatis">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                  </label>
                </div>
              </div>

              <div class="col-12 col-lg-4">
                <div class="status-group">
                  <div class="lamp-icon">
                    <i class="bi bi-lightbulb"></i>
                  </div>
                  <div>
                    <div class="status-title">Status Lampu</div>
                    <div class="status-pill">Nyala</div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-lg">
                <div class="d-flex flex-column flex-sm-row justify-content-lg-end gap-3">
                  <button type="button" class="control-btn on">Nyalakan</button>
                  <button type="button" class="control-btn off">Matikan</button>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
            <h2 class="section-title">Jadwal Nyala Lampu</h2>
            <button type="button" class="add-btn">+ Tambah Jadwal</button>
          </div>

          <div class="schedule-frame">
            <div class="table-responsive">
              <table class="table schedule-table align-middle">
                <thead>
                  <tr>
                    <th>Mode</th>
                    <th>Waktu</th>
                    <th>Durasi<br>Nyala</th>
                    <th>Hari</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Pagi</td>
                    <td>05:30</td>
                    <td>2 jam</td>
                    <td>Setiap Hari</td>
                    <td>
                      <div class="action-icons justify-content-center">
                        <i class="bi bi-pencil-square edit"></i>
                        <i class="bi bi-trash3 delete"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Siang</td>
                    <td>12:00</td>
                    <td>1 jam</td>
                    <td>Senin, Rabu, Jumat</td>
                    <td>
                      <div class="action-icons justify-content-center">
                        <i class="bi bi-pencil-square edit"></i>
                        <i class="bi bi-trash3 delete"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Sore</td>
                    <td>17:30</td>
                    <td>3 jam</td>
                    <td>Setiap Hari</td>
                    <td>
                      <div class="action-icons justify-content-center">
                        <i class="bi bi-pencil-square edit"></i>
                        <i class="bi bi-trash3 delete"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Malam</td>
                    <td>21:00</td>
                    <td>4 jam</td>
                    <td>Selasa, Kamis</td>
                    <td>
                      <div class="action-icons justify-content-center">
                        <i class="bi bi-pencil-square edit"></i>
                        <i class="bi bi-trash3 delete"></i>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Redup</td>
                    <td>02:00</td>
                    <td>1.5 jam</td>
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

            <div class="pagination-wrap">
              <button type="button" class="page-btn disabled" aria-label="Halaman sebelumnya dua kali">&laquo;</button>
              <button type="button" class="page-btn disabled" aria-label="Halaman sebelumnya">&lsaquo;</button>
              <button type="button" class="page-btn active">1</button>
              <button type="button" class="page-btn">2</button>
              <button type="button" class="page-btn">3</button>
              <button type="button" class="page-btn" aria-label="Halaman berikutnya">&rsaquo;</button>
              <button type="button" class="page-btn" aria-label="Halaman berikutnya dua kali">&raquo;</button>
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
