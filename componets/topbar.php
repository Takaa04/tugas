<?php
$topbarTitle = $topbarTitle ?? 'Dashboard';
$topbarSubtitle = $topbarSubtitle ?? '';
$username = $_SESSION['username'] ?? 'Admin';
?>
<header class="topbar">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
    <div>
      <h1><?= htmlspecialchars($topbarTitle, ENT_QUOTES, 'UTF-8') ?></h1>
      <p><?= htmlspecialchars($topbarSubtitle, ENT_QUOTES, 'UTF-8') ?></p>
    </div>
    <div class="d-flex align-items-center gap-3 ms-md-auto">
      <div class="text-end meta-text">
        <div class="fw-semibold" id="jam"></div>
        <div id="tanggal"></div>
      </div>
      <div class="avatar" title="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>">
        <i class="bi bi-person-fill"></i>
      </div>
    </div>
  </div>
</header>
