<?php
session_start();

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin</title>
  <link rel="icon" href="assets/images/branding/icon.png" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body class="login-page">
  <div class="container">
    <div class="scene scene-bird" aria-hidden="true"></div>
    <div class="scene scene-ring" aria-hidden="true"></div>
    <div class="scene scene-house-left" aria-hidden="true"></div>
    <div class="scene scene-house-right" aria-hidden="true"></div>
    <div class="scene scene-pillars-top" aria-hidden="true"></div>
    <div class="scene scene-pillars-bottom" aria-hidden="true"></div>
    <div class="scene scene-circle-left" aria-hidden="true"></div>
    <div class="scene scene-circle-right" aria-hidden="true"></div>
    <div class="scene scene-diamond" aria-hidden="true"></div>
    <div class="scene scene-dot" aria-hidden="true"></div>
    <div class="scene scene-person-left" aria-hidden="true"></div>
    <div class="scene scene-person-right" aria-hidden="true"></div>

    <div class="card">
      <img class="logo" src="assets/images/branding/logo.png" alt="Logo ChickGuard">

      <div class="title">Login Admin</div>
      <div class="subtitle">Masuk ke sistem monitoring kandang</div>

      <form action="proses/proses_login.php" method="POST" class="login-form">
        <?php if (isset($_SESSION['login_success'])): ?>
          <div class="login-alert success"><?= e($_SESSION['login_success']) ?></div>
          <?php unset($_SESSION['login_success']); ?>
        <?php endif; ?>

        <label class="label" for="username">Username</label>
        <input id="username" type="text" name="username" class="input-box" placeholder="Masukkan username" required>

        <label class="label" for="password">Password</label>
        <div class="password-wrap">
          <input id="password" type="password" name="password" class="input-box input-password" placeholder="Masukkan password" required>
          <button type="button" class="toggle-password active" id="togglePassword" aria-label="Tampilkan password" aria-pressed="false" title="Tampilkan password">
            <i class="bi bi-eye-slash eye-icon" aria-hidden="true"></i>
          </button>
        </div>

        <button type="submit" class="btn">Masuk</button>
      </form>

      <button type="button" class="forgot-link" id="openForgotPassword">Lupa Password?</button>

      <div class="footer">
        <div class="footer-label">Powered by</div>
        <img src="assets/images/branding/footer.png" alt="Logo footer" class="footer-logo">
      </div>
    </div>
  </div>

  <div class="modal-backdrop hidden" id="forgotModal">
    <div class="modal-card forgot-password-card" role="dialog" aria-modal="true" aria-labelledby="forgotTitle">
      <button type="button" class="modal-close forgot-close" id="closeForgotPassword" aria-label="Tutup popup">&times;</button>

      <img src="assets/images/branding/logo.png" alt="ChickGuard" class="forgot-logo">
      <h2 id="forgotTitle">Lupa Password?</h2>

      <?php if (isset($_SESSION['forgot_error'])): ?>
        <div class="login-alert error"><?= e($_SESSION['forgot_error']) ?></div>
        <?php unset($_SESSION['forgot_error']); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['forgot_success'])): ?>
        <div class="login-alert success"><?= e($_SESSION['forgot_success']) ?></div>
        <?php unset($_SESSION['forgot_success']); ?>
      <?php endif; ?>

      <form action="proses/proses_lupa_password.php" method="POST" class="forgot-form">
        <input type="email" name="email" class="forgot-input" placeholder="Masukkan email anda" required>
        <button type="submit" class="forgot-submit">Kirim link reset password</button>
      </form>

      <div class="forgot-footer">
        <span class="forgot-footer-icon">i</span>
        <span>Sistem Monitoring Kandang Ayam</span>
      </div>
    </div>
  </div>

  <script>
    const passwordInput = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");
    const forgotModal = document.getElementById("forgotModal");
    const openForgotPassword = document.getElementById("openForgotPassword");
    const closeForgotPassword = document.getElementById("closeForgotPassword");

    togglePassword.addEventListener("click", function () {
      const isPassword = passwordInput.type === "password";
      passwordInput.type = isPassword ? "text" : "password";
      togglePassword.setAttribute("aria-label", isPassword ? "Sembunyikan password" : "Tampilkan password");
      togglePassword.setAttribute("aria-pressed", isPassword ? "true" : "false");
      togglePassword.setAttribute("title", isPassword ? "Sembunyikan password" : "Tampilkan password");
      togglePassword.classList.toggle("active", !isPassword);
      const icon = togglePassword.querySelector(".eye-icon");
      if (icon) {
        icon.className = isPassword ? "bi bi-eye eye-icon" : "bi bi-eye-slash eye-icon";
      }
    });

    function openModal() {
      forgotModal.classList.remove("hidden");
      document.body.classList.add("modal-open");
    }

    function closeModal() {
      forgotModal.classList.add("hidden");
      document.body.classList.remove("modal-open");
    }

    openForgotPassword.addEventListener("click", openModal);
    closeForgotPassword.addEventListener("click", closeModal);

    forgotModal.addEventListener("click", function (event) {
      if (event.target === forgotModal) {
        closeModal();
      }
    });

    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape" && !forgotModal.classList.contains("hidden")) {
        closeModal();
      }
    });

    <?php if (isset($_GET['forgot'])): ?>
      openModal();
    <?php endif; ?>
  </script>
</body>
</html>
