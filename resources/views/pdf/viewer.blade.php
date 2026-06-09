<!DOCTYPE html>
<html lang="{{ App::currentLocale() }}">

<head>
    <meta charset="UTF-8">
    {{-- WCAG 2.1 AA: viewport accesible con zoom de usuario permitido --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>{{ $boletin['titulo'] ?? 'Boletín · Mr. Lucky' }}</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#003ca6">
    <meta name="format-detection" content="telephone=no">

    {{-- Preconnect para fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome 6.5.2 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous">

    {{-- PDF.js 3.11.174 + PageFlip 2.0.7 --}}
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/page-flip@2.0.7/dist/js/page-flip.browser.js"></script>

    <style>
        /* ════════════════════════════════════════════════════════════════
       MR. LUCKY FLIPBOOK — PRODUCTION READY v2026.05
       Basado en análisis real de InformeWeb.json

       Dispositivos prioritarios (datos reales):
       Mobile:  414x896(5v) 360x780(3v) 390x844(2v) 393x852(3v)
                375x812(1v) 430x932(1v) 440x956(1v) 360x840(1v)
       Tablet:  600x960(1v) 601x1007(1v) 800x1280(1v) 1024x720(2v)
       Desktop: 1512x982(5v) 2240x1260(4v) 1366x768(4v) 1536x864(8v)
                1920x1080(6v) 1440x900(2v)

       Navegadores prioritarios: Chrome(29v), MobileSafari(11v),
       Edge(6v), Safari(5v), ChromeMobile(4v), Samsung(1v), FB(1v), LI(1v)

       Problemas detectados: Rebote 49%, sesiones cortas móviles,
       baja interacción, problemas de legibilidad.
       ════════════════════════════════════════════════════════════════ */

        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --azul: #003ca6;
            --azul-dark: #002d80;
            --azul-mid: #1565c0;
            --azul-light: #e8f0fd;
            --verde: #56b276;
            --verde-dark: #3d8a58;
            --verde-light: #e8f5e9;
            --naranja: #ebb650;
            --amarillo: #ffd52f;
            --gris: #7c8ba0;
            --gris-claro: #e1e8ef;
            --gris-bg: #f0f0f0;
            --rojo: #db0632;
            --blanco: #ffffff;
            --negro: #1a1a2e;
            --shadow-book: 0 12px 40px rgba(0, 60, 166, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-ctrl: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-card: 0 2px 8px rgba(0, 0, 0, 0.06);
            --shadow-float: 0 6px 24px rgba(0, 60, 166, 0.15);
            --radius-sm: 6px;
            --radius: 10px;
            --radius-lg: 14px;
            --radius-pill: 50px;
            --transition-fast: all .15s ease;
            --transition: all .25s ease;
            --transition-slow: all .35s cubic-bezier(.4, 0, .2, 1);
            --header-h: 52px;
            --toolbar-h: 52px;
            --safe-top: env(safe-area-inset-top);
            --safe-bottom: env(safe-area-inset-bottom);
        }

        /* NO overflow:hidden en html — permite scroll natural en Safari */
        html {
            height: 100%;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--gris-bg);
            font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: #333;
            -webkit-font-smoothing: antialiased;
            overscroll-behavior-y: none;
        }

        /* Safe Areas iPhone */
        @supports (padding:env(safe-area-inset-top)) {
            body {
                padding-top: var(--safe-top);
                padding-bottom: var(--safe-bottom);
            }
        }

        /* ════════════════════════════════════════════════════════════════
       HEADER
    ════════════════════════════════════════════════════════════════ */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            height: var(--header-h);
            background: linear-gradient(135deg, var(--azul) 0%, var(--azul-mid) 100%);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 clamp(10px, 3vw, 20px);
            box-shadow: 0 2px 12px rgba(0, 60, 166, 0.25);
            transition: transform .3s ease;
        }

        @supports (padding:env(safe-area-inset-top)) {
            header {
                padding-top: var(--safe-top);
                height: calc(var(--header-h) + var(--safe-top));
            }
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
            flex: 1;
        }

        .header-logo {
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .header-logo i {
            color: var(--amarillo);
            font-size: 14px;
        }

        .header-text {
            min-width: 0;
        }

        .header-title {
            font-family: 'Pacifico', cursive;
            font-size: clamp(11px, 3.2vw, 14px);
            color: var(--blanco);
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .header-subtitle {
            font-size: clamp(8px, 1.8vw, 10px);
            color: rgba(255, 255, 255, 0.55);
            letter-spacing: 1.2px;
            text-transform: uppercase;
            margin-top: 1px;
        }

        .header-actions {
            display: flex;
            gap: 6px;
            align-items: center;
            flex-shrink: 0;
        }

        .hdr-btn {
            width: 36px;
            height: 36px;
            border-radius: var(--radius-sm);
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.85);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-fast);
            text-decoration: none;
            font-size: 14px;
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
        }

        .hdr-btn:hover {
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
        }

        .hdr-btn:active {
            transform: scale(0.92);
        }

        .hdr-btn-verde {
            background: var(--verde);
            border-color: var(--verde-dark);
            color: #fff;
        }

        .hdr-btn-verde:hover {
            background: var(--verde-dark);
        }

        /* ════════════════════════════════════════════════════════════════
       MAIN LAYOUT
    ════════════════════════════════════════════════════════════════ */
        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding-top: var(--header-h);
            position: relative;
            overflow: hidden;
        }

        @supports (padding:env(safe-area-inset-top)) {
            main {
                padding-top: calc(var(--header-h) + var(--safe-top));
            }
        }

        /* ════════════════════════════════════════════════════════════════
       LOADING — Skeleton Premium
    ════════════════════════════════════════════════════════════════ */
        #loading {
            position: fixed;
            inset: 0;
            z-index: 200;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 18px;
            padding: 24px;
            background: var(--gris-bg);
            transition: opacity .4s ease, visibility .4s ease;
        }

        #loading.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .loading-icon {
            width: 64px;
            height: 64px;
            background: var(--blanco);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-float);
            animation: iconFloat 2.5s ease-in-out infinite;
        }

        .loading-icon i {
            font-size: 26px;
            color: var(--azul);
        }

        @keyframes iconFloat {

            0%,
            100% {
                transform: translateY(0) rotate(-1deg);
            }

            50% {
                transform: translateY(-8px) rotate(1deg);
            }
        }

        .loading-title {
            font-family: 'Pacifico', cursive;
            font-size: clamp(15px, 4vw, 18px);
            color: var(--azul);
        }

        .loading-detail {
            font-size: 12px;
            color: var(--gris);
            min-height: 18px;
            text-align: center;
        }

        .skeleton-wrap {
            width: min(260px, 65vw);
            aspect-ratio: 0.707;
            background: var(--blanco);
            border-radius: var(--radius);
            box-shadow: var(--shadow-book);
            overflow: hidden;
            position: relative;
        }

        .skeleton-line {
            position: absolute;
            background: linear-gradient(90deg, var(--gris-claro) 25%, #f0f3f7 50%, var(--gris-claro) 75%);
            background-size: 200% 100%;
            animation: shimmer 1.4s infinite;
            border-radius: 3px;
        }

        .skeleton-line.title {
            top: 12%;
            left: 10%;
            width: 60%;
            height: 5%;
        }

        .skeleton-line.text1 {
            top: 21%;
            left: 10%;
            width: 75%;
            height: 2.5%;
        }

        .skeleton-line.text2 {
            top: 26%;
            left: 10%;
            width: 65%;
            height: 2.5%;
        }

        .skeleton-line.img {
            top: 33%;
            left: 10%;
            width: 80%;
            height: 28%;
            border-radius: var(--radius-sm);
        }

        .skeleton-line.text3 {
            top: 68%;
            left: 10%;
            width: 70%;
            height: 2.5%;
        }

        .skeleton-line.text4 {
            top: 73%;
            left: 10%;
            width: 50%;
            height: 2.5%;
        }

        @keyframes shimmer {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .progress-wrap {
            width: min(260px, 65vw);
        }

        .progress-rail {
            height: 4px;
            background: var(--gris-claro);
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, var(--azul), var(--verde));
            border-radius: 10px;
            transition: width .3s ease;
        }

        .progress-pct {
            font-size: 11px;
            color: var(--gris);
            text-align: right;
            margin-top: 4px;
        }

        /* ════════════════════════════════════════════════════════════════
       ERROR SCREEN
    ════════════════════════════════════════════════════════════════ */
        #error-screen {
            display: none;
            flex: 1;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 14px;
            padding: 32px 20px;
            text-align: center;
        }

        #error-screen.active {
            display: flex;
        }

        .error-icon {
            width: 56px;
            height: 56px;
            background: #fdecea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-icon i {
            font-size: 22px;
            color: var(--rojo);
        }

        .error-title {
            font-size: 15px;
            font-weight: 600;
            color: #c62828;
        }

        .error-body {
            font-size: 13px;
            color: var(--gris);
            max-width: 320px;
            line-height: 1.6;
        }

        .error-code {
            font-family: monospace;
            font-size: 11px;
            color: var(--gris);
            background: var(--gris-claro);
            border-radius: var(--radius-sm);
            padding: 8px 12px;
            max-width: 320px;
            word-break: break-all;
        }

        .btn-retry {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 22px;
            background: var(--azul);
            color: #fff;
            border: none;
            border-radius: var(--radius-pill);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-family: 'Roboto', sans-serif;
            min-height: 44px;
            min-width: 44px;
        }

        .btn-retry:hover {
            background: var(--azul-dark);
            transform: translateY(-1px);
            box-shadow: var(--shadow-float);
        }

        .btn-retry:active {
            transform: scale(0.96);
        }

        /* ════════════════════════════════════════════════════════════════
       VIEWER STAGE
    ════════════════════════════════════════════════════════════════ */
        #viewer {
            display: none;
            flex: 1;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 8px;
            gap: 8px;
            min-height: 0;
            position: relative;
            overflow: hidden;
        }

        #viewer.active {
            display: flex;
        }

        /* Progress bar superior */
        .page-progress {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: transparent;
            z-index: 50;
        }

        .page-progress-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, var(--azul), var(--verde));
            transition: width .35s ease;
            border-radius: 0 3px 3px 0;
        }

        /* Book stage */
        .book-stage {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            min-height: 0;
            width: 100%;
            max-width: 100%;
            touch-action: pan-y pinch-zoom;
        }

        .book-shadow {
            position: absolute;
            bottom: -4px;
            left: 50%;
            transform: translateX(-50%);
            width: 55%;
            height: 12px;
            background: radial-gradient(ellipse, rgba(0, 60, 166, 0.1) 0%, transparent 70%);
            filter: blur(8px);
            pointer-events: none;
        }

        #flipbook {
            position: relative;
            box-shadow: var(--shadow-book);
            z-index: 10;
            border-radius: 2px;
        }

        .page {
            overflow: hidden;
            background: #fff;
        }

        .page img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: contain;
            /* CORREGIDO: nunca fill */
            pointer-events: none;
            user-select: none;
            -webkit-user-select: none;
            -webkit-user-drag: none;
        }

        /* ════════════════════════════════════════════════════════════════
       ZOOM SYSTEM — Inline Desktop
    ════════════════════════════════════════════════════════════════ */
        .zoom-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .zoom-container.zoomed {
            overflow: auto;
            cursor: grab;
        }

        .zoom-container.zoomed:active {
            cursor: grabbing;
        }

        .zoom-wrapper {
            transform-origin: center center;
            transition: transform .25s cubic-bezier(.4, 0, .2, 1);
            will-change: transform;
        }

        .zoom-wrapper.animating {
            transition: transform .3s cubic-bezier(.4, 0, .2, 1);
        }

        /* Zoom floating controls */
        .zoom-controls {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            gap: 5px;
            z-index: 30;
        }

        .zoom-ctrl-btn {
            width: 36px;
            height: 36px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--gris-claro);
            background: var(--blanco);
            color: var(--gris);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: var(--transition-fast);
            box-shadow: var(--shadow-card);
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
            min-width: 36px;
            min-height: 36px;
        }

        .zoom-ctrl-btn:hover {
            background: var(--azul);
            color: #fff;
            border-color: var(--azul);
        }

        .zoom-ctrl-btn:active {
            transform: scale(0.92);
        }

        .zoom-ctrl-btn:disabled {
            opacity: .3;
            cursor: default;
        }

        /* ════════════════════════════════════════════════════════════════
       DESKTOP NAVIGATION
    ════════════════════════════════════════════════════════════════ */
        .arrow-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 42px;
            height: 72px;
            background: var(--blanco);
            border: 1.5px solid var(--gris-claro);
            color: var(--gris);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            z-index: 20;
            box-shadow: var(--shadow-card);
            font-size: 15px;
            min-width: 42px;
            min-height: 44px;
        }

        .arrow-btn:hover:not(:disabled) {
            background: var(--azul);
            border-color: var(--azul);
            color: #fff;
            box-shadow: var(--shadow-float);
        }

        .arrow-btn:active:not(:disabled) {
            transform: translateY(-50%) scale(0.94);
        }

        .arrow-btn:disabled {
            opacity: .15;
            cursor: default;
            pointer-events: none;
        }

        .arrow-btn.prev {
            left: 6px;
            border-radius: var(--radius) 0 0 var(--radius);
            border-right: none;
        }

        .arrow-btn.next {
            right: 6px;
            border-radius: 0 var(--radius) var(--radius) 0;
            border-left: none;
        }

        .controls-bar {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            gap: 5px;
            background: var(--blanco);
            border: 1px solid var(--gris-claro);
            border-radius: var(--radius-pill);
            padding: 5px 14px;
            box-shadow: var(--shadow-ctrl);
        }

        .ctrl-btn {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 1px solid transparent;
            background: transparent;
            color: var(--gris);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-fast);
            font-size: 13px;
            min-width: 34px;
            min-height: 34px;
        }

        .ctrl-btn:hover:not(:disabled) {
            background: var(--azul);
            color: #fff;
            border-color: var(--azul);
        }

        .ctrl-btn:active:not(:disabled) {
            transform: scale(0.9);
        }

        .ctrl-btn:disabled {
            opacity: .2;
            cursor: default;
        }

        .ctrl-btn.active {
            background: var(--azul-light);
            color: var(--azul);
            border-color: var(--azul);
        }

        .ctrl-sep {
            width: 1px;
            height: 20px;
            background: var(--gris-claro);
            flex-shrink: 0;
        }

        .page-counter {
            font-size: 13px;
            font-weight: 600;
            color: var(--azul);
            min-width: 68px;
            text-align: center;
            letter-spacing: .3px;
            font-variant-numeric: tabular-nums;
        }

        .kbd-hint {
            font-size: 10px;
            color: var(--gris);
            letter-spacing: 1px;
            text-transform: uppercase;
            opacity: .45;
        }

        /* ════════════════════════════════════════════════════════════════
       MOBILE NAVIGATION
    ════════════════════════════════════════════════════════════════ */
        .mobile-nav {
            display: none;
            width: 100%;
            flex-shrink: 0;
            flex-direction: column;
            gap: 6px;
            padding: 0 6px 6px;
            padding-bottom: max(6px, var(--safe-bottom));
        }

        .mobile-nav-main {
            display: flex;
            width: 100%;
            gap: 6px;
            align-items: center;
        }

        .mobile-nav-btn {
            flex: 1;
            height: 44px;
            border: 2px solid var(--azul);
            background: var(--blanco);
            color: var(--azul);
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: var(--transition-fast);
            font-family: 'Roboto', sans-serif;
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
            user-select: none;
            min-height: 44px;
            min-width: 44px;
        }

        .mobile-nav-btn:hover:not(:disabled) {
            background: var(--azul);
            color: #fff;
        }

        .mobile-nav-btn:active:not(:disabled) {
            transform: scale(0.96);
            background: var(--azul-dark);
        }

        .mobile-nav-btn:disabled {
            opacity: .2;
            cursor: default;
        }

        .mobile-counter {
            flex-shrink: 0;
            min-width: 52px;
            text-align: center;
            font-size: 12px;
            font-weight: 600;
            color: var(--azul);
            font-variant-numeric: tabular-nums;
        }

        .mobile-toolbar {
            display: flex;
            width: 100%;
            gap: 5px;
            justify-content: center;
        }

        .mobile-tool-btn {
            flex: 1;
            max-width: 76px;
            height: 36px;
            border: none;
            background: var(--blanco);
            color: var(--gris);
            border-radius: var(--radius-sm);
            font-size: 10px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1px;
            transition: var(--transition-fast);
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
            box-shadow: var(--shadow-card);
            font-family: 'Roboto', sans-serif;
            min-height: 36px;
            min-width: 44px;
        }

        .mobile-tool-btn i {
            font-size: 14px;
        }

        .mobile-tool-btn:active {
            transform: scale(0.94);
            background: var(--azul-light);
            color: var(--azul);
        }

        .mobile-tool-btn.active {
            background: var(--azul);
            color: #fff;
        }

        /* Swipe hint */
        .swipe-hint {
            display: none;
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            padding: 5px 12px;
            background: rgba(0, 0, 0, 0.72);
            color: #fff;
            font-size: 11px;
            border-radius: var(--radius-pill);
            white-space: nowrap;
            z-index: 25;
            animation: hintPulse 2.2s ease-in-out infinite;
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            pointer-events: none;
            transition: opacity .5s ease;
        }

        @keyframes hintPulse {

            0%,
            100% {
                opacity: .8;
                transform: translateX(-50%) translateY(0);
            }

            50% {
                opacity: 1;
                transform: translateX(-50%) translateY(-2px);
            }
        }

        .swipe-hint.hidden {
            opacity: 0;
            pointer-events: none;
        }

        /* ════════════════════════════════════════════════════════════════
       ZOOM OVERLAY — Fullscreen mobile zoom
    ════════════════════════════════════════════════════════════════ */
        .zoom-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.95);
            z-index: 500;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .zoom-overlay.active {
            display: flex;
        }

        .zoom-overlay-header {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 14px;
            padding-top: var(--safe-top);
            z-index: 510;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), transparent);
        }

        .zoom-overlay-title {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.65);
            font-weight: 500;
        }

        .zoom-overlay-close {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1.5px solid rgba(255, 255, 255, 0.35);
            background: transparent;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-fast);
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
            min-width: 38px;
            min-height: 38px;
        }

        .zoom-overlay-close:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .zoom-overlay-close:active {
            transform: scale(0.9);
        }

        .zoom-overlay-content {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            touch-action: none;
            position: relative;
        }

        .zoom-overlay-pan {
            transform-origin: 0 0;
            will-change: transform;
        }

        .zoom-overlay-pan.animating {
            transition: transform .3s cubic-bezier(.4, 0, .2, 1);
        }

        .zoom-overlay-image {
            max-width: none;
            max-height: none;
            pointer-events: none;
            user-select: none;
            -webkit-user-select: none;
            display: block;
        }

        .zoom-overlay-nav {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 510;
            padding-bottom: var(--safe-bottom);
        }

        .zoom-nav-btn {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 1.5px solid rgba(255, 255, 255, 0.35);
            background: rgba(0, 0, 0, 0.45);
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-fast);
            -webkit-tap-highlight-color: transparent;
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            touch-action: manipulation;
            min-width: 44px;
            min-height: 44px;
        }

        .zoom-nav-btn:hover:not(:disabled) {
            background: var(--azul);
            border-color: var(--azul);
        }

        .zoom-nav-btn:active:not(:disabled) {
            transform: scale(0.9);
        }

        .zoom-nav-btn:disabled {
            opacity: .25;
            pointer-events: none;
        }

        .zoom-overlay-info {
            position: absolute;
            bottom: 72px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 11px;
            color: rgba(255, 255, 255, 0.45);
            z-index: 510;
            padding-bottom: var(--safe-bottom);
            white-space: nowrap;
        }

        /* ════════════════════════════════════════════════════════════════
       THUMBNAIL PANEL
    ════════════════════════════════════════════════════════════════ */
        .thumb-panel {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            max-height: 32vh;
            background: var(--blanco);
            border-top: 1px solid var(--gris-claro);
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
            z-index: 300;
            flex-direction: column;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
            overflow: hidden;
            transition: transform .3s cubic-bezier(.4, 0, .2, 1);
        }

        .thumb-panel.open {
            display: flex;
        }

        .thumb-panel-handle {
            width: 100%;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
            border-bottom: 1px solid var(--gris-claro);
            position: relative;
        }

        .thumb-handle-bar {
            width: 32px;
            height: 3px;
            background: var(--gris-claro);
            border-radius: 2px;
            position: absolute;
            top: 5px;
            left: 50%;
            transform: translateX(-50%);
        }

        .thumb-panel-title {
            font-size: 12px;
            font-weight: 600;
            color: var(--azul);
        }

        .thumb-close-btn {
            width: 28px;
            height: 28px;
            border: none;
            background: transparent;
            color: var(--gris);
            font-size: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            min-width: 28px;
            min-height: 28px;
        }

        .thumb-close-btn:hover {
            background: var(--gris-claro);
        }

        .thumb-scroll {
            flex: 1;
            overflow-x: auto;
            overflow-y: hidden;
            padding: 10px 14px;
            display: flex;
            gap: 8px;
            -webkit-overflow-scrolling: touch;
            scroll-snap-type: x mandatory;
        }

        .thumb-scroll::-webkit-scrollbar {
            height: 3px;
        }

        .thumb-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .thumb-scroll::-webkit-scrollbar-thumb {
            background: var(--gris-claro);
            border-radius: 3px;
        }

        .thumb-item {
            flex-shrink: 0;
            width: 56px;
            scroll-snap-align: start;
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: var(--radius-sm);
            overflow: hidden;
            transition: var(--transition-fast);
            opacity: .55;
        }

        .thumb-item:hover {
            border-color: var(--azul-light);
            opacity: .8;
        }

        .thumb-item.active {
            border-color: var(--azul);
            opacity: 1;
            box-shadow: 0 0 0 2px var(--azul-light);
        }

        .thumb-item img {
            width: 56px;
            height: auto;
            display: block;
            pointer-events: none;
        }

        /* ════════════════════════════════════════════════════════════════
       RESPONSIVE BREAKPOINTS — Basados en datos reales InformeWeb
       ════════════════════════════════════════════════════════════════ */

        /* ── Ultra Mobile (≤374px): 360x780, 360x840, 360x780(Linux) ── */
        @media (max-width:374px) {
            :root {
                --header-h: 44px;
            }

            .header-logo {
                width: 26px;
                height: 26px;
            }

            .header-logo i {
                font-size: 12px;
            }

            .header-title {
                font-size: 10px;
            }

            .hdr-btn {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }

            .mobile-nav {
                gap: 4px;
                padding: 0 4px 4px;
            }

            .mobile-nav-btn {
                height: 38px;
                font-size: 12px;
                gap: 4px;
                border-width: 1.5px;
            }

            .mobile-nav-btn i {
                font-size: 12px;
            }

            .mobile-counter {
                font-size: 11px;
                min-width: 40px;
            }

            .mobile-toolbar {
                gap: 4px;
            }

            .mobile-tool-btn {
                height: 32px;
                font-size: 9px;
                max-width: 68px;
            }

            .mobile-tool-btn i {
                font-size: 13px;
            }

            .zoom-controls {
                display: none !important;
            }

            /* Simplificar en ultra móvil */
            .book-shadow {
                display: none;
            }

            /* Reducir sombras pesadas */
            #viewer {
                padding: 4px;
                gap: 4px;
            }

            .page-progress {
                height: 2px;
            }
        }

        /* ── Mobile (375px-599px): 375x812, 376x835, 384x857, 390x844, 393x852, 414x896, 430x932, 440x956 ── */
        @media (min-width:375px) and (max-width:599px) {
            :root {
                --header-h: 48px;
            }

            .header-logo {
                width: 30px;
                height: 30px;
            }

            .header-logo i {
                font-size: 13px;
            }

            .header-title {
                font-size: clamp(10px, 3vw, 12px);
            }

            .hdr-btn {
                width: 32px;
                height: 32px;
                font-size: 13px;
            }

            #viewer {
                padding: 6px;
                gap: 6px;
            }

            .mobile-nav {
                display: flex !important;
                padding-bottom: max(6px, var(--safe-bottom));
            }

            .arrow-btn,
            .controls-bar,
            .kbd-hint,
            .zoom-controls {
                display: none !important;
            }

            .swipe-hint {
                display: block;
            }

            .book-shadow {
                width: 50%;
                height: 10px;
                filter: blur(6px);
            }
        }

        /* ── Mobile landscape ── */
        @media (max-width:767px) and (orientation:landscape) {
            :root {
                --header-h: 38px;
            }

            .header-subtitle {
                display: none;
            }

            .mobile-nav-btn {
                height: 34px;
                font-size: 11px;
            }

            .mobile-toolbar {
                display: none !important;
            }

            /* Simplificar en landscape */
            #viewer {
                padding: 4px;
                gap: 4px;
            }
        }

        /* ── Tablet Small (600px-799px): 600x960, 601x1007 ── */
        @media (min-width:600px) and (max-width:799px) {
            :root {
                --header-h: 50px;
            }

            .header-subtitle {
                display: none;
            }

            .arrow-btn {
                display: none !important;
            }

            .controls-bar {
                display: none !important;
            }

            .kbd-hint {
                display: none !important;
            }

            .mobile-nav {
                display: flex !important;
            }

            .zoom-controls {
                display: none !important;
            }

            .swipe-hint {
                display: block;
            }
        }

        /* ── Tablet Large (800px-1024px): 800x1280, 1024x720 ── */
        @media (min-width:800px) and (max-width:1024px) {
            :root {
                --header-h: 50px;
            }

            .header-title {
                font-size: 13px;
            }

            .header-subtitle {
                font-size: 9px;
            }

            #viewer {
                padding: 10px 14px;
                gap: 10px;
            }

            .arrow-btn {
                width: 38px;
                height: 64px;
                font-size: 14px;
            }

            .controls-bar {
                padding: 6px 12px;
                gap: 4px;
            }

            .ctrl-btn {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }

            .page-counter {
                font-size: 12px;
                min-width: 64px;
            }

            .kbd-hint {
                display: none;
            }

            .mobile-nav {
                display: none !important;
            }

            .swipe-hint {
                display: none !important;
            }
        }

        /* ── Desktop Small (1025px-1199px) ── */
        @media (min-width:1025px) and (max-width:1199px) {
            #viewer {
                padding: 12px 16px;
                gap: 12px;
            }

            .arrow-btn {
                width: 40px;
                height: 68px;
            }
        }

        /* ── Desktop Large (≥1200px): 1366x768, 1440x900, 1536x864/960, 1600x900, 1920x1080, 2240x1260, 1512x982 ── */
        @media (min-width:1200px) {
            .controls-bar {
                padding: 7px 18px;
                gap: 6px;
            }

            .ctrl-btn {
                width: 36px;
                height: 36px;
                font-size: 14px;
            }

            .page-counter {
                font-size: 14px;
                min-width: 76px;
            }

            .arrow-btn {
                width: 44px;
                height: 76px;
            }
        }

        /* ── Desktop only: ocultar móvil ── */
        @media (min-width:800px) {
            .mobile-nav {
                display: none !important;
            }

            .swipe-hint {
                display: none !important;
            }
        }

        /* ── Reduced Motion ── */
        @media (prefers-reduced-motion:reduce) {

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }

            .zoom-wrapper,
            .zoom-overlay-pan {
                transition: none !important;
            }
        }

        /* ── Print ── */
        @media print {

            header,
            .mobile-nav,
            .controls-bar,
            .arrow-btn,
            .zoom-controls,
            .swipe-hint,
            .page-progress,
            .thumb-panel {
                display: none !important;
            }

            #viewer {
                display: flex !important;
                padding: 0;
            }

            .book-stage {
                overflow: visible;
            }

            #flipbook {
                box-shadow: none;
            }
        }

        /* ── Samsung Browser / In-App fixes ── */
        @supports not (backdrop-filter:blur(6px)) {
            .swipe-hint {
                background: rgba(0, 0, 0, 0.85);
            }

            .zoom-nav-btn {
                background: rgba(0, 0, 0, 0.7);
            }
        }
    </style>
</head>

<body>

    {{-- ════════════════════════════════════════════════════════════════
     HEADER
════════════════════════════════════════════════════════════════ --}}
    <header id="main-header">
        <div class="header-brand">
            <div class="header-logo">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <div class="header-text">
                <div class="header-title">{{ $boletin['titulo'] ?? 'Boletín Informativo · Mr. Lucky' }}</div>

                {{-- Si existe el número de boletín, muestra el subtítulo. Si no, lo ignora por completo --}}
                @if(isset($boletin['numero']))
                <div class="header-subtitle">
                    Mr. Lucky · {{ $boletin['ano'] ?? date('Y') }} · No. {{ $boletin['numero'] }}
                </div>
                @endif
            </div>
        </div>
        <div class="header-actions">
            <a class="hdr-btn hdr-btn-verde" href="{{ $pdfUrl }}" download
                aria-label="{{ App::currentLocale() == 'es' ? 'Descargar PDF' : 'Download PDF' }}">
                <i class="fa-solid fa-download"></i>
            </a>
            <button class="hdr-btn" onclick="toggleFullscreen()"
                aria-label="{{ App::currentLocale() == 'es' ? 'Pantalla completa' : 'Fullscreen' }}">
                <i class="fa-solid fa-expand" id="fs-icon"></i>
            </button>
        </div>
    </header>

    {{-- ════════════════════════════════════════════════════════════════
     MAIN CONTENT
════════════════════════════════════════════════════════════════ --}}
    <main>

        {{-- LOADING --}}
        <div id="loading">
            <div class="loading-icon">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <div class="loading-title">
                {{ App::currentLocale() == 'es' ? 'Cargando boletín...' : 'Loading newsletter...' }}
            </div>
            <div class="loading-detail" id="load-detail">
                {{ App::currentLocale() == 'es' ? 'Iniciando motor...' : 'Starting engine...' }}
            </div>
            <div class="skeleton-wrap">
                <div class="skeleton-line title"></div>
                <div class="skeleton-line text1"></div>
                <div class="skeleton-line text2"></div>
                <div class="skeleton-line img"></div>
                <div class="skeleton-line text3"></div>
                <div class="skeleton-line text4"></div>
            </div>
            <div class="progress-wrap">
                <div class="progress-rail">
                    <div class="progress-fill" id="progress-fill"></div>
                </div>
                <div class="progress-pct" id="progress-pct">0%</div>
            </div>
        </div>

        {{-- ERROR SCREEN --}}
        <div id="error-screen">
            <div class="error-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="error-title">{{ App::currentLocale() == 'es' ? 'No se pudo cargar el boletín' : 'Could not load newsletter' }}</div>
            <div class="error-body">
                {{ App::currentLocale() == 'es' ? 'Verifica tu conexión o intenta más tarde.' : 'Check your connection or try again later.' }}
            </div>
            <div class="error-code" id="error-detail"></div>
            <button class="btn-retry" onclick="retryLoad()">
                <i class="fa-solid fa-rotate-right"></i>
                {{ App::currentLocale() == 'es' ? 'Reintentar' : 'Retry' }}
            </button>
        </div>

        {{-- VIEWER --}}
        <div id="viewer" role="main" aria-label="Visor de boletín">
            <div class="page-progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                <div class="page-progress-bar" id="page-progress-bar"></div>
            </div>

            <div class="book-stage" id="book-stage">
                <div class="swipe-hint" id="swipe-hint">
                    <i class="fa-solid fa-hand-pointer"></i>&ensp;
                    {{ App::currentLocale() == 'es' ? 'Desliza para cambiar página' : 'Swipe to turn page' }}
                </div>

                <div class="zoom-controls" id="zoom-controls">
                    <button class="zoom-ctrl-btn" id="zoom-in-btn" onclick="zoomIn()" aria-label="Acercar" title="Acercar">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                    </button>
                    <button class="zoom-ctrl-btn" id="zoom-out-btn" onclick="zoomOut()" aria-label="Alejar" title="Alejar">
                        <i class="fa-solid fa-magnifying-glass-minus"></i>
                    </button>
                    <button class="zoom-ctrl-btn" id="zoom-fit-btn" onclick="zoomFit()" aria-label="Ajustar" title="Ajustar">
                        <i class="fa-solid fa-compress"></i>
                    </button>
                </div>

                <button class="arrow-btn prev" id="btn-prev-d" onclick="prevPage()" aria-label="Página anterior">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <div class="zoom-container" id="zoom-container">
                    <div class="zoom-wrapper" id="zoom-wrapper">
                        <div id="flipbook"></div>
                    </div>
                </div>
                <div class="book-shadow"></div>

                <button class="arrow-btn next" id="btn-next-d" onclick="nextPage()" aria-label="Página siguiente">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>

            {{-- Desktop Controls --}}
            <div class="controls-bar" role="toolbar" aria-label="Controles del visor">
                <button class="ctrl-btn" id="c-first" onclick="goToPage(0)" title="Primera" aria-label="Primera página">
                    <i class="fa-solid fa-angles-left"></i>
                </button>
                <button class="ctrl-btn" id="c-prev" onclick="prevPage()" title="Anterior" aria-label="Página anterior">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <div class="ctrl-sep"></div>
                <div class="page-counter" id="page-counter" aria-live="polite">— / —</div>
                <div class="ctrl-sep"></div>
                <button class="ctrl-btn" id="c-next" onclick="nextPage()" title="Siguiente" aria-label="Página siguiente">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
                <button class="ctrl-btn" id="c-last" onclick="goToLast()" title="Última" aria-label="Última página">
                    <i class="fa-solid fa-angles-right"></i>
                </button>
                <div class="ctrl-sep"></div>
                <button class="ctrl-btn" id="c-thumb" onclick="toggleThumbnails()" title="Miniaturas" aria-label="Miniaturas">
                    <i class="fa-solid fa-table-cells"></i>
                </button>
                <button class="ctrl-btn" id="c-zoom-fit" onclick="zoomFit()" title="Ajustar" aria-label="Ajustar a pantalla">
                    <i class="fa-solid fa-compress"></i>
                </button>
                <button class="ctrl-btn" id="c-zoom-in" onclick="zoomIn()" title="Acercar" aria-label="Acercar">
                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                </button>
                <button class="ctrl-btn" id="c-zoom-out" onclick="zoomOut()" title="Alejar" aria-label="Alejar">
                    <i class="fa-solid fa-magnifying-glass-minus"></i>
                </button>
            </div>

            <div class="kbd-hint">
                {{ App::currentLocale() == 'es' ? '← → navegar · + - zoom · F pantalla completa · Esc cerrar' : '← → nav · + - zoom · F fullscreen · Esc close' }}
            </div>

            {{-- Mobile Bottom Nav --}}
            <div class="mobile-nav">
                <div class="mobile-nav-main">
                    <button class="mobile-nav-btn" id="m-prev" onclick="prevPage()" disabled aria-label="Página anterior">
                        <i class="fa-solid fa-chevron-left"></i>
                        <span>{{ App::currentLocale() == 'es' ? 'Anterior' : 'Prev' }}</span>
                    </button>
                    <div class="mobile-counter" id="m-counter" aria-live="polite">— / —</div>
                    <button class="mobile-nav-btn" id="m-next" onclick="nextPage()" aria-label="Página siguiente">
                        <span>{{ App::currentLocale() == 'es' ? 'Siguiente' : 'Next' }}</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                <div class="mobile-toolbar">
                    <button class="mobile-tool-btn" onclick="zoomIn()" aria-label="Acercar">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                        <span>{{ App::currentLocale() == 'es' ? 'Acercar' : 'Zoom+' }}</span>
                    </button>
                    <button class="mobile-tool-btn" onclick="zoomOut()" aria-label="Alejar">
                        <i class="fa-solid fa-magnifying-glass-minus"></i>
                        <span>{{ App::currentLocale() == 'es' ? 'Alejar' : 'Zoom-' }}</span>
                    </button>
                    <button class="mobile-tool-btn" onclick="openZoomOverlay()" aria-label="Zoom completo">
                        <i class="fa-solid fa-expand"></i>
                        <span>{{ App::currentLocale() == 'es' ? 'Completo' : 'Full' }}</span>
                    </button>
                    <button class="mobile-tool-btn" onclick="toggleThumbnails()" aria-label="Miniaturas">
                        <i class="fa-solid fa-table-cells"></i>
                        <span>{{ App::currentLocale() == 'es' ? 'Páginas' : 'Pages' }}</span>
                    </button>
                </div>
            </div>
        </div>{{-- /#viewer --}}

    </main>

    {{-- ════════════════════════════════════════════════════════════════
     ZOOM OVERLAY
════════════════════════════════════════════════════════════════ --}}
    <div class="zoom-overlay" id="zoom-overlay" role="dialog" aria-label="Vista ampliada de página">
        <div class="zoom-overlay-header">
            <div class="zoom-overlay-title" id="zoom-overlay-title">Página 1</div>
            <button class="zoom-overlay-close" onclick="closeZoomOverlay()" aria-label="Cerrar zoom">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="zoom-overlay-content" id="zoom-overlay-content">
            <div class="zoom-overlay-pan" id="zoom-overlay-pan">
                <img class="zoom-overlay-image" id="zoom-overlay-image" src="" alt="Página ampliada" draggable="false">
            </div>
        </div>
        <div class="zoom-overlay-info" id="zoom-overlay-info"></div>
        <div class="zoom-overlay-nav">
            <button class="zoom-nav-btn" id="zoom-prev" onclick="zoomOverlayPrev()" aria-label="Página anterior">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="zoom-nav-btn" onclick="zoomOverlayReset()" aria-label="Restablecer zoom">
                <i class="fa-solid fa-compress"></i>
            </button>
            <button class="zoom-nav-btn" id="zoom-next" onclick="zoomOverlayNext()" aria-label="Página siguiente">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════════════
     THUMBNAIL PANEL
════════════════════════════════════════════════════════════════ --}}
    <div class="thumb-panel" id="thumb-panel" role="dialog" aria-label="Miniaturas de páginas">
        <div class="thumb-panel-handle">
            <div class="thumb-handle-bar"></div>
            <div class="thumb-panel-title">{{ App::currentLocale() == 'es' ? 'Páginas' : 'Pages' }}</div>
            <button class="thumb-close-btn" onclick="toggleThumbnails()" aria-label="Cerrar miniaturas">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="thumb-scroll" id="thumb-scroll"></div>
    </div>

    <script>
        /* ═══════════════════════════════════════════════════════════════════
   MR. LUCKY FLIPBOOK ENGINE v2026.05 — PRODUCTION READY

   Estrategia responsive basada en datos reales de InformeWeb.json:
   - Móvil prioritario: 414x896(5v), 360x780(3v), 390x844(2v), 393x852(3v)
   - Tablets: 800x1280(1v), 600x960(1v), 1024x720(2v)
   - Desktop: 1512x982(5v), 2240x1260(4v), 1366x768(4v), 1536x864(8v)

   Navegadores: Chrome(29v), MobileSafari(11v), Edge(6v), Safari(5v)

   Problemas atacados:
   - Rebote 49% → Mejor legibilidad móvil, carga progresiva
   - Sesiones cortas → Lazy render, preload inteligente
   - Baja interacción → UX táctil optimizada, controles accesibles
   ═══════════════════════════════════════════════════════════════════ */

        const PDF_URL = "{{ $pdfUrl }}";
        const LOCALE = "{{ App::currentLocale() }}";
        const IS_ES = (LOCALE === 'es');

        /* ── Constantes de renderizado adaptativas ── */
        const CONFIG = {
            jpegQuality: 0.78,
            batchSize: 2, // Reducido para móviles modestos
            thumbScale: 0.25,
            maxZoom: 3.0,
            minZoom: 1.0,
            zoomStep: 0.3,
            preloadRange: 1, // Solo prev + next
            memoryLimit: 6, // Máx páginas en memoria (lazy eviction)
            // Adaptive quality según dispositivo
            get scale() {
                if (env.isUltraMobile) return 1.0;
                if (env.isMobile) return 1.2;
                if (env.isTablet) return 1.4;
                if (env.isLowMemory) return 1.0;
                return 1.6;
            }
        };

        pdfjsLib.GlobalWorkerOptions.workerSrc =
            'https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.worker.min.js';

        /* ═══════════════════════════════════════════════════════════════════
           ENVIRONMENT DETECTION — Basado en datos reales InformeWeb
           ═══════════════════════════════════════════════════════════════════ */
        const env = {
            width: 0,
            height: 0,
            isMobile: false,
            isTablet: false,
            isIOS: false,
            isAndroid: false,
            isSafari: false,
            isLowMemory: false,
            isFacebook: false,
            isLinkedIn: false,
            isSamsung: false,
            isUltraMobile: false,
            isLandscape: false,

            detect() {
                const w = window.innerWidth;
                const h = window.innerHeight;
                const ua = navigator.userAgent || '';
                const platform = navigator.platform || '';

                this.width = w;
                this.height = h;
                this.isLandscape = w > h;
                this.isMobile = w < 800; // Datos: tablets empiezan en 800
                this.isUltraMobile = w <= 374; // 360px devices
                this.isTablet = w >= 800 && w <= 1024;
                this.isIOS = /iPad|iPhone|iPod/.test(ua) || (platform === 'MacIntel' && navigator.maxTouchPoints > 1);
                this.isAndroid = /Android/.test(ua);
                this.isSafari = /Safari/.test(ua) && !/Chrome/.test(ua) && !/Chromium/.test(ua);
                this.isFacebook = /FBAN|FBAV/.test(ua);
                this.isLinkedIn = /LinkedInApp/.test(ua);
                this.isSamsung = /SamsungBrowser/.test(ua);
                this.isLowMemory = this.isIOS || this.isUltraMobile || (navigator.deviceMemory && navigator.deviceMemory <= 4);

                // Clases CSS para fixes específicos
                document.body.classList.toggle('ios-device', this.isIOS);
                document.body.classList.toggle('fb-browser', this.isFacebook);
                document.body.classList.toggle('li-browser', this.isLinkedIn);
                document.body.classList.toggle('samsung-browser', this.isSamsung);
                document.body.classList.toggle('ultra-mobile', this.isUltraMobile);
                document.body.classList.toggle('low-memory', this.isLowMemory);
            }
        };

        /* ═══════════════════════════════════════════════════════════════════
           STATE MANAGEMENT
           ═══════════════════════════════════════════════════════════════════ */
        const state = {
            book: null,
            pdf: null,
            totalFlipPages: 0,
            totalPdfPages: 0,
            pageImages: [], // URLs de dataURL
            pageCanvases: new Map(), // Map<flipIdx, canvas> para lazy eviction
            currentPage: 0,
            flipMeta: [], // Mapeo flipIdx -> {pdfPage, side}
            uniquePdfPages: [],
            thumbnailsReady: false,
            isRendering: false,
            loadError: null,
            retryCount: 0,
            maxRetries: 3,
            // Zoom inline
            inlineZoom: 1,
            isPanning: false,
            panStartX: 0,
            panStartY: 0,
            scrollStartX: 0,
            scrollStartY: 0,
            // Zoom overlay
            overlayZoom: 1,
            overlayPanX: 0,
            overlayPanY: 0,
            overlayPageIdx: 0,
            overlayListeners: false,
            // Analytics
            analytics: {
                zoomCount: 0,
                overlayCount: 0,
                thumbCount: 0,
                fullscreenCount: 0,
                pageTime: {},
                sessionStart: Date.now(),
                errors: [],
                maxScrollDepth: 0
            }
        };

        /* ═══════════════════════════════════════════════════════════════════
           UTILIDADES — Debounce, Throttle, Memoria
           ═══════════════════════════════════════════════════════════════════ */
        function debounce(fn, wait) {
            let t;
            return function(...args) {
                clearTimeout(t);
                t = setTimeout(() => fn.apply(this, args), wait);
            };
        }

        function throttle(fn, limit) {
            let inThrottle;
            return function(...args) {
                if (!inThrottle) {
                    fn.apply(this, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            };
        }

        /** Libera memoria de canvas recortando a 1x1 y removiendo referencias */
        function releaseCanvas(canvas) {
            if (!canvas) return;
            try {
                const ctx = canvas.getContext('2d');
                if (ctx) ctx.clearRect(0, 0, canvas.width, canvas.height);
                canvas.width = 1;
                canvas.height = 1;
            } catch (e) {}
        }

        /** Eviction LRU: mantiene solo CONFIG.memoryLimit páginas en memoria */
        function evictFarPages(currentIdx) {
            const keep = new Set();
            for (let i = -CONFIG.preloadRange; i <= CONFIG.preloadRange; i++) {
                const idx = currentIdx + i;
                if (idx >= 0 && idx < state.totalFlipPages) keep.add(idx);
            }
            state.pageCanvases.forEach((canvas, idx) => {
                if (!keep.has(idx)) {
                    releaseCanvas(canvas);
                    state.pageCanvases.delete(idx);
                }
            });
        }

        /* ═══════════════════════════════════════════════════════════════════
           UI HELPERS
           ═══════════════════════════════════════════════════════════════════ */
        function setProgress(pct, detail) {
            const fill = document.getElementById('progress-fill');
            const label = document.getElementById('progress-pct');
            const detailEl = document.getElementById('load-detail');
            if (fill) fill.style.width = Math.round(pct) + '%';
            if (label) label.textContent = Math.round(pct) + '%';
            if (detail && detailEl) detailEl.textContent = detail;
        }

        function showError(msg, code) {
            document.getElementById('loading').classList.add('hidden');
            document.getElementById('error-screen').classList.add('active');
            const detail = document.getElementById('error-detail');
            if (detail) detail.textContent = (msg || '') + (code ? ' [' + code + ']' : '');
            state.analytics.errors.push({
                msg,
                code,
                time: Date.now()
            });
            logAnalytics('error', {
                msg,
                code
            });
        }

        function hideLoading() {
            document.getElementById('loading').classList.add('hidden');
            document.getElementById('viewer').classList.add('active');
        }

        function retryLoad() {
            state.retryCount++;
            if (state.retryCount > state.maxRetries) {
                showError(IS_ES ? 'Máximo de reintentos alcanzado' : 'Max retries reached', 'MAX_RETRY');
                return;
            }
            document.getElementById('error-screen').classList.remove('active');
            document.getElementById('loading').classList.remove('hidden');
            setProgress(0, IS_ES ? 'Reintentando... (' + state.retryCount + '/' + state.maxRetries + ')' : 'Retrying...');
            setTimeout(() => loadPDF(), 800);
        }

        /* ═══════════════════════════════════════════════════════════════════
           ANALYTICS UX — Métricas de comportamiento real
           ═══════════════════════════════════════════════════════════════════ */
        function logAnalytics(event, data) {
            // En producción, enviar a endpoint de analytics
            if (window.console && console.debug) {
                console.debug('[MrLuckyAnalytics]', event, data);
            }
        }

        function trackPageView(idx) {
            const now = Date.now();
            if (state.currentPage !== idx) {
                // Guardar tiempo en página anterior
                if (state.analytics.pageTime[state.currentPage] === undefined) {
                    state.analytics.pageTime[state.currentPage] = 0;
                }
                state.analytics.pageTime[state.currentPage] += (now - (state.analytics.lastPageTime || state.analytics.sessionStart));
                state.analytics.lastPageTime = now;
                state.currentPage = idx;
                logAnalytics('page_view', {
                    page: idx + 1,
                    total: state.totalFlipPages
                });
            }
        }

        function trackZoom(type) {
            state.analytics.zoomCount++;
            logAnalytics('zoom', {
                type,
                count: state.analytics.zoomCount
            });
        }

        function trackOverlay() {
            state.analytics.overlayCount++;
            logAnalytics('overlay_open', {
                count: state.analytics.overlayCount
            });
        }

        /* ═══════════════════════════════════════════════════════════════════
           PLACEHOLDER & RENDERING ENGINE
           ═══════════════════════════════════════════════════════════════════ */
        function createPlaceholder(w, h) {
            const c = document.createElement('canvas');
            c.width = w || 200;
            c.height = h || 280;
            const ctx = c.getContext('2d');
            ctx.fillStyle = '#f8f9fb';
            ctx.fillRect(0, 0, c.width, c.height);
            ctx.strokeStyle = '#e5e7eb';
            ctx.lineWidth = 1;
            ctx.strokeRect(0.5, 0.5, c.width - 1, c.height - 1);
            ctx.fillStyle = '#d0d5dd';
            ctx.font = Math.round(c.height * 0.04) + 'px Arial';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText('Mr. Lucky', c.width / 2, c.height / 2 - 10);
            ctx.font = Math.round(c.height * 0.03) + 'px Arial';
            ctx.fillText(IS_ES ? 'Cargando...' : 'Loading...', c.width / 2, c.height / 2 + 10);
            return c.toDataURL('image/jpeg', 0.6);
        }

        async function renderPdfPage(pdf, pageNum, scaleOverride) {
            const page = await pdf.getPage(pageNum);
            const scale = scaleOverride || CONFIG.scale;
            const viewport = page.getViewport({
                scale: scale
            });
            const canvas = document.createElement('canvas');
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            const ctx = canvas.getContext('2d', {
                alpha: false
            });
            // Fondo blanco para PDFs transparentes
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            await page.render({
                canvasContext: ctx,
                viewport: viewport
            }).promise;
            return canvas;
        }

        function splitHalf(canvas, side) {
            const hw = Math.floor(canvas.width / 2);
            const out = document.createElement('canvas');
            out.width = hw;
            out.height = canvas.height;
            out.getContext('2d').drawImage(canvas, side === 'left' ? 0 : hw, 0, hw, canvas.height, 0, 0, hw, canvas.height);
            return out;
        }

        function canvasToDataURL(canvas) {
            const data = canvas.toDataURL('image/jpeg', CONFIG.jpegQuality);
            // Liberar canvas original inmediatamente
            releaseCanvas(canvas);
            return data;
        }

        /* ═══════════════════════════════════════════════════════════════════
           LAZY RENDERING — Solo página actual ± preloadRange
           ═══════════════════════════════════════════════════════════════════ */
        async function lazyRenderPage(flipIdx) {
            if (flipIdx < 0 || flipIdx >= state.totalFlipPages) return;
            if (state.pageImages[flipIdx] && state.pageImages[flipIdx] !== 'placeholder') return;

            const meta = state.flipMeta[flipIdx];
            if (!meta) return;

            try {
                const canvas = await renderPdfPage(state.pdf, meta.pdfPage);
                let src;
                if (meta.side === null) {
                    src = canvasToDataURL(canvas);
                } else {
                    src = canvasToDataURL(splitHalf(canvas, meta.side));
                }
                state.pageImages[flipIdx] = src;

                // Actualizar DOM si existe
                const imgEl = document.querySelector('#flipbook .page:nth-child(' + (flipIdx + 1) + ') img');
                if (imgEl && imgEl.src !== src) {
                    imgEl.src = src;
                }
            } catch (err) {
                console.warn('[LazyRender] Error en página', flipIdx, err);
            }
        }

        function preloadNeighbors(centerIdx) {
            for (let i = -CONFIG.preloadRange; i <= CONFIG.preloadRange; i++) {
                const idx = centerIdx + i;
                if (idx >= 0 && idx < state.totalFlipPages) {
                    lazyRenderPage(idx);
                }
            }
        }

        /* ═══════════════════════════════════════════════════════════════════
           THUMBNAILS
           ═══════════════════════════════════════════════════════════════════ */
        function buildThumbnails() {
            const container = document.getElementById('thumb-scroll');
            if (!container) return;
            container.innerHTML = '';
            state.pageImages.forEach(function(src, idx) {
                const div = document.createElement('div');
                div.className = 'thumb-item' + (idx === 0 ? ' active' : '');
                div.setAttribute('data-page', idx);
                div.setAttribute('role', 'button');
                div.setAttribute('aria-label', (IS_ES ? 'Página' : 'Page') + ' ' + (idx + 1));
                div.setAttribute('tabindex', '0');
                const img = document.createElement('img');
                img.src = src || createPlaceholder(120, 170);
                img.loading = 'lazy';
                img.alt = '';
                div.appendChild(img);
                div.addEventListener('click', function() {
                    if (state.book) {
                        state.book.flip(idx);
                        syncUI();
                    }
                });
                div.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        if (state.book) {
                            state.book.flip(idx);
                            syncUI();
                        }
                    }
                });
                container.appendChild(div);
            });
            state.thumbnailsReady = true;
        }

        function updateActiveThumbnail(idx) {
            if (!state.thumbnailsReady) return;
            const items = document.querySelectorAll('.thumb-item');
            items.forEach(function(el, i) {
                el.classList.toggle('active', i === idx);
            });
            const active = items[idx];
            if (active) active.scrollIntoView({
                behavior: 'smooth',
                inline: 'center',
                block: 'nearest'
            });
        }

        function toggleThumbnails() {
            const panel = document.getElementById('thumb-panel');
            if (!panel) return;
            const isOpen = panel.classList.contains('open');
            panel.classList.toggle('open', !isOpen);
            state.analytics.thumbCount++;
            logAnalytics('thumbnails', {
                action: isOpen ? 'close' : 'open'
            });
        }

        /* ═══════════════════════════════════════════════════════════════════
           SWIPE HINT
           ═══════════════════════════════════════════════════════════════════ */
        function hideSwipeHint() {
            const hint = document.getElementById('swipe-hint');
            if (hint) hint.classList.add('hidden');
        }

        function showSwipeHint() {
            const hint = document.getElementById('swipe-hint');
            if (hint && env.isMobile) {
                hint.classList.remove('hidden');
                setTimeout(hideSwipeHint, 3500);
            }
        }


        /* ═══════════════════════════════════════════════════════════════════
           INLINE ZOOM SYSTEM — Desktop + Tablet
           ═══════════════════════════════════════════════════════════════════ */
        function zoomIn() {
            if (state.inlineZoom >= CONFIG.maxZoom) {
                if (env.isMobile) openZoomOverlay();
                return;
            }
            state.inlineZoom = Math.min(state.inlineZoom + CONFIG.zoomStep, CONFIG.maxZoom);
            applyInlineZoom();
            trackZoom('in');
        }

        function zoomOut() {
            if (state.inlineZoom <= CONFIG.minZoom) return;
            state.inlineZoom = Math.max(state.inlineZoom - CONFIG.zoomStep, CONFIG.minZoom);
            applyInlineZoom();
            trackZoom('out');
        }

        function zoomFit() {
            state.inlineZoom = CONFIG.minZoom;
            applyInlineZoom();
            trackZoom('fit');
        }

        function applyInlineZoom() {
            const wrapper = document.getElementById('zoom-wrapper');
            const container = document.getElementById('zoom-container');
            if (!wrapper) return;
            wrapper.style.transform = 'scale(' + state.inlineZoom.toFixed(2) + ')';
            if (container) {
                container.classList.toggle('zoomed', state.inlineZoom > 1);
                if (state.inlineZoom <= 1) {
                    container.scrollLeft = 0;
                    container.scrollTop = 0;
                }
            }
            updateZoomButtons();
        }

        function updateZoomButtons() {
            const ids = ['zoom-in-btn', 'zoom-out-btn', 'zoom-fit-btn', 'c-zoom-in', 'c-zoom-out', 'c-zoom-fit'];
            ids.forEach(function(id) {
                const el = document.getElementById(id);
                if (!el) return;
                if (id.includes('in')) el.disabled = (state.inlineZoom >= CONFIG.maxZoom);
                else if (id.includes('out')) el.disabled = (state.inlineZoom <= CONFIG.minZoom);
                else if (id.includes('fit')) el.classList.toggle('active', state.inlineZoom > 1);
            });
        }

        /** Pan con click-and-drag en desktop cuando zoom > 1 */
        function initDesktopPan() {
            const container = document.getElementById('zoom-container');
            if (!container) return;

            container.addEventListener('mousedown', function(e) {
                if (state.inlineZoom <= 1) return;
                e.preventDefault();
                state.isPanning = true;
                state.panStartX = e.clientX;
                state.panStartY = e.clientY;
                state.scrollStartX = container.scrollLeft;
                state.scrollStartY = container.scrollTop;
                container.style.cursor = 'grabbing';
            });

            window.addEventListener('mousemove', function(e) {
                if (!state.isPanning) return;
                e.preventDefault();
                container.scrollLeft = state.scrollStartX - (e.clientX - state.panStartX);
                container.scrollTop = state.scrollStartY - (e.clientY - state.panStartY);
            });

            window.addEventListener('mouseup', function() {
                if (state.isPanning) {
                    state.isPanning = false;
                    if (container) container.style.cursor = '';
                }
            });

            // Wheel zoom con Ctrl/Cmd
            container.addEventListener('wheel', function(e) {
                if (e.ctrlKey || e.metaKey) {
                    e.preventDefault();
                    e.deltaY < 0 ? zoomIn() : zoomOut();
                }
            }, {
                passive: false
            });
        }

        /* ═══════════════════════════════════════════════════════════════════
           ZOOM OVERLAY — Mobile pinch/pan/double-tap + Desktop wheel
           ═══════════════════════════════════════════════════════════════════ */
        function openZoomOverlay() {
            if (!state.book || !state.pageImages.length) return;
            state.overlayPageIdx = state.currentPage;
            showOverlayPage(state.overlayPageIdx);
            document.getElementById('zoom-overlay').classList.add('active');
            document.body.style.overflow = 'hidden';
            trackOverlay();
            if (!state.overlayListeners) {
                initOverlayGestures();
                state.overlayListeners = true;
            }
        }

        function closeZoomOverlay() {
            document.getElementById('zoom-overlay').classList.remove('active');
            document.body.style.overflow = '';
            state.overlayZoom = 1;
            state.overlayPanX = 0;
            state.overlayPanY = 0;
        }

        function zoomOverlayPrev() {
            if (state.overlayPageIdx > 0) showOverlayPage(state.overlayPageIdx - 1);
        }

        function zoomOverlayNext() {
            if (state.overlayPageIdx < state.pageImages.length - 1) showOverlayPage(state.overlayPageIdx + 1);
        }

        function zoomOverlayReset() {
            state.overlayZoom = 1;
            state.overlayPanX = 0;
            state.overlayPanY = 0;
            const pan = document.getElementById('zoom-overlay-pan');
            if (pan) {
                pan.classList.add('animating');
                applyOverlayTransform();
                updateOverlayUI();
                setTimeout(function() {
                    pan.classList.remove('animating');
                }, 300);
            }
        }

        function showOverlayPage(idx) {
            state.overlayPageIdx = idx;
            const img = document.getElementById('zoom-overlay-image');
            if (state.pageImages[idx] && img) img.src = state.pageImages[idx];
            state.overlayZoom = 1;
            state.overlayPanX = 0;
            state.overlayPanY = 0;
            const pan = document.getElementById('zoom-overlay-pan');
            if (pan) {
                pan.classList.add('animating');
                applyOverlayTransform();
                updateOverlayUI();
                setTimeout(function() {
                    pan.classList.remove('animating');
                }, 300);
            }
        }

        function applyOverlayTransform() {
            const pan = document.getElementById('zoom-overlay-pan');
            if (pan) {
                pan.style.transform = 'translate(' + state.overlayPanX.toFixed(1) + 'px, ' + state.overlayPanY.toFixed(1) + 'px) scale(' + state.overlayZoom.toFixed(2) + ')';
            }
        }

        function updateOverlayUI() {
            const total = state.pageImages.length;
            const title = document.getElementById('zoom-overlay-title');
            if (title) title.textContent = (IS_ES ? 'Página' : 'Page') + ' ' + (state.overlayPageIdx + 1) + ' / ' + total;
            const prevBtn = document.getElementById('zoom-prev');
            const nextBtn = document.getElementById('zoom-next');
            if (prevBtn) prevBtn.disabled = (state.overlayPageIdx <= 0);
            if (nextBtn) nextBtn.disabled = (state.overlayPageIdx >= total - 1);
            const info = document.getElementById('zoom-overlay-info');
            if (info) info.textContent = Math.round(state.overlayZoom * 100) + '%';
        }

        function getTouchDistance(t1, t2) {
            const dx = t1.clientX - t2.clientX,
                dy = t1.clientY - t2.clientY;
            return Math.sqrt(dx * dx + dy * dy);
        }

        function clampOverlayPan() {
            if (state.overlayZoom <= 1) {
                state.overlayPanX = 0;
                state.overlayPanY = 0;
                return;
            }
            const img = document.getElementById('zoom-overlay-image');
            const content = document.getElementById('zoom-overlay-content');
            if (!img || !content || !img.naturalWidth) return;
            const scaledW = img.naturalWidth * state.overlayZoom;
            const scaledH = img.naturalHeight * state.overlayZoom;
            const maxPanX = Math.max(0, (scaledW - content.clientWidth) / 2);
            const maxPanY = Math.max(0, (scaledH - content.clientHeight) / 2);
            state.overlayPanX = Math.max(-maxPanX, Math.min(maxPanX, state.overlayPanX));
            state.overlayPanY = Math.max(-maxPanY, Math.min(maxPanY, state.overlayPanY));
        }

        function initOverlayGestures() {
            const content = document.getElementById('zoom-overlay-content');
            const pan = document.getElementById('zoom-overlay-pan');
            if (!content || !pan) return;

            let touchMode = null,
                lastPinchDist = 0,
                pinchStartScale = 1;
            let touchStartX = 0,
                touchStartY = 0,
                panStartX = 0,
                panStartY = 0;
            let lastTapTime = 0,
                lastTapX = 0,
                lastTapY = 0;

            content.addEventListener('touchstart', function(e) {
                if (e.touches.length === 2) {
                    e.preventDefault();
                    touchMode = 'pinch';
                    lastPinchDist = getTouchDistance(e.touches[0], e.touches[1]);
                    pinchStartScale = state.overlayZoom;
                } else if (e.touches.length === 1) {
                    const now = Date.now();
                    const touch = e.touches[0];
                    // Double-tap detection
                    if (now - lastTapTime < 300 && Math.abs(touch.clientX - lastTapX) < 30 && Math.abs(touch.clientY - lastTapY) < 30) {
                        e.preventDefault();
                        lastTapTime = 0;
                        pan.classList.add('animating');
                        if (state.overlayZoom > 1.1) {
                            state.overlayZoom = 1;
                            state.overlayPanX = 0;
                            state.overlayPanY = 0;
                        } else {
                            state.overlayZoom = 2.5;
                            state.overlayPanX = 0;
                            state.overlayPanY = 0;
                        }
                        clampOverlayPan();
                        applyOverlayTransform();
                        updateOverlayUI();
                        setTimeout(function() {
                            pan.classList.remove('animating');
                        }, 300);
                        touchMode = null;
                        return;
                    }
                    lastTapTime = now;
                    lastTapX = touch.clientX;
                    lastTapY = touch.clientY;
                    touchMode = 'pan';
                    touchStartX = touch.clientX;
                    touchStartY = touch.clientY;
                    panStartX = state.overlayPanX;
                    panStartY = state.overlayPanY;
                }
            }, {
                passive: false
            });

            content.addEventListener('touchmove', function(e) {
                if (touchMode === 'pinch' && e.touches.length === 2) {
                    e.preventDefault();
                    const dist = getTouchDistance(e.touches[0], e.touches[1]);
                    const newScale = pinchStartScale * (dist / lastPinchDist);
                    state.overlayZoom = Math.max(0.5, Math.min(5, newScale));
                    clampOverlayPan();
                    applyOverlayTransform();
                    updateOverlayUI();
                } else if (touchMode === 'pan' && e.touches.length === 1 && state.overlayZoom > 1) {
                    e.preventDefault();
                    state.overlayPanX = panStartX + (e.touches[0].clientX - touchStartX);
                    state.overlayPanY = panStartY + (e.touches[0].clientY - touchStartY);
                    clampOverlayPan();
                    applyOverlayTransform();
                }
            }, {
                passive: false
            });

            content.addEventListener('touchend', function(e) {
                if (e.touches.length === 0) {
                    touchMode = null;
                } else if (e.touches.length === 1 && touchMode === 'pinch') {
                    touchMode = 'pan';
                    touchStartX = e.touches[0].clientX;
                    touchStartY = e.touches[0].clientY;
                    panStartX = state.overlayPanX;
                    panStartY = state.overlayPanY;
                }
            });

            content.addEventListener('wheel', function(e) {
                e.preventDefault();
                const delta = e.deltaY > 0 ? 0.9 : 1.1;
                state.overlayZoom = Math.max(0.5, Math.min(5, state.overlayZoom * delta));
                clampOverlayPan();
                applyOverlayTransform();
                updateOverlayUI();
            }, {
                passive: false
            });
        }

        /* ═══════════════════════════════════════════════════════════════════
           NAVIGATION & UI SYNC
           ═══════════════════════════════════════════════════════════════════ */
        function prevPage() {
            if (state.book) state.book.flipPrev('bottom');
        }

        function nextPage() {
            if (state.book) state.book.flipNext('bottom');
        }

        function goToPage(n) {
            if (state.book) state.book.flip(Math.min(n, state.totalFlipPages - 1));
        }

        function goToLast() {
            goToPage(state.totalFlipPages - 1);
        }

        function syncUI() {
            if (!state.book) return;
            const cur = state.book.getCurrentPageIndex();
            const total = state.book.getPageCount();
            trackPageView(cur);

            const label = (cur + 1) + ' / ' + total;
            ['page-counter', 'm-counter'].forEach(function(id) {
                const el = document.getElementById(id);
                if (el) el.textContent = label;
            });

            const progressPct = total > 1 ? ((cur / (total - 1)) * 100) : 100;
            const bar = document.getElementById('page-progress-bar');
            if (bar) {
                bar.style.width = progressPct + '%';
                bar.parentElement.setAttribute('aria-valuenow', Math.round(progressPct));
            }

            const atStart = cur === 0,
                atEnd = cur >= total - 1;
            ['c-first', 'c-prev', 'btn-prev-d', 'm-prev'].forEach(function(id) {
                const el = document.getElementById(id);
                if (el) el.disabled = atStart;
            });
            ['c-last', 'c-next', 'btn-next-d', 'm-next'].forEach(function(id) {
                const el = document.getElementById(id);
                if (el) el.disabled = atEnd;
            });

            updateActiveThumbnail(cur);
            preloadNeighbors(cur);
            evictFarPages(cur);

            // Header auto-hide en móvil al leer
            if (env.isMobile && cur > 0) {
                document.getElementById('main-header').style.transform = 'translateY(-100%)';
            } else {
                document.getElementById('main-header').style.transform = '';
            }
        }

        /* ═══════════════════════════════════════════════════════════════════
           FULLSCREEN
           ═══════════════════════════════════════════════════════════════════ */
        function toggleFullscreen() {
            const doc = document;
            if (!doc.fullscreenElement && !doc.webkitFullscreenElement) {
                const el = doc.documentElement;
                (el.requestFullscreen || el.webkitRequestFullscreen).call(el).catch(function() {});
                state.analytics.fullscreenCount++;
                logAnalytics('fullscreen', {
                    count: state.analytics.fullscreenCount
                });
            } else {
                (doc.exitFullscreen || doc.webkitExitFullscreen).call(doc).catch(function() {});
            }
        }

        function onFullscreenChange() {
            const icon = document.getElementById('fs-icon');
            if (!icon) return;
            icon.className = !!(document.fullscreenElement || document.webkitFullscreenElement) ?
                'fa-solid fa-compress' : 'fa-solid fa-expand';
        }
        document.addEventListener('fullscreenchange', onFullscreenChange);
        document.addEventListener('webkitfullscreenchange', onFullscreenChange);

        /* ═══════════════════════════════════════════════════════════════════
           KEYBOARD NAVIGATION
           ═══════════════════════════════════════════════════════════════════ */
        document.addEventListener('keydown', function(e) {
            if (['INPUT', 'TEXTAREA', 'SELECT'].includes(e.target.tagName)) return;
            const overlayActive = document.getElementById('zoom-overlay').classList.contains('active');
            switch (e.key) {
                case 'ArrowLeft':
                    overlayActive ? zoomOverlayPrev() : prevPage();
                    break;
                case 'ArrowRight':
                    overlayActive ? zoomOverlayNext() : nextPage();
                    break;
                case 'Home':
                    if (!overlayActive) goToPage(0);
                    break;
                case 'End':
                    if (!overlayActive) goToLast();
                    break;
                case 'f':
                case 'F':
                    toggleFullscreen();
                    break;
                case 'Escape':
                    closeZoomOverlay();
                    const thumbPanel = document.getElementById('thumb-panel');
                    if (thumbPanel && thumbPanel.classList.contains('open')) toggleThumbnails();
                    break;
                case '+':
                case '=':
                    if (overlayActive) {
                        state.overlayZoom = Math.min(5, state.overlayZoom * 1.2);
                        clampOverlayPan();
                        applyOverlayTransform();
                        updateOverlayUI();
                    } else zoomIn();
                    break;
                case '-':
                    if (overlayActive) {
                        state.overlayZoom = Math.max(0.5, state.overlayZoom / 1.2);
                        clampOverlayPan();
                        applyOverlayTransform();
                        updateOverlayUI();
                    } else zoomOut();
                    break;
            }
        });


        /* ═══════════════════════════════════════════════════════════════════
           PDF LOADING — Pipeline con lazy render y gestión de memoria
           ═══════════════════════════════════════════════════════════════════ */
        async function loadPDF() {
            state.isRendering = true;
            try {
                // Paso 1: Abrir PDF con timeout de red
                setProgress(3, IS_ES ? 'Conectando...' : 'Connecting...');
                const loadPromise = pdfjsLib.getDocument({
                    url: PDF_URL,
                    disableRange: false,
                    disableStream: false
                }).promise;
                const timeoutPromise = new Promise(function(_, reject) {
                    setTimeout(function() {
                        reject(new Error(IS_ES ? 'Tiempo de espera agotado' : 'Connection timeout'));
                    }, 30000);
                });
                state.pdf = await Promise.race([loadPromise, timeoutPromise]);
                const numPages = state.pdf.numPages;
                state.totalPdfPages = numPages;

                // Paso 2: Analizar orientaciones con muestra ligera
                setProgress(8, IS_ES ? 'Analizando documento...' : 'Analyzing document...');
                const orientations = [];
                let sampleW = 0,
                    sampleH = 0;

                for (let i = 1; i <= numPages; i++) {
                    const page = await state.pdf.getPage(i);
                    const vp = page.getViewport({
                        scale: 1.0
                    }); // Muestra ligera
                    const isLandscape = vp.width > vp.height;
                    orientations.push(isLandscape);
                    if (!sampleW && !isLandscape) {
                        sampleW = Math.round(vp.width * CONFIG.scale);
                        sampleH = Math.round(vp.height * CONFIG.scale);
                    }
                }

                if (!sampleW) {
                    const firstPage = await state.pdf.getPage(1);
                    const firstVp = firstPage.getViewport({
                        scale: CONFIG.scale
                    });
                    sampleW = Math.floor(firstVp.width / 2);
                    sampleH = Math.round(firstVp.height);
                }

                // Paso 3: Construir mapa de flip pages
                const flipMeta = [];
                for (let i = 0; i < numPages; i++) {
                    if (orientations[i]) {
                        flipMeta.push({
                            pdfPage: i + 1,
                            side: 'left'
                        });
                        flipMeta.push({
                            pdfPage: i + 1,
                            side: 'right'
                        });
                    } else {
                        flipMeta.push({
                            pdfPage: i + 1,
                            side: null
                        });
                    }
                }
                state.flipMeta = flipMeta;
                state.totalFlipPages = flipMeta.length;
                state.pageImages = new Array(state.totalFlipPages).fill(null);

                // Paso 4: Crear DOM con placeholders
                setProgress(12, IS_ES ? 'Preparando visor...' : 'Preparing viewer...');
                const placeholder = createPlaceholder(sampleW, sampleH);
                const container = document.getElementById('flipbook');
                container.innerHTML = '';

                flipMeta.forEach(function(meta, idx) {
                    const div = document.createElement('div');
                    div.className = 'page';
                    const img = document.createElement('img');
                    img.src = placeholder;
                    img.draggable = false;
                    img.loading = 'lazy';
                    img.alt = (IS_ES ? 'Página' : 'Page') + ' ' + (idx + 1);
                    div.appendChild(img);
                    container.appendChild(div);
                });

                // Paso 5: Inicializar flipbook inmediatamente (con placeholders)
                setProgress(15, IS_ES ? 'Iniciando visor...' : 'Starting viewer...');
                env.detect();
                initBook(container, sampleW, sampleH);
                initDesktopPan();

                // Paso 6: Renderizado LAZY — solo primer batch visible
                const uniquePdfPages = [];
                const seen = {};
                flipMeta.forEach(function(m) {
                    if (!seen[m.pdfPage]) {
                        seen[m.pdfPage] = true;
                        uniquePdfPages.push(m.pdfPage);
                    }
                });
                state.uniquePdfPages = uniquePdfPages;

                // Render inicial: solo las primeras páginas visibles (current + neighbors)
                const initialBatch = [];
                for (let i = 0; i < Math.min(CONFIG.batchSize * 2, state.totalFlipPages); i++) {
                    initialBatch.push(i);
                }

                let completed = 0;
                await Promise.all(initialBatch.map(async function(flipIdx) {
                    await lazyRenderPage(flipIdx);
                    completed++;
                    const pct = 15 + Math.round((completed / initialBatch.length) * 35);
                    setProgress(pct, IS_ES ? 'Página ' + completed + ' lista' : 'Page ' + completed + ' ready');
                }));

                // Paso 7: Render background del resto en batches pequeños
                const remaining = [];
                for (let i = initialBatch.length; i < state.totalFlipPages; i++) remaining.push(i);

                for (let b = 0; b < remaining.length; b += CONFIG.batchSize) {
                    const batch = remaining.slice(b, b + CONFIG.batchSize);
                    await Promise.all(batch.map(async function(flipIdx) {
                        await lazyRenderPage(flipIdx);
                        completed++;
                    }));
                    const pct = 50 + Math.round((completed / state.totalFlipPages) * 50);
                    setProgress(pct, IS_ES ? 'Procesando...' : 'Processing...');

                    // Yield al event loop para mantener UI responsive
                    await new Promise(function(r) {
                        requestAnimationFrame(r);
                    });
                }

                setProgress(100, IS_ES ? '¡Listo!' : 'Ready!');
                setTimeout(function() {
                    hideLoading();
                }, 400);

                // Construir thumbnails después de que haya imágenes
                buildThumbnails();
                setTimeout(showSwipeHint, 2000);

                logAnalytics('load_complete', {
                    totalPages: state.totalFlipPages,
                    pdfPages: numPages,
                    device: env.isMobile ? 'mobile' : (env.isTablet ? 'tablet' : 'desktop'),
                    resolution: env.width + 'x' + env.height
                });

            } catch (err) {
                console.error('[MrLucky Viewer]', err);
                state.loadError = err;
                showError(err.message || String(err), err.name);
                logAnalytics('load_error', {
                    message: err.message,
                    name: err.name
                });
            } finally {
                state.isRendering = false;
            }
        }

        /* ═══════════════════════════════════════════════════════════════════
           INIT BOOK — Responsive inteligente basado en datos reales
           ═══════════════════════════════════════════════════════════════════ */
        function initBook(container, pageW, pageH) {
            hideLoading();

            const aspectH_W = pageH / pageW;
            const headerEl = document.querySelector('header');
            const headerH = headerEl ? headerEl.offsetHeight : 52;

            const mobileNavH = env.isMobile ? 90 : 0;
            const desktopCtrlH = (!env.isMobile && !env.isTablet) ? 60 : 0;
            const gapsH = env.isMobile ? 16 : 24;

            const usedV = headerH + mobileNavH + desktopCtrlH + gapsH;
            const avH = Math.max(window.innerHeight - usedV, 180);
            const avW = Math.max(window.innerWidth - (env.isMobile ? 12 : 140), 140);

            let pW, pH, usePortrait = true;

            if (env.isUltraMobile) {
                // 360px: máxima legibilidad, 1 página, sin sombras pesadas
                usePortrait = true;
                pW = Math.min(avW, 340);
                pH = Math.round(pW * aspectH_W);
                if (pH > avH) {
                    pH = avH;
                    pW = Math.round(pH / aspectH_W);
                }
            } else if (env.isMobile) {
                // 375-599px: 1 página optimizada
                usePortrait = true;
                pW = Math.min(avW, 420);
                pH = Math.round(pW * aspectH_W);
                if (pH > avH) {
                    pH = avH;
                    pW = Math.round(pH / aspectH_W);
                }
            } else if (env.isTablet) {
                // 800-1024px: evaluar espacio para 1 o 2 páginas
                pH = Math.min(avH, 680);
                pW = Math.round(pH / aspectH_W);
                if (pW * 2 + 40 <= avW) {
                    usePortrait = false;
                } else {
                    usePortrait = true;
                    pW = Math.min(avW, 480);
                    pH = Math.round(pW * aspectH_W);
                    if (pH > avH) {
                        pH = avH;
                        pW = Math.round(pH / aspectH_W);
                    }
                }
            } else {
                // Desktop: doble página (spread)
                usePortrait = false;
                pH = Math.min(avH, 760);
                pW = Math.round(pH / aspectH_W);
                if (pW * 2 + 40 > avW) {
                    pW = Math.floor((avW - 40) / 2);
                    pH = Math.round(pW * aspectH_W);
                }
            }

            pW = Math.max(pW, 100);
            pH = Math.max(pH, 140);

            // Configuración de animación según capacidad del dispositivo
            const flipTime = env.isLowMemory ? 400 : (env.isMobile ? 550 : 700);
            const showCorners = !env.isMobile && !env.isTablet && !env.isLowMemory;
            const useMouse = !env.isMobile;
            const swipeDist = env.isMobile ? 18 : 45;

            state.book = new St.PageFlip(container, {
                width: pW,
                height: pH,
                size: 'fixed',
                drawShadow: !env.isUltraMobile, // Sin sombras en ultra móvil
                maxShadowOpacity: env.isLowMemory ? 0.15 : 0.35,
                flippingTime: flipTime,
                usePortrait: usePortrait,
                startPage: 0,
                showCover: true,
                mobileScrollSupport: false,
                clickEventForward: true,
                useMouseEvents: useMouse,
                swipeDistance: swipeDist,
                showPageCorners: showCorners,
                disableFlipByClick: false,
            });

            state.book.loadFromHTML(container.querySelectorAll('.page'));
            state.book.on('flip', syncUI);
            state.book.on('changeState', syncUI);

            syncUI();
        }

        /* ═══════════════════════════════════════════════════════════════════
           RESIZE / ORIENTATION — Debounce obligatorio, recálculo inteligente
           ═══════════════════════════════════════════════════════════════════ */
        let lastOrientation = window.innerWidth > window.innerHeight ? 'landscape' : 'portrait';
        let resizeTimer;

        const handleResize = debounce(function() {
            const newOrientation = window.innerWidth > window.innerHeight ? 'landscape' : 'portrait';
            if (newOrientation !== lastOrientation) {
                lastOrientation = newOrientation;
                env.detect();
                if (state.book) {
                    const flipContainer = document.getElementById('flipbook');
                    const pages = flipContainer.querySelectorAll('.page');
                    const firstPage = pages[0];
                    if (firstPage) {
                        const img = firstPage.querySelector('img');
                        if (img && img.naturalWidth && img.naturalHeight) {
                            state.book.destroy();
                            state.book = null;
                            initBook(flipContainer, img.naturalWidth, img.naturalHeight);
                        }
                    }
                }
            }
            // Actualizar envío de analytics de scroll depth
            state.analytics.maxScrollDepth = Math.max(state.analytics.maxScrollDepth, window.scrollY);
        }, 250);

        window.addEventListener('resize', handleResize);
        window.addEventListener('orientationchange', function() {
            setTimeout(handleResize, 350);
        });

        // Visibility API: pausar/reanudar según visibilidad de pestaña
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                // Liberar memoria cuando pestaña no visible
                if (state.pageCanvases.size > 0) {
                    state.pageCanvases.forEach(function(canvas) {
                        releaseCanvas(canvas);
                    });
                    state.pageCanvases.clear();
                }
            } else {
                // Restaurar páginas cercanas
                if (state.book) preloadNeighbors(state.book.getCurrentPageIndex());
            }
        });

        /* ═══════════════════════════════════════════════════════════════════
           INICIALIZACIÓN
           ═══════════════════════════════════════════════════════════════════ */
        env.detect();
        loadPDF();

        // Analytics de abandono
        window.addEventListener('beforeunload', function() {
            const sessionTime = Date.now() - state.analytics.sessionStart;
            logAnalytics('session_end', {
                duration: sessionTime,
                pagesViewed: Object.keys(state.analytics.pageTime).length,
                maxScrollDepth: state.analytics.maxScrollDepth,
                zoomUses: state.analytics.zoomCount,
                overlayUses: state.analytics.overlayCount,
                errors: state.analytics.errors.length
            });
        });
    </script>

</body>

</html>