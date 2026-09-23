<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PORTALE — Catálogo de Géneros</title>
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
    <section class="marketplace-hero-section reveal-on-scroll">
      <div class="editorial-12-grid">
        <div class="grid-col-12" style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 2rem;">
          <div>
            <span class="editorial-meta">MÓDULO FUNCIONAL HITO 1 · ENTIDAD SECUNDARIA</span>
            <h1 class="catalog-main-heading" style="font-size: clamp(3rem, 6vw, 5rem);">Géneros Musicales.</h1>
            <p class="catalog-sub-lead" style="margin-top: 1rem;">
              Taxonomía sonora de PORTALE: clasificación acústica para lanzamientos, vinilos digitales y sesiones de club.
            </p>
          </div>
          <?php if (session()->get('rol') === 'Administrador'): ?>
            <div>
              <a href="/generos/nuevo" class="btn-solid">+ Crear Nuevo Género</a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <div class="thin-separator"></div>

    <section class="catalog-section reveal-on-scroll" style="padding-top: 4rem;">
      <div style="max-width: 1400px; margin: 0 auto;">

        <!-- Mensajes Flash -->
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

        <!-- Tabla Editorial de Géneros -->
        <div class="specs-wrapper">
          <table class="specs-table" aria-label="Listado de Géneros">
            <thead>
              <tr>
                <th scope="col" style="width: 15%;">CÓDIGO</th>
                <th scope="col" style="width: 50%;">DENOMINACIÓN DEL GÉNERO</th>
                <th scope="col" style="width: 35%; text-align: right;">ACCIONES DISPONIBLES</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($genres)): ?>
                <tr>
                  <td colspan="3" style="text-align: center; padding: 4rem 0;">
                    <span class="editorial-meta">[ NO EXISTEN GÉNEROS REGISTRADOS ]</span>
                  </td>
                </tr>
              <?php else: ?>
                <?php foreach ($genres as $genre): ?>
                  <tr>
                    <td>[ GEN-<?= str_pad((string)$genre['id_genero'], 3, '0', STR_PAD_LEFT) ?> ]</td>
                    <td style="font-family: var(--font-primary); font-size: 1.8rem;">
                      <?= esc($genre['nombre']) ?>
                    </td>
                    <td style="text-align: right;">
                      <?php if (session()->get('rol') === 'Administrador'): ?>
                        <div style="display: inline-flex; gap: 0.8rem; justify-content: flex-end; align-items: center;">
                          <a href="/generos/editar/<?= $genre['id_genero'] ?>" class="btn-solid btn-sm" style="padding: 0.6rem 1.2rem;">Editar</a>
                          <form method="post" action="/generos/eliminar/<?= $genre['id_genero'] ?>" style="display: inline;" onsubmit="return confirm('¿Confirmás eliminar el género «<?= esc($genre['nombre']) ?>»?');">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn-solid btn-sm" style="padding: 0.6rem 1.2rem; background: transparent; color: #F44336; border-color: #F44336;">
                              Eliminar
                            </button>
                          </form>
                        </div>
                      <?php else: ?>
                        <span class="editorial-meta" style="margin: 0; display: inline-block;">[ SÓLO LECTURA ]</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <div style="margin-top: 3rem; display: flex; justify-content: space-between; align-items: center;">
          <a href="/perfil" class="scroll-indicator-link">← Volver al Perfil</a>
          <span class="editorial-meta" style="margin: 0;">TOTAL: <?= count($genres) ?> GÉNEROS EN CATÁLOGO</span>
        </div>

      </div>
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
      <li><a href="/perfil">Perfil</a></li>
      <li><a href="/logout">Salir</a></li>
    </ul>
  </footer>

  <script src="/main.js"></script>
</body>
</html>
