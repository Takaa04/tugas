<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChickGuard Dashboard</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- CSS EKSTERNAL -->
  <link rel="stylesheet" href="../assets/dashboard.css">
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
              <a class="nav-link active" href="index.html">
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
            <a class="nav-link" href="#">
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
            <h1>Selamat datang, Admin 👋</h1>
            <p>Pantau kondisi kandang dan sistem secara real-time</p>
          </div>
          <div class="d-flex align-items-center gap-3 ms-md-auto">
            <div class="text-end meta-text">
              <div class="fw-semibold">07:45</div>
              <div>Selasa, 21 April 2026</div>
            </div>
            <div class="avatar">
              <i class="bi bi-person-fill"></i>
            </div>
          </div>
        </div>
      </header>

      <section class="content-section">
        <div class="container-fluid px-0">
          <div class="row g-4 mb-4">

            <div class="col-12 col-md-6 col-xl-4">
              <div class="card-soft metric-card metric-card-centered d-flex align-items-center">
                <div class="metric-icon">
                  <i class="bi bi-thermometer-half"></i>
                </div>
                <div class="metric-body">
                  <div class="metric-title">Suhu Kandang</div>
                  <div class="metric-value">28.5&deg; C</div>
                  <p class="metric-subtitle">Normal</p>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
              <div class="card-soft metric-card metric-card-centered d-flex align-items-center">
                <div class="metric-icon water">
                  <i class="bi bi-droplet-fill"></i>
                </div>
                <div class="metric-body">
                  <div class="metric-title">Kelembapan</div>
                  <div class="metric-value">40%</div>
                  <p class="metric-subtitle">Normal</p>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
              <div class="card-soft metric-card status-card d-flex align-items-center justify-content-center text-center">
                <div class="position-relative z-1">
                  <div class="metric-title">Status Kandang</div>
                  <div class="status-pill">
                    <span class="status-dot"></span>
                    <span>Normal</span>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-12">
              <div class="card-soft chart-card">
                <h2>Grafik Suhu dan Kelembapan Kandang</h2>
                <p>Monitoring mingguan kondisi kandang</p>

                <div class="chart-wrap">
                  <canvas id="farmChart"></canvas>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-center gap-4 mt-4">
                  <div class="mini-stat text-center">
                    <div class="label">Suhu Rata-rata</div>
                    <div class="value">28.9&deg;C</div>
                  </div>
                  <div class="mini-stat text-center">
                    <div class="label">Kelembapan Rata-rata</div>
                    <div class="value">67%</div>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>
      </section>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

  <!-- JS tetap sama -->
  <script>
    const ctx = document.getElementById("farmChart");

    new Chart(ctx, {
      type: "line",
      data: {
        labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"],
        datasets: [
          {
            label: "Suhu (\u00B0C)",
            data: [31.0, 31.4, 30.5, 31.2, 32.1, 31.7, 30.9],
            borderColor: "#4f6f76",
            backgroundColor: "transparent",
            borderWidth: 3,
            pointRadius: 0,
            tension: 0.35,
            yAxisID: "y"
          },
          {
            label: "Kelembapan (%)",
            data: [66, 69, 62, 71, 73, 69, 67],
            borderColor: "#5cb6df",
            backgroundColor: "rgba(92, 182, 223, 0.18)",
            fill: true,
            borderWidth: 3,
            pointRadius: 0,
            tension: 0.35,
            yAxisID: "y1"
          }
        ]
      },
      options: { responsive: true }
    });
  </script>
</body>
</html>