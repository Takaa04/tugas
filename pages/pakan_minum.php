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
            <div class="row align-items-center g-4 status-overview-grid">
              <div class="col-12 col-lg-3 status-grid-item supply-panel-item">
                <div class="supply-group">
                  <div class="supply-icon feed">
                    <i class="fa-solid fa-bowl-food"></i>
                  </div>
                  <div class="supply-body">
                    <div class="supply-title">Pakan</div>
                    <div class="supply-value" id="feedPercent">75%</div>
                    <div class="supply-stock-text" id="feedStockText">15.0 / 20.0 kg</div>
                    <div class="progress-slim">
                      <div class="progress-bar bg-success" id="feedProgressBar" style="width: 75%"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-auto d-none d-lg-flex status-grid-item divider-item">
                <div class="overview-divider"></div>
              </div>

              <div class="col-12 col-lg-3 status-grid-item supply-panel-item">
                <div class="supply-group">
                  <div class="supply-icon water">
                    <i class="bi bi-droplet-fill"></i>
                  </div>
                  <div class="supply-body">
                    <div class="supply-title">Air</div>
                    <div class="supply-value" id="waterPercent">60%</div>
                    <div class="supply-stock-text" id="waterStockText">12.0 / 20.0 L</div>
                    <div class="progress-slim">
                      <div class="progress-bar bg-info" id="waterProgressBar" style="width: 60%"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-6 col-lg-3 status-grid-item action-slot">
                <div class="d-flex justify-content-center">
                  <button type="button" class="pill-button action-btn feed" id="feedActionBtn">Beri Pakan</button>
                </div>
              </div>

              <div class="col-12 col-md-6 col-lg-3 status-grid-item action-slot">
                <div class="d-flex justify-content-center">
                  <button type="button" class="pill-button action-btn water" id="waterActionBtn">Beri Minum</button>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
            <h2 class="section-title">Jadwal Pemberian</h2>
            <button type="button" class="pill-button add-btn js-open-schedule-modal">+ Tambah Jadwal</button>
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
                    <th>Catatan</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Pakan</td>
                    <td>06:00</td>
                    <td>3.0 kg</td>
                    <td>Senin, Rabu, Jumat</td>
                    <td>Pakan pagi untuk awal aktivitas</td>
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
                    <td>Isi air minum setelah pakan pagi</td>
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
                    <td>Tambahan pakan siang secukupnya</td>
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
                    <td>Pengecekan dan isi ulang wadah air</td>
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
                    <td>Pakan malam untuk akhir pekan</td>
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

  <div class="schedule-modal-backdrop hidden" id="scheduleModal" aria-hidden="true">
    <div class="schedule-modal-card" role="dialog" aria-modal="true" aria-labelledby="scheduleModalTitle">
      <form class="schedule-form">
        <div class="schedule-modal-head">
          <div class="schedule-modal-icon" id="scheduleTypeIcon">
            <i class="fa-solid fa-bowl-food"></i>
          </div>
          <div>
            <h2 id="scheduleModalTitle">Tambah Jadwal</h2>
            <p id="scheduleModalSubtitle">Atur jadwal pemberian pakan dan minum</p>
          </div>
        </div>

        <div class="schedule-group">
          <div class="schedule-group-title">Jenis</div>
          <div class="schedule-type-switch">
            <button type="button" class="schedule-type-btn active" data-type="Pakan">Pakan</button>
            <button type="button" class="schedule-type-btn" data-type="Minum">Minum</button>
          </div>
        </div>

        <div class="schedule-fields-grid">
          <label class="schedule-field">
            <span class="schedule-field-label"><i class="bi bi-clock"></i> Waktu Pemberian</span>
            <input type="time" value="08:00">
          </label>

          <div class="schedule-field">
            <span class="schedule-field-label"><i class="bi bi-sliders"></i> Jumlah</span>
            <div class="schedule-amount-wrap">
              <input type="number" min="0" step="0.1">
              <span class="schedule-unit" id="scheduleUnit">Kg</span>
            </div>
          </div>
        </div>

        <div class="schedule-group">
          <span class="schedule-field-label"><i class="bi bi-calendar3"></i> Pilih Hari</span>
          <div class="schedule-days">
            <label class="schedule-day"><input type="checkbox"><span>Senin</span></label>
            <label class="schedule-day"><input type="checkbox"><span>Selasa</span></label>
            <label class="schedule-day"><input type="checkbox"><span>Rabu</span></label>
            <label class="schedule-day"><input type="checkbox"><span>Kamis</span></label>
            <label class="schedule-day"><input type="checkbox"><span>Jumat</span></label>
            <label class="schedule-day"><input type="checkbox"><span>Sabtu</span></label>
            <label class="schedule-day"><input type="checkbox"><span>Minggu</span></label>
          </div>
          <button type="button" class="schedule-reset-btn" id="scheduleResetBtn">
            <i class="bi bi-arrow-repeat"></i>
            <span>Reset</span>
          </button>
        </div>

        <label class="schedule-field schedule-note-field">
          <span class="schedule-field-label"><i class="bi bi-check-circle"></i> Catatan (Opsional)</span>
          <input type="text" placeholder="Contoh: Pagi Hari">
        </label>

        <div class="schedule-actions">
          <button type="button" class="schedule-btn secondary" id="closeScheduleModal">Batal</button>
          <button type="submit" class="schedule-btn primary">
            <i class="bi bi-calendar-check"></i>
            <span>Simpan</span>
          </button>
        </div>
      </form>
    </div>
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

    const scheduleModal = document.getElementById("scheduleModal");
    const openScheduleModalBtn = document.querySelector(".js-open-schedule-modal");
    const closeScheduleModalBtn = document.getElementById("closeScheduleModal");
    const scheduleResetBtn = document.getElementById("scheduleResetBtn");
    const scheduleTypeButtons = document.querySelectorAll(".schedule-type-btn");
    const scheduleTypeIcon = document.getElementById("scheduleTypeIcon");
    const scheduleModalSubtitle = document.getElementById("scheduleModalSubtitle");
    const scheduleUnit = document.getElementById("scheduleUnit");
    const scheduleCheckboxes = document.querySelectorAll(".schedule-day input");
    const feedPercent = document.getElementById("feedPercent");
    const waterPercent = document.getElementById("waterPercent");
    const feedStockText = document.getElementById("feedStockText");
    const waterStockText = document.getElementById("waterStockText");
    const feedProgressBar = document.getElementById("feedProgressBar");
    const waterProgressBar = document.getElementById("waterProgressBar");
    const feedActionBtn = document.getElementById("feedActionBtn");
    const waterActionBtn = document.getElementById("waterActionBtn");

    const stockState = {
      feed: {
        current: 15.0,
        max: 20.0,
        step: 1.0,
        unit: "kg",
        percentEl: feedPercent,
        stockEl: feedStockText,
        progressEl: feedProgressBar,
      },
      water: {
        current: 12.0,
        max: 20.0,
        step: 0.8,
        unit: "L",
        percentEl: waterPercent,
        stockEl: waterStockText,
        progressEl: waterProgressBar,
      }
    };

    function renderStock(type) {
      const stock = stockState[type];
      const percent = Math.max(0, (stock.current / stock.max) * 100);

      stock.percentEl.textContent = `${Math.round(percent)}%`;
      stock.stockEl.textContent = `${stock.current.toFixed(1)} / ${stock.max.toFixed(1)} ${stock.unit}`;
      stock.progressEl.style.width = `${percent}%`;
      stock.progressEl.setAttribute("aria-valuenow", Math.round(percent));
    }

    function useStock(type) {
      const stock = stockState[type];
      stock.current = Math.max(0, stock.current - stock.step);
      renderStock(type);
    }

    function setScheduleType(type) {
      const isPakan = type === "Pakan";

      scheduleTypeButtons.forEach((button) => {
        button.classList.toggle("active", button.dataset.type === type);
      });

      scheduleModal.classList.toggle("is-minum", !isPakan);
      scheduleTypeIcon.innerHTML = isPakan
        ? '<i class="fa-solid fa-bowl-food"></i>'
        : '<i class="bi bi-droplet-fill"></i>';
      scheduleUnit.textContent = isPakan ? "Kg" : "L";
      scheduleModalSubtitle.textContent = isPakan
        ? "Atur jadwal pemberian pakan dan minum"
        : "Atur ulang jadwal pemberian pakan dan minum";
    }

    function openScheduleModal() {
      scheduleModal.classList.remove("hidden");
      document.body.classList.add("modal-open");
      scheduleModal.setAttribute("aria-hidden", "false");
    }

    function closeScheduleModal() {
      scheduleModal.classList.add("hidden");
      document.body.classList.remove("modal-open");
      scheduleModal.setAttribute("aria-hidden", "true");
    }

    openScheduleModalBtn.addEventListener("click", openScheduleModal);
    closeScheduleModalBtn.addEventListener("click", closeScheduleModal);

    scheduleModal.addEventListener("click", (event) => {
      if (event.target === scheduleModal) {
        closeScheduleModal();
      }
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape" && !scheduleModal.classList.contains("hidden")) {
        closeScheduleModal();
      }
    });

    scheduleTypeButtons.forEach((button) => {
      button.addEventListener("click", () => {
        setScheduleType(button.dataset.type);
      });
    });

    scheduleResetBtn.addEventListener("click", () => {
      scheduleCheckboxes.forEach((checkbox) => {
        checkbox.checked = false;
      });
    });

    feedActionBtn.addEventListener("click", () => {
      useStock("feed");
    });

    waterActionBtn.addEventListener("click", () => {
      useStock("water");
    });

    renderStock("feed");
    renderStock("water");
  </script>
</body>
</html>
