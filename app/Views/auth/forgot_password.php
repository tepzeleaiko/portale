<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PORTALE — Recuperar Contraseña</title>
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
        <li><a href="/marketplace.html" class="nav-link">Marketplace</a></li>
        <li><a href="/login" class="nav-link nav-login">Iniciar Sesión</a></li>
      </ul>
    </nav>
  </header>

  <main style="padding-top: 9rem; padding-bottom: 8rem;">
    <section class="register-container reveal-on-scroll">
      <header class="register-header">
        <span class="editorial-meta">PORTALE RECOVERY PROTOCOL</span>
        <h1 class="register-title">Recuperar Acceso.</h1>
        <p class="register-sub">
          Ingresá tu correo electrónico registrado para generar un enlace seguro de restablecimiento de contraseña.
        </p>
      </header>

      <?php if ($msg = session()->getFlashdata('success')): ?>
        <div style="background-color: var(--color-card-bg); border: 1px solid #4CAF50; padding: 1.2rem 1.8rem; margin-bottom: 2rem;">
          <p style="font-family: var(--font-secondary); font-size: 0.85rem; color: #4CAF50; margin: 0;">✓ <?= esc($msg) ?></p>
        </div>
      <?php endif; ?>

      <?php if ($msg = session()->getFlashdata('error')): ?>
        <div style="background-color: var(--color-card-bg); border: 1px solid #F44336; padding: 1.2rem 1.8rem; margin-bottom: 2rem;">
          <p style="font-family: var(--font-secondary); font-size: 0.85rem; color: #F44336; margin: 0;">✕ <?= esc($msg) ?></p>
        </div>
      <?php endif; ?>

      <?php if ($token = session()->getFlashdata('reset_token_demo')): ?>
        <div style="background-color: var(--color-card-bg); border: 1px solid var(--color-text-primary); padding: 1.2rem 1.8rem; margin-bottom: 2rem;">
          <span class="editorial-meta" style="margin-bottom: 0.5rem;">[ SIMULACIÓN DE ENLACE SEGURO ]</span>
          <p style="font-family: var(--font-secondary); font-size: 0.85rem;">Hacé clic aquí para continuar: <a href="/reset-password/<?= esc($token) ?>" style="text-decoration: underline; font-weight: bold; color: var(--color-text-primary);">Restablecer contraseña ahora →</a></p>
        </div>
      <?php endif; ?>

      <form action="/forgot-password" method="post" class="register-form-box">
        <?= csrf_field() ?>

        <div class="form-step">
          <label for="email" class="form-label">CORREO ELECTRÓNICO REGISTRADO</label>
          <input type="email" id="email" name="email" class="form-input" placeholder="usuario@gmail.com" required autofocus>
        </div>

        <div style="margin-top: 2rem;">
          <button type="submit" class="btn-solid btn-large btn-full">
            Enviar Instrucciones
          </button>
        </div>

        <div style="text-align: center; margin-top: 1.5rem; border-top: 1px solid var(--color-border); padding-top: 1.5rem;">
          <a href="/login" class="form-help-text" style="color: var(--color-text-primary); text-decoration: underline;">← Volver al inicio de sesión</a>
        </div>
      </form>
    </section>
  </main>

  <footer class="site-footer">
    <div class="footer-left">
      <a href="/" class="footer-logo-link" aria-label="PORTALE Home">
        <img src="/assets/logo_dark.png" alt="PORTALE" class="footer-logo-img logo-dark-img">
        <img src="/assets/logo_light.png" alt="PORTALE" class="footer-logo-img logo-light-img">
      </a>
      <span class="footer-copy">© 2026 PORTALE. SWISS EDITORIAL DESIGN.</span>
    </div>
  </footer>

  <script src="/main.js"></script>
</body>
</html>
