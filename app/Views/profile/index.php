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
          
          <!-- Avatar del Usuario -->
          <div class="avatar-preview-box large-avatar" style="position: relative;">
            <img id="headerAvatarImg" src="<?= esc($user['avatar'] ?: '/assets/cover1.jpg') ?>" alt="Foto de perfil" style="width: 100%; height: 100%; object-fit: cover; display: block;">
          </div>

          <div>
            <div style="display: flex; align-items: center; gap: 0.8rem; flex-wrap: wrap;">
              <h1 class="profile-name" style="margin: 0;"><?= esc($user['nombre'] . ' ' . $user['apellido']) ?></h1>
              
              <!-- Check de Verificación si es Artista Verificado -->
              <?php if ($artist && !empty($artist['verificado'])): ?>
                <span title="Artista Verificado Oficial" style="background: var(--color-text-primary); color: var(--color-btn-text); padding: 0.25rem 0.6rem; font-family: var(--font-secondary); font-size: 0.65rem; font-weight: 700; letter-spacing: 0.15em;">
                  ✓ VERIFICADO
                </span>
              <?php endif; ?>
            </div>

            <span class="editorial-meta" style="margin-top: 0.4rem; color: var(--color-text-primary);">
              [ ROL: <?= esc(strtoupper(session()->get('rol'))) ?> ]
              <?php if ($artist && !empty($artist['ubicacion'])): ?>
                · 📍 <?= esc(strtoupper($artist['ubicacion'])) ?>
              <?php endif; ?>
            </span>
            <p class="profile-email"><?= esc($user['email']) ?></p>
          </div>
        </div>

        <div style="margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap;">
          <?php if ($artist): ?>
            <a href="/artista/<?= $artist['id_artista'] ?>" class="btn-solid btn-sm" style="background: var(--color-text-primary); color: var(--color-btn-text);">Ver Mi Perfil Público de Artista ↗</a>
          <?php endif; ?>
          <a href="/generos" class="btn-solid btn-sm">Catálogo de Géneros →</a>
          <a href="/logout" class="btn-solid btn-sm" style="background: transparent; color: var(--color-text-primary);">Cerrar Sesión</a>
        </div>
      </div>

      <!-- Notificación Flash -->
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

      <!-- Formulario de Edición de Perfil con Subida de Foto -->
      <header class="register-header" style="text-align: left; margin-bottom: 2rem;">
        <span class="editorial-meta">CONFIGURACIÓN DE CUENTA</span>
        <h2 style="font-size: 2.2rem; font-weight: 400;">Editar Perfil y Fotografía</h2>
      </header>

      <form action="/perfil" method="post" enctype="multipart/form-data" class="register-form-box">
        <?= csrf_field() ?>

        <!-- Sección de Foto de Perfil -->
        <div class="form-step">
          <label class="form-label">FOTOGRAFÍA DE PERFIL / RETRATO</label>
          <div class="avatar-upload-row">
            <div class="avatar-preview-box large-avatar" id="avatarPreviewContainer">
              <img id="formAvatarPreview" src="<?= esc($user['avatar'] ?: '/assets/cover1.jpg') ?>" alt="Vista previa de avatar" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            </div>
            <div class="avatar-upload-controls">
              <input type="file" id="avatarInput" name="avatar" accept="image/png, image/jpeg, image/webp" style="display: none;" onchange="previewAvatar(event)">
              <button type="button" class="btn-solid btn-sm" onclick="document.getElementById('avatarInput').click();">
                Seleccionar Nueva Foto
              </button>
              <span class="form-help-text" style="display: block; margin-top: 0.5rem;">Formatos aceptados: JPG, PNG o WEBP. Guardado automático al enviar formulario.</span>
            </div>
          </div>
        </div>

        <div class="thin-separator" style="margin: 1.5rem 0;"></div>

        <!-- Datos Personales -->
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

        <!-- Datos del Artista -->
        <?php if ($artist): ?>
          <div style="border-top: 1px solid var(--color-border); padding-top: 2rem; margin-top: 1rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
              <span class="editorial-meta" style="margin: 0;">[ DATOS PÚBLICOS DE ARTISTA ]</span>
              <?php if (!empty($artist['verificado'])): ?>
                <span style="font-family: var(--font-secondary); font-size: 0.75rem; color: #4CAF50; font-weight: bold;">
                  ✓ ESTADO: ARTISTA VERIFICADO
                </span>
              <?php endif; ?>
            </div>

            <div class="form-step-grid">
              <div class="form-step">
                <label for="nombre_artistico" class="form-label">NOMBRE ARTÍSTICO / ALIAS</label>
                <input type="text" id="nombre_artistico" name="nombre_artistico" class="form-input" value="<?= esc($artist['nombre_artistico']) ?>" placeholder="Ej. Tiziano Fardini">
              </div>

              <div class="form-step">
                <label for="ubicacion" class="form-label">UBICACIÓN / CIUDAD & PAÍS</label>
                <input type="text" id="ubicacion" name="ubicacion" class="form-input" value="<?= esc($artist['ubicacion'] ?? '') ?>" placeholder="Ej. Córdoba, Argentina">
              </div>
            </div>

            <div class="form-step" style="margin-top: 1.5rem;">
              <label for="biografia" class="form-label">BIOGRAFÍA / MANIFIESTO ARTÍSTICO</label>
              <textarea id="biografia" name="biografia" class="form-input" rows="5" placeholder="Describí tu visión sonora, proyectos y trayectoria..."><?= esc($artist['biografia']) ?></textarea>
            </div>

            <!-- Redes Sociales / Plataformas -->
            <span class="editorial-meta" style="margin-top: 2rem; margin-bottom: 1rem;">[ ENLACES A PLATAFORMAS EXTERNAS ]</span>
            <div class="form-step-grid">
              <div class="form-step">
                <label for="spotify" class="form-label">PERFIL DE SPOTIFY</label>
                <input type="url" id="spotify" name="spotify" class="form-input" value="<?= esc($artist['spotify'] ?? '') ?>" placeholder="https://open.spotify.com/artist/...">
              </div>

              <div class="form-step">
                <label for="soundcloud" class="form-label">PERFIL DE SOUNDCLOUD</label>
                <input type="url" id="soundcloud" name="soundcloud" class="form-input" value="<?= esc($artist['soundcloud'] ?? '') ?>" placeholder="https://soundcloud.com/...">
              </div>

              <div class="form-step">
                <label for="instagram" class="form-label">INSTAGRAM O RESIDENT ADVISOR</label>
                <input type="url" id="instagram" name="instagram" class="form-input" value="<?= esc($artist['instagram'] ?? '') ?>" placeholder="https://instagram.com/...">
              </div>
            </div>

          </div>
        <?php endif; ?>

        <div style="margin-top: 2.5rem;">
          <button type="submit" class="btn-solid btn-large btn-full">
            Guardar Cambios de Perfil
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
  <script>
    function previewAvatar(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('formAvatarPreview').src = e.target.result;
          const headerImg = document.getElementById('headerAvatarImg');
          if (headerImg) headerImg.src = e.target.result;
        }
        reader.readAsDataURL(file);
      }
    }
  </script>
</body>
</html>
