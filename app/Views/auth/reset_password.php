<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PORTALE — Restablecer Contraseña</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/styles.css">
</head>
<body>

  <canvas id="cursor-canvas" aria-hidden="true"></canvas>
  <div id="page-backdrop" aria-hidden="true"></div>
  <div id="page-overlay" aria-hidden="true"></div>

  <header class="site-header">
    <nav class="nav-container" aria-label="Main Navigation">
      <a href="/" class="site-logo" aria-label="PORTALE Home">
        <img src="/assets/logo_dark.png" alt="PORTALE" class="logo-img logo-dark-img">
        <img src="/assets/logo_light.png" alt="PORTALE" class="logo-img logo-light-img">
      </a>
      <ul class="nav-menu">
        <li><a href="/" class="nav-link">Home</a></li>
        <li><a href="/login" class="nav-link nav-login">Iniciar Sesión</a></li>
      </ul>
    </nav>
  </header>

  <main style="padding-top: 9rem; padding-bottom: 8rem;">
    <section class="register-container reveal-on-scroll">
      <header class="register-header">
        <span class="editorial-meta">PORTALE SECURITY PROTOCOL</span>
        <h1 class="register-title">Nueva Contraseña.</h1>
        <p class="register-sub">
          Definí tu nueva clave de acceso de al menos 8 caracteres para recuperar el control de tu cuenta.
        </p>
      </header>

      <?php if ($msg = session()->getFlashdata('error')): ?>
        <div style="background-color: var(--color-card-bg); border: 1px solid #F44336; padding: 1.2rem 1.8rem; margin-bottom: 2rem;">
          <p style="font-family: var(--font-secondary); font-size: 0.85rem; color: #F44336; margin: 0;">✕ <?= esc($msg) ?></p>
        </div>
      <?php endif; ?>

      <form action="/reset-password/<?= esc($token) ?>" method="post" class="register-form-box">
        <?= csrf_field() ?>

        <div class="form-step">
          <label for="password" class="form-label">NUEVA CONTRASEÑA</label>
          <input type="password" id="password" name="password" class="form-input" placeholder="••••••••••••" required minlength="8" autofocus>
          <span class="form-help-text">Mínimo 8 caracteres requeridos.</span>
        </div>

        <div style="margin-top: 2rem;">
          <button type="submit" class="btn-solid btn-large btn-full">
            Actualizar y Continuar
          </button>
        </div>
      </form>
    </section>
  </main>

  <footer class="site-footer">
    <div class="footer-left">
      <span class="footer-copy">© 2026 PORTALE. SWISS EDITORIAL DESIGN.</span>
    </div>
  </footer>

  <script src="/main.js"></script>
</body>
</html>
