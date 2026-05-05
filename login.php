<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin</title>
  <link rel="stylesheet" href="/kelompok_2/assets/style.css">
</head>
<body>

<div class="container">

  <!-- background -->
  <div class="bg-main"></div>
  <div class="bg-overlay"></div>

  <!-- blur -->
  <div class="blur-1"></div>
  <div class="blur-2"></div>
  <div class="blur-3"></div>

  <!-- card -->
  <div class="card">

    <img class="logo" src="assets/logo.png">

    <div class="title">Login Admin</div>
    <div class="subtitle">Masuk ke sistem monitoring kandang</div>

    <!-- FORM -->
    <form action="../kelompok_2/proses/proses_login.php" method="POST">

      <!-- username -->
      <label class="label">Username</label>
      <input type="text" name="username" class="input-box" placeholder="Masukkan username" required>

      <!-- password -->
      <label class="label">Password</label>
      <input type="password" name="password" class="input-box" placeholder="Masukkan password" required>

      <!-- button -->
      <button type="submit" class="btn">Masuk</button>

    </form>

    <div class="forgot">Lupa password?</div>

    <div class="footer">
      Sistem Monitoring Kandang Ayam
    </div>

  </div>
</div>

</body>
</html>