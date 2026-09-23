<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PORTALE — Perfil de <?= esc($artist['nombre_artistico'] ?: ($artist['user_nombre'] . ' ' . $artist['user_apellido'])) ?></title>
  <meta name="description" content="Perfil oficial del artista en PORTALE: obras maestras sin compresión y lanzamientos directos.">
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
        <li><a href="/releases.html" class="nav-link">Releases</a></li>
        <li>
          <button id="themeToggle" class="theme-toggle-btn" aria-label="Toggle light and dark mode">
            <span id="themeLabel">[ MODE: DARK ]</span>
          </button>
        </li>
        <?php if (session()->get('logged_in')): ?>
          <li><a href="/perfil" class="nav-link nav-login">[ <?= esc(session()->get('nombre')) ?> ]</a></li>
        <?php else: ?>
          <li><a href="/login" class="nav-link nav-login">Ingresar</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>

  <main style="padding-top: 9rem; padding-bottom: 8rem;">
    <section class="register-container reveal-on-scroll" style="max-width: 1200px;">

      <!-- Panel Principal del Artista -->
      <article class="user-profile-display" style="padding: 4rem;">
        <span class="editorial-meta">EXPEDIENTE DE ARTISTA · ARCHIVAL PROFILE</span>

        <div style="display: flex; gap: 3.5rem; align-items: flex-start; flex-wrap: wrap; margin-top: 2rem;">
          
          <!-- Avatar del Artista -->
          <div style="width: 220px; height: 220px; border: 1px solid var(--color-border); overflow: hidden; background-color: var(--color-header-bg); flex-shrink: 0;">
            <img src="<?= esc($artist['avatar'] ?: '/assets/cover1.jpg') ?>" alt="<?= esc($artist['nombre_artistico']) ?>" style="width: 100%; height: 100%; object-fit: cover; display: block;">
          </div>

          <!-- Datos Principales e Insignia -->
          <div style="flex: 1; min-width: 300px;">
            <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
              <h1 class="profile-name" style="font-size: clamp(2.8rem, 5vw, 4.5rem); margin: 0; line-height: 1;">
                <?= esc($artist['nombre_artistico'] ?: ($artist['user_nombre'] . ' ' . $artist['user_apellido'])) ?>
              </h1>
              
              <!-- Check de Verificación Oficial -->
              <?php if ($artist['verificado']): ?>
                <span title="Artista Verificado Oficial" style="display: inline-flex; align-items: center; gap: 0.4rem; background: var(--color-text-primary); color: var(--color-btn-text); padding: 0.35rem 0.8rem; font-family: var(--font-secondary); font-size: 0.7rem; font-weight: 700; letter-spacing: 0.15em;">
                  ✓ VERIFICADO
                </span>
              <?php endif; ?>
            </div>

            <!-- Ubicación -->
            <?php if (!empty($artist['ubicacion'])): ?>
              <div style="display: inline-flex; align-items: center; gap: 0.6rem; margin-top: 1rem;">
                <span class="editorial-meta" style="margin: 0; letter-spacing: 0.15em;">
                  📍 UBICACIÓN: <?= esc(strtoupper($artist['ubicacion'])) ?>
                </span>
              </div>
            <?php endif; ?>

            <!-- Nombre real del creador -->
            <p style="font-family: var(--font-secondary); font-size: 0.9rem; color: var(--color-text-muted); margin-top: 0.6rem;">
              CREADOR: <?= esc($artist['user_nombre'] . ' ' . $artist['user_apellido']) ?> · CONTACTO: <?= esc($artist['email']) ?>
            </p>

            <!-- Redes y Plataformas Conectadas -->
            <?php if (!empty($artist['spotify']) || !empty($artist['soundcloud']) || !empty($artist['instagram'])): ?>
              <div class="links-flex-row" style="margin-top: 1.8rem;">
                <?php if (!empty($artist['spotify'])): ?>
                  <a href="<?= esc($artist['spotify']) ?>" target="_blank" class="artist-link-badge">↗ SPOTIFY</a>
                <?php endif; ?>
                <?php if (!empty($artist['soundcloud'])): ?>
                  <a href="<?= esc($artist['soundcloud']) ?>" target="_blank" class="artist-link-badge">↗ SOUNDCLOUD</a>
                <?php endif; ?>
                <?php if (!empty($artist['instagram'])): ?>
                  <a href="<?= esc($artist['instagram']) ?>" target="_blank" class="artist-link-badge">↗ INSTAGRAM / RA</a>
                <?php endif; ?>
              </div>
            <?php endif; ?>

          </div>
        </div>

        <!-- Biografía / Manifiesto -->
        <div style="border-top: 1px solid var(--color-border); margin-top: 3.5rem; padding-top: 2.5rem;">
          <span class="editorial-meta">MANIFIESTO Y PROPUESTA SONORA</span>
          <?php if (!empty($artist['biografia'])): ?>
            <p class="intro-description" style="font-size: 1.15rem; line-height: 1.8; color: var(--color-text-primary); max-width: 900px;">
              <?= nl2br(esc($artist['biografia'])) ?>
            </p>
          <?php else: ?>
            <p style="font-family: var(--font-secondary); color: var(--color-text-muted); font-style: italic;">
              Este creador aún no ha redactado su manifiesto sonoro oficial.
            </p>
          <?php endif; ?>
        </div>

        <!-- Obras y Adquisición Directa -->
        <div style="border-top: 1px solid var(--color-border); margin-top: 3.5rem; padding-top: 2.5rem;">
          <span class="editorial-meta">LANZAMIENTOS Y ARCHIVOS DE ESTUDIO DISPONIBLES</span>
          <p style="margin-bottom: 2rem;">Los masters bit-perfect y producciones de este artista están distribuidos a través del santuario de PORTALE.</p>
          
          <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
            <a href="/marketplace.html" class="btn-solid">Explorar Catálogo en Marketplace →</a>
            <a href="/" class="btn-solid" style="background: transparent; color: var(--color-text-primary);">Volver al Inicio</a>
          </div>
        </div>

      </article>

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
      <li><a href="/perfil">Mi Perfil</a></li>
    </ul>
  </footer>

  <script src="/main.js"></script>
</body>
</html>
