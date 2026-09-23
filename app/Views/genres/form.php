<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PORTALE — <?= $genre ? 'Editar' : 'Nuevo' ?> Género</title>
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
        <img src="/assets/logo_dark.png" alt="PORTALE" class="logo-img logo-dark-img">
        <img src="/assets/logo_light.png" alt="PORTALE" class="logo-img logo-light-img">
      </a>
      
      <ul class="nav-menu">
        <li><a href="/" class="nav-link">Home</a></li>
        <li><a href="/marketplace.html" class="nav-link">Marketplace</a></li>
        <li><a href="/generos" class="nav-link active">Géneros</a></li>
        <li>
          <button id="themeToggle" class="theme-toggle-btn" aria-label="Toggle light and dark mode">
            <span id="themeLabel">[ MODE: DARK ]</span>
          </button>
        </li>
        <li><a href="/perfil" class="nav-link nav-login">[ <?= esc(session()->get('nombre')) ?> ]</a></li>
        <li><a href="/logout" class="nav-link" style="color:var(--color-text-muted);">Salir</a></li>
      </ul>
    </nav>
  </header>

  <main style="padding-top: 9rem; padding-bottom: 8rem;">
    <section class="register-container reveal-on-scroll">
      <header class="register-header">
        <span class="editorial-meta">ADMINISTRACIÓN DE CATÁLOGO · HITO 1</span>
        <h1 class="register-title"><?= $genre ? 'Editar Género.' : 'Nuevo Género.' ?></h1>
        <p class="register-sub">
          <?= $genre ? 'Modificá la denominación formal de este estilo musical en la base de datos.' : 'Ingresá un nuevo estilo sonoro para clasificar las producciones y masters del portal.' ?>
        </p>
      </header>

      <?php if ($msg = session()->getFlashdata('error')): ?>
        <div style="background-color: var(--color-card-bg); border: 1px solid #F44336; padding: 1.2rem 1.8rem; margin-bottom: 2rem;">
          <p style="font-family: var(--font-secondary); font-size: 0.85rem; color: #F44336; margin: 0;">✕ <?= esc($msg) ?></p>
        </div>
      <?php endif; ?>

      <form action="<?= $genre ? '/generos/actualizar/' . $genre['id_genero'] : '/generos' ?>" method="post" class="register-form-box">
        <?= csrf_field() ?>

        <div class="form-step">
          <label for="nombre" class="form-label">DENOMINACIÓN DEL GÉNERO</label>
          <input type="text" id="nombre" name="nombre" class="form-input" value="<?= $genre ? esc(old('nombre', $genre['nombre'])) : esc(old('nombre')) ?>" placeholder="Ej. Ambient Drone, Minimal Techno, Acid House..." required autofocus maxlength="80">
          <span class="form-help-text">El nombre debe ser único y descriptivo del estilo.</span>
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap;">
          <button type="submit" class="btn-solid btn-large" style="flex: 2;">
            <?= $genre ? 'Actualizar Género' : 'Crear Género' ?>
          </button>
          <a href="/generos" class="btn-solid btn-large" style="flex: 1; background: transparent; color: var(--color-text-primary); text-align: center;">
            Cancelar
          </a>
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
