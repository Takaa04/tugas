<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include '../config/koneksi.php';
include '../proses/init_tables.php';
include '../proses/filter_log_harian.php';
chickguard_init_tables($koneksi);

$search = $_GET['search'] ?? '';
$page = max(1, (int) ($_GET['page'] ?? 1));
$logData = ambil_log_harian($koneksi, $search, $page);
$rows = $logData['rows'];
$total = $logData['total'];
$limit = $logData['limit'];
$page = $logData['page'];
$totalPages = $logData['total_pages'];
$search = $logData['search'];
$shown = count($rows);
$startData = $total > 0 ? (($page - 1) * $limit) + 1 : 0;
$endData = $total > 0 ? $startData + $shown - 1 : 0;

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function format_number_or_dash($value, string $unit): string
{
    if ($value === null || $value === '') {
        return '-';
    }

    return number_format((float) $value, 1) . ' ' . $unit;
}

function log_page_url(int $page, string $search): string
{
    $params = ['page' => $page];
    if ($search !== '') {
        $params['search'] = $search;
    }

    return 'log_harian.php?' . http_build_query($params);
}

$activePage = 'log_harian';
$topbarTitle = 'Log Harian';
$topbarSubtitle = 'Tinjau riwayat suhu, kelembaban, pakan, minum, dan status lampu kandang';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChickGuard - Log Harian</title>
  <link rel="icon" href="../assets/icon.png" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="page-log-harian">
  <div class="dashboard-shell d-lg-flex">
    <?php include '../componets/sidebar.php'; ?>

    <main class="main-content">
      <?php include '../componets/topbar.php'; ?>

      <section class="content-section">
        <div class="container-fluid px-0">
          <div class="card-soft log-card">
            <div class="log-toolbar">
              <div>
                <h2 class="log-title">Log Harian Kandang</h2>
                <p class="log-subtitle">Data pencatatan harian suhu, kelembaban, pakan, minum & lampu</p>
              </div>

              <form class="toolbar-actions" method="get" action="log_harian.php">
                <div class="search-box">
                  <i class="bi bi-search"></i>
                  <input type="text" name="search" class="search-input" value="<?= e($search) ?>" placeholder="Cari waktu, status, lampu...">
                </div>

                <button type="submit" class="btn btn-sm btn-info text-white fw-semibold">Cari</button>
                <?php if ($search !== ''): ?>
                  <a href="log_harian.php" class="btn btn-sm btn-light fw-semibold">Reset</a>
                <?php endif; ?>
              </form>
            </div>

            <div class="table-wrap">
              <div class="table-responsive">
                <table class="table data-table log-table align-middle">
                  <thead>
                    <tr>
                      <th class="check-col"><span class="fake-check"></span></th>
                      <th>Waktu</th>
                      <th>Suhu (&deg;C)</th>
                      <th>Kelembaban (%)</th>
                      <th>Pakan (kg)</th>
                      <th>Minum (L)</th>
                      <th class="text-center">Lampu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($shown === 0): ?>
                      <tr>
                        <td colspan="7" class="text-center text-muted py-4">Data log tidak ditemukan.</td>
                      </tr>
                    <?php endif; ?>

                    <?php foreach ($rows as $item): ?>
                      <?php $lampuClass = $item['lampu'] === 'Hidup' ? 'on' : 'off'; ?>
                      <tr>
                        <td class="check-col"><span class="fake-check"></span></td>
                        <td><?= e(date('H:i', strtotime($item['waktu']))) ?></td>
                        <td class="cell-strong"><?= e(number_format((float) $item['suhu'], 0)) ?>&deg;C</td>
                        <td class="cell-strong"><?= e(number_format((float) $item['kelembaban'], 0)) ?>%</td>
                        <td><?= e(format_number_or_dash($item['pakan'], 'kg')) ?></td>
                        <td><?= e(format_number_or_dash($item['minum'], 'L')) ?></td>
                        <td class="text-center"><span class="lamp-badge <?= e($lampuClass) ?>"><?= e($item['lampu']) ?></span></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="table-footer">
              <div class="footer-left">
                <span>Menampilkan <strong><?= e($startData) ?> - <?= e($endData) ?></strong> dari <strong><?= e($total) ?></strong> entri</span>
              </div>

              <div class="pagination-wrap">
                <a class="page-chip <?= $page <= 1 ? 'muted' : '' ?>" href="<?= e(log_page_url(1, $search)) ?>">&laquo;</a>
                <a class="page-chip <?= $page <= 1 ? 'muted' : '' ?>" href="<?= e(log_page_url(max(1, $page - 1), $search)) ?>">&lsaquo;</a>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                  <a class="page-chip <?= $page === $i ? 'active' : '' ?>" href="<?= e(log_page_url($i, $search)) ?>"><?= e($i) ?></a>
                <?php endfor; ?>
                <a class="page-chip <?= $page >= $totalPages ? 'muted' : '' ?>" href="<?= e(log_page_url(min($totalPages, $page + 1), $search)) ?>">&rsaquo;</a>
                <a class="page-chip <?= $page >= $totalPages ? 'muted' : '' ?>" href="<?= e(log_page_url($totalPages, $search)) ?>">&raquo;</a>
              </div>
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
      document.getElementById("jam").textContent = now.toLocaleTimeString("id-ID", { hour: "2-digit", minute: "2-digit" });
      document.getElementById("tanggal").textContent = now.toLocaleDateString("id-ID", { weekday: "long", day: "numeric", month: "long", year: "numeric" });
    }

    setInterval(updateWaktu, 1000);
    updateWaktu();
  </script>
</body>
</html>
