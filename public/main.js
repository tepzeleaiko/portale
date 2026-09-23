/* ==========================================
   PORTALE — Marketplace Engine, 30s Background Rotator, Cursor Trail & Account System
   ========================================== */

const MARKETPLACE_CATALOG = [
  {
    id: 'PL-006',
    title: 'Austerity Sonar',
    artist: 'Tiziano Fardini',
    genre: 'Techno',
    bpm: 124,
    key: '7A (D Minor)',
    price: 15.00,
    artwork: './assets/cover1.jpg',
    formats: ['WAV 32-bit', 'FLAC', 'MP3 320'],
    soundCode: 'PL-001'
  },
  {
    id: 'PL-001',
    title: 'Architectures of Silence',
    artist: 'Aura & The Void',
    genre: 'Ambient',
    bpm: 0,
    key: 'Atmospheric Drone',
    price: 12.00,
    artwork: './assets/cover1.jpg',
    formats: ['WAV 32-bit', 'FLAC', 'MP3 320'],
    soundCode: 'PL-001'
  },
  {
    id: 'PL-002',
    title: 'Dark Mineral Frequencies',
    artist: 'Monolith Collective',
    genre: 'Techno',
    bpm: 128,
    key: '11A (F# Minor)',
    price: 14.00,
    artwork: './assets/cover2.jpg',
    formats: ['WAV 24-bit', 'FLAC', 'MP3 320'],
    soundCode: 'PL-002'
  },
  {
    id: 'PL-003',
    title: 'Monolith In Echo',
    artist: 'Kaelen Vance',
    genre: 'Deep House',
    bpm: 122,
    key: '8A (A Minor)',
    price: 13.50,
    artwork: './assets/cover3.jpg',
    formats: ['WAV 32-bit', 'FLAC', 'MP3 320'],
    soundCode: 'PL-003'
  },
  {
    id: 'PL-004',
    title: 'Verdant Resonance',
    artist: 'Elysian Systems',
    genre: 'Ambient',
    bpm: 75,
    key: '5A (C Minor)',
    price: 10.00,
    artwork: './assets/cover4.jpg',
    formats: ['WAV 24-bit', 'FLAC', 'MP3 320'],
    soundCode: 'PL-004'
  },
  {
    id: 'PL-005',
    title: 'Polychrome Strata',
    artist: 'Chronos Synth Suite',
    genre: 'Experimental',
    bpm: 130,
    key: '2A (E Minor)',
    price: 16.00,
    artwork: './assets/cover5.jpg',
    formats: ['WAV 32-bit', 'FLAC', 'MP3 320'],
    soundCode: 'PL-005'
  },
  {
    id: 'PL-007',
    title: 'Sub-Acoustic Monologue',
    artist: 'Sonder Soundworks',
    genre: 'Experimental',
    bpm: 118,
    key: '4A (F Minor)',
    price: 11.00,
    artwork: './assets/cover2.jpg',
    formats: ['WAV 32-bit', 'FLAC', 'MP3 320'],
    soundCode: 'PL-002'
  },
  {
    id: 'PL-008',
    title: 'Resonant Sanctuary Edit',
    artist: 'Tiziano Fardini',
    genre: 'Techno',
    bpm: 126,
    key: '9A (E Minor)',
    price: 15.00,
    artwork: './assets/cover3.jpg',
    formats: ['WAV 32-bit', 'FLAC', 'MP3 320'],
    soundCode: 'PL-003'
  }
];

document.addEventListener('DOMContentLoaded', () => {
  
  // 0. Dynamic 30-Second Random Background Rotator Engine
  const pageBackdrop = document.getElementById('page-backdrop');
  const backgroundList = [
    './assets/bg_marble1.jpg',
    './assets/bg_marble2.jpg',
    './assets/bg_ice.jpg',
    './assets/bg_brutalist.jpg',
    './assets/bg_desert.jpg',
    './assets/bg_lake.jpg'
  ];

  let currentBgIndex = 0;

  if (pageBackdrop) {
    setInterval(() => {
      let nextIndex;
      do {
        nextIndex = Math.floor(Math.random() * backgroundList.length);
      } while (nextIndex === currentBgIndex && backgroundList.length > 1);

      currentBgIndex = nextIndex;
      const newImage = backgroundList[currentBgIndex];

      pageBackdrop.style.opacity = '0.2';
      setTimeout(() => {
        pageBackdrop.style.backgroundImage = `url('${newImage}')`;
        pageBackdrop.style.opacity = '1';
      }, 700);
    }, 30000);
  }

  // 1. Dynamic Diffuse Cursor Light Trail Canvas Engine
  const cursorCanvas = document.getElementById('cursor-canvas');
  if (cursorCanvas) {
    const ctx = cursorCanvas.getContext('2d');
    let width = (cursorCanvas.width = window.innerWidth);
    let height = (cursorCanvas.height = window.innerHeight);

    window.addEventListener('resize', () => {
      width = cursorCanvas.width = window.innerWidth;
      height = cursorCanvas.height = window.innerHeight;
    });

    const particles = [];
    const maxParticles = 35;
    let mouseX = -100;
    let mouseY = -100;

    window.addEventListener('mousemove', (e) => {
      mouseX = e.clientX;
      mouseY = e.clientY;

      particles.push({
        x: mouseX,
        y: mouseY,
        size: Math.random() * 24 + 18,
        alpha: 0.4,
        vx: (Math.random() - 0.5) * 0.4,
        vy: (Math.random() - 0.5) * 0.4
      });

      if (particles.length > maxParticles) {
        particles.shift();
      }
    });

    function renderCursorTrail() {
      ctx.clearRect(0, 0, width, height);

      const isDark = document.documentElement.getAttribute('data-theme') !== 'light';

      for (let i = 0; i < particles.length; i++) {
        const p = particles[i];
        p.x += p.vx;
        p.y += p.vy;
        p.alpha *= 0.93;
        p.size *= 0.97;

        if (p.alpha > 0.01) {
          ctx.beginPath();
          const radialGlow = ctx.createRadialGradient(p.x, p.y, 0, p.x, p.y, p.size);
          
          if (isDark) {
            radialGlow.addColorStop(0, `rgba(245, 242, 235, ${p.alpha * 0.45})`);
            radialGlow.addColorStop(0.5, `rgba(212, 175, 55, ${p.alpha * 0.18})`);
            radialGlow.addColorStop(1, 'rgba(255, 255, 255, 0)');
          } else {
            radialGlow.addColorStop(0, `rgba(20, 20, 20, ${p.alpha * 0.35})`);
            radialGlow.addColorStop(0.5, `rgba(80, 80, 80, ${p.alpha * 0.12})`);
            radialGlow.addColorStop(1, 'rgba(0, 0, 0, 0)');
          }

          ctx.fillStyle = radialGlow;
          ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
          ctx.fill();
        }
      }

      requestAnimationFrame(renderCursorTrail);
    }

    renderCursorTrail();
  }

  // 2. Theme Engine
  const themeToggle = document.getElementById('themeToggle');
  const themeLabel = document.getElementById('themeLabel');
  const htmlElement = document.documentElement;

  const savedTheme = localStorage.getItem('portale-theme') || 'dark';
  setTheme(savedTheme);

  function setTheme(theme) {
    htmlElement.setAttribute('data-theme', theme);
    localStorage.setItem('portale-theme', theme);
    if (themeLabel) {
      themeLabel.textContent = theme === 'dark' ? '[ MODE: DARK ]' : '[ MODE: LIGHT ]';
    }
  }

  if (themeToggle) {
    themeToggle.addEventListener('click', () => {
      const currentTheme = htmlElement.getAttribute('data-theme') || 'dark';
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      setTheme(newTheme);
    });
  }

  // 3. Scroll Reveal Animations Engine
  const revealElements = document.querySelectorAll('.reveal-on-scroll');
  
  if (revealElements.length > 0 && 'IntersectionObserver' in window) {
    const observerOptions = {
      root: null,
      threshold: 0.12,
      rootMargin: '0px 0px -50px 0px'
    };

    const revealObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    revealElements.forEach(el => revealObserver.observe(el));
  } else {
    revealElements.forEach(el => el.classList.add('is-visible'));
  }

  // 4. Marketplace Directory Filtering Engine
  const marketplaceGrid = document.getElementById('marketplaceGrid');
  const marketSearch = document.getElementById('marketSearch');
  const filterGenre = document.getElementById('filterGenre');
  const filterBpm = document.getElementById('filterBpm');
  const filterFormat = document.getElementById('filterFormat');
  const filterSort = document.getElementById('filterSort');
  const resultsCount = document.getElementById('resultsCount');
  const resetFiltersBtn = document.getElementById('resetFiltersBtn');

  function renderMarketplaceCards(items) {
    if (!marketplaceGrid) return;
    marketplaceGrid.innerHTML = '';

    if (items.length === 0) {
      marketplaceGrid.innerHTML = `
        <div style="grid-column: span 12; padding: 4rem 0; text-align: center;">
          <span class="editorial-meta">[ NO MATCHING SOUND RELEASES FOUND ]</span>
          <p>Try resetting search terms or adjusting your genre / BPM filters.</p>
        </div>
      `;
      if (resultsCount) resultsCount.textContent = `SHOWING 0 RELEASES`;
      return;
    }

    if (resultsCount) resultsCount.textContent = `SHOWING ${items.length} OF ${MARKETPLACE_CATALOG.length} RELEASES`;

    items.forEach(item => {
      const card = document.createElement('article');
      card.className = 'market-card';

      const bpmText = item.bpm > 0 ? `${item.bpm} BPM` : 'AMBIENT';

      card.innerHTML = `
        <div>
          <figure class="market-artwork">
            <img src="${item.artwork}" alt="${item.title}" class="market-img">
          </figure>
          <span class="market-cat-tag">[ ${item.id} ]</span>
          <h3 class="market-title">${item.title}</h3>
          <p class="market-artist">BY ${item.artist.toUpperCase()}</p>

          <div class="market-tag-flex">
            <span class="market-badge">${item.genre}</span>
            <span class="market-badge">${bpmText}</span>
            <span class="market-badge">${item.key}</span>
          </div>
        </div>

        <div>
          <div class="market-price-row">
            <span class="editorial-meta" style="margin-bottom:0;">DIRECT ACQUISITION</span>
            <span class="market-price-val">$${item.price.toFixed(2)} USD</span>
          </div>

          <div class="market-actions-row">
            <button class="btn-solid btn-full preview-btn" data-track="${item.soundCode}" data-title="${item.title}">
              Preview [0:30]
            </button>
            <button class="btn-solid btn-full buy-release-btn" data-id="${item.id}" data-title="${item.title}" data-price="${item.price}">
              Acquire Master
            </button>
          </div>
        </div>
      `;

      marketplaceGrid.appendChild(card);
    });

    // Rebind audio preview buttons for new cards
    document.querySelectorAll('.marketplace-cards-grid .preview-btn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const trackCode = btn.getAttribute('data-track') || 'PL-001';
        const trackTitleText = btn.getAttribute('data-title') || 'Architectures of Silence';
        playTrackPreview(trackCode, trackTitleText);
      });
    });

    // Bind acquire buttons
    document.querySelectorAll('.buy-release-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const title = btn.getAttribute('data-title');
        const price = btn.getAttribute('data-price');
        alert(`[ PORTALE SANCTUARY ]: Direct acquisition initialized for "${title}" ($${price} USD). Please complete registration or login.`);
        window.location.href = 'register.html';
      });
    });
  }

  function filterAndSortMarketplace() {
    if (!marketplaceGrid) return;

    let filtered = [...MARKETPLACE_CATALOG];

    // Search filter (Title / Artist)
    const searchTerm = marketSearch ? marketSearch.value.trim().toLowerCase() : '';
    if (searchTerm) {
      filtered = filtered.filter(item => 
        item.title.toLowerCase().includes(searchTerm) ||
        item.artist.toLowerCase().includes(searchTerm) ||
        item.id.toLowerCase().includes(searchTerm)
      );
    }

    // Genre Filter
    const genreVal = filterGenre ? filterGenre.value : 'all';
    if (genreVal !== 'all') {
      filtered = filtered.filter(item => item.genre === genreVal);
    }

    // BPM Filter
    const bpmVal = filterBpm ? filterBpm.value : 'all';
    if (bpmVal === 'ambient') {
      filtered = filtered.filter(item => item.bpm === 0);
    } else if (bpmVal === 'low') {
      filtered = filtered.filter(item => item.bpm > 0 && item.bpm < 120);
    } else if (bpmVal === 'mid') {
      filtered = filtered.filter(item => item.bpm >= 120 && item.bpm <= 126);
    } else if (bpmVal === 'high') {
      filtered = filtered.filter(item => item.bpm > 126);
    }

    // Audio Format Filter
    const formatVal = filterFormat ? filterFormat.value : 'all';
    if (formatVal !== 'all') {
      filtered = filtered.filter(item => item.formats.includes(formatVal));
    }

    // Sorting
    const sortVal = filterSort ? filterSort.value : 'default';
    if (sortVal === 'price-asc') {
      filtered.sort((a, b) => a.price - b.price);
    } else if (sortVal === 'price-desc') {
      filtered.sort((a, b) => b.price - a.price);
    } else if (sortVal === 'bpm-asc') {
      filtered.sort((a, b) => a.bpm - b.bpm);
    } else if (sortVal === 'title-asc') {
      filtered.sort((a, b) => a.title.localeCompare(b.title));
    }

    renderMarketplaceCards(filtered);
  }

  if (marketplaceGrid) {
    renderMarketplaceCards(MARKETPLACE_CATALOG);

    if (marketSearch) marketSearch.addEventListener('input', filterAndSortMarketplace);
    if (filterGenre) filterGenre.addEventListener('change', filterAndSortMarketplace);
    if (filterBpm) filterBpm.addEventListener('change', filterAndSortMarketplace);
    if (filterFormat) filterFormat.addEventListener('change', filterAndSortMarketplace);
    if (filterSort) filterSort.addEventListener('change', filterAndSortMarketplace);

    if (resetFiltersBtn) {
      resetFiltersBtn.addEventListener('click', () => {
        if (marketSearch) marketSearch.value = '';
        if (filterGenre) filterGenre.value = 'all';
        if (filterBpm) filterBpm.value = 'all';
        if (filterFormat) filterFormat.value = 'all';
        if (filterSort) filterSort.value = 'default';
        renderMarketplaceCards(MARKETPLACE_CATALOG);
      });
    }
  }

  // 5. User & Artist Registration Engine
  const tabUser = document.getElementById('tabUser');
  const tabArtist = document.getElementById('tabArtist');
  const accountRoleInput = document.getElementById('accountRole');
  const artistFields = document.getElementById('artistFields');
  const registerForm = document.getElementById('registerForm');
  const userProfileCard = document.getElementById('userProfileCard');

  let generatedCode = null;
  let isVerified = false;

  const sendCodeBtn = document.getElementById('sendCodeBtn');
  const verifyCodeBtn = document.getElementById('verifyCodeBtn');
  const regEmail = document.getElementById('regEmail');
  const verificationStep = document.getElementById('verificationStep');
  const codeStatus = document.getElementById('codeStatus');
  const regCodeInput = document.getElementById('regCode');

  const uploadAvatarBtn = document.getElementById('uploadAvatarBtn');
  const regAvatarInput = document.getElementById('regAvatarInput');
  const avatarImage = document.getElementById('avatarImage');
  const avatarPlaceholderText = document.getElementById('avatarPlaceholderText');
  let avatarDataUrl = '';

  if (tabUser && tabArtist) {
    tabUser.addEventListener('click', () => {
      tabUser.classList.add('active');
      tabUser.setAttribute('aria-selected', 'true');
      tabArtist.classList.remove('active');
      tabArtist.setAttribute('aria-selected', 'false');
      if (accountRoleInput) accountRoleInput.value = 'user';
      if (artistFields) artistFields.style.display = 'none';
    });

    tabArtist.addEventListener('click', () => {
      tabArtist.classList.add('active');
      tabArtist.setAttribute('aria-selected', 'true');
      tabUser.classList.remove('active');
      tabUser.setAttribute('aria-selected', 'false');
      if (accountRoleInput) accountRoleInput.value = 'artist';
      if (artistFields) artistFields.style.display = 'block';
    });
  }

  if (sendCodeBtn && regEmail) {
    sendCodeBtn.addEventListener('click', () => {
      const emailValue = regEmail.value.trim();
      if (!emailValue || !emailValue.includes('@')) {
        alert('Please enter a valid Gmail / Email address.');
        return;
      }

      generatedCode = Math.floor(100000 + Math.random() * 900000).toString();
      sendCodeBtn.textContent = 'Code Sent!';
      sendCodeBtn.style.opacity = '0.7';
      if (verificationStep) verificationStep.style.display = 'block';

      if (codeStatus) {
        codeStatus.style.color = 'var(--color-text-primary)';
        codeStatus.textContent = `SIMULATION: Verification code [ ${generatedCode} ] sent to ${emailValue}.`;
      }
    });
  }

  if (verifyCodeBtn && regCodeInput) {
    verifyCodeBtn.addEventListener('click', () => {
      const enteredCode = regCodeInput.value.trim();
      if (enteredCode === generatedCode) {
        isVerified = true;
        codeStatus.style.color = '#4CAF50';
        codeStatus.textContent = '✓ Email address verified successfully.';
        verifyCodeBtn.textContent = 'Verified ✓';
        verifyCodeBtn.disabled = true;
      } else {
        isVerified = false;
        codeStatus.style.color = '#F44336';
        codeStatus.textContent = '✕ Invalid verification code.';
      }
    });
  }

  if (uploadAvatarBtn && regAvatarInput) {
    uploadAvatarBtn.addEventListener('click', () => regAvatarInput.click());

    regAvatarInput.addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (event) => {
          avatarDataUrl = event.target.result;
          if (avatarImage) {
            avatarImage.src = avatarDataUrl;
            avatarImage.style.display = 'block';
          }
          if (avatarPlaceholderText) avatarPlaceholderText.style.display = 'none';
        };
        reader.readAsDataURL(file);
      }
    });
  }

  if (registerForm) {
    registerForm.addEventListener('submit', (e) => {
      e.preventDefault();

      const role = accountRoleInput.value;
      const email = regEmail.value.trim();
      const username = document.getElementById('regUsername').value.trim();

      const spotify = document.getElementById('linkSpotify') ? document.getElementById('linkSpotify').value.trim() : '';
      const soundcloud = document.getElementById('linkSoundcloud') ? document.getElementById('linkSoundcloud').value.trim() : '';
      const beatport = document.getElementById('linkBeatport') ? document.getElementById('linkBeatport').value.trim() : '';
      const tidal = document.getElementById('linkTidal') ? document.getElementById('linkTidal').value.trim() : '';
      const apple = document.getElementById('linkApple') ? document.getElementById('linkApple').value.trim() : '';
      const instagram = document.getElementById('linkInstagram') ? document.getElementById('linkInstagram').value.trim() : '';

      const userData = {
        role,
        email,
        username,
        avatar: avatarDataUrl || './assets/cover1.jpg',
        artistLinks: { spotify, soundcloud, beatport, tidal, apple, instagram }
      };

      localStorage.setItem('portale_user', JSON.stringify(userData));
      displayUserAccount(userData);
    });
  }

  function displayUserAccount(data) {
    if (registerForm) registerForm.style.display = 'none';
    if (userProfileCard) userProfileCard.style.display = 'block';

    const activeUsername = document.getElementById('activeUsername');
    const activeEmail = document.getElementById('activeEmail');
    const activeRoleTag = document.getElementById('activeRoleTag');
    const activeAvatarImg = document.getElementById('activeAvatarImg');
    const activeArtistLinks = document.getElementById('activeArtistLinks');
    const linksList = document.getElementById('linksList');
    const navAccountBtn = document.getElementById('navAccountBtn');

    if (activeUsername) activeUsername.textContent = data.username;
    if (activeEmail) activeEmail.textContent = data.email;
    if (activeRoleTag) activeRoleTag.textContent = data.role === 'artist' ? '[ ARTIST & PRODUCER ]' : '[ LISTENER & DJ ]';
    if (activeAvatarImg) activeAvatarImg.src = data.avatar;
    if (navAccountBtn) navAccountBtn.textContent = `[ ${data.username} ]`;

    if (data.role === 'artist' && linksList && activeArtistLinks) {
      activeArtistLinks.style.display = 'block';
      linksList.innerHTML = '';

      Object.entries(data.artistLinks).forEach(([platform, url]) => {
        if (url) {
          const badge = document.createElement('a');
          badge.href = url;
          badge.target = '_blank';
          badge.className = 'artist-link-badge';
          badge.textContent = `↗ ${platform.toUpperCase()}`;
          linksList.appendChild(badge);
        }
      });
    }
  }

  const storedUser = localStorage.getItem('portale_user');
  if (storedUser) {
    try {
      const parsedUser = JSON.parse(storedUser);
      if (window.location.pathname.includes('register.html')) {
        displayUserAccount(parsedUser);
      } else {
        const navAccountBtn = document.getElementById('navAccountBtn');
        if (navAccountBtn) navAccountBtn.textContent = `[ ${parsedUser.username} ]`;
      }
    } catch (e) {}
  }

  const logoutBtn = document.getElementById('logoutBtn');
  if (logoutBtn) {
    logoutBtn.addEventListener('click', () => {
      localStorage.removeItem('portale_user');
      window.location.reload();
    });
  }

  // 6. Web Audio Synthesizer Engine
  let audioCtx = null;
  let isAudioPlaying = false;
  let activeNodes = [];
  let currentTrackTitle = '';

  const soundToast = document.getElementById('soundToast');
  const toastTitle = document.getElementById('toastTitle');
  const toastSub = document.getElementById('toastSub');
  const toastClose = document.getElementById('toastClose');

  const trackFrequencies = {
    'PL-001': [146.83, 220.00, 261.63, 329.63, 440.00],
    'PL-002': [110.00, 164.81, 196.00, 246.94, 293.66],
    'PL-003': [130.81, 196.00, 261.63, 392.00, 523.25],
    'PL-004': [164.81, 246.94, 329.63, 392.00, 493.88],
    'PL-005': [174.61, 261.63, 349.23, 440.00, 523.25]
  };

  function initAudio() {
    if (!audioCtx) {
      const AudioContext = window.AudioContext || window.webkitAudioContext;
      audioCtx = new AudioContext();
    }
  }

  function playTrackPreview(trackCode, trackTitleText) {
    initAudio();
    if (audioCtx.state === 'suspended') {
      audioCtx.resume();
    }

    if (isAudioPlaying && currentTrackTitle === trackTitleText) {
      stopAmbientPreview();
      return;
    }

    if (isAudioPlaying) {
      stopAmbientPreview();
    }

    isAudioPlaying = true;
    currentTrackTitle = trackTitleText;

    if (toastTitle) toastTitle.textContent = trackTitleText;
    if (toastSub) toastSub.textContent = `${trackCode} — 30S AUDIOPHILE PREVIEW ACTIVE`;
    if (soundToast) soundToast.classList.add('active');

    const freqs = trackFrequencies[trackCode] || trackFrequencies['PL-001'];

    freqs.forEach((freq, idx) => {
      const osc = audioCtx.createOscillator();
      const gain = audioCtx.createGain();
      const filter = audioCtx.createBiquadFilter();

      osc.type = idx % 2 === 0 ? 'sine' : 'triangle';
      osc.frequency.setValueAtTime(freq, audioCtx.currentTime);

      filter.type = 'lowpass';
      filter.frequency.setValueAtTime(500 + idx * 180, audioCtx.currentTime);

      gain.gain.setValueAtTime(0, audioCtx.currentTime);
      gain.gain.linearRampToValueAtTime(0.07 / (idx + 1), audioCtx.currentTime + 1.8);

      osc.connect(filter);
      filter.connect(gain);
      gain.connect(audioCtx.destination);

      osc.start();
      activeNodes.push({ osc, gain });
    });

    setTimeout(() => {
      if (isAudioPlaying && currentTrackTitle === trackTitleText) stopAmbientPreview();
    }, 30000);
  }

  function stopAmbientPreview() {
    activeNodes.forEach(({ osc, gain }) => {
      try {
        gain.gain.linearRampToValueAtTime(0, audioCtx.currentTime + 0.8);
        setTimeout(() => osc.stop(), 800);
      } catch (e) {}
    });
    activeNodes = [];
    isAudioPlaying = false;
    currentTrackTitle = '';
    if (soundToast) soundToast.classList.remove('active');
  }

  document.querySelectorAll('.preview-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const trackCode = btn.getAttribute('data-track') || 'PL-001';
      const trackTitleText = btn.getAttribute('data-title') || 'Architectures of Silence';
      playTrackPreview(trackCode, trackTitleText);
    });
  });

  if (toastClose) {
    toastClose.addEventListener('click', stopAmbientPreview);
  }

  // Smooth Scroll
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;
      
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        targetElement.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });
});
