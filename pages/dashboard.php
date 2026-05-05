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
                    <div class="value" id="avgSuhu">0&deg;C</div>
                  </div>
                  <div class="mini-stat text-center">
                    <div class="label">Kelembapan Rata-rata</div>
                    <div class="value" id="avgLembap">0%</div>
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
  function generateData(base, fluctuation, length) {
    let data = [];
    for (let i = 0; i < length; i++) {
      let random = (Math.random() - 0.5) * fluctuation;
      data.push((base + random).toFixed(1));
    }
    return data;
  }

  const labels = ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"];

  const suhuData = generateData(30, 3, 7);       // sekitar 28 - 32°C
  const lembapData = generateData(68, 10, 7);    // sekitar 60 - 75%

  const hitungRataRata = data => data.reduce((total, nilai) => total + parseFloat(nilai), 0) / data.length;

  document.getElementById("avgSuhu").innerHTML = hitungRataRata(suhuData).toFixed(1) + "&deg;C";
  document.getElementById("avgLembap").textContent = Math.round(hitungRataRata(lembapData)) + "%";

  const ctx = document.getElementById("farmChart");

  new Chart(ctx, {
    type: "line",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Suhu (°C)",
          data: suhuData,
          borderColor: "#4f6f76",
          backgroundColor: "transparent",
          borderWidth: 3,
          tension: 0.4,
          fill: false,
          yAxisID: "y"
        },
        {
          label: "Kelembapan (%)",
          data: lembapData,
          borderColor: "#5cb6df",
          backgroundColor: "rgba(92, 182, 223, 0.15)",
          borderWidth: 3,
          tension: 0.4,
          fill: true,
          yAxisID: "y1"
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { position: 'top' }
      },
      scales: {
        y: {
          min: 25,
          max: 35,
          ticks: {
            callback: val => val + '°C'
          }
        },
        y1: {
          min: 50,
          max: 80,
          position: 'right',
          grid: { drawOnChartArea: false },
          ticks: {
            callback: val => val + '%'
          }
        }
      }
    }
  });
  function updateWaktu() {
    const now = new Date();

    // JAM
    const jam = now.toLocaleTimeString("id-ID", {
      hour: "2-digit",
      minute: "2-digit",
    });

    // TANGGAL
    const tanggal = now.toLocaleDateString("id-ID", {
      weekday: "long",
      day: "numeric",
      month: "long",
      year: "numeric"
    });

    document.getElementById("jam").textContent = jam;
    document.getElementById("tanggal").textContent = tanggal;
  }

  // update tiap detik
  setInterval(updateWaktu, 1000);

  // jalankan pertama kali
  updateWaktu();
</script>
</body>
</html>
