<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
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
      <img class="logo" src="assets/logo.png" alt="Logo ChickGuard">

      <div class="title">Login Admin</div>
      <div class="subtitle">Masuk ke sistem monitoring kandang</div>

      <form action="proses/proses_login.php" method="POST" class="login-form">
        <label class="label" for="username">Username</label>
        <input id="username" type="text" name="username" class="input-box" placeholder="Masukkan username" required>

        <label class="label" for="password">Password</label>
        <div class="password-wrap">
          <input id="password" type="password" name="password" class="input-box input-password" placeholder="Masukkan password" required>
          <button type="button" class="toggle-password" id="togglePassword" aria-label="Tampilkan password">
            <span class="eye-icon"></span>
          </button>
        </div>

        <button type="submit" class="btn">Masuk</button>
      </form>

      <button type="button" class="forgot-link" id="openForgotPassword">Lupa Password?</button>

      <div class="footer">
        <div class="footer-label">Powered by</div>
        <img src="assets/footer.png" alt="Logo footer" class="footer-logo">
      </div>
    </div>
  </div>

  <div class="modal-backdrop hidden" id="forgotModal">
    <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="forgotTitle">
      <button type="button" class="modal-close" id="closeForgotPassword" aria-label="Tutup popup">&times;</button>
      <h2 id="forgotTitle">Lupa Password</h2>
      <p>Silakan hubungi admin utama atau pengembang sistem untuk melakukan reset password akun kamu.</p>
      <div class="modal-actions">
        <button type="button" class="modal-btn" id="closeForgotPasswordBottom">Tutup</button>
      </div>
    </div>
  </div>

  <script>
    const passwordInput = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");
    const forgotModal = document.getElementById("forgotModal");
    const openForgotPassword = document.getElementById("openForgotPassword");
    const closeForgotPassword = document.getElementById("closeForgotPassword");
    const closeForgotPasswordBottom = document.getElementById("closeForgotPasswordBottom");

    togglePassword.addEventListener("click", function () {
      const isPassword = passwordInput.type === "password";
      passwordInput.type = isPassword ? "text" : "password";
      togglePassword.setAttribute("aria-label", isPassword ? "Sembunyikan password" : "Tampilkan password");
      togglePassword.classList.toggle("active", isPassword);
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
    closeForgotPasswordBottom.addEventListener("click", closeModal);

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
  </script>
</body>
</html>
