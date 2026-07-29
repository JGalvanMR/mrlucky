{{-- ============================================================ --}}
{{-- Banner de Cookies Mr. Lucky — Integrado con Matomo          --}}
{{-- Incluir en master.blade.php justo antes de </body>          --}}
{{-- @include('site.partials.cookies-banner')                    --}}
{{-- ============================================================ --}}

<div id="ml-cookie-banner" aria-live="polite" aria-label="Aviso de cookies">
    <div class="ml-cookie-inner">

        <div class="ml-cookie-icon">
            <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="32" cy="32" r="30" fill="#db0632" />
                <circle cx="22" cy="26" r="4" fill="#ffd52f" />
                <circle cx="38" cy="20" r="3" fill="#ffd52f" />
                <circle cx="42" cy="36" r="5" fill="#ffd52f" />
                <circle cx="26" cy="42" r="3.5" fill="#ffd52f" />
                <circle cx="36" cy="48" r="2.5" fill="#ffd52f" />
                <path d="M32 8 C32 8 34 14 40 14 C40 14 34 16 34 22 C34 22 30 16 24 18 C24 18 28 12 32 8Z" fill="rgba(255,255,255,0.2)" />
            </svg>
        </div>

        <div class="ml-cookie-body">
            <div class="ml-cookie-header">
                <span class="ml-cookie-tag">{{ App::currentLocale() == "en" ? "Privacy Notice" : "Aviso de Privacidad" }}</span>
                <h4>{{ App::currentLocale() == "en" ? "This site uses cookies" : "Este sitio utiliza cookies" }}</h4>
            </div>
            <p>{{ App::currentLocale() == "en" ? "We use cookies to analyze traffic and improve your browsing experience on" : "Usamos cookies para analizar el tráfico y mejorar tu experiencia de navegación en" }} <strong>mrlucky.com.mx</strong>. {{ App::currentLocale() == "en" ? "Data is processed securely and never shared with third parties." : "Los datos son procesados de forma segura y nunca compartidos con terceros." }}</p>
            <a class="ml-cookie-link" href="/site/certificaciones/POLITICA_DE_PRIVACIDAD_MR_LUCKY.pdf" target="_blank" rel="noopener">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                </svg>
                {{ App::currentLocale() == "en" ? "Read full Privacy Notice" : "Leer Aviso de Privacidad completo" }}
            </a>
        </div>

        <div class="ml-cookie-actions">
            <button id="ml-cookie-reject" class="ml-btn ml-btn-secondary" type="button">
                {{ App::currentLocale() == "en" ? "Essential only" : "Solo esenciales" }}
            </button>
            <button id="ml-cookie-accept" class="ml-btn ml-btn-primary" type="button">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12" />
                </svg>
                {{ App::currentLocale() == "en" ? "Accept all" : "Aceptar todo" }}
            </button>
        </div>

        <button id="ml-cookie-close" class="ml-cookie-close" aria-label="Cerrar" type="button">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </button>

    </div>
</div>

<style>
    /* ── Variables ─────────────────────────────────────────────── */
    #ml-cookie-banner {
        --ml-azul: #003ca6;
        --ml-rojo: #db0632;
        --ml-amarillo: #ffd52f;
        --ml-blanco: #ffffff;
        --ml-radius: 16px;
        --ml-shadow: 0 -2px 40px rgba(0, 60, 166, 0.18), 0 8px 32px rgba(0, 0, 0, 0.12);
    }

    /* ── Contenedor principal ──────────────────────────────────── */
    #ml-cookie-banner {
        position: fixed;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%) translateY(120%);
        width: calc(100% - 48px);
        max-width: 860px;
        z-index: 99999;
        transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    #ml-cookie-banner.ml-visible {
        transform: translateX(-50%) translateY(0);
    }

    /* ── Inner card ────────────────────────────────────────────── */
    .ml-cookie-inner {
        background: var(--ml-azul);
        border-radius: var(--ml-radius);
        box-shadow: var(--ml-shadow);
        padding: 24px 28px;
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        overflow: hidden;
    }

    /* Decoración de fondo */
    .ml-cookie-inner::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.04);
        pointer-events: none;
    }

    .ml-cookie-inner::after {
        content: '';
        position: absolute;
        bottom: -60px;
        right: 80px;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255, 213, 47, 0.06);
        pointer-events: none;
    }

    /* ── Icono ─────────────────────────────────────────────────── */
    .ml-cookie-icon {
        flex-shrink: 0;
        width: 52px;
        height: 52px;
        filter: drop-shadow(0 4px 12px rgba(219, 6, 50, 0.4));
        animation: ml-pulse 3s ease-in-out infinite;
    }

    .ml-cookie-icon svg {
        width: 100%;
        height: 100%;
    }

    @keyframes ml-pulse {

        0%,
        100% {
            transform: scale(1) rotate(-3deg);
        }

        50% {
            transform: scale(1.06) rotate(3deg);
        }
    }

    /* ── Texto ─────────────────────────────────────────────────── */
    .ml-cookie-body {
        flex: 1;
        min-width: 0;
    }

    .ml-cookie-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 6px;
        flex-wrap: wrap;
    }

    .ml-cookie-tag {
        display: inline-block;
        background: var(--ml-amarillo);
        color: #222;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 2px 8px;
        border-radius: 20px;
        font-family: 'Roboto', sans-serif;
    }

    .ml-cookie-body h4 {
        color: var(--ml-blanco);
        font-size: 15px;
        font-weight: 700;
        margin: 0;
        font-family: 'Roboto', sans-serif;
        line-height: 1.3;
    }

    .ml-cookie-body p {
        color: rgba(255, 255, 255, 0.78);
        font-size: 12.5px;
        margin: 0 0 8px 0;
        line-height: 1.55;
        font-family: 'Roboto', sans-serif;
    }

    .ml-cookie-body p strong {
        color: rgba(255, 255, 255, 0.95);
        font-weight: 600;
    }

    .ml-cookie-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: var(--ml-amarillo);
        font-size: 11.5px;
        font-weight: 500;
        text-decoration: none;
        font-family: 'Roboto', sans-serif;
        transition: opacity 0.2s;
    }

    .ml-cookie-link:hover {
        opacity: 0.8;
        text-decoration: underline;
        color: var(--ml-amarillo);
    }

    .ml-cookie-link svg {
        flex-shrink: 0;
    }

    /* ── Botones ───────────────────────────────────────────────── */
    .ml-cookie-actions {
        display: flex;
        flex-direction: column;
        gap: 8px;
        flex-shrink: 0;
    }

    .ml-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px 20px;
        border-radius: 30px;
        font-family: 'Roboto', sans-serif;
        font-size: 12.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        cursor: pointer;
        border: none;
        transition: all 0.2s ease;
        white-space: nowrap;
        min-width: 140px;
    }

    .ml-btn-primary {
        background: var(--ml-rojo);
        color: var(--ml-blanco);
        box-shadow: 0 4px 16px rgba(219, 6, 50, 0.4);
    }

    .ml-btn-primary:hover {
        background: #b80028;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(219, 6, 50, 0.5);
    }

    .ml-btn-primary:active {
        transform: translateY(0);
    }

    .ml-btn-secondary {
        background: transparent;
        color: rgba(255, 255, 255, 0.75);
        border: 1.5px solid rgba(255, 255, 255, 0.25);
    }

    .ml-btn-secondary:hover {
        border-color: rgba(255, 255, 255, 0.6);
        color: #fff;
        background: rgba(255, 255, 255, 0.07);
    }

    /* ── Botón cerrar ──────────────────────────────────────────── */
    .ml-cookie-close {
        position: absolute;
        top: 10px;
        right: 12px;
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: rgba(255, 255, 255, 0.6);
        width: 24px;
        height: 24px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        transition: all 0.2s;
    }

    .ml-cookie-close:hover {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    /* ── Responsive ────────────────────────────────────────────── */
    @media (max-width: 640px) {
        #ml-cookie-banner {
            bottom: 12px;
            width: calc(100% - 24px);
        }

        .ml-cookie-inner {
            flex-wrap: wrap;
            padding: 20px;
            gap: 14px;
        }

        .ml-cookie-icon {
            width: 40px;
            height: 40px;
        }

        .ml-cookie-body {
            width: 100%;
        }

        .ml-cookie-actions {
            flex-direction: row;
            width: 100%;
        }

        .ml-btn {
            flex: 1;
            min-width: 0;
        }
    }
</style>

<script>
    (function() {
        var STORAGE_KEY = 'ml_cookies_v1';
        var banner = document.getElementById('ml-cookie-banner');
        var btnAccept = document.getElementById('ml-cookie-accept');
        var btnReject = document.getElementById('ml-cookie-reject');
        var btnClose = document.getElementById('ml-cookie-close');

        var consent = localStorage.getItem(STORAGE_KEY);

        if (!consent) {
            setTimeout(function() {
                banner.classList.add('ml-visible');
            }, 1200);
        } else {
            applyConsent(consent);
        }

        btnAccept.addEventListener('click', function() {
            setConsent('accepted');
        });
        btnReject.addEventListener('click', function() {
            setConsent('rejected');
        });
        btnClose.addEventListener('click', function() {
            hideBanner();
        });

        function setConsent(value) {
            localStorage.setItem(STORAGE_KEY, value);
            hideBanner();
            applyConsent(value);
        }

        function hideBanner() {
            banner.classList.remove('ml-visible');
        }

        function applyConsent(value) {
            // Si el usuario acepta, cargar Matomo y dar consentimiento
            if (value === 'accepted') {
                if (typeof loadMatomo === 'function') {
                    loadMatomo(); // Esto define _paq y carga el script
                }
                // A veces loadMatomo es asíncrono; mejor esperar un poco
                setTimeout(function() {
                    if (typeof _paq !== 'undefined') {
                        _paq.push(['setDoNotTrack', false]);
                        _paq.push(['rememberConsentGiven']);
                        _paq.push(['trackPageView']);
                    }
                }, 300);
            } else {
                // Si rechaza, podemos optar por no cargar Matomo en absoluto,
                // o cargarlo pero con optUserOut. Por simplicidad, si rechaza,
                // no cargamos nada.
            }
        }
    })();
</script>
