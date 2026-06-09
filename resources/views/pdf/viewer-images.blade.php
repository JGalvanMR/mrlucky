<!DOCTYPE html>
<html lang="{{ App::currentLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>{{ $boletin['titulo'] ?? 'Boletín · Mr. Lucky' }}</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#003ca6">
    <meta name="format-detection" content="telephone=no">

    {{-- Fuentes optimizadas con display=swap --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome 4.7 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/all.min.css" crossorigin="anonymous">

    {{-- Solo page-flip — SIN PDF.js --}}
    <script src="https://cdn.jsdelivr.net/npm/page-flip@2.0.7/dist/js/page-flip.browser.js"></script>

    <style>
        /* ══════════════════════════════════════════════════════════════
           RESET & VARIABLES — Mr. Lucky Design System
           Imagen-based viewer (NO PDF.js required)
        ══════════════════════════════════════════════════════════════ */
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

            --shadow-book: 0 20px 60px rgba(0, 60, 166, 0.15), 0 4px 16px rgba(0, 0, 0, 0.1);
            --shadow-ctrl: 0 4px 24px rgba(0, 0, 0, 0.1);
            --shadow-card: 0 2px 12px rgba(0, 0, 0, 0.08);
            --shadow-float: 0 8px 32px rgba(0, 60, 166, 0.2);

            --radius-sm: 6px;
            --radius: 10px;
            --radius-lg: 16px;
            --radius-pill: 50px;

            --transition-fast: all 0.15s ease;
            --transition: all 0.25s ease;
            --transition-slow: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);

            --header-h: 56px;
            --toolbar-h: 56px;
            --nav-h: 52px;
        }

        html {
            height: 100%;
            overflow: hidden;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            height: 100%;
            display: flex;
            flex-direction: column;
            background: var(--gris-bg);
            font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: #333;
            overflow: hidden;
            touch-action: manipulation;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overscroll-behavior: none;
        }

        @supports (padding: env(safe-area-inset-top)) {
            body {
                padding-top: env(safe-area-inset-top);
                padding-bottom: env(safe-area-inset-bottom);
                padding-left: env(safe-area-inset-left);
                padding-right: env(safe-area-inset-right);
            }
        }

        /* ══════════════════════════════════════════════════════════════
           HEADER
        ══════════════════════════════════════════════════════════════ */
        header {
            position: relative;
            z-index: 100;
            flex-shrink: 0;
            height: var(--header-h);
            background: linear-gradient(135deg, var(--azul) 0%, var(--azul-mid) 100%);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 clamp(10px, 3vw, 24px);
            box-shadow: 0 2px 16px rgba(0, 60, 166, 0.3);
        }

        @supports (padding: env(safe-area-inset-top)) {
            header {
                padding-top: env(safe-area-inset-top);
                height: calc(var(--header-h) + env(safe-area-inset-top));
            }
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
            flex: 1;
        }

        .header-logo {
            width: 34px;
            height: 34px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(4px);
        }

        .header-logo i {
            color: var(--amarillo);
            font-size: 16px;
        }

        .header-text {
            min-width: 0;
        }

        .header-title {
            font-family: 'Pacifico', cursive;
            font-size: clamp(11px, 3.5vw, 15px);
            color: var(--blanco);
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .header-subtitle {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.65);
            font-weight: 300;
            white-space: nowrap;
        }

        .header-actions {
            display: flex;
            gap: 8px;
            flex-shrink: 0;
        }

        .hdr-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            color: var(--blanco);
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-fast);
            -webkit-tap-highlight-color: transparent;
            text-decoration: none;
            backdrop-filter: blur(4px);
        }

        .hdr-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .hdr-btn:active {
            transform: scale(0.92);
        }

        .hdr-btn-verde {
            border-color: rgba(86, 178, 118, 0.6);
        }

        .hdr-btn-verde:hover {
            background: rgba(86, 178, 118, 0.3);
        }

        /* ══════════════════════════════════════════════════════════════
           LOADING
        ══════════════════════════════════════════════════════════════ */
        #loading {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 32px 24px;
            gap: 20px;
            text-align: center;
        }

        .loading-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--azul) 0%, var(--azul-mid) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-float);
            animation: loadPulse 2s ease-in-out infinite;
        }

        .loading-icon i {
            color: var(--blanco);
            font-size: 30px;
        }

        @keyframes loadPulse {

            0%,
            100% {
                transform: scale(1);
                box-shadow: var(--shadow-float);
            }

            50% {
                transform: scale(1.06);
                box-shadow: 0 12px 40px rgba(0, 60, 166, 0.3);
            }
        }

        .loading-title {
            font-family: 'Pacifico', cursive;
            font-size: 20px;
            color: var(--azul);
        }

        .loading-detail {
            font-size: 13px;
            color: var(--gris);
        }

        .skeleton-wrap {
            width: 200px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .skeleton-line {
            border-radius: 4px;
            background: linear-gradient(90deg, #e8ecf2 25%, #f4f6f9 50%, #e8ecf2 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        .skeleton-line.title {
            height: 14px;
            width: 80%;
        }

        .skeleton-line.text1 {
            height: 8px;
            width: 100%;
        }

        .skeleton-line.text2 {
            height: 8px;
            width: 90%;
        }

        .skeleton-line.img-block {
            height: 60px;
            width: 100%;
            border-radius: 6px;
        }

        .skeleton-line.text3 {
            height: 8px;
            width: 95%;
        }

        .skeleton-line.text4 {
            height: 8px;
            width: 70%;
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
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 4px;
        }

        .progress-rail {
            width: 180px;
            height: 4px;
            background: var(--gris-claro);
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, var(--azul), var(--verde));
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .progress-pct {
            font-size: 12px;
            font-weight: 600;
            color: var(--azul);
            min-width: 36px;
        }

        /* ══════════════════════════════════════════════════════════════
           ERROR SCREEN
        ══════════════════════════════════════════════════════════════ */
        #error-screen {
            display: none;
            flex: 1;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 32px 24px;
            gap: 14px;
            text-align: center;
        }

        .error-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: var(--rojo);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-icon i {
            color: #fff;
            font-size: 24px;
        }

        .error-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--negro);
        }

        .error-body {
            font-size: 13px;
            color: var(--gris);
            max-width: 300px;
        }

        .error-code {
            font-size: 11px;
            color: var(--gris-claro);
            font-family: monospace;
            word-break: break-all;
        }

        .btn-retry {
            padding: 10px 24px;
            border: none;
            background: var(--azul);
            color: #fff;
            border-radius: var(--radius-pill);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition-fast);
            font-family: 'Roboto', sans-serif;
        }

        .btn-retry:hover {
            background: var(--azul-dark);
        }

        /* ══════════════════════════════════════════════════════════════
           MAIN VIEWER
        ══════════════════════════════════════════════════════════════ */
        #viewer {
            display: none;
            flex: 1;
            flex-direction: column;
            padding: 10px 20px;
            gap: 10px;
            min-height: 0;
        }

        /* Page Progress Bar */
        .page-progress {
            flex-shrink: 0;
            height: 3px;
            background: var(--gris-claro);
            border-radius: 2px;
            overflow: hidden;
        }

        .page-progress-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, var(--azul), var(--verde));
            border-radius: 2px;
            transition: width 0.35s ease;
        }

        /* Book Stage */
        .book-stage {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            min-height: 0;
            position: relative;
            touch-action: pan-y;
        }

        .book-shadow {
            position: absolute;
            width: 90%;
            max-width: 1100px;
            height: 16px;
            bottom: -8px;
            background: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.08), transparent 70%);
            pointer-events: none;
            z-index: 1;
        }

        /* Flipbook Container */
        #flipbook {
            position: relative;
            box-shadow: var(--shadow-book);
            border-radius: 4px;
            overflow: hidden;
            background: #fff;
        }

        .page {
            background: #fff;
        }

        .page img {
            width: 100%;
            height: 100%;
            object-fit: fill;
            display: block;
            pointer-events: none;
            user-select: none;
            -webkit-user-select: none;
        }

        /* Desktop Arrows */
        .arrow-btn {
            flex-shrink: 0;
            width: 44px;
            height: 80px;
            border: none;
            background: var(--blanco);
            color: var(--azul);
            border-radius: var(--radius);
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-card);
            transition: var(--transition-fast);
            z-index: 10;
            -webkit-tap-highlight-color: transparent;
        }

        .arrow-btn:hover {
            background: var(--azul-light);
            box-shadow: var(--shadow-float);
        }

        .arrow-btn:active {
            transform: scale(0.94);
        }

        .arrow-btn:disabled {
            opacity: 0.2;
            pointer-events: none;
            cursor: default;
        }

        /* Desktop Controls Bar */
        .controls-bar {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px 20px;
            gap: 6px;
            background: var(--blanco);
            border-radius: var(--radius-pill);
            box-shadow: var(--shadow-ctrl);
            z-index: 10;
        }

        .ctrl-btn {
            width: 34px;
            height: 34px;
            border: none;
            background: transparent;
            color: var(--gris);
            border-radius: 50%;
            font-size: 13px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-fast);
            -webkit-tap-highlight-color: transparent;
        }

        .ctrl-btn:hover {
            background: var(--azul-light);
            color: var(--azul);
        }

        .ctrl-btn:active {
            transform: scale(0.9);
        }

        .ctrl-btn:disabled {
            opacity: 0.2;
            pointer-events: none;
        }

        .ctrl-btn.active {
            background: var(--azul);
            color: #fff;
        }

        .ctrl-sep {
            width: 1px;
            height: 20px;
            background: var(--gris-claro);
            flex-shrink: 0;
        }

        .page-counter {
            font-size: 13px;
            font-weight: 500;
            color: var(--negro);
            min-width: 72px;
            text-align: center;
            font-variant-numeric: tabular-nums;
            user-select: none;
        }

        .kbd-hint {
            text-align: center;
            font-size: 10px;
            color: var(--gris-claro);
            padding: 2px 0;
            flex-shrink: 0;
        }

        /* Zoom Controls (floating on book stage) */
        .zoom-controls {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            z-index: 20;
        }

        .zoom-ctrl-btn {
            width: 34px;
            height: 34px;
            border: none;
            background: rgba(255, 255, 255, 0.92);
            color: var(--azul);
            border-radius: 50%;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-card);
            transition: var(--transition-fast);
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
        }

        .zoom-ctrl-btn:hover {
            background: var(--blanco);
            box-shadow: var(--shadow-float);
        }

        .zoom-ctrl-btn:active {
            transform: scale(0.9);
        }

        .zoom-ctrl-btn:disabled {
            opacity: 0.3;
            pointer-events: none;
        }

        /* Zoom Container (for desktop inline zoom) */
        .zoom-container {
            flex: 1;
            min-width: 0;
            min-height: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: auto;
            -webkit-overflow-scrolling: touch;
            position: relative;
        }

        .zoom-container.zoomed {
            overflow: auto;
            cursor: grab;
        }

        .zoom-wrapper {
            flex-shrink: 0;
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center center;
        }

        /* ══════════════════════════════════════════════════════════════
           MOBILE NAV
        ══════════════════════════════════════════════════════════════ */
        .mobile-nav {
            display: none;
            flex-shrink: 0;
            flex-direction: column;
            gap: 6px;
            padding: 6px 10px;
        }

        .mobile-nav-main {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
        }

        .mobile-nav-btn {
            flex: 1;
            height: 46px;
            border: 2px solid var(--azul);
            background: var(--blanco);
            color: var(--azul);
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: var(--transition-fast);
            font-family: 'Roboto', sans-serif;
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
            user-select: none;
        }

        .mobile-nav-btn:hover:not(:disabled) {
            background: var(--azul);
            color: #fff;
        }

        .mobile-nav-btn:active:not(:disabled) {
            transform: scale(0.96);
            background: var(--azul-dark);
            color: #fff;
        }

        .mobile-nav-btn:disabled {
            opacity: 0.2;
            cursor: default;
        }

        .mobile-counter {
            flex-shrink: 0;
            min-width: 56px;
            text-align: center;
            font-size: 13px;
            font-weight: 600;
            color: var(--azul);
            font-variant-numeric: tabular-nums;
        }

        .mobile-toolbar {
            display: flex;
            width: 100%;
            gap: 6px;
            justify-content: center;
        }

        .mobile-tool-btn {
            flex: 1;
            max-width: 80px;
            height: 38px;
            border: none;
            background: var(--blanco);
            color: var(--gris);
            border-radius: var(--radius-sm);
            font-size: 11px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2px;
            transition: var(--transition-fast);
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
            box-shadow: var(--shadow-card);
            font-family: 'Roboto', sans-serif;
        }

        .mobile-tool-btn i {
            font-size: 15px;
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

        /* Swipe Hint (mobile) */
        .swipe-hint {
            display: none;
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            padding: 6px 14px;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            font-size: 12px;
            border-radius: var(--radius-pill);
            white-space: nowrap;
            z-index: 25;
            animation: hintPulse 2s ease-in-out infinite;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            pointer-events: none;
            transition: opacity 0.5s ease;
        }

        @keyframes hintPulse {

            0%,
            100% {
                opacity: 0.85;
                transform: translateX(-50%) translateY(0);
            }

            50% {
                opacity: 1;
                transform: translateX(-50%) translateY(-3px);
            }
        }

        .swipe-hint.hidden {
            opacity: 0;
            pointer-events: none;
        }

        /* ══════════════════════════════════════════════════════════════
           ZOOM OVERLAY
        ══════════════════════════════════════════════════════════════ */
        .zoom-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.96);
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
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            padding-top: env(safe-area-inset-top, 0px);
            z-index: 510;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), transparent);
        }

        .zoom-overlay-title {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
        }

        .zoom-overlay-close {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1.5px solid rgba(255, 255, 255, 0.4);
            background: transparent;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-fast);
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
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
            transition: none;
        }

        .zoom-overlay-pan.animating {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 510;
            padding-bottom: env(safe-area-inset-bottom, 0px);
        }

        .zoom-nav-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 1.5px solid rgba(255, 255, 255, 0.4);
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition-fast);
            -webkit-tap-highlight-color: transparent;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            touch-action: manipulation;
        }

        .zoom-nav-btn:hover:not(:disabled) {
            background: var(--azul);
            border-color: var(--azul);
        }

        .zoom-nav-btn:active:not(:disabled) {
            transform: scale(0.9);
        }

        .zoom-nav-btn:disabled {
            opacity: 0.25;
            pointer-events: none;
        }

        .zoom-overlay-zoom-info {
            position: absolute;
            bottom: 84px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 11px;
            color: rgba(255, 255, 255, 0.5);
            z-index: 510;
            padding-bottom: env(safe-area-inset-bottom, 0px);
            white-space: nowrap;
        }

        /* ══════════════════════════════════════════════════════════════
           THUMBNAIL PANEL
        ══════════════════════════════════════════════════════════════ */
        .thumb-panel {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            max-height: 35vh;
            background: var(--blanco);
            border-top: 1px solid var(--gris-claro);
            box-shadow: 0 -4px 24px rgba(0, 0, 0, 0.12);
            z-index: 300;
            flex-direction: column;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
            overflow: hidden;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .thumb-panel.open {
            display: flex;
        }

        .thumb-panel-handle {
            width: 100%;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
            border-bottom: 1px solid var(--gris-claro);
        }

        .thumb-handle-bar {
            width: 36px;
            height: 4px;
            background: var(--gris-claro);
            border-radius: 2px;
            position: absolute;
            top: 6px;
            left: 50%;
            transform: translateX(-50%);
        }

        .thumb-panel-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--azul);
        }

        .thumb-close-btn {
            width: 28px;
            height: 28px;
            border: none;
            background: transparent;
            color: var(--gris);
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .thumb-close-btn:hover {
            background: var(--gris-claro);
        }

        .thumb-scroll {
            flex: 1;
            overflow-x: auto;
            overflow-y: hidden;
            padding: 12px 16px;
            display: flex;
            gap: 10px;
            -webkit-overflow-scrolling: touch;
            scroll-snap-type: x mandatory;
        }

        .thumb-scroll::-webkit-scrollbar {
            height: 4px;
        }

        .thumb-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .thumb-scroll::-webkit-scrollbar-thumb {
            background: var(--gris-claro);
            border-radius: 4px;
        }

        .thumb-item {
            flex-shrink: 0;
            width: 60px;
            scroll-snap-align: start;
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: var(--radius-sm);
            overflow: hidden;
            transition: var(--transition-fast);
            opacity: 0.6;
        }

        .thumb-item:hover {
            border-color: var(--azul-light);
            opacity: 0.85;
        }

        .thumb-item.active {
            border-color: var(--azul);
            opacity: 1;
            box-shadow: 0 0 0 2px var(--azul-light);
        }

        .thumb-item img {
            width: 60px;
            height: auto;
            display: block;
            pointer-events: none;
        }

        /* ══════════════════════════════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════════════════════════════ */
        @media (min-width: 1200px) {
            .controls-bar {
                padding: 8px 22px;
                gap: 8px;
            }

            .ctrl-btn {
                width: 36px;
                height: 36px;
                font-size: 14px;
            }

            .page-counter {
                font-size: 14px;
                min-width: 80px;
            }
        }

        @media (min-width: 1025px) and (max-width: 1199px) {
            #viewer {
                padding: 12px 16px;
                gap: 12px;
            }

            .arrow-btn {
                width: 40px;
                height: 72px;
            }
        }

        @media (min-width: 800px) and (max-width: 1024px) {
            :root {
                --header-h: 52px;
            }

            header {
                padding: 0 14px;
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
                height: 68px;
                font-size: 14px;
            }

            .controls-bar {
                padding: 6px 14px;
                gap: 5px;
            }

            .ctrl-btn {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }

            .page-counter {
                font-size: 12px;
                min-width: 66px;
            }

            .kbd-hint {
                display: none;
            }
        }

        @media (min-width: 600px) and (max-width: 799px) {
            :root {
                --header-h: 50px;
            }

            header {
                padding: 0 12px;
            }

            .header-title {
                font-size: 12px;
            }

            .header-subtitle {
                display: none;
            }

            #viewer {
                padding: 8px 10px;
                gap: 8px;
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
        }

        @media (max-width: 599px) {
            :root {
                --header-h: 48px;
            }

            header {
                padding: 0 10px;
            }

            @supports (padding: env(safe-area-inset-top)) {
                header {
                    height: calc(var(--header-h) + env(safe-area-inset-top));
                }
            }

            .header-logo {
                width: 30px;
                height: 30px;
            }

            .header-logo i {
                font-size: 14px;
            }

            .header-title {
                font-size: clamp(10px, 3.2vw, 12px);
            }

            .header-subtitle {
                display: none;
            }

            .hdr-btn {
                width: 32px;
                height: 32px;
                font-size: 13px;
            }

            #loading {
                padding: 24px 16px;
                gap: 16px;
            }

            .loading-icon {
                width: 56px;
                height: 56px;
            }

            .loading-icon i {
                font-size: 24px;
            }

            .loading-title {
                font-size: 16px;
            }

            #viewer {
                padding: 6px 6px 4px;
                gap: 6px;
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
                padding: 0 6px;
                gap: 6px;
                padding-bottom: env(safe-area-inset-bottom, 0px);
            }

            .mobile-nav-btn {
                height: 42px;
                font-size: 13px;
                border-radius: var(--radius-sm);
            }

            .mobile-tool-btn {
                height: 34px;
                font-size: 10px;
            }

            .mobile-tool-btn i {
                font-size: 14px;
            }

            .swipe-hint {
                font-size: 11px;
                padding: 5px 12px;
            }

            .thumb-item {
                width: 48px;
            }

            .thumb-item img {
                width: 48px;
            }

            .zoom-overlay-close {
                width: 36px;
                height: 36px;
            }

            .zoom-nav-btn {
                width: 42px;
                height: 42px;
            }
        }

        @media (max-width: 374px) {
            .mobile-nav {
                gap: 4px;
                padding: 0 4px;
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
                min-width: 44px;
            }

            .mobile-toolbar {
                gap: 4px;
            }

            .mobile-tool-btn {
                height: 32px;
                font-size: 9px;
            }
        }

        @media (min-width: 415px) and (max-width: 599px) {
            .mobile-nav-btn {
                height: 46px;
                font-size: 14px;
            }

            .mobile-tool-btn {
                height: 38px;
                font-size: 11px;
            }
        }

        @media (max-width: 767px) and (orientation: landscape) {
            :root {
                --header-h: 40px;
            }

            @supports (padding: env(safe-area-inset-top)) {
                header {
                    height: calc(var(--header-h) + env(safe-area-inset-top));
                }
            }

            .header-logo {
                width: 26px;
                height: 26px;
            }

            .header-logo i {
                font-size: 12px;
            }

            .header-title {
                font-size: clamp(9px, 2.5vw, 11px);
            }

            .hdr-btn {
                width: 28px;
                height: 28px;
                font-size: 12px;
            }

            #viewer {
                padding: 4px 4px 2px;
                gap: 4px;
            }

            .mobile-nav {
                gap: 4px;
                padding: 0 4px;
            }

            .mobile-nav-btn {
                height: 34px;
                font-size: 12px;
            }

            .mobile-toolbar {
                display: none;
            }

            .mobile-counter {
                font-size: 11px;
                min-width: 44px;
            }
        }

        @media (min-width: 800px) {
            .mobile-nav {
                display: none !important;
            }

            .swipe-hint {
                display: none !important;
            }

            .mobile-toolbar {
                display: none !important;
            }
        }

        :fullscreen header,
        :-webkit-full-screen header {
            display: flex;
        }

        :fullscreen #viewer,
        :-webkit-full-screen #viewer {
            padding: 10px 16px;
        }

        @supports not (backdrop-filter: blur(8px)) {
            .swipe-hint {
                background: rgba(0, 0, 0, 0.9);
            }

            .zoom-nav-btn {
                background: rgba(0, 0, 0, 0.8);
            }
        }

        .fb-browser-fix,
        .li-browser-fix {}

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }

            .zoom-wrapper {
                transition: none;
            }
        }

        @media print {

            header,
            .mobile-nav,
            .controls-bar,
            .arrow-btn,
            .zoom-controls,
            .swipe-hint,
            .page-progress {
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
    </style>
</head>

<body>

    {{-- HEADER --}}
    <header>
        <div class="header-brand">
            <div class="header-logo">
                <i class="fa fa-book-open"></i>
            </div>
            <div class="header-text">
                <div class="header-title">{{ $boletin['titulo'] ?? 'Boletín Informativo · Mr. Lucky' }}</div>
                <div class="header-subtitle">
                    Mr. Lucky &middot; {{ $boletin['ano'] ?? date('Y') }} &middot; No. {{ $boletin['numero'] ?? '–' }}
                </div>
            </div>
        </div>
        <div class="header-actions">
            @isset($pdfUrl)
            <a class="hdr-btn hdr-btn-verde"
                href="{{ $pdfUrl }}" download
                aria-label="{{ App::currentLocale() == 'es' ? 'Descargar PDF' : 'Download PDF' }}"
                data-tip="PDF">
                <i class="fa fa-download"></i>
            </a>
            @endisset
            <button class="hdr-btn" onclick="toggleFullscreen()"
                aria-label="{{ App::currentLocale() == 'es' ? 'Pantalla completa' : 'Fullscreen' }}">
                <i class="fa fa-expand" id="fs-icon"></i>
            </button>
        </div>
    </header>

    {{-- LOADING --}}
    <div id="loading">
        <div class="loading-icon">
            <i class="fa fa-book-open"></i>
        </div>
        <div class="loading-title">
            {{ App::currentLocale() == 'es' ? 'Cargando boletín...' : 'Loading newsletter...' }}
        </div>
        <div class="loading-detail" id="load-detail">
            {{ App::currentLocale() == 'es' ? 'Iniciando...' : 'Starting...' }}
        </div>
        <div class="skeleton-wrap">
            <div class="skeleton-line title"></div>
            <div class="skeleton-line text1"></div>
            <div class="skeleton-line text2"></div>
            <div class="skeleton-line img-block"></div>
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
        <div class="error-icon"><i class="fa fa-exclamation-triangle"></i></div>
        <div class="error-title">{{ App::currentLocale() == 'es' ? 'No se pudo cargar el boletín' : 'Could not load the newsletter' }}</div>
        <div class="error-body">
            {{ App::currentLocale() == 'es'
                ? 'Verifica tu conexión a internet o intenta más tarde.'
                : 'Check your internet connection or try again later.' }}
        </div>
        <div class="error-code" id="error-detail"></div>
        <button class="btn-retry" onclick="retryLoad()">
            <i class="fa fa-refresh"></i>
            {{ App::currentLocale() == 'es' ? 'Reintentar' : 'Retry' }}
        </button>
    </div>

    {{-- MAIN VIEWER --}}
    <div id="viewer" role="main" aria-label="Visor de boletín">

        <div class="page-progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="page-progress-bar" id="page-progress-bar"></div>
        </div>

        <div class="book-stage" id="book-stage">

            <div class="swipe-hint" id="swipe-hint">
                <i class="fa fa-hand-pointer-o"></i>&ensp;
                {{ App::currentLocale() == 'es' ? 'Desliza para cambiar página' : 'Swipe to turn page' }}
            </div>

            <div class="zoom-controls" id="zoom-controls">
                <button class="zoom-ctrl-btn" id="zoom-in-btn" onclick="zoomIn()" aria-label="{{ App::currentLocale() == 'es' ? 'Acercar' : 'Zoom In' }}">
                    <i class="fa fa-search-plus"></i>
                </button>
                <button class="zoom-ctrl-btn" id="zoom-out-btn" onclick="zoomOut()" aria-label="{{ App::currentLocale() == 'es' ? 'Alejar' : 'Zoom Out' }}">
                    <i class="fa fa-search-minus"></i>
                </button>
            </div>

            <button class="arrow-btn prev" id="btn-prev-d" onclick="prevPage()" aria-label="Página anterior">
                <i class="fa fa-chevron-left"></i>
            </button>

            <div class="zoom-container" id="zoom-container">
                <div class="zoom-wrapper" id="zoom-wrapper">
                    <div id="flipbook"></div>
                </div>
            </div>
            <div class="book-shadow"></div>

            <button class="arrow-btn next" id="btn-next-d" onclick="nextPage()" aria-label="Página siguiente">
                <i class="fa fa-chevron-right"></i>
            </button>
        </div>

        <div class="controls-bar" role="toolbar" aria-label="Controles del visor">
            <button class="ctrl-btn" id="c-first" onclick="goToPage(0)" aria-label="{{ App::currentLocale() == 'es' ? 'Primera página' : 'First page' }}">
                <i class="fa fa-angle-double-left"></i>
            </button>
            <button class="ctrl-btn" id="c-prev" onclick="prevPage()" aria-label="{{ App::currentLocale() == 'es' ? 'Página anterior' : 'Previous page' }}">
                <i class="fa fa-chevron-left"></i>
            </button>
            <div class="ctrl-sep"></div>
            <div class="page-counter" id="page-counter" aria-live="polite">— / —</div>
            <div class="ctrl-sep"></div>
            <button class="ctrl-btn" id="c-next" onclick="nextPage()" aria-label="{{ App::currentLocale() == 'es' ? 'Página siguiente' : 'Next page' }}">
                <i class="fa fa-chevron-right"></i>
            </button>
            <button class="ctrl-btn" id="c-last" onclick="goToLast()" aria-label="{{ App::currentLocale() == 'es' ? 'Última página' : 'Last page' }}">
                <i class="fa fa-angle-double-right"></i>
            </button>
            <div class="ctrl-sep"></div>
            <button class="ctrl-btn" id="c-thumb" onclick="toggleThumbnails()" aria-label="{{ App::currentLocale() == 'es' ? 'Miniaturas' : 'Thumbnails' }}">
                <i class="fa fa-th-large"></i>
            </button>
            <button class="ctrl-btn" id="c-zoom-fit" onclick="zoomFit()" aria-label="{{ App::currentLocale() == 'es' ? 'Ajustar' : 'Fit' }}">
                <i class="fa fa-expand"></i>
            </button>
            <button class="ctrl-btn" id="c-zoom-in" onclick="zoomIn()" aria-label="{{ App::currentLocale() == 'es' ? 'Acercar' : 'Zoom In' }}">
                <i class="fa fa-search-plus"></i>
            </button>
            <button class="ctrl-btn" id="c-zoom-out" onclick="zoomOut()" aria-label="{{ App::currentLocale() == 'es' ? 'Alejar' : 'Zoom Out' }}">
                <i class="fa fa-search-minus"></i>
            </button>
        </div>

        <div class="kbd-hint">
            {{ App::currentLocale() == 'es'
                ? 'Arrastra esquinas · ← → teclado · F pantalla completa'
                : 'Drag corners · ← → keyboard · F fullscreen' }}
        </div>

        {{-- Mobile Bottom Nav --}}
        <div class="mobile-nav">
            <div class="mobile-nav-main">
                <button class="mobile-nav-btn" id="m-prev" onclick="prevPage()" disabled aria-label="{{ App::currentLocale() == 'es' ? 'Página anterior' : 'Previous page' }}">
                    <i class="fa fa-chevron-left"></i>
                    <span>{{ App::currentLocale() == 'es' ? 'Anterior' : 'Prev' }}</span>
                </button>
                <div class="mobile-counter" id="m-counter" aria-live="polite">— / —</div>
                <button class="mobile-nav-btn" id="m-next" onclick="nextPage()" aria-label="{{ App::currentLocale() == 'es' ? 'Página siguiente' : 'Next page' }}">
                    <span>{{ App::currentLocale() == 'es' ? 'Siguiente' : 'Next' }}</span>
                    <i class="fa fa-chevron-right"></i>
                </button>
            </div>
            <div class="mobile-toolbar">
                <button class="mobile-tool-btn" onclick="zoomIn()" aria-label="{{ App::currentLocale() == 'es' ? 'Acercar' : 'Zoom+' }}">
                    <i class="fa fa-search-plus"></i>
                    <span>{{ App::currentLocale() == 'es' ? 'Acercar' : 'Zoom+' }}</span>
                </button>
                <button class="mobile-tool-btn" onclick="zoomOut()" aria-label="{{ App::currentLocale() == 'es' ? 'Alejar' : 'Zoom-' }}">
                    <i class="fa fa-search-minus"></i>
                    <span>{{ App::currentLocale() == 'es' ? 'Alejar' : 'Zoom-' }}</span>
                </button>
                <button class="mobile-tool-btn" onclick="openZoomOverlay()" aria-label="{{ App::currentLocale() == 'es' ? 'Completo' : 'Full' }}">
                    <i class="fa fa-arrows-alt"></i>
                    <span>{{ App::currentLocale() == 'es' ? 'Completo' : 'Full' }}</span>
                </button>
                <button class="mobile-tool-btn" onclick="toggleThumbnails()" aria-label="{{ App::currentLocale() == 'es' ? 'Páginas' : 'Pages' }}">
                    <i class="fa fa-th-large"></i>
                    <span>{{ App::currentLocale() == 'es' ? 'Páginas' : 'Pages' }}</span>
                </button>
            </div>
        </div>
    </div>{{-- /#viewer --}}

    {{-- ZOOM OVERLAY --}}
    <div class="zoom-overlay" id="zoom-overlay" role="dialog" aria-label="Vista ampliada de página">
        <div class="zoom-overlay-header">
            <div class="zoom-overlay-title" id="zoom-overlay-title">Página 1</div>
            <button class="zoom-overlay-close" onclick="closeZoomOverlay()" aria-label="{{ App::currentLocale() == 'es' ? 'Cerrar zoom' : 'Close zoom' }}">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="zoom-overlay-content" id="zoom-overlay-content">
            <div class="zoom-overlay-pan" id="zoom-overlay-pan">
                <img class="zoom-overlay-image" id="zoom-overlay-image" src="" alt="Página ampliada" draggable="false">
            </div>
        </div>
        <div class="zoom-overlay-zoom-info" id="zoom-overlay-info"></div>
        <div class="zoom-overlay-nav">
            <button class="zoom-nav-btn" id="zoom-prev" onclick="zoomOverlayPrev()" aria-label="{{ App::currentLocale() == 'es' ? 'Página anterior' : 'Previous page' }}">
                <i class="fa fa-chevron-left"></i>
            </button>
            <button class="zoom-nav-btn" onclick="zoomOverlayReset()" aria-label="{{ App::currentLocale() == 'es' ? 'Restablecer zoom' : 'Reset zoom' }}">
                <i class="fa fa-compress"></i>
            </button>
            <button class="zoom-nav-btn" id="zoom-next" onclick="zoomOverlayNext()" aria-label="{{ App::currentLocale() == 'es' ? 'Página siguiente' : 'Next page' }}">
                <i class="fa fa-chevron-right"></i>
            </button>
        </div>
    </div>

    {{-- THUMBNAIL PANEL --}}
    <div class="thumb-panel" id="thumb-panel" role="dialog" aria-label="Miniaturas de páginas">
        <div class="thumb-panel-handle">
            <div class="thumb-handle-bar"></div>
            <div class="thumb-panel-title">{{ App::currentLocale() == 'es' ? 'Páginas' : 'Pages' }}</div>
            <button class="thumb-close-btn" onclick="toggleThumbnails()" aria-label="{{ App::currentLocale() == 'es' ? 'Cerrar miniaturas' : 'Close thumbnails' }}">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="thumb-scroll" id="thumb-scroll"></div>
    </div>


    <script>
        /* ══════════════════════════════════════════════════════════════════
       CONFIGURACIÓN — Image-based viewer
       ══════════════════════════════════════════════════════════════════ */

        /*
         * |--------------------------------------------------------------------------
         * | ARREGLO DE IMÁGENES — Recibe las URLs desde Blade
         * |--------------------------------------------------------------------------
         * |
         * | Desde el controlador Laravel debes pasar la variable $pageImages:
         * |
         * |   $pageImages = [
         * |       '/storage/boletines/numero-42/hoja-01.jpg',
         * |       '/storage/boletines/numero-42/hoja-02.jpg',
         * |       '/storage/boletines/numero-42/hoja-03.jpg',
         * |       // ... una URL por cada hoja
         * |   ];
         * |
         * | Blade lo convierte automáticamente en un array JavaScript.
         * | Las imágenes deben ser JPG o PNG de alta resolución.
         * |
         * | OPCIÓN 2: Si prefieres usar las imágenes en el mismo orden del filesystem:
         * |   $pageImages = glob(storage_path('app/public/boletines/42/*.jpg'));
         * |   $pageImages = array_map(function($p) {
         * |       return Storage::url(basename($p));
         * |   }, $pageImages);
         * |   sort($pageImages);
         * |
         */
        var PAGE_IMAGES = @json($pageImages);

        /* Verificación de seguridad */
        if (!Array.isArray(PAGE_IMAGES) || PAGE_IMAGES.length === 0) {
            console.error('[MrLucky Viewer] PAGE_IMAGES vacío o no definido. Verifica $pageImages en el controlador.');
            document.getElementById('loading').innerHTML =
                '<div style="text-align:center;padding:32px;">' +
                '<i class="fa fa-exclamation-triangle" style="font-size:48px;color:#db0632;"></i>' +
                '<p style="margin-top:16px;font-size:16px;color:#333;">No se encontraron imágenes</p>' +
                '<p style="font-size:13px;color:#7c8ba0;">Verifica la variable $pageImages en el controlador</p>' +
                '</div>';
        }

        /* ── State ── */
        var book = null;
        var totalFlipPages = 0;
        var pageImages = [];
        var currentPage = 0;
        var isMobile = false;
        var isTablet = false;
        var thumbnailsReady = false;

        /* ══════════════════════════════════════════════════════════════════
           DESKTOP INLINE ZOOM SYSTEM
           zoomIn(), zoomOut(), zoomFit() — called from HTML onclick
           Includes click-and-drag pan when zoomed
        ══════════════════════════════════════════════════════════════════ */
        var currentZoom = 1;
        var ZOOM_MIN = 1;
        var ZOOM_MAX = 3;
        var ZOOM_STEP = 0.3;
        var isPanning = false;
        var panStartX = 0;
        var panStartY = 0;
        var scrollStartX = 0;
        var scrollStartY = 0;

        function zoomIn() {
            if (currentZoom >= ZOOM_MAX) {
                if (isMobile) openZoomOverlay();
                return;
            }
            currentZoom = Math.min(currentZoom + ZOOM_STEP, ZOOM_MAX);
            applyDesktopZoom();
        }

        function zoomOut() {
            if (currentZoom <= ZOOM_MIN) return;
            currentZoom = Math.max(currentZoom - ZOOM_STEP, ZOOM_MIN);
            applyDesktopZoom();
        }

        function zoomFit() {
            currentZoom = ZOOM_MIN;
            applyDesktopZoom();
        }

        function applyDesktopZoom() {
            var wrapper = document.getElementById('zoom-wrapper');
            var container = document.getElementById('zoom-container');
            if (!wrapper) return;

            wrapper.style.transform = 'scale(' + currentZoom + ')';

            if (container) {
                if (currentZoom > 1) {
                    container.classList.add('zoomed');
                } else {
                    container.classList.remove('zoomed');
                    container.scrollLeft = 0;
                    container.scrollTop = 0;
                }
            }

            var zoomInBtn = document.getElementById('zoom-in-btn');
            var zoomOutBtn = document.getElementById('zoom-out-btn');
            var cZoomIn = document.getElementById('c-zoom-in');
            var cZoomOut = document.getElementById('c-zoom-out');
            var cZoomFit = document.getElementById('c-zoom-fit');

            if (zoomInBtn) zoomInBtn.disabled = (currentZoom >= ZOOM_MAX);
            if (zoomOutBtn) zoomOutBtn.disabled = (currentZoom <= ZOOM_MIN);
            if (cZoomIn) cZoomIn.disabled = (currentZoom >= ZOOM_MAX);
            if (cZoomOut) cZoomOut.disabled = (currentZoom <= ZOOM_MIN);
            if (cZoomFit) {
                if (currentZoom > 1) {
                    cZoomFit.classList.add('active');
                } else {
                    cZoomFit.classList.remove('active');
                }
            }
        }

        function initDesktopPan() {
            var container = document.getElementById('zoom-container');
            if (!container) return;

            container.addEventListener('mousedown', function(e) {
                if (currentZoom <= 1) return;
                e.preventDefault();
                isPanning = true;
                panStartX = e.clientX;
                panStartY = e.clientY;
                scrollStartX = container.scrollLeft;
                scrollStartY = container.scrollTop;
                container.style.cursor = 'grabbing';
            });

            window.addEventListener('mousemove', function(e) {
                if (!isPanning) return;
                e.preventDefault();
                var dx = e.clientX - panStartX;
                var dy = e.clientY - panStartY;
                container.scrollLeft = scrollStartX - dx;
                container.scrollTop = scrollStartY - dy;
            });

            window.addEventListener('mouseup', function() {
                if (isPanning) {
                    isPanning = false;
                    var c = document.getElementById('zoom-container');
                    if (c) c.style.cursor = '';
                }
            });

            container.addEventListener('wheel', function(e) {
                if (e.ctrlKey || e.metaKey) {
                    e.preventDefault();
                    if (e.deltaY < 0) {
                        zoomIn();
                    } else {
                        zoomOut();
                    }
                }
            }, {
                passive: false
            });
        }

        /* ══════════════════════════════════════════════════════════════════
           MOBILE ZOOM OVERLAY SYSTEM
           openZoomOverlay(), closeZoomOverlay(), zoomOverlayPrev(),
           zoomOverlayNext() — pinch-to-zoom, pan, double-tap
        ══════════════════════════════════════════════════════════════════ */
        var overlayZoom = 1;
        var overlayPanX = 0;
        var overlayPanY = 0;
        var lastPinchDist = 0;
        var pinchStartScale = 1;
        var overlayTouchMode = null;
        var overlayTouchStartX = 0;
        var overlayTouchStartY = 0;
        var overlayPanStartX = 0;
        var overlayPanStartY = 0;
        var lastTapTime = 0;
        var lastTapX = 0;
        var lastTapY = 0;
        var zoomOverlayPageIdx = 0;
        var overlayGestureListenersAdded = false;

        function openZoomOverlay() {
            if (!book || !pageImages.length) return;
            zoomOverlayPageIdx = currentPage;
            showZoomOverlayPage(zoomOverlayPageIdx);
            document.getElementById('zoom-overlay').classList.add('active');
            document.body.style.overflow = 'hidden';

            if (!overlayGestureListenersAdded) {
                initOverlayGestures();
                overlayGestureListenersAdded = true;
            }
        }

        function closeZoomOverlay() {
            document.getElementById('zoom-overlay').classList.remove('active');
            document.body.style.overflow = '';
            overlayZoom = 1;
            overlayPanX = 0;
            overlayPanY = 0;
            overlayTouchMode = null;
        }

        function zoomOverlayPrev() {
            if (zoomOverlayPageIdx > 0) {
                showZoomOverlayPage(zoomOverlayPageIdx - 1);
            }
        }

        function zoomOverlayNext() {
            if (zoomOverlayPageIdx < pageImages.length - 1) {
                showZoomOverlayPage(zoomOverlayPageIdx + 1);
            }
        }

        function zoomOverlayReset() {
            overlayZoom = 1;
            overlayPanX = 0;
            overlayPanY = 0;
            var pan = document.getElementById('zoom-overlay-pan');
            if (pan) {
                pan.classList.add('animating');
                applyOverlayTransform();
                updateOverlayUI();
                setTimeout(function() {
                    pan.classList.remove('animating');
                }, 300);
            }
        }

        function showZoomOverlayPage(idx) {
            zoomOverlayPageIdx = idx;
            var img = document.getElementById('zoom-overlay-image');
            if (pageImages[idx] && img) {
                img.src = pageImages[idx];
            }
            overlayZoom = 1;
            overlayPanX = 0;
            overlayPanY = 0;
            var pan = document.getElementById('zoom-overlay-pan');
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
            var pan = document.getElementById('zoom-overlay-pan');
            if (pan) {
                pan.style.transform = 'translate(' + overlayPanX + 'px, ' + overlayPanY + 'px) scale(' + overlayZoom + ')';
            }
        }

        function updateOverlayUI() {
            var total = pageImages.length;
            var titleEl = document.getElementById('zoom-overlay-title');
            if (titleEl) {
                titleEl.textContent = '{{ App::currentLocale() == "es" ? "Página" : "Page" }}' +
                    ' ' + (zoomOverlayPageIdx + 1) + ' / ' + total;
            }

            var prevBtn = document.getElementById('zoom-prev');
            var nextBtn = document.getElementById('zoom-next');
            if (prevBtn) prevBtn.disabled = (zoomOverlayPageIdx <= 0);
            if (nextBtn) nextBtn.disabled = (zoomOverlayPageIdx >= total - 1);

            var infoEl = document.getElementById('zoom-overlay-info');
            if (infoEl) infoEl.textContent = Math.round(overlayZoom * 100) + '%';
        }

        function getTouchDistance(t1, t2) {
            var dx = t1.clientX - t2.clientX;
            var dy = t1.clientY - t2.clientY;
            return Math.sqrt(dx * dx + dy * dy);
        }

        function clampOverlayPan() {
            if (overlayZoom <= 1) {
                overlayPanX = 0;
                overlayPanY = 0;
                return;
            }

            var img = document.getElementById('zoom-overlay-image');
            var content = document.getElementById('zoom-overlay-content');
            if (!img || !content || !img.naturalWidth) return;

            var scaledW = img.naturalWidth * overlayZoom;
            var scaledH = img.naturalHeight * overlayZoom;
            var containerW = content.clientWidth;
            var containerH = content.clientHeight;

            var maxPanX = Math.max(0, (scaledW - containerW) / 2);
            var maxPanY = Math.max(0, (scaledH - containerH) / 2);

            overlayPanX = Math.max(-maxPanX, Math.min(maxPanX, overlayPanX));
            overlayPanY = Math.max(-maxPanY, Math.min(maxPanY, overlayPanY));
        }

        function initOverlayGestures() {
            var content = document.getElementById('zoom-overlay-content');
            var pan = document.getElementById('zoom-overlay-pan');
            if (!content || !pan) return;

            content.addEventListener('touchstart', function(e) {
                if (e.touches.length === 2) {
                    e.preventDefault();
                    overlayTouchMode = 'pinch';
                    lastPinchDist = getTouchDistance(e.touches[0], e.touches[1]);
                    pinchStartScale = overlayZoom;
                } else if (e.touches.length === 1) {
                    var now = Date.now();
                    var touch = e.touches[0];

                    /* Double-tap detection */
                    if (now - lastTapTime < 300 &&
                        Math.abs(touch.clientX - lastTapX) < 30 &&
                        Math.abs(touch.clientY - lastTapY) < 30) {
                        e.preventDefault();
                        if (overlayZoom > 1.2) {
                            overlayZoom = 1;
                            overlayPanX = 0;
                            overlayPanY = 0;
                        } else {
                            overlayZoom = 2.5;
                            overlayPanX = 0;
                            overlayPanY = 0;
                        }
                        pan.classList.add('animating');
                        clampOverlayPan();
                        applyOverlayTransform();
                        updateOverlayUI();
                        setTimeout(function() {
                            pan.classList.remove('animating');
                        }, 300);
                        overlayTouchMode = null;
                        return;
                    }

                    lastTapTime = now;
                    lastTapX = touch.clientX;
                    lastTapY = touch.clientY;
                    overlayTouchMode = 'pan';
                    overlayTouchStartX = touch.clientX;
                    overlayTouchStartY = touch.clientY;
                    overlayPanStartX = overlayPanX;
                    overlayPanStartY = overlayPanY;
                }
            }, {
                passive: false
            });

            content.addEventListener('touchmove', function(e) {
                if (overlayTouchMode === 'pinch' && e.touches.length === 2) {
                    e.preventDefault();
                    var dist = getTouchDistance(e.touches[0], e.touches[1]);
                    var newScale = pinchStartScale * (dist / lastPinchDist);
                    overlayZoom = Math.max(0.5, Math.min(5, newScale));
                    clampOverlayPan();
                    applyOverlayTransform();
                    updateOverlayUI();
                } else if (overlayTouchMode === 'pan' && e.touches.length === 1 && overlayZoom > 1) {
                    e.preventDefault();
                    var dx = e.touches[0].clientX - overlayTouchStartX;
                    var dy = e.touches[0].clientY - overlayTouchStartY;
                    overlayPanX = overlayPanStartX + dx;
                    overlayPanY = overlayPanStartY + dy;
                    clampOverlayPan();
                    applyOverlayTransform();
                }
            }, {
                passive: false
            });

            content.addEventListener('touchend', function(e) {
                if (e.touches.length === 0) {
                    overlayTouchMode = null;
                } else if (e.touches.length === 1 && overlayTouchMode === 'pinch') {
                    overlayTouchMode = 'pan';
                    overlayTouchStartX = e.touches[0].clientX;
                    overlayTouchStartY = e.touches[0].clientY;
                    overlayPanStartX = overlayPanX;
                    overlayPanStartY = overlayPanY;
                }
            });

            content.addEventListener('wheel', function(e) {
                e.preventDefault();
                var delta = e.deltaY > 0 ? 0.9 : 1.1;
                overlayZoom = Math.max(0.5, Math.min(5, overlayZoom * delta));
                clampOverlayPan();
                applyOverlayTransform();
                updateOverlayUI();
            }, {
                passive: false
            });
        }

        /* ══════════════════════════════════════════════════════════════════
           ENVIRONMENT DETECTION
        ══════════════════════════════════════════════════════════════════ */
        function detectEnvironment() {
            var w = window.innerWidth;
            isMobile = w < 600;
            isTablet = w >= 600 && w <= 1024;

            var ua = navigator.userAgent || '';
            if (/FBAN|FBAV/i.test(ua)) {
                document.body.classList.add('fb-browser-fix');
            }
            if (/LinkedInApp/i.test(ua)) {
                document.body.classList.add('li-browser-fix');
            }
        }

        /* ══════════════════════════════════════════════════════════════════
           UI HELPERS
        ══════════════════════════════════════════════════════════════════ */
        function setProgress(pct, detail) {
            var fill = document.getElementById('progress-fill');
            var label = document.getElementById('progress-pct');
            if (fill) fill.style.width = Math.round(pct) + '%';
            if (label) label.textContent = Math.round(pct) + '%';
            if (detail) {
                var d = document.getElementById('load-detail');
                if (d) d.textContent = detail;
            }
        }

        function showError(msg) {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('error-screen').style.display = 'flex';
            document.getElementById('error-detail').textContent = msg || '';
        }

        function retryLoad() {
            document.getElementById('error-screen').style.display = 'none';
            document.getElementById('loading').style.display = 'flex';
            setProgress(0, '{{ App::currentLocale() == "es" ? "Reiniciando..." : "Restarting..." }}');
            loadImages();
        }

        /* ══════════════════════════════════════════════════════════════════
           PLACEHOLDER — Genera un placeholder SVG ligero
        ══════════════════════════════════════════════════════════════════ */
        function createPlaceholder(w, h) {
            var svg = '<svg xmlns="http://www.w3.org/2000/svg" width="' + w + '" height="' + h + '">' +
                '<rect width="100%" height="100%" fill="#f9fafb"/>' +
                '<rect x="0.5" y="0.5" width="' + (w - 1) + '" height="' + (h - 1) + '" fill="none" stroke="#e5e7eb" stroke-width="1"/>' +
                '<text x="50%" y="50%" text-anchor="middle" dominant-baseline="central" font-family="Arial" font-size="' + Math.round(h * 0.05) + '" fill="#c8d0dc">&#x27F3;</text>' +
                '</svg>';
            return 'data:image/svg+xml;base64,' + btoa(svg);
        }

        /* ══════════════════════════════════════════════════════════════════
           THUMBNAILS
        ══════════════════════════════════════════════════════════════════ */
        function buildThumbnails(imgUrls) {
            var container = document.getElementById('thumb-scroll');
            if (!container) return;
            container.innerHTML = '';
            imgUrls.forEach(function(src, idx) {
                var div = document.createElement('div');
                div.className = 'thumb-item' + (idx === 0 ? ' active' : '');
                div.setAttribute('data-page', idx);
                div.setAttribute('role', 'button');
                div.setAttribute('aria-label', 'Page ' + (idx + 1));
                var img = document.createElement('img');
                img.src = src;
                img.loading = 'lazy';
                img.alt = '';
                div.appendChild(img);
                div.addEventListener('click', function() {
                    if (book) {
                        book.flip(idx);
                        updateActiveThumbnail(idx);
                    }
                });
                container.appendChild(div);
            });
            thumbnailsReady = true;
        }

        function updateActiveThumbnail(activeIdx) {
            if (!thumbnailsReady) return;
            var items = document.querySelectorAll('.thumb-item');
            for (var i = 0; i < items.length; i++) {
                if (parseInt(items[i].getAttribute('data-page')) === activeIdx) {
                    items[i].classList.add('active');
                    items[i].scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center'
                    });
                } else {
                    items[i].classList.remove('active');
                }
            }
        }

        function toggleThumbnails() {
            var panel = document.getElementById('thumb-panel');
            if (!panel) return;
            if (panel.classList.contains('open')) {
                panel.classList.remove('open');
            } else {
                panel.classList.add('open');
            }
        }

        /* ══════════════════════════════════════════════════════════════════
           SWIPE HINT
        ══════════════════════════════════════════════════════════════════ */
        function hideSwipeHint() {
            var hint = document.getElementById('swipe-hint');
            if (hint) hint.classList.add('hidden');
        }

        function showSwipeHint() {
            var hint = document.getElementById('swipe-hint');
            if (hint && isMobile) {
                hint.classList.remove('hidden');
                hint.style.display = 'block';
                setTimeout(hideSwipeHint, 3000);
            }
        }

        /* ══════════════════════════════════════════════════════════════════
           IMAGE LOADING — Pipeline optimizado (SIN PDF.js)
           Carga imágenes directamente desde URLs, mucho más rápido.
        ══════════════════════════════════════════════════════════════════ */
        function loadImages() {
            if (!Array.isArray(PAGE_IMAGES) || PAGE_IMAGES.length === 0) {
                showError('No hay imágenes para mostrar');
                return;
            }

            try {
                /* PASO 1: Crear DOM con placeholders */
                setProgress(10, '{{ App::currentLocale() == "es" ? "Preparando visor..." : "Preparing viewer..." }}');

                totalFlipPages = PAGE_IMAGES.length;
                pageImages = new Array(totalFlipPages).fill(null);

                var container = document.getElementById('flipbook');
                container.innerHTML = '';
                var imgEls = [];
                var placeholderW = 400;
                var placeholderH = 560;
                var placeholder = createPlaceholder(placeholderW, placeholderH);

                for (var idx = 0; idx < PAGE_IMAGES.length; idx++) {
                    var div = document.createElement('div');
                    div.className = 'page';
                    var img = document.createElement('img');
                    img.src = placeholder;
                    img.draggable = false;
                    img.loading = 'lazy';
                    img.alt = '{{ App::currentLocale() == "es" ? "Página" : "Page" }} ' + (idx + 1);
                    img.setAttribute('data-real-src', PAGE_IMAGES[idx]);
                    div.appendChild(img);
                    container.appendChild(div);
                    imgEls.push(img);
                }

                /* PASO 2: Precargar la primera imagen para obtener dimensiones */
                setProgress(20, '{{ App::currentLocale() == "es" ? "Cargando primera página..." : "Loading first page..." }}');

                var firstImg = new Image();
                firstImg.crossOrigin = 'anonymous';
                firstImg.onload = function() {
                    var sampleW = firstImg.naturalWidth;
                    var sampleH = firstImg.naturalHeight;

                    /* Actualizar placeholder con dimensiones reales */
                    if (imgEls[0]) {
                        imgEls[0].src = PAGE_IMAGES[0];
                        pageImages[0] = PAGE_IMAGES[0];
                    }
                    setProgress(40, '{{ App::currentLocale() == "es" ? "Página" : "Page" }} 1 / ' + totalFlipPages);

                    /* PASO 3: Inicializar flipbook */
                    setProgress(45, '{{ App::currentLocale() == "es" ? "Iniciando visor..." : "Starting viewer..." }}');
                    detectEnvironment();
                    initBook(container, sampleW, sampleH);
                    initDesktopPan();

                    /* PASO 4: Cargar el resto de imágenes en background */
                    var loaded = 1;
                    var batchSize = 3;
                    var queue = [];

                    for (var i = 1; i < PAGE_IMAGES.length; i++) {
                        (function(pageIdx) {
                            queue.push(function() {
                                return new Promise(function(resolve) {
                                    var bgImg = new Image();
                                    bgImg.onload = function() {
                                        if (imgEls[pageIdx]) {
                                            imgEls[pageIdx].src = PAGE_IMAGES[pageIdx];
                                            pageImages[pageIdx] = PAGE_IMAGES[pageIdx];
                                        }
                                        loaded++;
                                        var pct = 45 + Math.round((loaded / totalFlipPages) * 55);
                                        setProgress(pct,
                                            '{{ App::currentLocale() == "es" ? "Página" : "Page" }} ' + loaded +
                                            ' {{ App::currentLocale() == "es" ? "de" : "of" }} ' + totalFlipPages
                                        );
                                        resolve();
                                    };
                                    bgImg.onerror = function() {
                                        /* Si falla una imagen, mostrar error en ese slot */
                                        if (imgEls[pageIdx]) {
                                            imgEls[pageIdx].alt = '{{ App::currentLocale() == "es" ? "Error al cargar" : "Load error" }}';
                                            imgEls[pageIdx].style.background = '#fee2e2';
                                        }
                                        loaded++;
                                        resolve();
                                    };
                                    bgImg.src = PAGE_IMAGES[pageIdx];
                                });
                            });
                        })(i);
                    }

                    /* Ejecutar en batches */
                    function processBatch() {
                        if (queue.length === 0) {
                            setProgress(100, '{{ App::currentLocale() == "es" ? "¡Listo!" : "Ready!" }}');
                            buildThumbnails(pageImages);
                            setTimeout(hideSwipeHint, 4000);
                            return;
                        }

                        var batch = queue.splice(0, batchSize);
                        Promise.all(batch.map(function(fn) {
                            return fn();
                        })).then(processBatch);
                    }

                    processBatch();
                };

                firstImg.onerror = function() {
                    showError('{{ App::currentLocale() == "es" ? "No se pudo cargar la primera imagen" : "Could not load first image" }}');
                };

                firstImg.src = PAGE_IMAGES[0];

            } catch (err) {
                console.error('[MrLucky Viewer]', err);
                showError(err.message || String(err));
            }
        }

        /* ══════════════════════════════════════════════════════════════════
           INIT BOOK — Responsive inteligente
        ══════════════════════════════════════════════════════════════════ */
        function initBook(container, pageW, pageH) {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('viewer').style.display = 'flex';

            var w = window.innerWidth;
            isMobile = w < 600;
            isTablet = w >= 600 && w <= 1024;

            var aspectH_W = pageH / pageW;
            var headerEl = document.querySelector('header');
            var headerH = headerEl ? headerEl.offsetHeight : 56;

            var mobileNavH = isMobile ? 100 : 0;
            var desktopCtrlH = (!isMobile && !isTablet) ? 70 : 0;
            var progressH = 3;
            var gapsH = isMobile ? 20 : 30;

            var usedV = headerH + mobileNavH + desktopCtrlH + progressH + gapsH;
            var avH = Math.max(window.innerHeight - usedV, 200);
            var avW = Math.max(window.innerWidth - (isMobile ? 16 : 160), 160);

            var pW, pH;
            var usePortrait = true;

            if (isMobile || (isTablet && w < 800)) {
                usePortrait = true;
                pW = Math.min(avW, 440);
                pH = Math.round(pW * aspectH_W);
                if (pH > avH) {
                    pH = Math.round(avH);
                    pW = Math.round(pH / aspectH_W);
                }
            } else if (isTablet && w >= 800) {
                pH = Math.min(avH, 700);
                pW = Math.round(pH / aspectH_W);
                if (pW * 2 <= avW) {
                    usePortrait = false;
                } else {
                    usePortrait = true;
                    pW = Math.min(avW, 500);
                    pH = Math.round(pW * aspectH_W);
                    if (pH > avH) {
                        pH = avH;
                        pW = Math.round(pH / aspectH_W);
                    }
                }
            } else {
                usePortrait = false;
                pH = Math.min(avH, 780);
                pW = Math.round(pH / aspectH_W);
                if (pW * 2 > avW) {
                    pW = Math.floor(avW / 2);
                    pH = Math.round(pW * aspectH_W);
                }
            }

            pW = Math.max(pW, 120);
            pH = Math.max(pH, 170);

            book = new St.PageFlip(container, {
                width: pW,
                height: pH,
                size: 'fixed',
                drawShadow: true,
                maxShadowOpacity: 0.35,
                flippingTime: isMobile ? 500 : 650,
                usePortrait: usePortrait,
                startPage: 0,
                showCover: true,
                mobileScrollSupport: false,
                clickEventForward: true,
                useMouseEvents: !isMobile,
                swipeDistance: isMobile ? 20 : 50,
                showPageCorners: !isMobile && !isTablet,
                disableFlipByClick: false,
            });

            book.loadFromHTML(container.querySelectorAll('.page'));
            book.on('flip', syncUI);
            book.on('changeState', syncUI);

            if (isMobile) {
                var hint = document.getElementById('swipe-hint');
                if (hint) hint.style.display = 'block';
            }

            syncUI();
        }

        /* ══════════════════════════════════════════════════════════════════
           NAVIGATION
        ══════════════════════════════════════════════════════════════════ */
        function prevPage() {
            book && book.flipPrev('bottom');
        }

        function nextPage() {
            book && book.flipNext('bottom');
        }

        function goToPage(n) {
            book && book.flip(Math.min(n, totalFlipPages - 1));
        }

        function goToLast() {
            goToPage(totalFlipPages - 1);
        }

        /* ══════════════════════════════════════════════════════════════════
           SYNC UI — Update buttons, counters, progress
        ══════════════════════════════════════════════════════════════════ */
        function syncUI() {
            if (!book) return;
            var cur = book.getCurrentPageIndex();
            var total = book.getPageCount();
            currentPage = cur;
            var label = (cur + 1) + '\u2009/\u2009' + total;

            var ids = ['page-counter', 'm-counter'];
            for (var i = 0; i < ids.length; i++) {
                var el = document.getElementById(ids[i]);
                if (el) el.textContent = label;
            }

            var progressPct = total > 1 ? ((cur / (total - 1)) * 100) : 100;
            var bar = document.getElementById('page-progress-bar');
            if (bar) {
                bar.style.width = progressPct + '%';
                bar.parentElement.setAttribute('aria-valuenow', Math.round(progressPct));
            }

            var atStart = cur === 0;
            var atEnd = cur >= total - 1;

            var prevIds = ['c-first', 'c-prev', 'btn-prev-d', 'm-prev'];
            for (var j = 0; j < prevIds.length; j++) {
                var el2 = document.getElementById(prevIds[j]);
                if (el2) el2.disabled = atStart;
            }
            var nextIds = ['c-last', 'c-next', 'btn-next-d', 'm-next'];
            for (var k = 0; k < nextIds.length; k++) {
                var el3 = document.getElementById(nextIds[k]);
                if (el3) el3.disabled = atEnd;
            }

            updateActiveThumbnail(cur);
        }

        /* ══════════════════════════════════════════════════════════════════
           FULLSCREEN
        ══════════════════════════════════════════════════════════════════ */
        function toggleFullscreen() {
            if (!document.fullscreenElement && !document.webkitFullscreenElement) {
                var el = document.documentElement;
                (el.requestFullscreen || el.webkitRequestFullscreen).call(el).catch(function() {});
            } else {
                (document.exitFullscreen || document.webkitExitFullscreen).call(document).catch(function() {});
            }
        }

        function onFullscreenChange() {
            var icon = document.getElementById('fs-icon');
            if (!icon) return;
            var isFS = !!(document.fullscreenElement || document.webkitFullscreenElement);
            icon.className = isFS ? 'fa fa-compress' : 'fa fa-expand';
        }

        document.addEventListener('fullscreenchange', onFullscreenChange);
        document.addEventListener('webkitfullscreenchange', onFullscreenChange);

        /* ══════════════════════════════════════════════════════════════════
           KEYBOARD NAVIGATION
        ══════════════════════════════════════════════════════════════════ */
        document.addEventListener('keydown', function(e) {
            if (['INPUT', 'TEXTAREA', 'SELECT'].indexOf(e.target.tagName) !== -1) return;

            var overlayActive = document.getElementById('zoom-overlay') &&
                document.getElementById('zoom-overlay').classList.contains('active');

            switch (e.key) {
                case 'ArrowLeft':
                    if (overlayActive) {
                        zoomOverlayPrev();
                    } else {
                        prevPage();
                    }
                    break;
                case 'ArrowRight':
                    if (overlayActive) {
                        zoomOverlayNext();
                    } else {
                        nextPage();
                    }
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
                    var thumbPanel = document.getElementById('thumb-panel');
                    if (thumbPanel && thumbPanel.classList.contains('open')) {
                        toggleThumbnails();
                    }
                    break;
                case '+':
                case '=':
                    if (overlayActive) {
                        overlayZoom = Math.min(5, overlayZoom * 1.2);
                        clampOverlayPan();
                        applyOverlayTransform();
                        updateOverlayUI();
                    } else {
                        zoomIn();
                    }
                    break;
                case '-':
                    if (overlayActive) {
                        overlayZoom = Math.max(0.5, overlayZoom / 1.2);
                        clampOverlayPan();
                        applyOverlayTransform();
                        updateOverlayUI();
                    } else {
                        zoomOut();
                    }
                    break;
            }
        });

        /* ══════════════════════════════════════════════════════════════════
           RESIZE HANDLER
        ══════════════════════════════════════════════════════════════════ */
        var resizeTimer;
        var lastOrientation = window.innerWidth > window.innerHeight ? 'landscape' : 'portrait';

        function handleResize() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                var newOrientation = window.innerWidth > window.innerHeight ? 'landscape' : 'portrait';

                if (newOrientation !== lastOrientation) {
                    lastOrientation = newOrientation;
                    if (book) {
                        var flipContainer = document.getElementById('flipbook');
                        var pages = flipContainer.querySelectorAll('.page');
                        var firstPage = pages[0];
                        if (firstPage) {
                            var img = firstPage.querySelector('img');
                            if (img && img.naturalWidth && img.naturalHeight) {
                                book.destroy();
                                book = null;
                                detectEnvironment();
                                initBook(flipContainer, img.naturalWidth, img.naturalHeight);
                            }
                        }
                    }
                }
            }, 250);
        }

        window.addEventListener('resize', handleResize);
        window.addEventListener('orientationchange', function() {
            setTimeout(handleResize, 300);
        });

        /* ══════════════════════════════════════════════════════════════════
           INITIALIZATION
        ══════════════════════════════════════════════════════════════════ */
        detectEnvironment();
        loadImages();
    </script>

</body>

</html>
