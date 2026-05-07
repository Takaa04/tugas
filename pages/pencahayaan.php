<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include '../config/koneksi.php';
include '../proses/init_tables.php';
chickguard_init_tables($koneksi);

$limit = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$countResult = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM jadwal_pencahayaan");
$totalData = (int) (mysqli_fetch_assoc($countResult)['total'] ?? 0);
$totalPages = max(1, (int) ceil($totalData / $limit));
if ($page > $totalPages) {
    $page = $totalPages;
}
$offset = ($page - 1) * $limit;

$stmt = mysqli_prepare($koneksi, "SELECT * FROM jadwal_pencahayaan ORDER BY waktu ASC, id ASC LIMIT ? OFFSET ?");
mysqli_stmt_bind_param($stmt, "ii", $limit, $offset);
mysqli_stmt_execute($stmt);
$query = mysqli_stmt_get_result($stmt);
$jadwal = [];
while ($row = mysqli_fetch_assoc($query)) {
    $jadwal[] = $row;
}
$startData = $totalData > 0 ? $offset + 1 : 0;
$endData = $totalData > 0 ? $offset + count($jadwal) : 0;

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$statusMessages = [
    'created' => 'Jadwal lampu berhasil ditambahkan.',
    'updated' => 'Jadwal lampu berhasil diperbarui.',
    'deleted' => 'Jadwal lampu berhasil dihapus.',
    'invalid' => 'Data belum lengkap. Periksa kembali form jadwal.',
];

$activePage = 'pencahayaan';
$topbarTitle = 'Selamat datang, ' . ($_SESSION['username'] ?? 'Admin');
$topbarSubtitle = 'Pantau kondisi kandang dan sistem secara real-time';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChickGuard - Pencahayaan</title>
  <link rel="icon" href="../assets/icon.png" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="page-pencahayaan">
  <div class="dashboard-shell d-lg-flex">
    <?php include '../componets/sidebar.php'; ?>

    <main class="main-content">
      <?php include '../componets/topbar.php'; ?>

      <section class="content-section">
        <div class="container-fluid px-0">
          <?php if (isset($_GET['status'], $statusMessages[$_GET['status']])): ?>
            <div class="alert alert-<?= $_GET['status'] === 'invalid' ? 'warning' : 'success' ?> mb-3">
              <?= e($statusMessages[$_GET['status']]) ?>
            </div>
          <?php endif; ?>

          <div class="card-soft hero-card">
            <div class="hero-grid">
              <div class="hero-block centered">
                <div>
                  <div class="hero-title text-center">Mode Lampu<br>otomatis</div>
                  <button type="button" class="toggle-pill mx-auto is-on" id="autoLampToggle" aria-label="Matikan mode lampu otomatis" aria-pressed="true"></button>
                </div>
              </div>

              <div class="hero-block centered">
                <div class="hero-icon is-on" id="lampIcon"><i class="bi bi-lightbulb-fill"></i></div>
                <div>
                  <div class="hero-title">Status Lampu</div>
                  <div class="status-pill-large is-on" id="lampStatus">Nyala</div>
                </div>
              </div>

              <div class="hero-block centered">
                <button type="button" class="pill-button action-btn green" id="turnOnLamp">Nyalakan</button>
              </div>

              <div class="hero-block centered">
                <button type="button" class="pill-button action-btn orange" id="turnOffLamp">Matikan</button>
              </div>
            </div>
          </div>

          <div class="section-head">
            <h2 class="page-title">Jadwal Nyala Lampu</h2>
            <button type="button" class="pill-button add-btn js-open-light-modal">+ Tambah Jadwal</button>
          </div>

          <div class="card-soft table-card schedule-card">
            <div class="table-shell table-wrap">
              <div class="table-responsive">
                <table class="table data-table schedule-table align-middle">
                  <thead>
                    <tr>
                      <th>Jenis</th>
                      <th>Waktu</th>
                      <th>Durasi</th>
                      <th>Hari</th>
                      <th>Catatan</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (count($jadwal) === 0): ?>
                      <tr><td colspan="6" class="text-center text-muted py-4">Belum ada jadwal lampu.</td></tr>
                    <?php endif; ?>

                    <?php foreach ($jadwal as $item): ?>
                      <tr>
                        <td><?= e($item['jenis']) ?></td>
                        <td><?= e(date('H:i', strtotime($item['waktu']))) ?></td>
                        <td><?= e(number_format((float) $item['durasi'], 1)) ?> Jam</td>
                        <td><?= e($item['hari']) ?></td>
                        <td><?= e($item['catatan']) ?></td>
                        <td>
                          <div class="action-icons">
                            <i class="bi bi-pencil-square edit js-edit-light"
                               data-id="<?= e($item['id']) ?>"
                               data-jenis="<?= e($item['jenis']) ?>"
                               data-waktu="<?= e(date('H:i', strtotime($item['waktu']))) ?>"
                               data-durasi="<?= e($item['durasi']) ?>"
                               data-hari="<?= e($item['hari']) ?>"
                               data-catatan="<?= e($item['catatan']) ?>"></i>
                            <a href="../proses/proses_pencahayaan.php?action=delete&id=<?= e($item['id']) ?>" onclick="return confirm('Hapus jadwal lampu ini?')">
                              <i class="bi bi-trash3 delete"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="table-footer">
              <div class="footer-left">
                <i class="bi bi-trash3-fill trash-mini"></i>
                <span>Menampilkan <strong><?= e($startData) ?> - <?= e($endData) ?></strong> dari <strong><?= e($totalData) ?></strong> entri</span>
              </div>

              <div class="pagination-wrap">
                <a class="page-chip <?= $page <= 1 ? 'muted' : '' ?>" href="?page=1">&laquo;</a>
                <a class="page-chip <?= $page <= 1 ? 'muted' : '' ?>" href="?page=<?= e(max(1, $page - 1)) ?>">&lsaquo;</a>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                  <a class="page-chip <?= $page === $i ? 'active' : '' ?>" href="?page=<?= e($i) ?>"><?= e($i) ?></a>
                <?php endfor; ?>
                <a class="page-chip <?= $page >= $totalPages ? 'muted' : '' ?>" href="?page=<?= e(min($totalPages, $page + 1)) ?>">&rsaquo;</a>
                <a class="page-chip <?= $page >= $totalPages ? 'muted' : '' ?>" href="?page=<?= e($totalPages) ?>">&raquo;</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>

  <div class="schedule-modal-backdrop hidden is-minum" id="lightModal" aria-hidden="true">
    <div class="schedule-modal-card" role="dialog" aria-modal="true" aria-labelledby="lightModalTitle">
      <form class="schedule-form" method="post" action="../proses/proses_pencahayaan.php">
        <input type="hidden" name="action" id="lightFormAction" value="create">
        <input type="hidden" name="id" id="lightId">

        <div class="schedule-modal-head">
          <div class="schedule-modal-icon"><i class="bi bi-lightbulb-fill"></i></div>
          <div>
            <h2 id="lightModalTitle">Tambah Jadwal Lampu</h2>
            <p>Atur waktu dan durasi pencahayaan kandang</p>
          </div>
        </div>

        <div class="schedule-fields-grid">
          <label class="schedule-field">
            <span class="schedule-field-label"><i class="bi bi-lightbulb"></i> Jenis Lampu</span>
            <input type="text" name="jenis" id="lightJenis" placeholder="Contoh: Lampu Utama" required>
          </label>

          <label class="schedule-field">
            <span class="schedule-field-label"><i class="bi bi-clock"></i> Waktu Nyala</span>
            <input type="time" name="waktu" id="lightWaktu" value="08:00" required>
          </label>
        </div>

        <div class="schedule-fields-grid">
          <div class="schedule-field">
            <span class="schedule-field-label"><i class="bi bi-hourglass-split"></i> Durasi</span>
            <div class="schedule-amount-wrap">
              <input type="number" name="durasi" id="lightDurasi" min="0.1" step="0.1" required>
              <span class="schedule-unit">Jam</span>
            </div>
          </div>
        </div>

        <div class="schedule-group">
          <span class="schedule-field-label"><i class="bi bi-calendar3"></i> Pilih Hari</span>
          <div class="schedule-days">
            <?php foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day): ?>
              <label class="schedule-day"><input type="checkbox" name="hari[]" value="<?= e($day) ?>"><span><?= e($day) ?></span></label>
            <?php endforeach; ?>
            <label class="schedule-day"><input type="checkbox" name="hari[]" value="Semua Hari"><span>Semua Hari</span></label>
          </div>
          <button type="button" class="schedule-reset-btn" id="lightResetBtn"><i class="bi bi-arrow-repeat"></i><span>Reset</span></button>
        </div>

        <label class="schedule-field schedule-note-field">
          <span class="schedule-field-label"><i class="bi bi-check-circle"></i> Catatan (Opsional)</span>
          <input type="text" name="catatan" id="lightCatatan" placeholder="Contoh: Pencahayaan pagi">
        </label>

        <div class="schedule-actions">
          <button type="button" class="schedule-btn secondary" id="closeLightModal">Batal</button>
          <button type="submit" class="schedule-btn primary"><i class="bi bi-calendar-check"></i><span>Simpan</span></button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function updateWaktu() {
      const now = new Date();
      document.getElementById("jam").textContent = now.toLocaleTimeString("id-ID", { hour: "2-digit", minute: "2-digit" });
      document.getElementById("tanggal").textContent = now.toLocaleDateString("id-ID", { weekday: "long", day: "numeric", month: "long", year: "numeric" });
    }

    setInterval(updateWaktu, 1000);
    updateWaktu();

    const lampStatus = document.getElementById("lampStatus");
    const lampIcon = document.getElementById("lampIcon");
    const autoLampToggle = document.getElementById("autoLampToggle");
    const turnOnLamp = document.getElementById("turnOnLamp");
    const turnOffLamp = document.getElementById("turnOffLamp");
    let isLampOn = true;
    let isAutoMode = true;

    function renderLampState() {
      lampStatus.textContent = isLampOn ? "Nyala" : "Mati";
      lampStatus.classList.toggle("is-on", isLampOn);
      lampStatus.classList.toggle("is-off", !isLampOn);

      lampIcon.classList.toggle("is-on", isLampOn);
      lampIcon.classList.toggle("is-off", !isLampOn);
      lampIcon.innerHTML = isLampOn ? '<i class="bi bi-lightbulb-fill"></i>' : '<i class="bi bi-lightbulb"></i>';

      autoLampToggle.classList.toggle("is-on", isAutoMode);
      autoLampToggle.setAttribute("aria-pressed", isAutoMode ? "true" : "false");
      autoLampToggle.setAttribute("aria-label", isAutoMode ? "Matikan mode lampu otomatis" : "Nyalakan mode lampu otomatis");

      turnOnLamp.classList.toggle("is-active", isLampOn);
      turnOffLamp.classList.toggle("is-active", !isLampOn);
    }

    turnOnLamp.addEventListener("click", () => {
      isLampOn = true;
      isAutoMode = false;
      renderLampState();
    });

    turnOffLamp.addEventListener("click", () => {
      isLampOn = false;
      isAutoMode = false;
      renderLampState();
    });

    autoLampToggle.addEventListener("click", () => {
      isAutoMode = !isAutoMode;
      if (isAutoMode) {
        isLampOn = true;
      }
      renderLampState();
    });

    renderLampState();

    const lightModal = document.getElementById("lightModal");
    const lightFormAction = document.getElementById("lightFormAction");
    const lightId = document.getElementById("lightId");
    const lightJenis = document.getElementById("lightJenis");
    const lightWaktu = document.getElementById("lightWaktu");
    const lightDurasi = document.getElementById("lightDurasi");
    const lightCatatan = document.getElementById("lightCatatan");
    const lightModalTitle = document.getElementById("lightModalTitle");
    const lightCheckboxes = lightModal.querySelectorAll(".schedule-day input");

    function clearLightForm() {
      lightFormAction.value = "create";
      lightId.value = "";
      lightJenis.value = "";
      lightWaktu.value = "08:00";
      lightDurasi.value = "";
      lightCatatan.value = "";
      lightModalTitle.textContent = "Tambah Jadwal Lampu";
      lightCheckboxes.forEach((checkbox) => checkbox.checked = false);
    }

    function openLightModal() {
      lightModal.classList.remove("hidden");
      lightModal.setAttribute("aria-hidden", "false");
      document.body.classList.add("modal-open");
    }

    function closeLightModal() {
      lightModal.classList.add("hidden");
      lightModal.setAttribute("aria-hidden", "true");
      document.body.classList.remove("modal-open");
    }

    document.querySelector(".js-open-light-modal").addEventListener("click", () => {
      clearLightForm();
      openLightModal();
    });
    document.getElementById("closeLightModal").addEventListener("click", closeLightModal);
    document.getElementById("lightResetBtn").addEventListener("click", () => lightCheckboxes.forEach((checkbox) => checkbox.checked = false));
    lightModal.addEventListener("click", (event) => { if (event.target === lightModal) closeLightModal(); });
    document.addEventListener("keydown", (event) => { if (event.key === "Escape" && !lightModal.classList.contains("hidden")) closeLightModal(); });

    document.querySelectorAll(".js-edit-light").forEach((button) => {
      button.addEventListener("click", () => {
        lightFormAction.value = "update";
        lightId.value = button.dataset.id;
        lightJenis.value = button.dataset.jenis;
        lightWaktu.value = button.dataset.waktu;
        lightDurasi.value = button.dataset.durasi;
        lightCatatan.value = button.dataset.catatan;
        lightModalTitle.textContent = "Edit Jadwal Lampu";
        const days = button.dataset.hari.split(",").map((day) => day.trim());
        lightCheckboxes.forEach((checkbox) => checkbox.checked = days.includes(checkbox.value));
        openLightModal();
      });
    });
  </script>
</body>
</html>
