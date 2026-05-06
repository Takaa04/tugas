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
        <a class="nav-link logout-link js-open-logout-modal" href="../proses/logout.php">
          <i class="bi bi-power"></i>
          <span>Logout</span>
        </a>
      </div>
    </div>
  </div>
</aside>

<style>
  .logout-modal-backdrop {
    position: fixed;
    inset: 0;
    z-index: 1300;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    background: rgba(28, 28, 28, 0.72);
    backdrop-filter: blur(4px);
  }

  .logout-modal-backdrop.hidden {
    display: none !important;
  }

  .logout-modal-card {
    width: min(100%, 380px);
    min-height: 332px;
    background: #ffffff;
    border-radius: 28px;
    padding: 24px 20px 24px;
    text-align: center;
    box-shadow: 0 24px 58px rgba(15, 23, 42, 0.22);
  }

  .logout-modal-icon {
    width: 74px;
    height: 74px;
    margin: 0 auto 20px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background: #ff5417;
    color: #ffffff;
    font-size: 2rem;
  }

  .logout-modal-card h2 {
    margin: 0 0 10px;
    font-size: 1.7rem;
    line-height: 1.1;
    font-weight: 800;
    color: #111827;
  }

  .logout-modal-card p {
    max-width: 300px;
    margin: 0 auto;
    color: #6b7280;
    font-size: 0.92rem;
    line-height: 1.45;
  }

  .logout-modal-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-top: 22px;
  }

  .logout-modal-btn {
    min-height: 52px;
    border-radius: 14px;
    font-size: 0.95rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: filter 0.18s ease;
    cursor: pointer;
  }

  .logout-modal-btn:hover {
    filter: brightness(0.98);
  }

  .logout-modal-btn.secondary {
    border: 0;
    background: #f3f4f6;
    color: #111827;
  }

  .logout-modal-btn.primary {
    border: 0;
    background: #ff5417;
    color: #ffffff;
  }

  @media (max-width: 768px) {
    .logout-modal-card {
      border-radius: 24px;
      min-height: auto;
      padding: 22px 16px 20px;
    }

    .logout-modal-icon {
      width: 68px;
      height: 68px;
      margin-bottom: 18px;
      font-size: 1.85rem;
    }

    .logout-modal-card h2 {
      font-size: 1.5rem;
    }

    .logout-modal-card p {
      font-size: 0.9rem;
    }

    .logout-modal-actions {
      grid-template-columns: 1fr;
      gap: 14px;
    }

    .logout-modal-btn {
      min-height: 48px;
    }
  }
</style>

<div class="logout-modal-backdrop hidden" id="logoutConfirmModal" aria-hidden="true">
  <div class="logout-modal-card" role="dialog" aria-modal="true" aria-labelledby="logoutConfirmTitle">
    <div class="logout-modal-icon">
      <i class="bi bi-box-arrow-right"></i>
    </div>
    <h2 id="logoutConfirmTitle">Konfirmasi Logout</h2>
    <p>Apakah Anda yakin ingin keluar dari sistem? Anda perlu login kembali untuk mengakses dashboard.</p>
    <div class="logout-modal-actions">
      <button type="button" class="logout-modal-btn secondary" id="cancelLogoutBtn">Batal</button>
      <a href="../proses/logout.php" class="logout-modal-btn primary">Ya, Logout</a>
    </div>
  </div>
</div>

<script>
  (() => {
    const logoutModal = document.getElementById("logoutConfirmModal");
    const openLogoutModalBtn = document.querySelector(".js-open-logout-modal");
    const cancelLogoutBtn = document.getElementById("cancelLogoutBtn");

    if (!logoutModal || !openLogoutModalBtn || !cancelLogoutBtn) {
      return;
    }

    function openLogoutModal(event) {
      event.preventDefault();
      logoutModal.classList.remove("hidden");
      logoutModal.setAttribute("aria-hidden", "false");
      document.body.classList.add("modal-open");
    }

    function closeLogoutModal() {
      logoutModal.classList.add("hidden");
      logoutModal.setAttribute("aria-hidden", "true");
      document.body.classList.remove("modal-open");
    }

    openLogoutModalBtn.addEventListener("click", openLogoutModal);
    cancelLogoutBtn.addEventListener("click", closeLogoutModal);

    logoutModal.addEventListener("click", (event) => {
      if (event.target === logoutModal) {
        closeLogoutModal();
      }
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape" && !logoutModal.classList.contains("hidden")) {
        closeLogoutModal();
      }
    });
  })();
</script>
