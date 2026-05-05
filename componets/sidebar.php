<?php
$activePage = $activePage ?? '';

$menuItems = [
    [
        'key' => 'dashboard',
        'href' => 'dashboard.php',
        'icon' => '<i class="bi bi-house-fill"></i>',
        'label' => 'Dashboard',
    ],
    [
        'key' => 'pakan_minum',
        'href' => 'pakan_minum.php',
        'icon' => '<i class="fa-solid fa-bowl-food"></i>',
        'label' => 'Pakan Minum',
    ],
    [
        'key' => 'pencahayaan',
        'href' => 'pencahayaan.php',
        'icon' => '<i class="bi bi-lightbulb-fill"></i>',
        'label' => 'Pencahayaan',
    ],
    [
        'key' => 'log_harian',
        'href' => 'log_harian.php',
        'icon' => '<i class="fa-solid fa-note-sticky"></i>',
        'label' => 'Log Harian',
    ],
];
?>
<aside class="sidebar">
  <div class="sidebar-panel">
    <div class="brand-wrap">
      <img src="../assets/logo.png" alt="ChickGuard" class="brand-image">
    </div>

    <div class="sidebar-nav-wrap">
      <ul class="nav nav-pills flex-column gap-2 sidebar-menu">
        <?php foreach ($menuItems as $item): ?>
          <li class="nav-item">
            <a class="nav-link <?= $activePage === $item['key'] ? 'active' : '' ?>" href="<?= htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8') ?>">
              <?= $item['icon'] ?>
              <span><?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') ?></span>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>

      <div class="sidebar-logout">
        <a class="nav-link" href="../proses/logout.php">
          <i class="bi bi-power"></i>
          <span>Logout</span>
        </a>
      </div>
    </div>
  </div>
</aside>
