<!DOCTYPE html>
<html lang="{{ App::currentLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>{{ $boletin['titulo'] ?? 'Boletín · Grupo U' }}</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="theme-color" content="#003ca6">

    {{-- Fuentes del sitio --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/page-flip@2.0.7/dist/js/page-flip.browser.js"></script>

    <style>
        /* ══════════════════════════════════════════════════
   RESET & VARIABLES — Paleta Mr. Lucky
══════════════════════════════════════════════════ */
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
            --verde: #56b276;
            --verde-dark: #3d8a58;
            --naranja: #ebb650;
            --amarillo: #ffd52f;
            --gris: #7c8ba0;
            --gris-claro: #e1e1e1;
            --gris-bg: #f0f0f0;
            --rojo: #db0632;
            --blanco: #ffffff;
            --shadow-book: 0 20px 60px rgba(0, 60, 166, 0.18), 0 4px 16px rgba(0, 0, 0, 0.12);
            --shadow-ctrl: 0 4px 20px rgba(0, 0, 0, 0.12);
            --radius: 10px;
            --transition: all 0.25s ease;
            --header-height: 60px;
        }

        html {
            height: 100%;
            overflow: hidden;
        }

        body {
            min-height: 100%;
            display: flex;
            flex-direction: column;
            background: var(--gris-bg);
            background-image:
                linear-gradient(135deg, #e8f0fd 0%, #f0f0f0 50%, #e8f5e9 100%);
            font-family: 'Roboto', sans-serif;
            color: #333;
            overflow: hidden;
            touch-action: none;
        }

        /* ══════════════════════════════════════════════════
   HEADER — Brand Mr. Lucky
══════════════════════════════════════════════════ */
        header {
            position: relative;
            z-index: 100;
            flex-shrink: 0;
            height: var(--header-height);
            background: var(--azul);
            background-image: linear-gradient(135deg, var(--azul) 0%, var(--azul-mid) 100%);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            box-shadow: 0 2px 12px rgba(0, 60, 166, 0.35);
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .header-logo {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header-logo .fa {
            color: var(--amarillo);
            font-size: 18px;
        }

        .header-text {
            min-width: 0;
        }

        .header-title {
            font-family: 'Pacifico', cursive;
            font-size: 14px;
            color: var(--blanco);
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .header-subtitle {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.65);
            letter-spacing: 1.5px;
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
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.85);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            text-decoration: none;
            font-size: 14px;
            -webkit-tap-highlight-color: transparent;
        }

        .hdr-btn:hover {
            background: rgba(255, 255, 255, 0.22);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
        }

        .hdr-btn-verde {
            background: var(--verde);
            border-color: var(--verde-dark);
            color: #fff;
        }

        .hdr-btn-verde:hover {
            background: var(--verde-dark);
            color: #fff;
        }

        /* ══════════════════════════════════════════════════
   ESTADO: CARGANDO
══════════════════════════════════════════════════ */
        #loading {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 24px;
            padding: 40px 20px;
        }

        .loading-icon {
            width: 72px;
            height: 72px;
            background: var(--blanco);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(0, 60, 166, 0.15);
            animation: iconFloat 2s ease-in-out infinite;
        }

        .loading-icon .fa {
            font-size: 32px;
            color: var(--azul);
        }

        @keyframes iconFloat {

            0%,
            100% {
                transform: translateY(0) rotate(-3deg);
            }

            50% {
                transform: translateY(-8px) rotate(3deg);
            }
        }

        .loading-title {
            font-family: 'Pacifico', cursive;
            font-size: 18px;
            color: var(--azul);
            text-align: center;
        }

        .loading-detail {
            font-size: 13px;
            color: var(--gris);
            text-align: center;
            min-height: 20px;
        }

        .progress-wrap {
            width: min(300px, 80vw);
        }

        .progress-rail {
            height: 6px;
            background: var(--gris-claro);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .progress-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, var(--azul), var(--verde));
            border-radius: 10px;
            transition: width 0.4s ease;
        }

        .progress-pct {
            font-size: 11px;
            color: var(--gris);
            text-align: right;
            margin-top: 6px;
            letter-spacing: 0.5px;
        }

        /* ══════════════════════════════════════════════════
   ESTADO: ERROR
══════════════════════════════════════════════════ */
        #error-screen {
            display: none;
            flex: 1;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 16px;
            padding: 40px 20px;
            text-align: center;
        }

        .error-icon {
            width: 64px;
            height: 64px;
            background: #fdecea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-icon .fa {
            font-size: 28px;
            color: var(--rojo);
        }

        .error-title {
            font-size: 16px;
            font-weight: 600;
            color: #c62828;
        }

        .error-body {
            font-size: 13px;
            color: var(--gris);
            max-width: 360px;
            line-height: 1.7;
        }

        .error-code {
            font-family: monospace;
            font-size: 11px;
            color: var(--gris);
            background: var(--gris-claro);
            border-radius: 6px;
            padding: 8px 14px;
            max-width: 380px;
            word-break: break-all;
        }

        .btn-retry {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 22px;
            background: var(--azul);
            color: #fff;
            border: none;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-retry:hover {
            background: var(--azul-dark);
            transform: translateY(-1px);
        }

        /* ══════════════════════════════════════════════════
   VISOR PRINCIPAL
══════════════════════════════════════════════════ */
        #viewer {
            display: none;
            flex: 1;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 16px 16px 12px;
            gap: 16px;
            min-height: 0;
            position: relative;
            overflow: hidden;
        }

        /* ── Escenario del libro ── */
        .book-stage {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            min-height: 0;
            width: 100%;
            max-width: 100%;
        }

        /* Sombra decorativa bajo el libro */
        .book-shadow {
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 70%;
            height: 20px;
            background: radial-gradient(ellipse, rgba(0, 60, 166, 0.18) 0%, transparent 70%);
            filter: blur(8px);
            pointer-events: none;
        }

        #flipbook {
            position: relative;
            box-shadow: var(--shadow-book);
            z-index: 10;
        }

        /* Contenedor para zoom */
        .zoom-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .zoom-wrapper {
            transform-origin: center center;
            transition: transform 0.2s ease-out;
            will-change: transform;
        }

        /* Páginas del flipbook */
        .page {
            overflow: hidden;
            background: #fff;
        }

        .page img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: fill;
            pointer-events: none;
            user-select: none;
            -webkit-user-select: none;
        }

        /* ── Botones laterales (desktop) ── */
        .arrow-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 80px;
            background: var(--blanco);
            border: 2px solid var(--gris-claro);
            color: var(--gris);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            z-index: 20;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        .arrow-btn:hover:not(:disabled) {
            background: var(--azul);
            border-color: var(--azul);
            color: #fff;
            box-shadow: 0 6px 20px rgba(0, 60, 166, 0.3);
        }

        .arrow-btn:disabled {
            opacity: 0.25;
            cursor: default;
        }

        .arrow-btn.prev {
            left: 8px;
            border-radius: 8px;
            border-right: none;
        }

        .arrow-btn.next {
            right: 8px;
            border-radius: 8px;
            border-left: none;
        }

        /* ── Botones inferiores (mobile) ── */
        .mobile-nav {
            display: none;
            width: 100%;
            gap: 10px;
            padding: 0 16px;
        }

        .mobile-nav-btn {
            flex: 1;
            height: 48px;
            border: 2px solid var(--azul);
            background: var(--blanco);
            color: var(--azul);
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition);
            font-family: 'Roboto', sans-serif;
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
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
            opacity: 0.25;
            cursor: default;
        }

        /* ── Barra de controles (desktop) ── */
        .controls-bar {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--blanco);
            border: 1px solid var(--gris-claro);
            border-radius: 50px;
            padding: 8px 20px;
            box-shadow: var(--shadow-ctrl);
        }

        .ctrl-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid transparent;
            background: transparent;
            color: var(--gris);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            font-size: 14px;
        }

        .ctrl-btn:hover:not(:disabled) {
            background: var(--azul);
            color: #fff;
            border-color: var(--azul);
        }

        .ctrl-btn:active:not(:disabled) {
            transform: scale(0.92);
        }

        .ctrl-btn:disabled {
            opacity: 0.2;
            cursor: default;
        }

        .ctrl-sep {
            width: 1px;
            height: 24px;
            background: var(--gris-claro);
            flex-shrink: 0;
        }

        .page-counter {
            font-size: 13px;
            font-weight: 600;
            color: var(--azul);
            min-width: 80px;
            text-align: center;
            letter-spacing: 0.5px;
        }

        /* ── Hint de teclado ── */
        .kbd-hint {
            font-size: 10px;
            color: var(--gris);
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: 0.6;
        }

        /* ── Indicador de gesto (swipe hint) ── */
        .swipe-hint {
            display: none;
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 8px 16px;
            background: rgba(0, 0, 0, 0.75);
            color: #fff;
            font-size: 12px;
            border-radius: 20px;
            white-space: nowrap;
            margin-bottom: 10px;
            animation: hintPulse 2s ease-in-out infinite;
        }

        .swipe-hint::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            border: 6px solid transparent;
            border-top-color: rgba(0, 0, 0, 0.75);
        }

        @keyframes hintPulse {

            0%,
            100% {
                opacity: 0.8;
                transform: translateX(-50%) translateY(0);
            }

            50% {
                opacity: 1;
                transform: translateX(-50%) translateY(-3px);
            }
        }

        /* ── Controles de zoom ── */
        .zoom-controls {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            z-index: 30;
        }

        .zoom-btn {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            border: none;
            background: var(--blanco);
            color: var(--azul);
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
            transition: var(--transition);
            -webkit-tap-highlight-color: transparent;
        }

        .zoom-btn:hover {
            background: var(--azul);
            color: #fff;
        }

        .zoom-btn:active {
            transform: scale(0.92);
        }

        .zoom-btn.active {
            background: var(--azul);
            color: #fff;
        }

        /* ── Modo zoom overlay ── */
        .zoom-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 200;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .zoom-overlay.active {
            display: flex;
        }

        .zoom-overlay-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.5);
            background: transparent;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 210;
        }

        .zoom-overlay-close:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .zoom-overlay-content {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: auto;
            -webkit-overflow-scrolling: touch;
        }

        .zoom-overlay-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            pointer-events: auto;
        }

        .zoom-overlay-nav {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 16px;
        }

        .zoom-nav-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.5);
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .zoom-nav-btn:hover:not(:disabled) {
            background: var(--azul);
            border-color: var(--azul);
        }

        .zoom-nav-btn:disabled {
            opacity: 0.3;
        }

        /* ══════════════════════════════════════════════════
   RESPONSIVE — Tablet & Mobile
══════════════════════════════════════════════════ */

        /* ── Tablet (768px - 1024px) ── */
        @media (min-width: 768px) and (max-width: 1024px) {
            :root {
                --header-height: 56px;
            }

            header {
                padding: 0 16px;
            }

            .header-title {
                font-size: 13px;
            }

            .header-subtitle {
                font-size: 9px;
            }

            #viewer {
                padding: 12px 12px 10px;
                gap: 12px;
            }

            .arrow-btn {
                width: 40px;
                height: 70px;
            }

            .arrow-btn.prev {
                left: 4px;
            }

            .arrow-btn.next {
                right: 4px;
            }

            .controls-bar {
                padding: 6px 16px;
                gap: 6px;
            }

            .ctrl-btn {
                width: 34px;
                height: 34px;
                font-size: 13px;
            }

            .page-counter {
                font-size: 12px;
                min-width: 70px;
            }

            .kbd-hint {
                display: none;
            }

            .mobile-nav {
                padding: 0 12px;
            }

            .mobile-nav-btn {
                height: 46px;
                font-size: 14px;
            }

            .zoom-btn {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .zoom-controls {
                top: 8px;
                right: 8px;
                gap: 6px;
            }
        }

        /* ── Mobile pequeño (hasta 480px) ── */
        @media (max-width: 480px) {
            :root {
                --header-height: 52px;
            }

            header {
                height: var(--header-height);
                padding: 0 12px;
            }

            .header-logo {
                width: 32px;
                height: 32px;
            }

            .header-logo .fa {
                font-size: 16px;
            }

            .header-title {
                font-size: 11px;
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
                padding: 30px 16px;
                gap: 20px;
            }

            .loading-icon {
                width: 60px;
                height: 60px;
            }

            .loading-icon .fa {
                font-size: 26px;
            }

            .loading-title {
                font-size: 16px;
            }

            .loading-detail {
                font-size: 12px;
            }

            #viewer {
                padding: 8px 8px 6px;
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
                padding: 0 10px;
            }

            .mobile-nav-btn {
                height: 44px;
                font-size: 13px;
                border-radius: 10px;
            }

            .zoom-btn {
                width: 38px;
                height: 38px;
                font-size: 14px;
                border-radius: 8px;
            }

            .zoom-controls {
                top: 6px;
                right: 6px;
                gap: 5px;
            }

            .swipe-hint {
                font-size: 11px;
                padding: 6px 12px;
                margin-bottom: 8px;
            }

            .zoom-overlay-close {
                width: 40px;
                height: 40px;
                top: 15px;
                right: 15px;
            }

            .zoom-nav-btn {
                width: 44px;
                height: 44px;
            }
        }

        /* ── Mobile estándar (481px - 767px) ── */
        @media (min-width: 481px) and (max-width: 767px) {
            :root {
                --header-height: 54px;
            }

            header {
                padding: 0 14px;
            }

            .header-title {
                font-size: 12px;
            }

            .header-subtitle {
                display: none;
            }

            #viewer {
                padding: 10px 10px 8px;
                gap: 10px;
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
                padding: 0 14px;
            }

            .mobile-nav-btn {
                height: 46px;
                font-size: 14px;
            }

            .zoom-btn {
                width: 42px;
                height: 42px;
            }

            .zoom-controls {
                top: 8px;
                right: 8px;
            }
        }

        /* ── Solo mostrar mobile nav en móvil ── */
        @media (min-width: 768px) {
            .mobile-nav {
                display: none !important;
            }

            .zoom-controls {
                display: none !important;
            }

            .swipe-hint {
                display: none !important;
            }
        }

        /* ── Landscape mobile ── */
        @media (max-width: 767px) and (orientation: landscape) {
            :root {
                --header-height: 44px;
            }

            header {
                height: var(--header-height);
            }

            .header-logo {
                width: 28px;
                height: 28px;
            }

            .header-logo .fa {
                font-size: 14px;
            }

            .header-title {
                font-size: 10px;
            }

            .header-subtitle {
                display: none;
            }

            .hdr-btn {
                width: 28px;
                height: 28px;
                font-size: 12px;
            }

            #viewer {
                padding: 6px 6px 4px;
                gap: 6px;
            }

            .mobile-nav {
                padding: 0 8px;
            }

            .mobile-nav-btn {
                height: 36px;
                font-size: 12px;
                border-radius: 8px;
            }

            #m-counter {
                font-size: 11px !important;
                min-width: 60px;
            }

            .zoom-btn {
                width: 34px;
                height: 34px;
                font-size: 14px;
            }

            .zoom-controls {
                top: 4px;
                right: 4px;
                gap: 4px;
            }

            .swipe-hint {
                bottom: 90%;
            }
        }

        /* ── Pantalla muy pequeña (320px - 374px) ── */
        @media (max-width: 374px) {
            .mobile-nav {
                gap: 6px;
                padding: 0 8px;
            }

            .mobile-nav-btn {
                height: 40px;
                font-size: 12px;
                padding: 0 10px;
            }

            .mobile-nav-btn .fa {
                font-size: 12px;
            }

            .zoom-btn {
                width: 34px;
                height: 34px;
                font-size: 13px;
            }
        }

        /* ── Fullscreen ── */
        :fullscreen header {
            display: flex;
        }

        :fullscreen #viewer {
            padding: 8px 16px;
        }

        :-webkit-full-screen header {
            display: flex;
        }

        :-webkit-full-screen #viewer {
            padding: 8px 16px;
        }

        /* ── Safe area para iPhone notch ── */
        @supports (padding: env(safe-area-inset-top)) {
            body {
                padding-top: env(safe-area-inset-top);
                padding-bottom: env(safe-area-inset-bottom);
                padding-left: env(safe-area-inset-left);
                padding-right: env(safe-area-inset-right);
            }

            header {
                padding-top: calc(env(safe-area-inset-top) / 2);
                padding-bottom: calc(env(safe-area-inset-top) / 2);
            }
        }
    </style>
</head>

<body>

    {{-- ══ HEADER ════════════════════════════════════════ --}}
    <header>
        <div class="header-brand">
            <div class="header-logo">
                <i class="fa fa-book"></i>
            </div>
            <div class="header-text">
                <div class="header-title">
                    {{ $boletin['titulo'] ?? 'Boletín Informativo · Grupo U' }}
                </div>
                <div class="header-subtitle">
                    Grupo U &nbsp;·&nbsp; {{ $boletin['ano'] ?? date('Y') }} &nbsp;·&nbsp; No. {{ $boletin['numero'] ?? '–' }}
                </div>
            </div>
        </div>

        <div class="header-actions">
            {{-- Descargar PDF --}}
            <a class="hdr-btn hdr-btn-verde"
                href="{{ $pdfUrl }}"
                download
                title="{{ App::currentLocale() == 'es' ? 'Descargar PDF' : 'Download PDF' }}">
                <i class="fa fa-download"></i>
            </a>
            {{-- Pantalla completa --}}
            <button class="hdr-btn" onclick="toggleFullscreen()"
                title="{{ App::currentLocale() == 'es' ? 'Pantalla completa (F)' : 'Fullscreen (F)' }}">
                <i class="fa fa-arrows-alt" id="fs-icon"></i>
            </button>
        </div>
    </header>


    {{-- ══ CARGANDO ═══════════════════════════════════════ --}}
    <div id="loading">
        <div class="loading-icon">
            <i class="fa fa-book"></i>
        </div>
        <div class="loading-title">
            {{ App::currentLocale() == 'es' ? 'Cargando boletín...' : 'Loading newsletter...' }}
        </div>
        <div class="loading-detail" id="load-detail">
            {{ App::currentLocale() == 'es' ? 'Iniciando...' : 'Starting...' }}
        </div>
        <div class="progress-wrap">
            <div class="progress-rail">
                <div class="progress-fill" id="progress-fill"></div>
            </div>
            <div class="progress-pct" id="progress-pct">0%</div>
        </div>
    </div>


    {{-- ══ ERROR ══════════════════════════════════════════ --}}
    <div id="error-screen">
        <div class="error-icon"><i class="fa fa-exclamation-triangle"></i></div>
        <div class="error-title">
            {{ App::currentLocale() == 'es' ? 'No se pudo cargar el boletín' : 'Could not load the newsletter' }}
        </div>
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


    {{-- ══ VISOR ══════════════════════════════════════════ --}}
    <div id="viewer">

        {{-- Escenario del libro --}}
        <div class="book-stage" id="book-stage">

            {{-- Indicador de gesto swipe --}}
            <div class="swipe-hint" id="swipe-hint">
                <i class="fa fa-hand-pointer-o"></i>
                {{ App::currentLocale() == 'es' ? ' Desliza para cambiar página' : ' Swipe to change page' }}
            </div>

            {{-- Controles de zoom (solo móvil) --}}
            <div class="zoom-controls" id="zoom-controls">
                <button class="zoom-btn" id="zoom-in-btn" onclick="zoomIn()" title="{{ App::currentLocale() == 'es' ? 'Acercar' : 'Zoom in' }}">
                    <i class="fa fa-search-plus"></i>
                </button>
                <button class="zoom-btn" id="zoom-out-btn" onclick="zoomOut()" title="{{ App::currentLocale() == 'es' ? 'Alejar' : 'Zoom out' }}">
                    <i class="fa fa-search-minus"></i>
                </button>
                <button class="zoom-btn" id="zoom-full-btn" onclick="openZoomOverlay()" title="{{ App::currentLocale() == 'es' ? 'Ver página completa' : 'View full page' }}">
                    <i class="fa fa-expand"></i>
                </button>
            </div>

            {{-- Botón anterior (desktop) --}}
            <button class="arrow-btn prev" id="btn-prev-d" onclick="prevPage()"
                title="{{ App::currentLocale() == 'es' ? 'Página anterior (←)' : 'Previous page (←)' }}">
                <i class="fa fa-chevron-left"></i>
            </button>

            {{-- Contenedor con zoom wrapper --}}
            <div class="zoom-container">
                <div class="zoom-wrapper" id="zoom-wrapper">
                    {{-- El libro vive aquí --}}
                    <div id="flipbook"></div>
                </div>
            </div>
            <div class="book-shadow"></div>

            {{-- Botón siguiente (desktop) --}}
            <button class="arrow-btn next" id="btn-next-d" onclick="nextPage()"
                title="{{ App::currentLocale() == 'es' ? 'Página siguiente (→)' : 'Next page (→)' }}">
                <i class="fa fa-chevron-right"></i>
            </button>
        </div>

        {{-- Controles (desktop) --}}
        <div class="controls-bar">
            <button class="ctrl-btn" id="c-first" onclick="goToPage(0)" title="Primera">
                <i class="fa fa-step-backward"></i>
            </button>
            <button class="ctrl-btn" id="c-prev" onclick="prevPage()">
                <i class="fa fa-chevron-left"></i>
            </button>
            <div class="ctrl-sep"></div>
            <div class="page-counter" id="page-counter">— / —</div>
            <div class="ctrl-sep"></div>
            <button class="ctrl-btn" id="c-next" onclick="nextPage()">
                <i class="fa fa-chevron-right"></i>
            </button>
            <button class="ctrl-btn" id="c-last" onclick="goToLast()" title="Última">
                <i class="fa fa-step-forward"></i>
            </button>
        </div>

        {{-- Hint teclado (desktop) --}}
        <div class="kbd-hint">
            {{ App::currentLocale() == 'es'
        ? 'Arrastra las esquinas · ← → teclado · F pantalla completa'
        : 'Drag corners · ← → keyboard · F fullscreen' }}
        </div>

        {{-- Navegación móvil --}}
        <div class="mobile-nav">
            <button class="mobile-nav-btn" id="m-prev" onclick="prevPage()" disabled>
                <i class="fa fa-chevron-left"></i>
                {{ App::currentLocale() == 'es' ? 'Anterior' : 'Previous' }}
            </button>
            <div style="display:flex;align-items:center;justify-content:center;min-width:70px;
                font-size:13px;font-weight:600;color:var(--azul);"
                id="m-counter">— / —</div>
            <button class="mobile-nav-btn" id="m-next" onclick="nextPage()">
                {{ App::currentLocale() == 'es' ? 'Siguiente' : 'Next' }}
                <i class="fa fa-chevron-right"></i>
            </button>
        </div>

    </div>{{-- /#viewer --}}

    {{-- ══ ZOOM OVERLAY ══════════════════════════════════════ --}}
    <div class="zoom-overlay" id="zoom-overlay">
        <button class="zoom-overlay-close" onclick="closeZoomOverlay()">
            <i class="fa fa-times"></i>
        </button>
        <div class="zoom-overlay-content" id="zoom-overlay-content">
            <img class="zoom-overlay-image" id="zoom-overlay-image" src="" alt="">
        </div>
        <div class="zoom-overlay-nav">
            <button class="zoom-nav-btn" id="zoom-prev" onclick="zoomOverlayPrev()">
                <i class="fa fa-chevron-left"></i>
            </button>
            <button class="zoom-nav-btn" id="zoom-next" onclick="zoomOverlayNext()">
                <i class="fa fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <script>
        /* ══════════════════════════════════════════════════════
   CONFIG
   - SCALE 1.4  : suficiente para cualquier pantalla, 2.5x más rápido que 2.2
   - JPEG_Q 0.78: buen balance calidad/velocidad
   - BATCH_SIZE : cuántas páginas PDF se renderizan en paralelo
══════════════════════════════════════════════════════ */
        const PDF_URL = "{{ $pdfUrl }}";
        const SCALE = 1.4;
        const JPEG_Q = 0.78;
        const BATCH_SIZE = 4;

        pdfjsLib.GlobalWorkerOptions.workerSrc =
            'https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.worker.min.js';

        let book = null;
        let totalFlipPages = 0;

        /* ── UI helpers ─────────────────────────────────────── */
        function setProgress(pct, detail) {
            document.getElementById('progress-fill').style.width = Math.round(pct) + '%';
            document.getElementById('progress-pct').textContent = Math.round(pct) + '%';
            if (detail) document.getElementById('load-detail').textContent = detail;
        }

        function showError(msg) {
            document.getElementById('loading').style.display = 'none';
            const el = document.getElementById('error-screen');
            el.style.display = 'flex';
            document.getElementById('error-detail').textContent = msg || '';
        }

        function retryLoad() {
            document.getElementById('error-screen').style.display = 'none';
            document.getElementById('loading').style.display = 'flex';
            setProgress(0, '{{ App::currentLocale() == "es" ? "Reiniciando..." : "Restarting..." }}');
            loadPDF();
        }

        /* ── Imagen placeholder (hoja blanca con spinner) ──── */
        function createPlaceholder(w, h) {
            const c = document.createElement('canvas');
            c.width = w;
            c.height = h;
            const ctx = c.getContext('2d');
            ctx.fillStyle = '#f9f9f9';
            ctx.fillRect(0, 0, w, h);
            // Borde sutil
            ctx.strokeStyle = '#e0e0e0';
            ctx.lineWidth = 2;
            ctx.strokeRect(1, 1, w - 2, h - 2);
            // Ícono central
            ctx.fillStyle = '#c8d0dc';
            ctx.font = `${Math.round(h * 0.06)}px Arial`;
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText('⟳', w / 2, h / 2);
            return c.toDataURL('image/jpeg', 0.7);
        }

        /* ── Renderizar una página PDF a canvas ──────────────── */
        async function renderPdfPage(pdf, pageNum) {
            const page = await pdf.getPage(pageNum);
            const viewport = page.getViewport({
                scale: SCALE
            });
            const canvas = document.createElement('canvas');
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            await page.render({
                canvasContext: canvas.getContext('2d'),
                viewport
            }).promise;
            return canvas;
        }

        /* ── Dividir canvas landscape en mitad ──────────────── */
        function splitHalf(canvas, side) {
            const hw = Math.floor(canvas.width / 2);
            const out = document.createElement('canvas');
            out.width = hw;
            out.height = canvas.height;
            out.getContext('2d').drawImage(
                canvas,
                side === 'left' ? 0 : hw, 0, hw, canvas.height,
                0, 0, hw, canvas.height
            );
            return out;
        }

        function canvasToDataURL(canvas) {
            const data = canvas.toDataURL('image/jpeg', JPEG_Q);
            // Liberar memoria del canvas auxiliar
            canvas.width = 1;
            canvas.height = 1;
            return data;
        }

        /* ══ CARGA PRINCIPAL ══════════════════════════════════
           Flujo:
           1) Abrir PDF y leer orientaciones de páginas (sin renderizar)
           2) Crear DOM con placeholders → mostrar libro YA
           3) Renderizar páginas en batches paralelos
           4) Actualizar img.src conforme terminan
        ══════════════════════════════════════════════════════ */
        async function loadPDF() {
            try {

                /* ─── PASO 1: Abrir PDF ─── */
                setProgress(5, '{{ App::currentLocale() == "es" ? "Abriendo documento..." : "Opening document..." }}');
                const pdf = await pdfjsLib.getDocument({
                    url: PDF_URL,
                    disableRange: false
                }).promise;
                const numPages = pdf.numPages;

                /* ─── PASO 2: Leer orientaciones (solo viewport, sin renderizar) ─── */
                setProgress(10, '{{ App::currentLocale() == "es" ? "Analizando páginas..." : "Analyzing pages..." }}');

                const orientations = []; // true = landscape
                let sampleW = 0; // ancho de página flip (portrait)
                let sampleH = 0;

                for (let i = 1; i <= numPages; i++) {
                    const page = await pdf.getPage(i);
                    const vp = page.getViewport({
                        scale: SCALE
                    });
                    const land = vp.width > vp.height;
                    orientations.push(land);

                    // Tomamos dimensiones del primer page portrait como referencia
                    if (!sampleW && !land) {
                        sampleW = Math.round(vp.width);
                        sampleH = Math.round(vp.height);
                    }
                }

                // Fallback: si todas son landscape, usar mitad del ancho
                if (!sampleW) {
                    const page = await pdf.getPage(1);
                    const vp = page.getViewport({
                        scale: SCALE
                    });
                    sampleW = Math.floor(vp.width / 2);
                    sampleH = Math.round(vp.height);
                }

                /* ─── PASO 3: Construir mapa de páginas flip ─── */
                // flipMeta[i] = { pdfPage: N, side: null | 'left' | 'right' }
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
                totalFlipPages = flipMeta.length;

                /* ─── PASO 4: Crear DOM con placeholders ─── */
                setProgress(14, '{{ App::currentLocale() == "es" ? "Preparando visor..." : "Preparing viewer..." }}');
                const placeholder = createPlaceholder(sampleW, sampleH);
                const container = document.getElementById('flipbook');
                container.innerHTML = '';
                const imgEls = [];

                flipMeta.forEach(() => {
                    const div = document.createElement('div');
                    div.className = 'page';
                    const img = document.createElement('img');
                    img.src = placeholder;
                    img.draggable = false;
                    div.appendChild(img);
                    container.appendChild(div);
                    imgEls.push(img);
                });

                /* ─── PASO 5: Inicializar flipbook CON placeholders ─── */
                // El usuario VE el libro inmediatamente mientras cargan las páginas reales
                setProgress(16, '{{ App::currentLocale() == "es" ? "Iniciando visor..." : "Starting viewer..." }}');
                initBook(container, sampleW, sampleH);

                /* ─── PASO 6: Renderizar páginas PDF en batches paralelos ─── */
                // Agrupamos páginas PDF únicas (landscape cuenta como 1 página a renderizar)
                const uniquePdfPages = [...new Set(flipMeta.map(m => m.pdfPage))];
                let completed = 0;

                for (let b = 0; b < uniquePdfPages.length; b += BATCH_SIZE) {
                    const batch = uniquePdfPages.slice(b, b + BATCH_SIZE);

                    // Renderizar este batch en paralelo
                    await Promise.all(batch.map(async pdfPageNum => {

                        // Renderizar la página PDF completa
                        const canvas = await renderPdfPage(pdf, pdfPageNum);

                        // Actualizar todos los flip pages que vienen de esta página PDF
                        flipMeta.forEach((meta, idx) => {
                            if (meta.pdfPage !== pdfPageNum) return;

                            if (meta.side === null) {
                                // Página portrait: usar canvas directamente
                                imgEls[idx].src = canvasToDataURL(canvas);
                            } else if (meta.side === 'left') {
                                // Mitad izquierda del landscape
                                imgEls[idx].src = canvasToDataURL(splitHalf(canvas, 'left'));
                            } else {
                                // Mitad derecha del landscape
                                imgEls[idx].src = canvasToDataURL(splitHalf(canvas, 'right'));
                            }
                        });

                        // Liberar canvas de memoria
                        canvas.width = 1;
                        canvas.height = 1;

                        completed++;
                        const pct = 16 + Math.round((completed / uniquePdfPages.length) * 84);
                        setProgress(pct,
                            '{{ App::currentLocale() == "es" ? "Página" : "Page" }} ' +
                            completed + ' {{ App::currentLocale() == "es" ? "de" : "of" }} ' +
                            uniquePdfPages.length
                        );
                    }));
                }

                setProgress(100, '{{ App::currentLocale() == "es" ? "¡Listo!" : "Ready!" }}');

            } catch (err) {
                console.error('[MrLucky Viewer]', err);
                showError(err.message || String(err));
            }
        }

        /* ══ INICIALIZAR STPAGEFLIP ═══════════════════════════
           Recibe dimensiones reales de la página para calcular
           el tamaño correcto del libro en pantalla.
        ══════════════════════════════════════════════════════ */
        function initBook(container, pageW, pageH) {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('viewer').style.display = 'flex';

            const isMobile = window.innerWidth < 768;
            const aspectH_W = pageH / pageW;

            /* Espacio disponible en pantalla */
            const hdrH = isMobile ? 54 : 60;
            const usedV = isMobile ?
                hdrH + 44 + 10 + 20 // header + nav-mobile + gaps
                :
                hdrH + 44 + 22 + 16 + 32; // header + controls + hint + gaps
            const padH = isMobile ? 20 : 160; // espacio para flechas laterales en desktop

            const avH = Math.max(window.innerHeight - usedV, 300);
            const avW = Math.max(window.innerWidth - padH, 200);

            let pW, pH;

            if (isMobile) {
                /* Mobile: UNA página, llena el ancho */
                pW = Math.min(avW, 440);
                pH = Math.round(pW * aspectH_W);
                if (pH > avH) {
                    pH = avH;
                    pW = Math.round(pH / aspectH_W);
                }
            } else {
                /* Desktop: dos páginas en spread */
                pH = Math.min(avH, 780);
                pW = Math.round(pH / aspectH_W);
                if (pW * 2 > avW) {
                    pW = Math.floor(avW / 2);
                    pH = Math.round(pW * aspectH_W);
                }
            }

            book = new St.PageFlip(container, {
                width: pW,
                height: pH,
                size: 'fixed',
                drawShadow: true,
                maxShadowOpacity: 0.40,
                flippingTime: 650,
                usePortrait: isMobile, // 1 página en mobile, 2 en desktop
                startPage: 0,
                showCover: true,
                mobileScrollSupport: false,
                clickEventForward: true,
                useMouseEvents: true,
                swipeDistance: isMobile ? 25 : 50,
                showPageCorners: !isMobile,
                disableFlipByClick: false,
            });

            book.loadFromHTML(container.querySelectorAll('.page'));
            book.on('flip', syncUI);
            book.on('changeState', syncUI);
            syncUI();
        }

        /* ── Navegación ─────────────────────────────────────── */
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

        /* ── Sincronizar estados de botones ──────────────────── */
        function syncUI() {
            if (!book) return;
            const cur = book.getCurrentPageIndex();
            const total = book.getPageCount();
            const label = (cur + 1) + '\u2009/\u2009' + total;

            ['page-counter', 'm-counter'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = label;
            });

            const atStart = cur === 0;
            const atEnd = cur >= total - 1;

            ['c-first', 'c-prev', 'btn-prev-d', 'm-prev'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.disabled = atStart;
            });
            ['c-last', 'c-next', 'btn-next-d', 'm-next'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.disabled = atEnd;
            });
        }

        /* ── Fullscreen ─────────────────────────────────────── */
        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen().catch(() => {});
            } else {
                document.exitFullscreen().catch(() => {});
            }
        }

        document.addEventListener('fullscreenchange', () => {
            const icon = document.getElementById('fs-icon');
            if (!icon) return;
            icon.className = document.fullscreenElement ? 'fa fa-compress' : 'fa fa-arrows-alt';
        });

        /* ── Teclado ─────────────────────────────────────────── */
        document.addEventListener('keydown', e => {
            if (['INPUT', 'TEXTAREA'].includes(e.target.tagName)) return;
            switch (e.key) {
                case 'ArrowLeft':
                    prevPage();
                    break;
                case 'ArrowRight':
                    nextPage();
                    break;
                case 'Home':
                    goToPage(0);
                    break;
                case 'End':
                    goToLast();
                    break;
                case 'f':
                case 'F':
                    toggleFullscreen();
                    break;
            }
        });

        /* ── Arranque ────────────────────────────────────────── */
        loadPDF();
    </script>

</body>

</html>