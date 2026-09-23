<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PORTALE — Mi Perfil</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/styles.css">
</head>
<body>

  <canvas id="cursor-canvas" aria-hidden="true"></canvas>
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
        <li><a href="/generos" class="nav-link">Géneros</a></li>
        <li>
          <button id="themeToggle" class="theme-toggle-btn" aria-label="Toggle light and dark mode">
            <span id="themeLabel">[ MODE: DARK ]</span>
          </button>
        </li>
        <li><a href="/logout" class="nav-link nav-login">Cerrar Sesión</a></li>
      </ul>
    </nav>
  </header>

  <main style="padding-top: 9rem; padding-bottom: 8rem;">
    <section class="register-container reveal-on-scroll">

      <!-- Header del Perfil -->
      <div class="user-profile-display" style="margin-bottom: 3rem;">
        <span class="editorial-meta">CUENTA ACTIVA · PORTALE</span>
        <div class="profile-header-info">
          <div class="avatar-preview-box large-avatar">
            <img src="/assets/cover1.jpg" alt="User avatar" style="display: block;">
          </div>
          <div>
            <h1 class="profile-name"><?= esc($user['nombre'] . ' ' . $user['apellido']) ?></h1>
            <span class="editorial-meta" style="margin-top: 0.4rem; color: var(--color-text-primary);">[ ROL: <?= esc(strtoupper(session()->get('rol'))) ?> ]</span>
            <p class="profile-email"><?= esc($user['email']) ?></p>
          </div>
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap;">
          <a href="/generos" class="btn-solid btn-sm">Ver Catálogo de Géneros →</a>
          <a href="/logout" class="btn-solid btn-sm" style="background: transparent; color: var(--color-text-primary);">Cerrar Sesión</a>
        </div>
      </div>

      <!-- Notificación Flash -->
      <?php if ($msg = session()->getFlashdata('success')): ?>
        <div style="background-color: var(--color-card-bg); border: 1px solid #4CAF50; padding: 1.2rem 1.8rem; margin-bottom: 2rem;">
          <p style="font-family: var(--font-secondary); font-size: 0.85rem; color: #4CAF50; margin: 0;">✓ <?= esc($msg) ?></p>
        </div>
      <?php endif; ?>

      <!-- Formulario de Edición de Perfil -->
      <header class="register-header" style="text-align: left; margin-bottom: 2rem;">
        <span class="editorial-meta">CONFIGURACIÓN DE CUENTA</span>
        <h2 style="font-size: 2.2rem; font-weight: 400;">Editar Datos de Perfil</h2>
      </header>

      <form action="/perfil" method="post" class="register-form-box">
        <?= csrf_field() ?>

        <div class="form-step-grid">
          <div class="form-step">
            <label for="nombre" class="form-label">NOMBRE</label>
            <input type="text" id="nombre" name="nombre" class="form-input" value="<?= esc($user['nombre']) ?>" required minlength="2">
          </div>

          <div class="form-step">
            <label for="apellido" class="form-label">APELLIDO</label>
            <input type="text" id="apellido" name="apellido" class="form-input" value="<?= esc($user['apellido']) ?>" required minlength="2">
          </div>
        </div>

        <div class="form-step">
          <label class="form-label">CORREO ELECTRÓNICO (NO MODIFICABLE)</label>
          <input type="email" class="form-input" value="<?= esc($user['email']) ?>" disabled style="opacity: 0.5; cursor: not-allowed;">
        </div>

        <?php if ($artist): ?>
          <div style="border-top: 1px solid var(--color-border); padding-top: 2rem; margin-top: 1rem;">
            <span class="editorial-meta" style="margin-bottom: 1.5rem;">[ DATOS DE ARTISTA ASOCIADOS ]</span>

            <div class="form-step">
              <label for="nombre_artistico" class="form-label">NOMBRE ARTÍSTICO / ALIAS PÚBLICO</label>
              <input type="text" id="nombre_artistico" name="nombre_artistico" class="form-input" value="<?= esc($artist['nombre_artistico']) ?>" placeholder="Alias musical">
            </div>

            <div class="form-step" style="margin-top: 1.5rem;">
              <label for="biografia" class="form-label">BIOGRAFÍA / MANIFIESTO ARTÍSTICO</label>
              <textarea id="biografia" name="biografia" class="form-input" rows="4" placeholder="Describí tu trayectoria sonora..."><?= esc($artist['biografia']) ?></textarea>
            </div>
          </div>
        <?php endif; ?>

        <div style="margin-top: 2rem;">
          <button type="submit" class="btn-solid btn-large btn-full">
            Guardar Cambios
          </button>
        </div>
      </form>

    </section>
  </main>

  <footer class="site-footer">
    <div class="footer-left">
      <a href="/" class="footer-logo-link" aria-label="PORTALE Home">
        <img src="/assets/logo_portal.png" alt="PORTALE" class="footer-logo-img" style="height:36px;width:auto;opacity:0.8;">
      </a>
      <span class="footer-copy">© 2026 PORTALE. SWISS EDITORIAL DESIGN.</span>
    </div>
    <ul class="footer-menu">
      <li><a href="/">Home</a></li>
      <li><a href="/marketplace.html">Marketplace</a></li>
      <li><a href="/generos">Géneros</a></li>
      <li><a href="/logout">Salir</a></li>
    </ul>
  </footer>

  <script src="/main.js"></script>
</body>
</html>
