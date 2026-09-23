<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PORTALE — Registro de Membresía y Artista</title>
  <meta name="description" content="Unite a PORTALE como Consumidor/DJ o Artista Independiente. Santuario de música directa y sin compresión.">
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
        <img src="/assets/logo_portal.png" alt="PORTALE" class="logo-portal-emblem">
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
        <li><a href="/login" class="nav-link nav-login">Iniciar Sesión</a></li>
      </ul>
    </nav>
  </header>

  <main style="padding-top: 9rem; padding-bottom: 8rem;">

    <section class="register-container reveal-on-scroll">
      <header class="register-header">
        <span class="editorial-meta">PROTOCOLO DE MEMBRESÍA PORTALE</span>
        <h1 class="register-title">Crear Cuenta.</h1>
        <p class="register-sub">
          Seleccioná tu tipo de cuenta para acceder a descargas bit-perfect o publicar obra sonora directa.
        </p>
      </header>

      <!-- Account Type Switcher -->
      <div class="account-type-toggle" role="tablist">
        <button type="button" id="tabConsumer" class="type-tab-btn active" role="tab" aria-selected="true" onclick="selectRole('Consumidor')">
          [ 01 / CONSUMIDOR & DJ ]
        </button>
        <button type="button" id="tabArtist" class="type-tab-btn" role="tab" aria-selected="false" onclick="selectRole('Artista')">
          [ 02 / ARTISTA & PRODUCTOR ]
        </button>
      </div>

      <!-- Errores de Validación -->
      <?php if ($errors = session()->getFlashdata('errors')): ?>
        <div style="background-color: var(--color-card-bg); border: 1px solid #F44336; padding: 1.5rem 2rem; margin-bottom: 2rem;">
          <span class="editorial-meta" style="color: #F44336; margin-bottom: 0.8rem;">[ ERRORES DETECTADOS ]</span>
          <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.4rem;">
            <?php foreach ($errors as $error): ?>
              <li style="font-family: var(--font-secondary); font-size: 0.85rem; color: #F44336;">• <?= esc($error) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <!-- Registration Form -->
      <form action="/register" method="post" class="register-form-box">
        <?= csrf_field() ?>

        <!-- Rol Seleccionado Oculto -->
        <input type="hidden" id="accountRoleInput" name="rol" value="<?= esc(old('rol', 'Consumidor')) ?>">

        <!-- Datos Personales -->
        <div class="form-step-grid">
          <div class="form-step">
            <label for="nombre" class="form-label">NOMBRE</label>
            <input type="text" id="nombre" name="nombre" class="form-input" value="<?= esc(old('nombre')) ?>" placeholder="Ej. Tiziano" required minlength="2" maxlength="50">
          </div>

          <div class="form-step">
            <label for="apellido" class="form-label">APELLIDO</label>
            <input type="text" id="apellido" name="apellido" class="form-input" value="<?= esc(old('apellido')) ?>" placeholder="Ej. Fardini" required minlength="2" maxlength="50">
          </div>
        </div>

        <div class="form-step">
          <label for="email" class="form-label">CORREO ELECTRÓNICO</label>
          <input type="email" id="email" name="email" class="form-input" value="<?= esc(old('email')) ?>" placeholder="usuario@gmail.com" required maxlength="120">
          <span class="form-help-text">Utilizado para acceso y notificaciones del portal.</span>
        </div>

        <div class="form-step">
          <label for="password" class="form-label">CONTRASEÑA</label>
          <input type="password" id="password" name="password" class="form-input" placeholder="••••••••••••" required minlength="8">
          <span class="form-help-text">Mínimo 8 caracteres alfanuméricos.</span>
        </div>

        <!-- Campos Específicos para Artistas -->
        <div id="artistFields" class="artist-fields-container" style="display: <?= old('rol') === 'Artista' ? 'block' : 'none' ?>;">
          <span class="editorial-meta" style="margin-top: 2rem; margin-bottom: 1rem;">[ PERFIL DE ARTISTA ]</span>

          <div class="form-step">
            <label for="nombre_artistico" class="form-label">NOMBRE ARTÍSTICO / ALIAS</label>
            <input type="text" id="nombre_artistico" name="nombre_artistico" class="form-input" value="<?= esc(old('nombre_artistico')) ?>" placeholder="Ej. Monolith Frequency">
          </div>

          <div class="form-step" style="margin-top: 1.5rem;">
            <label for="biografia" class="form-label">BIOGRAFÍA O MANIFIESTO SONORO</label>
            <textarea id="biografia" name="biografia" class="form-input" rows="4" placeholder="Breve reseña sobre tu obra y visión artística..."><?= esc(old('biografia')) ?></textarea>
          </div>
        </div>

        <div style="margin-top: 2rem;">
          <button type="submit" class="btn-solid btn-large btn-full">
            Completar Registro
          </button>
        </div>

        <div style="text-align: center; margin-top: 1.5rem; border-top: 1px solid var(--color-border); padding-top: 1.5rem;">
          <p class="form-help-text">¿Ya tenés una cuenta registrada? <a href="/login" style="text-decoration: underline; color: var(--color-text-primary);">Iniciar sesión aquí</a></p>
        </div>

      </form>

    </section>

  </main>

  <!-- Minimal Footer -->
  <footer class="site-footer">
    <div class="footer-left">
      <a href="/" class="footer-logo-link" aria-label="PORTALE Home">
        <img src="/assets/logo_portal.png" alt="PORTALE" class="footer-logo-img" style="height:36px;width:auto;opacity:0.8;">
      </a>
      <span class="footer-copy">© 2026 PORTALE. SWISS EDITORIAL DESIGN. ALL RIGHTS RESERVED.</span>
    </div>

    <ul class="footer-menu">
      <li><a href="/">Home</a></li>
      <li><a href="/marketplace.html">Marketplace</a></li>
      <li><a href="/releases.html">Releases</a></li>
      <li><a href="/login">Login</a></li>
    </ul>
  </footer>

  <script src="/main.js"></script>
  <script>
    function selectRole(role) {
      document.getElementById('accountRoleInput').value = role;
      const tabConsumer = document.getElementById('tabConsumer');
      const tabArtist = document.getElementById('tabArtist');
      const artistFields = document.getElementById('artistFields');

      if (role === 'Consumidor') {
        tabConsumer.classList.add('active');
        tabConsumer.setAttribute('aria-selected', 'true');
        tabArtist.classList.remove('active');
        tabArtist.setAttribute('aria-selected', 'false');
        if (artistFields) artistFields.style.display = 'none';
      } else {
        tabArtist.classList.add('active');
        tabArtist.setAttribute('aria-selected', 'true');
        tabConsumer.classList.remove('active');
        tabConsumer.setAttribute('aria-selected', 'false');
        if (artistFields) artistFields.style.display = 'block';
      }
    }

    // Inicializar estado según valor previo
    document.addEventListener('DOMContentLoaded', () => {
      const initialRole = document.getElementById('accountRoleInput').value;
      selectRole(initialRole || 'Consumidor');
    });
  </script>
</body>
</html>
