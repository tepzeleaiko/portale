<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PORTALE — Independent Music Marketplace & Contemporary Sound Institution</title>
  <meta name="description" content="PORTALE is an independent digital music marketplace and sanctuary where creators sell directly to listeners, DJs, and audiophiles.">
  <!-- Google Fonts: Bodoni Moda (Bodoni FLF equivalent) & Helvetica/Inter fallback -->
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
        <li><a href="/marketplace.html" class="nav-link">Marketplace</a></li>
        <li><a href="#intro" class="nav-link">About</a></li>
        <li><a href="#audiophile-dj" class="nav-link">Hi-Fi & DJ</a></li>
        <li><a href="#philosophy" class="nav-link">Philosophy</a></li>
        <li><a href="/releases.html" class="nav-link">Releases</a></li>
        <li>
          <button id="themeToggle" class="theme-toggle-btn" aria-label="Toggle light and dark mode">
            <span id="themeLabel">[ MODE: DARK ]</span>
          </button>
        </li>
        <?php if (session()->get('logged_in')): ?>
          <li><a href="/generos" class="nav-link">Géneros</a></li>
          <li><a href="/perfil" class="nav-link nav-login">[ <?= esc(session()->get('nombre')) ?> ]</a></li>
          <li><a href="/logout" class="nav-link" style="color:var(--color-text-muted);">Salir</a></li>
        <?php else: ?>
          <li><a href="/login" class="nav-link nav-login" id="navAccountBtn">Ingresar / Registro</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>

  <main>
    <!-- 1. Ultra-Minimal Editorial Hero Screen (Pure text, no releases on first glance) -->
    <section class="hero-section hero-pure-text reveal-on-scroll" id="hero">
      <div class="hero-minimal-container full-width-hero">
        <span class="editorial-meta">[ ARCHIVAL SOUND SANCTUARY ]</span>
        <h1 class="hero-headline-minimal">
          Beyond Streaming.
        </h1>
        <p class="hero-tagline-minimal">
          A passage into sound ownership.
        </p>

        <a href="#intro" class="scroll-indicator-link" aria-label="Scroll to enter portal">
          <span class="scroll-text">[ SCROLL TO ENTER ]</span>
          <span class="scroll-arrow">↓</span>
        </a>
      </div>
    </section>

    <div class="thin-separator"></div>

    <!-- 2. Introduction Section -->
    <section class="intro-section reveal-on-scroll" id="intro">
      <div class="editorial-12-grid">
        <div class="grid-col-4">
          <span class="editorial-meta">01 / THE PLATFORM</span>
        </div>
        <article class="grid-col-8 intro-content-box">
          <h2 class="intro-heading">
            PORTALE is an independent digital marketplace where creators sell directly to listeners, DJs, and audiophiles.
          </h2>
          <p class="intro-description">
            We restore intent, permanent ownership, and physical value to digital music. Free from algorithmic dilution, PORTALE operates as a contemporary sanctuary for sonic art.
          </p>
          <div style="margin-top: 2.5rem; display: flex; gap: 1.5rem; flex-wrap: wrap;">
            <a href="/marketplace.html" class="btn-solid">Enter Marketplace Directory →</a>
            <a href="/releases.html" class="btn-solid" style="background: transparent; color: var(--color-text-primary);">View Archival Catalogue</a>
          </div>
        </article>
      </div>
    </section>

    <div class="thin-separator"></div>

    <!-- 3. Audiophile & Electronic Music DJ Section -->
    <section class="audiophile-dj-section reveal-on-scroll" id="audiophile-dj">
      <header class="section-header-editorial">
        <span class="editorial-meta">02 / ACOUSTIC TARGET & SPECIFICATIONS</span>
        <h2 class="philosophy-main-title">
          Engineered for Audiophile Clarity and Electronic Music DJs.
        </h2>
      </header>

      <div class="editorial-12-grid">
        <!-- Audiophile Column -->
        <article class="grid-col-6 pillar-box">
          <span class="editorial-meta">[ AUDIOPHILE PROTOCOL ]</span>
          <h3 class="pillar-title">High-Fidelity Sound Reproduction</h3>
          <p class="pillar-text">
            For listeners seeking uncompromised acoustic fidelity. PORTALE delivers bit-perfect studio masters in 32-bit / 192kHz WAV and FLAC Lossless formats. Experience independent music without dynamic compression or signal colorization.
          </p>
          <ul class="pillar-list">
            <li>• Bit-Perfect Uncompressed WAV up to 32-bit / 192kHz</li>
            <li>• FLAC 24-bit Lossless Archival Masters</li>
            <li>• Pure Signal Path for Hi-Fi Acoustic Systems</li>
          </ul>
        </article>

        <!-- DJ Column -->
        <article class="grid-col-6 pillar-box">
          <span class="editorial-meta">[ ELECTRONIC MUSIC DJ ARCHIVE ]</span>
          <h3 class="pillar-title">Club-Ready & DJ Performance Tools</h3>
          <p class="pillar-text">
            For DJs and electronic music selectors requiring pristine independent sound. Every release comes tagged with precise BPM, Key metadata (Camelot Wheel), and extended DJ mixes ready for sound system deployment.
          </p>
          <ul class="pillar-list">
            <li>• Extended DJ Edits & Club Master WAV Downloads</li>
            <li>• Embedded BPM & Key Metadata (e.g. 124 BPM • Dm)</li>
            <li>• Direct Support for Independent Techno, House & Ambient Artists</li>
          </ul>
        </article>
      </div>
    </section>

    <div class="thin-separator"></div>

    <!-- 4. Philosophy Section -->
    <section class="philosophy-section reveal-on-scroll" id="philosophy">
      <header class="section-header-editorial">
        <span class="editorial-meta">03 / PHILOSOPHY</span>
        <h2 class="philosophy-main-title">
          Music should not simply be streamed. It must be owned, appreciated, and directly sustain its creator.
        </h2>
      </header>

      <div class="editorial-12-grid philosophy-grid">
        <article class="grid-col-6 philosophy-block">
          <span class="block-num">[ 01 ]</span>
          <h3>Music Has Become Disposable</h3>
          <p>
            Streaming changed accessibility but drastically reduced perceived value. In an age of infinite background playlists, profound artistic creation is treated as a temporary commodity.
          </p>
        </article>

        <article class="grid-col-6 philosophy-block">
          <span class="block-num">[ 02 ]</span>
          <h3>Accessibility vs. Perceived Value</h3>
          <p>
            When music costs fractions of a cent per stream, the emotional bond between creator and listener erodes. PORTALE exists to restore tangible reverence to sonic art.
          </p>
        </article>

        <article class="grid-col-6 philosophy-block">
          <span class="block-num">[ 03 ]</span>
          <h3>Fair Compensation</h3>
          <p>
            Independent artists deserve direct, uncompromised remuneration. True artistic independence thrives when creators are fully sustained by those who truly value their craft.
          </p>
        </article>

        <article class="grid-col-6 philosophy-block">
          <span class="block-num">[ 04 ]</span>
          <h3>Restoring Value Through Ownership</h3>
          <p>
            Owning music creates a stronger, permanent relationship between author and patron. PORTALE provides a digital sanctuary for authentic acoustic ownership.
          </p>
        </article>
      </div>
    </section>

    <!-- Marble Texture Block Section -->
    <div class="marble-banner-container reveal-on-scroll">
      <div class="marble-banner-image"></div>
      <div class="marble-banner-overlay-text">
        <span>SWISS EDITORIAL ARCHIVE — INSTITUTION OF SOUND</span>
      </div>
    </div>

    <!-- 5. Portal Concept Section -->
    <section class="portal-section reveal-on-scroll" id="portal-concept">
      <div class="editorial-12-grid">
        <div class="grid-col-5">
          <span class="editorial-meta">04 / THE CONCEPT</span>
          <blockquote class="portal-quote">
            “The portal represents the space between creation and appreciation.”
          </blockquote>
        </div>

        <article class="grid-col-7 portal-body">
          <p class="lead-text">
            The name <strong>PORTALE</strong> stems from the architectural concept of a portal—a physical or ceremonial passage connecting two distinct worlds.
          </p>
          <p>
            We define PORTALE as the space between the artist's studio and the listener’s sanctuary. We reject algorithmic curation in favor of deliberate, intentional artistic exchange.
          </p>
          
          <div class="architectural-diagram">
            <div class="diagram-node">CREATION</div>
            <div class="diagram-line"></div>
            <div class="diagram-node node-active">PORTALE</div>
            <div class="diagram-line"></div>
            <div class="diagram-node">APPRECIATION</div>
          </div>
        </article>
      </div>
    </section>

    <div class="thin-separator"></div>

    <!-- 6. Mission Section -->
    <section class="mission-section reveal-on-scroll" id="mission">
      <header class="mission-header">
        <span class="editorial-meta">05 / MISSION & SPECIFICATIONS</span>
        <h2 class="mission-title">
          Support independent artists through fair commissions, high-quality downloads and transparent digital ownership.
        </h2>
      </header>

      <div class="specs-wrapper">
        <table class="specs-table" aria-label="Format Specifications">
          <thead>
            <tr>
              <th scope="col">SPEC</th>
              <th scope="col">FORMAT</th>
              <th scope="col">TECHNICAL DELIVERABLE</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>[ 320 ]</td>
              <td>MP3 320 kbps</td>
              <td>High-bitrate mobile distribution format for immediate audio playback.</td>
            </tr>
            <tr>
              <td>[ FLAC ]</td>
              <td>FLAC Lossless</td>
              <td>Bit-perfect uncompressed audio preserving original studio master acoustics.</td>
            </tr>
            <tr>
              <td>[ WAV ]</td>
              <td>WAV up to 32-bit / 192kHz</td>
              <td>Ultra-high-definition master files engineered for audiophile setups and club sound systems.</td>
            </tr>
            <tr>
              <td>[ PREVIEW ]</td>
              <td>30-Second Previews</td>
              <td>Tactile 30-second audio previews prior to purchasing to ensure conscious acquisition.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- 7. Final CTA -->
    <section class="cta-section reveal-on-scroll" id="final-cta">
      <div class="cta-inner">
        <span class="editorial-meta">06 / PASSAGE</span>
        <h2 class="cta-heading">Enter Portale</h2>
        <a href="/marketplace.html" class="btn-solid btn-large">Enter Marketplace Directory</a>
      </div>
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
      <li><a href="#philosophy">Philosophy</a></li>
      <?php if (session()->get('logged_in')): ?>
        <li><a href="/perfil">Perfil</a></li>
        <li><a href="/generos">Géneros</a></li>
        <li><a href="/logout">Salir</a></li>
      <?php else: ?>
        <li><a href="/login">Login</a></li>
        <li><a href="/register">Register</a></li>
      <?php endif; ?>
    </ul>
  </footer>

  <!-- Audio Toast -->
  <aside class="sound-toast" id="soundToast" aria-live="polite">
    <div class="toast-indicator"></div>
    <div class="toast-info">
      <span class="toast-title" id="toastTitle">Architectures of Silence</span>
      <span class="toast-sub" id="toastSub">30S AUDIOPHILE PREVIEW ACTIVE</span>
    </div>
    <button class="toast-close" id="toastClose" aria-label="Close audio preview">&times;</button>
  </aside>

  <script src="/main.js"></script>
</body>
</html>
