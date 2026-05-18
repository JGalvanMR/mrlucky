<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Boletín Informativo No. 14 · Grupo U</title>
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/page-flip@2.0.7/dist/js/page-flip.browser.js"></script>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

:root {
  --green:       #2e7d32;
  --green-mid:   #43a047;
  --green-light: #81c784;
  --blue:        #1565c0;
  --blue-mid:    #1976d2;
  --gold:        #b8975a;
  --bg-deep:     #0c0805;
  --bg-surface:  #18110a;
  --text-dim:    rgba(240,232,210,0.35);
  --text-muted:  rgba(240,232,210,0.55);
  --text-base:   rgba(240,232,210,0.88);
  --border:      rgba(255,255,255,0.07);
}

html, body { height: 100%; }

body {
  background-color: var(--bg-deep);
  background-image:
    radial-gradient(ellipse 120% 60% at 50% 0%, #2a1808 0%, transparent 70%),
    radial-gradient(ellipse 60% 40% at 80% 100%, #0a1522 0%, transparent 60%);
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  font-family: Georgia, 'Times New Roman', serif;
  color: var(--text-base);
  overflow: hidden;
  position: relative;
}

/* Subtle grain overlay */
body::before {
  content: '';
  position: fixed;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
  opacity: 0.025;
  pointer-events: none;
  z-index: 0;
}

/* ══════════════════════════════════════════
   HEADER
══════════════════════════════════════════ */
header {
  position: relative;
  z-index: 10;
  width: 100%;
  flex-shrink: 0;
  height: 58px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 28px;
  background: rgba(10,7,4,0.6);
  border-bottom: 1px solid var(--border);
  backdrop-filter: blur(12px);
}

.brand {
  display: flex;
  align-items: center;
  gap: 13px;
}

.brand-mark {
  width: 36px;
  height: 36px;
  border-radius: 8px;
  background: linear-gradient(135deg, var(--green) 0%, var(--blue) 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.brand-mark svg { display: block; }

.brand-copy .name {
  font-family: system-ui, sans-serif;
  font-size: 13px;
  font-weight: 600;
  letter-spacing: 0.3px;
  color: var(--text-base);
  line-height: 1;
}

.brand-copy .meta {
  font-family: system-ui, sans-serif;
  font-size: 10px;
  color: var(--text-dim);
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-top: 3px;
}

.header-right { display: flex; gap: 6px; align-items: center; }

.hdr-btn {
  width: 34px;
  height: 34px;
  border-radius: 7px;
  border: 1px solid var(--border);
  background: rgba(255,255,255,0.03);
  color: var(--text-muted);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.15s, color 0.15s;
}
.hdr-btn:hover {
  background: rgba(255,255,255,0.08);
  color: var(--text-base);
}
.hdr-btn svg { pointer-events: none; }

/* ══════════════════════════════════════════
   LOADING SCREEN
══════════════════════════════════════════ */
#loading {
  position: relative;
  z-index: 5;
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 22px;
}

.loader-book {
  animation: bookPulse 1.6s ease-in-out infinite;
}
@keyframes bookPulse {
  0%, 100% { opacity: 0.45; transform: translateY(0); }
  50%       { opacity: 1;    transform: translateY(-4px); }
}

.loading-label {
  font-family: system-ui, sans-serif;
  font-size: 11px;
  color: var(--text-dim);
  letter-spacing: 2.5px;
  text-transform: uppercase;
}

.loading-detail {
  font-family: system-ui, sans-serif;
  font-size: 13px;
  color: var(--text-muted);
  min-height: 18px;
  text-align: center;
}

.progress-rail {
  width: 260px;
  height: 2px;
  background: rgba(255,255,255,0.07);
  border-radius: 2px;
  overflow: hidden;
}

.progress-fill {
  height: 100%;
  width: 0%;
  background: linear-gradient(90deg, var(--green), var(--green-mid));
  border-radius: 2px;
  transition: width 0.35s ease;
}

/* ══════════════════════════════════════════
   ERROR
══════════════════════════════════════════ */
#error-screen {
  display: none;
  position: relative;
  z-index: 5;
  flex: 1;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 16px;
  padding: 40px;
  text-align: center;
}
.error-title {
  font-family: system-ui, sans-serif;
  font-size: 15px;
  color: #ef9a9a;
}
.error-body {
  font-family: system-ui, sans-serif;
  font-size: 12px;
  color: var(--text-dim);
  max-width: 380px;
  line-height: 1.7;
}
.error-code {
  font-family: monospace;
  font-size: 11px;
  color: var(--text-muted);
  background: rgba(255,255,255,0.05);
  border: 1px solid var(--border);
  border-radius: 6px;
  padding: 8px 16px;
  max-width: 380px;
  word-break: break-all;
}

/* ══════════════════════════════════════════
   VIEWER
══════════════════════════════════════════ */
#viewer {
  display: none;
  position: relative;
  z-index: 5;
  flex: 1;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 18px 80px 14px;
  gap: 18px;
  width: 100%;
  min-height: 0;
}

/* Book stage with ambient glow */
.stage {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
}

.stage::before {
  content: '';
  position: absolute;
  bottom: -30px;
  left: 50%;
  transform: translateX(-50%);
  width: 85%;
  height: 50px;
  background: radial-gradient(ellipse, rgba(46,125,50,0.15) 0%, transparent 70%);
  filter: blur(12px);
  pointer-events: none;
}

#flipbook {
  /* dimensions set dynamically */
  position: relative;
}

/* StPageFlip internal page style */
.page {
  overflow: hidden;
  background: #fff;
}
.page img {
  width: 100%;
  height: 100%;
  display: block;
  object-fit: fill;
}

/* ── Side arrow buttons ── */
.side-arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 46px;
  height: 90px;
  border: 1px solid var(--border);
  background: rgba(8,5,3,0.55);
  color: var(--text-muted);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.15s, color 0.15s, border-color 0.15s;
  backdrop-filter: blur(6px);
  z-index: 20;
}
.side-arrow:hover:not(:disabled) {
  background: rgba(8,5,3,0.85);
  color: var(--text-base);
  border-color: rgba(255,255,255,0.18);
}
.side-arrow:disabled { opacity: 0.2; cursor: default; }

.side-arrow.prev {
  right: calc(100% + 8px);
  border-radius: 8px 0 0 8px;
}
.side-arrow.next {
  left: calc(100% + 8px);
  border-radius: 0 8px 8px 0;
}

/* ── Bottom controls pill ── */
.controls {
  flex-shrink: 0;
  display: flex;
  align-items: center;
  gap: 6px;
  background: rgba(8,5,3,0.65);
  border: 1px solid var(--border);
  border-radius: 50px;
  padding: 6px 14px;
  backdrop-filter: blur(10px);
}

.ctrl-btn {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  border: 1px solid transparent;
  background: transparent;
  color: var(--text-muted);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.15s, color 0.15s, border-color 0.15s;
  font-size: 14px;
  line-height: 1;
}
.ctrl-btn:hover:not(:disabled) {
  background: rgba(255,255,255,0.06);
  color: var(--text-base);
  border-color: var(--border);
}
.ctrl-btn:disabled { opacity: 0.22; cursor: default; }

.ctrl-sep {
  width: 1px;
  height: 18px;
  background: var(--border);
  flex-shrink: 0;
}

.page-counter {
  font-family: system-ui, sans-serif;
  font-size: 11px;
  color: var(--text-muted);
  letter-spacing: 1px;
  min-width: 70px;
  text-align: center;
  flex-shrink: 0;
}

/* ── Keyboard hint ── */
.kbd-hint {
  flex-shrink: 0;
  font-family: system-ui, sans-serif;
  font-size: 10px;
  color: rgba(240,232,210,0.15);
  letter-spacing: 2.5px;
  text-transform: uppercase;
}

/* ══════════════════════════════════════════
   FULLSCREEN ADJUSTMENTS
══════════════════════════════════════════ */
:fullscreen #viewer { padding: 10px 80px 8px; }
:-webkit-full-screen #viewer { padding: 10px 80px 8px; }
</style>
</head>
<body>

<!-- ── Header ────────────────────────────── -->
<header>
  <div class="brand">
    <div class="brand-mark">
      <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
        <path d="M4 3L4 14C4 17.314 6.686 20 10 20C13.314 20 16 17.314 16 14L16 3" stroke="white" stroke-width="2.2" stroke-linecap="round"/>
        <circle cx="17" cy="5" r="2.5" fill="#81c784"/>
      </svg>
    </div>
    <div class="brand-copy">
      <div class="name">Boletín Informativo · Grupo U</div>
      <div class="meta">2026 &nbsp;·&nbsp; Irapuato, Gto. &nbsp;·&nbsp; No. 14</div>
    </div>
  </div>
  <div class="header-right">
    <button class="hdr-btn" id="btn-fs" onclick="toggleFullscreen()" title="Pantalla completa (F)">
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round">
        <path d="M2 5.5V2.5h3M11 2.5h3v3M14 10.5v3h-3M5 13.5H2v-3"/>
      </svg>
    </button>
  </div>
</header>

<!-- ── Loading ───────────────────────────── -->
<div id="loading">
  <svg class="loader-book" width="56" height="52" viewBox="0 0 56 52" fill="none">
    <rect x="2" y="2" width="22" height="48" rx="2" fill="none" stroke="rgba(255,255,255,0.12)" stroke-width="1.5"/>
    <rect x="32" y="2" width="22" height="48" rx="2" fill="none" stroke="rgba(255,255,255,0.12)" stroke-width="1.5"/>
    <line x1="8" y1="14" x2="18" y2="14" stroke="#43a047" stroke-width="1.5" stroke-linecap="round"/>
    <line x1="8" y1="20" x2="18" y2="20" stroke="#43a047" stroke-width="1.5" stroke-linecap="round"/>
    <line x1="8" y1="26" x2="14" y2="26" stroke="#43a047" stroke-width="1.5" stroke-linecap="round"/>
    <line x1="38" y1="14" x2="48" y2="14" stroke="#1976d2" stroke-width="1.5" stroke-linecap="round"/>
    <line x1="38" y1="20" x2="48" y2="20" stroke="#1976d2" stroke-width="1.5" stroke-linecap="round"/>
    <line x1="38" y1="26" x2="44" y2="26" stroke="#1976d2" stroke-width="1.5" stroke-linecap="round"/>
    <line x1="24" y1="2" x2="24" y2="50" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"/>
    <line x1="32" y1="2" x2="32" y2="50" stroke="rgba(255,255,255,0.2)" stroke-width="1.5"/>
  </svg>
  <div class="loading-label">Preparando boletín</div>
  <div class="loading-detail" id="load-detail">Cargando PDF...</div>
  <div class="progress-rail">
    <div class="progress-fill" id="progress-fill"></div>
  </div>
</div>

<!-- ── Error ─────────────────────────────── -->
<div id="error-screen">
  <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
    <circle cx="20" cy="20" r="18" stroke="#ef9a9a" stroke-width="1.5"/>
    <line x1="20" y1="12" x2="20" y2="22" stroke="#ef9a9a" stroke-width="2" stroke-linecap="round"/>
    <circle cx="20" cy="28" r="1.5" fill="#ef9a9a"/>
  </svg>
  <div class="error-title">No se pudo cargar el boletín</div>
  <div class="error-body">
    Asegúrate de que el archivo <strong>Boletin-14-Grupo-U.pdf</strong> esté en la
    misma carpeta que este HTML y que estés accediendo a través de un servidor web
    (no desde <code>file://</code>).
  </div>
  <div class="error-code" id="error-detail"></div>
</div>

<!-- ── Viewer ────────────────────────────── -->
<div id="viewer">
  <div class="stage" id="stage">
    <button class="side-arrow prev" id="btn-prev-s" onclick="prevPage()" title="Página anterior (←)">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="11 4 6 9 11 14"/>
      </svg>
    </button>

    <div id="flipbook"></div>

    <button class="side-arrow next" id="btn-next-s" onclick="nextPage()" title="Página siguiente (→)">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="7 4 12 9 7 14"/>
      </svg>
    </button>
  </div>

  <div class="controls">
    <button class="ctrl-btn" id="c-first" onclick="goToPage(0)" title="Primera página">
      <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
        <line x1="2" y1="2" x2="2" y2="12"/><polyline points="12 2 5 7 12 12"/>
      </svg>
    </button>
    <button class="ctrl-btn" id="c-prev" onclick="prevPage()" title="Anterior">
      <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="9 2 4 7 9 12"/>
      </svg>
    </button>
    <div class="ctrl-sep"></div>
    <div class="page-counter" id="page-counter">— / —</div>
    <div class="ctrl-sep"></div>
    <button class="ctrl-btn" id="c-next" onclick="nextPage()" title="Siguiente">
      <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="5 2 10 7 5 12"/>
      </svg>
    </button>
    <button class="ctrl-btn" id="c-last" onclick="goToLast()" title="Última página">
      <svg width="14" height="14" viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
        <line x1="12" y1="2" x2="12" y2="12"/><polyline points="2 2 9 7 2 12"/>
      </svg>
    </button>
  </div>

  <div class="kbd-hint">Arrastra las esquinas &nbsp;·&nbsp; Flechas del teclado &nbsp;·&nbsp; F = pantalla completa</div>
</div>

<script>
/* ═══════════════════════════════════════════════════
   CONFIG — ajusta estas variables según necesites
═══════════════════════════════════════════════════ */
const PDF_URL = "{{ $pdfUrl }}";
const SCALE     = 2.2;   // Calidad de renderizado (mayor = más nítido, más lento)
const JPEG_Q    = 0.92;  // Calidad JPEG de cada página (0–1)

/* ═══════════════════════════════════════════════════ */
pdfjsLib.GlobalWorkerOptions.workerSrc =
  'https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.worker.min.js';

let book       = null;
let totalFlipPages = 0;

/* ─── UI helpers ─────────────────────────────────── */
function setProgress(pct, detail) {
  document.getElementById('progress-fill').style.width = pct + '%';
  document.getElementById('load-detail').textContent   = detail;
}

function showError(msg) {
  document.getElementById('loading').style.display = 'none';
  const el = document.getElementById('error-screen');
  el.style.display = 'flex';
  document.getElementById('error-detail').textContent = msg || '';
}

/* ─── Canvas helpers ─────────────────────────────── */
async function renderPdfPage(pdf, pageNum) {
  const page     = await pdf.getPage(pageNum);
  const viewport = page.getViewport({ scale: SCALE });
  const canvas   = document.createElement('canvas');
  canvas.width   = viewport.width;
  canvas.height  = viewport.height;
  const ctx      = canvas.getContext('2d');
  await page.render({ canvasContext: ctx, viewport }).promise;
  return canvas;
}

function splitHalf(canvas, side /* 'left' | 'right' */) {
  const hw  = Math.floor(canvas.width / 2);
  const h   = canvas.height;
  const out = document.createElement('canvas');
  out.width = hw; out.height = h;
  out.getContext('2d').drawImage(
    canvas,
    side === 'left' ? 0 : hw, 0, hw, h,
    0, 0, hw, h
  );
  return out;
}

function canvasToDataURL(canvas) {
  return canvas.toDataURL('image/jpeg', JPEG_Q);
}

/* ─── Main loading logic ─────────────────────────── */
async function loadPDF() {
  try {
    setProgress(3, 'Cargando PDF...');
    const pdf      = await pdfjsLib.getDocument(PDF_URL).promise;
    const numPages = pdf.numPages;
    const images   = [];
    const pageW    = [];   // track portrait width for sizing

    for (let i = 1; i <= numPages; i++) {
      const pct = 5 + Math.round((i / numPages) * 88);
      setProgress(pct, `Procesando página ${i} de ${numPages}...`);

      /* Detect portrait vs landscape via raw PDF units (scale=1) */
      const rawPage = await pdf.getPage(i);
      const rawVP   = rawPage.getViewport({ scale: 1 });
      const isLandscape = rawVP.width > rawVP.height;

      const canvas = await renderPdfPage(pdf, i);

      if (isLandscape) {
        /* Split into left + right portrait halves */
        images.push(canvasToDataURL(splitHalf(canvas, 'left')));
        images.push(canvasToDataURL(splitHalf(canvas, 'right')));
        pageW.push(Math.floor(canvas.width / 2), Math.floor(canvas.width / 2));
      } else {
        images.push(canvasToDataURL(canvas));
        pageW.push(canvas.width);
      }
    }

    setProgress(100, 'Iniciando visor...');
    await new Promise(r => setTimeout(r, 250));
    initBook(images);

  } catch (err) {
    console.error('[Boletin Viewer]', err);
    showError(err.message || String(err));
  }
}

/* ─── Init flipbook ──────────────────────────────── */
function initBook(images) {
  document.getElementById('loading').style.display = 'none';
  const viewer = document.getElementById('viewer');
  viewer.style.display = 'flex';

  /* ── Calculate dimensions to fit viewport ── */
  const hdrH   = 58;
  const ctrlH  = 44 + 22 + 18 + 36; // controls bar + hint + gaps
  const padV   = 18 * 2;
  const padH   = 80 * 2;

  const avH = window.innerHeight - hdrH - ctrlH - padV;
  const avW = window.innerWidth  - padH;

  /* Page aspect from first image (all same size: 666×935 raw units) */
  const aspectH_W = 935 / 666; // ~1.404

  let pH = Math.min(avH, 780);
  let pW = Math.round(pH / aspectH_W);

  /* Make sure 2-page spread fits horizontally */
  if (pW * 2 > avW) {
    pW = Math.floor(avW / 2);
    pH = Math.round(pW * aspectH_W);
  }

  /* ── Build DOM pages ── */
  const container = document.getElementById('flipbook');
  container.innerHTML = '';

  images.forEach(src => {
    const div = document.createElement('div');
    div.className = 'page';
    const img = document.createElement('img');
    img.src = src;
    img.draggable = false;
    div.appendChild(img);
    container.appendChild(div);
  });

  totalFlipPages = images.length;

  /* ── Instantiate StPageFlip ── */
  book = new St.PageFlip(container, {
    width:               pW,
    height:              pH,
    size:                'fixed',
    drawShadow:          true,
    maxShadowOpacity:    0.55,
    flippingTime:        750,
    usePortrait:         false,   // always landscape/spread view
    startPage:           0,
    showCover:           true,    // cover & back shown alone
    mobileScrollSupport: true,
    clickEventForward:   true,
    useMouseEvents:      true,
    swipeDistance:       35,
    showPageCorners:     true,
    disableFlipByClick:  false,
  });

  book.loadFromHTML(container.querySelectorAll('.page'));
  book.on('flip',        syncUI);
  book.on('changeState', syncUI);

  syncUI();
}

/* ─── Navigation ─────────────────────────────────── */
function prevPage()  { book && book.flipPrev('bottom'); }
function nextPage()  { book && book.flipNext('bottom'); }
function goToPage(n) { book && book.flip(Math.min(n, totalFlipPages - 1)); }
function goToLast()  { goToPage(totalFlipPages - 1); }

/* ─── Sync all button states ─────────────────────── */
function syncUI() {
  if (!book) return;
  const cur   = book.getCurrentPageIndex();
  const total = book.getPageCount();

  document.getElementById('page-counter').textContent =
    `${cur + 1}\u2009/\u2009${total}`;

  const atStart = cur === 0;
  const atEnd   = cur >= total - 1;

  for (const id of ['c-first', 'c-prev', 'btn-prev-s'])
    document.getElementById(id).disabled = atStart;
  for (const id of ['c-last', 'c-next', 'btn-next-s'])
    document.getElementById(id).disabled = atEnd;
}

/* ─── Fullscreen ─────────────────────────────────── */
function toggleFullscreen() {
  if (!document.fullscreenElement) {
    document.documentElement.requestFullscreen().catch(() => {});
  } else {
    document.exitFullscreen().catch(() => {});
  }
}

/* ─── Keyboard shortcuts ─────────────────────────── */
document.addEventListener('keydown', e => {
  switch (e.key) {
    case 'ArrowLeft':  prevPage(); break;
    case 'ArrowRight': nextPage(); break;
    case 'Home':       goToPage(0); break;
    case 'End':        goToLast();  break;
    case 'f': case 'F': toggleFullscreen(); break;
  }
});

/* ─── Boot ───────────────────────────────────────── */
loadPDF();
</script>
</body>
</html>
