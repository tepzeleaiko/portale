<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PORTALE — Iniciar Sesión</title>
  <meta name="description" content="Acceso a la plataforma y catálogo de PORTALE.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/styles.css">
</head>
<body>

  <!-- Canvas for Dynamic Diffuse Cursor Light Trail -->
  <canvas id="cursor-canvas" aria-hidden="true"></canvas>

  <!-- Full-Page Static Fixed Marble Backdrop -->
  <div id="page-backdrop" aria-hidden="true"></div>
  <div id="page-overlay" aria-hidden="true"></div>

  <!-- Minimal Navigation Bar -->
  <header class="site-header">
    <nav class="nav-container" aria-label="Main Navigation">
      <a href="/" class="site-logo" aria-label="PORTALE Home">
        <img src="/assets/logo_dark.png" alt="PORTALE" class="logo-img logo-dark-img">
        <img src="/assets/logo_light.png" alt="PORTALE" class="logo-img logo-light-img">
      </a>
      
      <ul class="nav-menu">
        <li><a href="/" class="nav-link">Home</a></li>
        <li><a href="/marketplace.html" class="nav-link">Marketplace</a></li>
        <li><a href="/releases.html" class="nav-link">Releases</a></li>
        <li>
          <button id="themeToggle" class="theme-toggle-btn" aria-label="Toggle light and dark mode">
            <span id="themeLabel">[ MODE: DARK ]</span>
          </button>
        </li>
        <li><a href="/register" class="nav-link nav-login">Crear Cuenta</a></li>
      </ul>
    </nav>
  </header>

  <main style="padding-top: 9rem; padding-bottom: 8rem;">

    <section class="register-container reveal-on-scroll">
      <header class="register-header">
        <span class="editorial-meta">PORTALE ACCESS PROTOCOL</span>
        <h1 class="register-title">Iniciar Sesión.</h1>
        <p class="register-sub">
          Ingresá tus credenciales para acceder a tu panel, gestionar géneros o reproducir catálogo.
        </p>
      </header>

      <!-- Mensajes de Estado Flash -->
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

      <!-- Login Form -->
      <form action="/login" method="post" class="register-form-box">
        <?= csrf_field() ?>

        <div class="form-step">
          <label for="email" class="form-label">CORREO ELECTRÓNICO</label>
          <input type="email" id="email" name="email" class="form-input" value="<?= esc(old('email')) ?>" placeholder="usuario@portale.local" required autofocus>
        </div>

        <div class="form-step">
          <label for="password" class="form-label">CONTRASEÑA</label>
          <input type="password" id="password" name="password" class="form-input" placeholder="••••••••••••" required>
        </div>

        <div style="margin-top: 2rem;">
          <button type="submit" class="btn-solid btn-large btn-full">
            Ingresar al Portal
          </button>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem; border-top: 1px solid var(--color-border); padding-top: 1.5rem; flex-wrap: wrap; gap: 1rem;">
          <a href="/register" class="form-help-text" style="color: var(--color-text-primary); text-decoration: underline;">¿No tenés cuenta? Registrate</a>
          <a href="/forgot-password" class="form-help-text" style="color: var(--color-text-muted);">Olvidé mi contraseña</a>
        </div>

      </form>

    </section>

  </main>

  <!-- Minimal Footer -->
  <footer class="site-footer">
    <div class="footer-left">
      <a href="/" class="footer-logo-link" aria-label="PORTALE Home">
        <img src="/assets/logo_dark.png" alt="PORTALE" class="footer-logo-img logo-dark-img">
        <img src="/assets/logo_light.png" alt="PORTALE" class="footer-logo-img logo-light-img">
      </a>
      <span class="footer-copy">© 2026 PORTALE. SWISS EDITORIAL DESIGN. ALL RIGHTS RESERVED.</span>
    </div>

    <ul class="footer-menu">
      <li><a href="/">Home</a></li>
      <li><a href="/marketplace.html">Marketplace</a></li>
      <li><a href="/releases.html">Releases</a></li>
      <li><a href="/register">Registrarse</a></li>
    </ul>
  </footer>

  <script src="/main.js"></script>
</body>
</html>
