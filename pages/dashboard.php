<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$activePage = 'dashboard';
$topbarTitle = 'Selamat datang, ' . ($_SESSION['username'] ?? 'Admin');
$topbarSubtitle = 'Pantau kondisi kandang dan sistem secara real-time';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ChickGuard Dashboard</title>
  <link rel="icon" href="../assets/images/branding/icon.png" type="image/png">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body class="dashboard-page">
  <div class="dashboard-shell d-lg-flex">
    <?php include '../components/sidebar.php'; ?>

    <main class="main-content">
      <?php include '../components/topbar.php'; ?>

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
                  <div class="metric-value" id="currentSuhu">0&deg; C</div>
                  <p class="metric-subtitle" id="suhuStatus">Normal</p>
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
                  <div class="metric-value" id="currentLembap">0%</div>
                  <p class="metric-subtitle" id="lembapStatus">Normal</p>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
              <div class="card-soft metric-card status-card d-flex align-items-center justify-content-center text-center">
                <div class="position-relative z-1">
                  <div class="metric-title">Status Kandang</div>
                  <div class="status-pill">
                    <span class="status-dot"></span>
                    <span id="statusKandang">Normal</span>
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
  <script>
    function generateData(base, fluctuation, length) {
      let data = [];
      for (let i = 0; i < length; i++) {
        let random = (Math.random() - 0.5) * fluctuation;
        data.push(Number((base + random).toFixed(1)));
      }
      return data;
    }

    function clamp(nilai, min, max) {
      return Math.min(max, Math.max(min, nilai));
    }

    function generateNextValue(current, min, max, step) {
      const delta = (Math.random() - 0.5) * step;
      return Number(clamp(current + delta, min, max).toFixed(1));
    }

    const labels = ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"];
    const suhuData = generateData(30, 3, 7);
    const lembapData = generateData(68, 10, 7);
    const hitungRataRata = data => data.reduce((total, nilai) => total + Number(nilai), 0) / data.length;
    const suhuTerakhir = suhuData[suhuData.length - 1];
    const lembapTerakhir = lembapData[lembapData.length - 1];
    const suhuStatus = suhuTerakhir >= 24 && suhuTerakhir <= 30 ? "Normal" : "Perlu Dicek";
    const lembapStatus = lembapTerakhir >= 55 && lembapTerakhir <= 75 ? "Normal" : "Perlu Dicek";
    const statusKandang = suhuStatus === "Normal" && lembapStatus === "Normal" ? "Normal" : "Perlu Dicek";

    document.getElementById("currentSuhu").innerHTML = suhuTerakhir.toFixed(1) + "&deg; C";
    document.getElementById("currentLembap").textContent = Math.round(lembapTerakhir) + "%";
    document.getElementById("suhuStatus").textContent = suhuStatus;
    document.getElementById("lembapStatus").textContent = lembapStatus;
    document.getElementById("statusKandang").textContent = statusKandang;
    document.getElementById("avgSuhu").innerHTML = hitungRataRata(suhuData).toFixed(1) + "&deg;C";
    document.getElementById("avgLembap").textContent = Math.round(hitungRataRata(lembapData)) + "%";

    const ctx = document.getElementById("farmChart");

    new Chart(ctx, {
      type: "line",
      data: {
        labels: labels,
        datasets: [
          {
            label: "Suhu (C)",
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
          legend: { position: "top" }
        },
        scales: {
          y: {
            min: 25,
            max: 35,
            ticks: {
              callback: val => val + " C"
            }
          },
          y1: {
            min: 50,
            max: 80,
            position: "right",
            grid: { drawOnChartArea: false },
            ticks: {
              callback: val => val + "%"
            }
          }
        }
      }
    });

    let currentSuhuLive = suhuTerakhir;
    let currentLembapLive = lembapTerakhir;

    function updateSensorDisplayOnly() {
      currentSuhuLive = generateNextValue(currentSuhuLive, 23, 33, 2.4);
      currentLembapLive = generateNextValue(currentLembapLive, 52, 80, 8);

      document.getElementById("currentSuhu").innerHTML = currentSuhuLive.toFixed(1) + "&deg; C";
      document.getElementById("currentLembap").textContent = Math.round(currentLembapLive) + "%";
    }

    window.setInterval(updateSensorDisplayOnly, 300e0);

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
