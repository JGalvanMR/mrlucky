@section('title', 'Certificaciones')
@extends('site.layouts.master')
@php $active = 'certificaciones'; @endphp

@section('page')

{{-- ═══════════════════════════════════════════════════════════════════
     BANNER / HERO DE LA PÁGINA
     ═══════════════════════════════════════════════════════════════════ --}}
<section class="cert-hero">
    <div class="cert-hero-bg" aria-hidden="true">
        <div class="cert-hero-shape cert-hero-shape--1"></div>
        <div class="cert-hero-shape cert-hero-shape--2"></div>
        <div class="cert-hero-shape cert-hero-shape--3"></div>
    </div>
    <div class="container position-relative">
        <div class="cert-hero-content text-center">
            <span class="cert-hero-eyebrow">
                <i class="fa fa-shield" aria-hidden="true"></i>
                {{ App::currentLocale() == 'es' ? 'Calidad e Inocuidad Alimentaria' : 'Quality & Food Safety' }}
            </span>
            <h1 class="cert-hero-title azul-marino">
                @if(App::currentLocale() == 'es')
                Nuestras <span class="cert-hero-title-script">Certificaciones</span>
                @else
                Our <span class="cert-hero-title-script">Certifications</span>
                @endif
            </h1>
            <div class="cert-hero-divider">
                <span></span>
                <i class="fa fa-certificate" aria-hidden="true"></i>
                <span></span>
            </div>
            <p class="cert-hero-subtitle gris">
                {{ App::currentLocale() == 'es'
                    ? 'Contamos con las más exigentes certificaciones internacionales que avalan nuestro compromiso con la calidad e inocuidad alimentaria.'
                    : 'We hold the most demanding international certifications that endorse our commitment to quality and food safety.' }}
            </p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════
     CONTENIDO PRINCIPAL
     ═══════════════════════════════════════════════════════════════════ --}}
<section class="padding bg-gris-claro cert-main">
    <div class="container">

        {{-- ── CERTIFICADOS VIGENTES (Generales) ─────────────────────── --}}
        <div class="cert-block bg-white shadow rounded mb-5">

            {{-- Encabezado de la sección --}}
            <div class="cert-block-header text-center">
                <span class="cert-block-eyebrow">
                    {{ App::currentLocale() == 'es' ? 'Generales' : 'General' }}
                </span>
                <h2 class="azul-marino f600 text-uppercase cert-block-title">
                    {{ App::currentLocale() == 'es' ? 'Certificados Vigentes' : 'Current Certificates' }}
                </h2>
                <div class="cert-block-divider">
                    <span></span>
                    <i class="fa fa-certificate" aria-hidden="true"></i>
                    <span></span>
                </div>
                <p class="cert-block-subtitle gris">
                    {{ App::currentLocale() == 'es'
                        ? 'Nuestras certificaciones corporativas avalan el cumplimiento de los más altos estándares internacionales en cada uno de nuestros procesos.'
                        : 'Our corporate certifications endorse compliance with the highest international standards across all of our processes.' }}
                </p>
            </div>

            {{-- Grid de certificados generales --}}
            <div class="cert-general-grid">

                @php
                // ───────────────────────────────────────────────────────
                // Catálogo de certificados generales de la empresa.
                // La clave 'slug' determina si el certificado tiene PDF
                // disponible. Si viene vacía, la card se muestra pero
                // el botón aparece deshabilitado.
                // ───────────────────────────────────────────────────────
                $certificadosGenerales = [
    [
        'slug' => 'ccof',
        'img' => '01.jpg',
        'alt' => 'CCOF',
        'name' => 'CCOF',
        'desc_es' => 'Certificación de productos orgánicos emitida por California Certified Organic Farmers, líder en agricultura orgánica desde 1973.',
        'desc_en' => 'Organic products certification issued by California Certified Organic Farmers, a leader in organic agriculture since 1973.',
    ],
    [
        'slug' => 'c-tpat',
        'img' => '07.jpg',
        'alt' => 'C-TPAT',
        'name' => 'C-TPAT',
        'desc_es' => 'Asociación Aduana-Comercio contra el Terrorismo. Programa voluntario de seguridad que fortalece la protección de la cadena de suministro internacional y facilita el comercio seguro.',
        'desc_en' => 'Customs-Trade Partnership Against Terrorism. A voluntary security program that strengthens international supply chain protection and facilitates secure trade.',
    ],
    [
        'slug' => 'ftusa',
        'img' => '06.jpg',
        'alt' => 'FTUSA',
        'name' => 'FT USA',
        'desc_es' => 'Certificación que respalda nuestras operaciones comerciales y el cumplimiento de regulaciones del mercado estadounidense.',
        'desc_en' => 'Certification that supports our commercial operations and compliance with U.S. market regulations.',
    ],
    [
        'slug' => 'global-gap',
        'img' => '08.png',
        'alt' => 'GLOBAL G.A.P.',
        'name' => 'GLOBAL G.A.P.',
        'desc_es' => 'Certificación internacional que garantiza buenas prácticas agrícolas, promoviendo la inocuidad de los alimentos, la sostenibilidad y la responsabilidad ambiental y social en los procesos de producción.',
        'desc_en' => 'International certification that ensures good agricultural practices, promoting food safety, sustainability, and environmental and social responsibility throughout production processes.',
    ],
    [
        'slug' => 'kosher',
        'img' => '03.jpg',
        'alt' => 'Kosher',
        'name' => 'Kosher',
        'desc_es' => 'Certificación que avala el cumplimiento de los requisitos alimentarios Kosher en nuestros procesos y productos.',
        'desc_en' => 'Certification that endorses compliance with Kosher food requirements in our processes and products.',
    ],
    [
        'slug' => 'smeta',
        'img' => '05.jpg',
        'alt' => 'SMETA',
        'name' => 'SMETA',
        'desc_es' => 'Auditoría de prácticas comerciales éticas que evalúa condiciones laborales, salud, seguridad y medio ambiente.',
        'desc_en' => 'Ethical trade practices audit that evaluates labor conditions, health, safety, and the environment.',
    ],
    [
        'slug' => 'sqf',
        'img' => '04.jpg',
        'alt' => 'SQF',
        'name' => 'SQF',
        'desc_es' => 'Estándar reconocido por la GFSI que garantiza la inocuidad y calidad en toda la cadena de producción de alimentos.',
        'desc_en' => 'GFSI-recognized standard that guarantees food safety and quality throughout the entire food production chain.',
    ],
    [
        'slug' => 'usda-organic',
        'img' => '02.jpg',
        'alt' => 'USDA Organic',
        'name' => 'USDA Organic',
        'desc_es' => 'Certificación del Departamento de Agricultura de los Estados Unidos que garantiza que los productos cumplen con los estándares establecidos para la producción y manejo de productos orgánicos.',
        'desc_en' => 'Certification from the United States Department of Agriculture that guarantees products comply with established standards for organic production and handling.',
    ],
];
                @endphp

                @foreach($certificadosGenerales as $cert)
                <article class="cert-general-card">
                    <div class="cert-general-card-img-wrap">
                        <img src="/site/img/certificaciones/{{ $cert['img'] }}"
                            alt="{{ $cert['alt'] }}"
                            class="cert-general-card-img"
                            loading="lazy">

                        <span class="cert-general-badge">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                            {{ App::currentLocale() == 'es' ? 'Vigente' : 'Valid' }}
                        </span>
                    </div>

                    <div class="cert-general-card-body">
                        @if(!empty($cert['name']))
                        <h3 class="cert-general-card-name azul-marino f600">{{ $cert['name'] }}</h3>
                        @else
                        <h3 class="cert-general-card-name azul-marino f600">
                            {{ App::currentLocale() == 'es' ? 'Certificación' : 'Certification' }}
                        </h3>
                        @endif

                        <p class="cert-general-card-desc gris">
                            {{ App::currentLocale() == 'es' ? $cert['desc_es'] : $cert['desc_en'] }}
                        </p>

                        @if(!empty($cert['slug']))
                        <a href="{{ route(App::currentLocale() == 'en' ? 'en.certificaciones.ver_general' : 'certificaciones.ver_general', $cert['slug']) }}"
                            class="cert-general-card-btn"
                            target="_blank"
                            rel="noopener"
                            aria-label="{{ App::currentLocale() == 'es'
                                                ? 'Ver certificado ' . $cert['name'] . ' en PDF (se abre en nueva pestaña)'
                                                : 'View ' . $cert['name'] . ' certificate PDF (opens in a new tab)' }}">
                            <i style="color: white;" class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            <span style="color: white;">{{ App::currentLocale() == 'es' ? 'Ver Certificado' : 'View Certificate' }}</span>
                            <i class="fa fa-external-link cert-general-card-btn-ext" aria-hidden="true"></i>
                        </a>
                        @else
                        <span class="cert-general-card-btn cert-general-card-btn--disabled" aria-disabled="true">
                            <i class="fa fa-hourglass-half" aria-hidden="true"></i>
                            <span>{{ App::currentLocale() == 'es' ? 'Próximamente' : 'Coming Soon' }}</span>
                        </span>
                        @endif
                    </div>
                </article>
                @endforeach

            </div>{{-- /.cert-general-grid --}}
        </div>{{-- /.cert-block --}}

        {{-- ── SECCIÓN PRIMUSGFS ─────────────────────────────────────── --}}
        <div class="cert-block cert-block--ranchos bg-white shadow rounded">

            {{-- Encabezado horizontal limpio (logo + descripción) --}}
            <div class="cert-ranchos-header">
                <div class="cert-ranchos-header-inner d-flex align-items-center flex-wrap">
                    @if(file_exists(public_path('site/img/certificaciones/primusgfs-logo.png')))
                    <img src="/site/img/certificaciones/primusgfs-logo.png"
                        alt="PrimusGFS"
                        class="cert-ranchos-logo"
                        loading="lazy">
                    @else
                    <h2 class="azul-marino f600 cert-ranchos-title mr-3 mb-0">PrimusGFS</h2>
                    @endif
                    <p class="gris mb-0 cert-ranchos-desc">
                        {{ App::currentLocale() == 'es'
                            ? 'Ranchos certificados bajo el estándar PrimusGFS, garantizando la inocuidad alimentaria desde el campo.'
                            : 'Ranches certified under the PrimusGFS standard, ensuring food safety from the field.' }}
                    </p>
                </div>
            </div>

            <div class="cert-ranchos-body">
                @include('site.partials.certificados-mosaico', [
                'ranchos' => $ranchos,
                'tipoCertificacion' => $tipoCertificacion ?? null
                ])
            </div>

        </div>{{-- /.cert-block --}}

        {{-- ── CTA INFERIOR ──────────────────────────────────────────── --}}
        <div class="cert-cta text-center">
            <div class="cert-cta-inner">
                <i class="fa fa-envelope-o cert-cta-icon" aria-hidden="true"></i>
                <h3 class="azul-marino f600">
                    {{ App::currentLocale() == 'es'
                        ? '¿Necesita más información sobre nuestras certificaciones?'
                        : 'Need more information about our certifications?' }}
                </h3>
                <p class="gris mb-3">
                    {{ App::currentLocale() == 'es'
                        ? 'Nuestro equipo está disponible para resolver cualquier duda sobre nuestros procesos y estándares de calidad.'
                        : 'Our team is available to answer any questions about our processes and quality standards.' }}
                </p>
                <a href="{{ route(App::currentLocale() . '.contacto') }}" class="cert-cta-btn">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    {{ App::currentLocale() == 'es' ? 'Contáctanos' : 'Contact Us' }}
                </a>
            </div>
        </div>

    </div>
</section>
@stop

@section('customCSS')
@parent
<style>
    /* ═══════════════════════════════════════════════════════════════════
       TOKENS — Paleta y tipografía alineadas con style.css del sitio
       ─ Colores base: --azul-marino (#003CA6), --rojo (#ED0013)
       ─ Grises azulados consistentes con la línea gráfica corporativa
       ═══════════════════════════════════════════════════════════════════ */
    :root {
        /* Colores primarios del sitio */
        --cert-azul: #003CA6;
        --cert-azul-dark: #002d80;
        --cert-azul-soft: rgba(0, 60, 166, 0.08);
        --cert-rojo: #ED0013;
        --cert-rojo-dark: #c90010;

        /* Estado de certificados */
        --cert-vigente: #00833E;
        --cert-vigente-bg: #E6F4EC;
        --cert-proximo: #E65100;
        --cert-proximo-bg: #FFF1E6;
        --cert-vencido: #C62828;
        --cert-vencido-bg: #FBE9E9;

        /* Neutrales (gris-azulados coherentes con azul-marino) */
        --cert-bg-light: #F4F7FB;
        --cert-bg-lighter: #FAFBFD;
        --cert-border: #E6ECF5;
        --cert-border-strong: #D4DEEB;
        --cert-texto: #2C3E50;
        --cert-texto-muted: #6B7785;
        --cert-texto-light: #98A2B3;
        --cert-white: #FFFFFF;

        /* Escala tipográfica (basada en rem, 1rem = 16px) */
        --cert-font: 'Roboto', sans-serif;
        --cert-font-script: 'Pacifico', cursive;
        --cert-fz-hero: 2.75rem;
        /* 44px */
        --cert-fz-section: 1.75rem;
        /* 28px */
        --cert-fz-card-title: 1.0625rem;
        /* 17px */
        --cert-fz-body: 0.9375rem;
        /* 15px */
        --cert-fz-small: 0.8125rem;
        /* 13px */
        --cert-fz-mini: 0.6875rem;
        /* 11px */
    }

    /* ═══════════════════════════════════════════════════════════════════
       BANNER / HERO
       ═══════════════════════════════════════════════════════════════════ */
    .cert-hero {
        position: relative;
        background: linear-gradient(180deg, var(--cert-white) 0%, var(--cert-bg-light) 60%, #EDF2F9 100%);
        padding: 35px 0 30px;
        overflow: hidden;
        border-bottom: 1px solid var(--cert-border);
    }

    .cert-hero-bg {
        position: absolute;
        inset: 0;
        pointer-events: none;
        z-index: 0;
    }

    .cert-hero-shape {
        position: absolute;
        border-radius: 50%;
        opacity: .12;
    }

    .cert-hero-shape--1 {
        width: 280px;
        height: 280px;
        background: var(--cert-azul);
        top: -90px;
        left: -90px;
    }

    .cert-hero-shape--2 {
        width: 200px;
        height: 200px;
        background: var(--cert-azul);
        bottom: -60px;
        right: -50px;
    }

    .cert-hero-shape--3 {
        width: 120px;
        height: 120px;
        background: var(--cert-rojo);
        top: 50%;
        right: 18%;
        opacity: .08;
    }

    .cert-hero-content {
        position: relative;
        z-index: 1;
        max-width: 820px;
        margin: 0 auto;
    }

    .cert-hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--cert-azul-soft);
        color: var(--cert-azul);
        padding: 8px 18px;
        border-radius: 30px;
        font-size: var(--cert-fz-small);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        margin-bottom: 18px;
        font-family: var(--cert-font);
    }

    .cert-hero-eyebrow i {
        color: var(--cert-rojo);
    }

    .cert-hero-title {
        font-size: var(--cert-fz-hero);
        font-weight: 700;
        line-height: 1.15;
        margin: 0 0 18px;
        letter-spacing: -0.5px;
        font-family: var(--cert-font);
    }

    .cert-hero-title-script {
        font-family: var(--cert-font-script);
        font-weight: 400;
        font-size: 3.25rem;
        color: var(--cert-azul);
        display: inline-block;
        line-height: 1;
    }

    .cert-hero-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin: 20px 0 18px;
    }

    .cert-hero-divider span {
        display: inline-block;
        width: 60px;
        height: 2px;
        background: var(--cert-azul);
        opacity: .35;
    }

    .cert-hero-divider i {
        color: var(--cert-rojo);
        font-size: 18px;
    }

    .cert-hero-subtitle {
        font-size: 1.0625rem;
        line-height: 1.6;
        max-width: 720px;
        margin: 0 auto;
        color: var(--cert-texto-muted);
        font-weight: 400;
    }

    @media (max-width: 767px) {
        .cert-hero {
            padding: 50px 0 40px;
        }

        .cert-hero-title {
            font-size: 2.125rem;
        }

        .cert-hero-title-script {
            font-size: 2.5rem;
        }

        .cert-hero-subtitle {
            font-size: var(--cert-fz-body);
        }
    }

    /* ═══════════════════════════════════════════════════════════════════
       SECCIONES / BLOQUES
       ═══════════════════════════════════════════════════════════════════ */
    .cert-main {
        padding-top: 60px;
        padding-bottom: 70px;
    }

    .cert-block {
        overflow: hidden;
    }

    .cert-block-header {
        padding: 38px 30px 26px;
    }

    .cert-block-eyebrow {
        display: inline-block;
        background: var(--cert-rojo);
        color: var(--cert-white);
        font-size: var(--cert-fz-mini);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        padding: 5px 14px;
        border-radius: 3px;
        margin-bottom: 12px;
    }

    .cert-block-title {
        font-size: var(--cert-fz-section);
        letter-spacing: 0.5px;
        margin: 8px 0 14px;
        font-family: var(--cert-font);
    }

    .cert-block-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin: 8px 0 14px;
    }

    .cert-block-divider span {
        display: inline-block;
        width: 50px;
        height: 2px;
        background: var(--cert-azul);
        opacity: .25;
    }

    .cert-block-divider i {
        color: var(--cert-rojo);
        font-size: 16px;
    }

    .cert-block-subtitle {
        font-size: var(--cert-fz-body);
        max-width: 680px;
        margin: 0 auto;
        line-height: 1.55;
        color: var(--cert-texto-muted);
    }

    .cert-block-body {
        padding: 8px 25px 30px;
    }

    /* ── Header horizontal para PrimusGFS (estilo limpio, en línea) ── */
    .cert-ranchos-header {
        padding: 24px 28px 18px;
        border-bottom: 1px solid #E6ECF5;
    }

    .cert-ranchos-header-inner {
        gap: 18px;
    }

    .cert-ranchos-logo {
        height: 50px;
        width: auto;
        flex-shrink: 0;
    }

    .cert-ranchos-title {
        font-size: 1.375rem;
        letter-spacing: 0.3px;
        white-space: nowrap;
    }

    .cert-ranchos-desc {
        font-size: var(--cert-fz-small);
        line-height: 1.5;
        flex: 1;
        min-width: 220px;
    }

    .cert-ranchos-body {
        padding: 22px 20px 28px;
    }

    @media (max-width: 767px) {
        .cert-block-header {
            padding: 30px 20px 20px;
        }

        .cert-block-title {
            font-size: 1.5rem;
        }

        .cert-ranchos-header {
            padding: 22px 20px 16px;
        }

        .cert-ranchos-header-inner {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 10px;
        }

        .cert-ranchos-logo {
            height: 42px;
        }
    }

    /* ═══════════════════════════════════════════════════════════════════
       GRID DE CERTIFICADOS GENERALES
       ═══════════════════════════════════════════════════════════════════ */
    .cert-general-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
        padding: 10px 25px 35px;
    }

    .cert-general-card {
        background: var(--cert-white);
        border-radius: 10px;
        box-shadow: 0 3px 12px rgba(0, 60, 166, 0.08);
        border: 1px solid var(--cert-border);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
        position: relative;
    }

    .cert-general-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--cert-azul) 0%, var(--cert-rojo) 100%);
        opacity: 0;
        transition: opacity .3s ease;
    }

    .cert-general-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 38px rgba(0, 60, 166, 0.18);
        border-color: transparent;
    }

    .cert-general-card:hover::before {
        opacity: 1;
    }

    .cert-general-card-img-wrap {
        position: relative;
        background: linear-gradient(180deg, var(--cert-bg-light) 0%, var(--cert-border) 100%);
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 22px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .cert-general-card-img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.08));
        transition: transform .35s ease;
    }

    .cert-general-card:hover .cert-general-card-img {
        transform: scale(1.08);
    }

    .cert-general-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: var(--cert-vigente);
        color: var(--cert-white);
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 4px 10px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        box-shadow: 0 2px 6px rgba(0, 131, 62, 0.35);
    }

    .cert-general-badge i {
        font-size: 11px;
    }

    .cert-general-card-body {
        padding: 18px 18px 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .cert-general-card-name {
        font-size: 1.125rem;
        font-weight: 700;
        margin: 0 0 8px;
        line-height: 1.2;
        font-family: var(--cert-font);
        letter-spacing: 0.2px;
        color: var(--cert-azul);
    }

    .cert-general-card-desc {
        font-size: var(--cert-fz-small);
        line-height: 1.55;
        margin: 0 0 16px;
        color: var(--cert-texto-muted);
        flex: 1;
    }

    .cert-general-card-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: var(--cert-azul);
        color: var(--cert-white) !important;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 11px 16px;
        border-radius: 6px;
        text-decoration: none !important;
        transition: background .25s ease, transform .2s ease, box-shadow .25s ease;
        margin-top: auto;
        font-family: var(--cert-font);
        border: none;
        cursor: pointer;
    }

    .cert-general-card-btn:hover {
        background: var(--cert-azul-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0, 60, 166, 0.35);
        color: var(--cert-white) !important;
    }

    .cert-general-card-btn-ext {
        font-size: 10px;
        opacity: .8;
    }

    .cert-general-card-btn--disabled {
        background: var(--cert-border);
        color: var(--cert-texto-muted) !important;
        cursor: not-allowed;
    }

    .cert-general-card-btn--disabled:hover {
        background: var(--cert-border);
        transform: none;
        box-shadow: none;
        color: var(--cert-texto-muted) !important;
    }

    /* Responsive grid */
    @media (max-width: 1199px) {
        .cert-general-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 991px) {
        .cert-general-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 575px) {
        .cert-general-grid {
            grid-template-columns: 1fr;
            padding: 10px 18px 30px;
        }
    }

    /* ═══════════════════════════════════════════════════════════════════
       CTA INFERIOR
       ═══════════════════════════════════════════════════════════════════ */
    .cert-cta {
        margin-top: 50px;
    }

    .cert-cta-inner {
        background: linear-gradient(135deg, var(--cert-azul) 0%, var(--cert-azul-dark) 100%);
        border-radius: 12px;
        padding: 45px 30px;
        box-shadow: 0 10px 30px rgba(0, 60, 166, 0.25);
        position: relative;
        overflow: hidden;
    }

    .cert-cta-inner::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.06);
        border-radius: 50%;
    }

    .cert-cta-inner::after {
        content: '';
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 240px;
        height: 240px;
        background: rgba(255, 255, 255, 0.04);
        border-radius: 50%;
    }

    .cert-cta-icon {
        font-size: 42px;
        color: var(--cert-white);
        margin-bottom: 14px;
        opacity: .9;
    }

    .cert-cta-inner h3 {
        color: var(--cert-white);
        font-size: 1.5rem;
        margin: 0 0 12px;
        position: relative;
        z-index: 1;
    }

    .cert-cta-inner p {
        color: rgba(255, 255, 255, 0.85) !important;
        font-size: var(--cert-fz-body);
        max-width: 600px;
        margin: 0 auto 22px;
        position: relative;
        z-index: 1;
    }

    .cert-cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        background: var(--cert-rojo);
        color: var(--cert-white) !important;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 14px 32px;
        border-radius: 6px;
        text-decoration: none !important;
        transition: background .25s ease, transform .2s ease, box-shadow .25s ease;
        position: relative;
        z-index: 1;
        box-shadow: 0 4px 12px rgba(237, 0, 19, 0.35);
    }

    .cert-cta-btn:hover {
        background: var(--cert-rojo-dark);
        color: var(--cert-white) !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(237, 0, 19, 0.5);
    }

    @media (max-width: 575px) {
        .cert-cta-inner {
            padding: 35px 22px;
        }

        .cert-cta-inner h3 {
            font-size: 20px;
        }
    }

    /* ═══════════════════════════════════════════════════════════════════
       MÓDULO CERTIFICACIONES — Partial certificados-mosaico
       (estilos para ranchos certificados: resumen, grid, cards, badges)
       ═══════════════════════════════════════════════════════════════════ */
    .cert-resumen-bar {
        background: linear-gradient(135deg, #F4F7FB 0%, #E6ECF5 100%);
        border-radius: 10px;
        padding: 18px 0;
        margin-bottom: 22px;
        border: 1px solid #E6ECF5;
    }

    .cert-stat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
    }

    .cert-stat-num {
        font-size: 1.875rem;
        font-weight: 800;
        line-height: 1;
        letter-spacing: -0.5px;
        font-family: var(--cert-font);
    }

    .cert-stat-label {
        font-size: var(--cert-fz-mini);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        color: var(--cert-texto-muted);
    }

    .cert-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 20px;
    }

    .cert-card {
        background: var(--cert-white);
        border-radius: 10px;
        box-shadow: 0 3px 12px rgba(0, 60, 166, 0.08);
        overflow: hidden;
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
        border: 2px solid transparent;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .cert-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 32px rgba(0, 60, 166, 0.18);
    }

    .cert-card--vigente {
        border-color: var(--cert-vigente-bg);
    }

    .cert-card--proximo {
        border-color: var(--cert-proximo-bg);
    }

    .cert-card--vencido {
        border-color: var(--cert-vencido-bg);
        opacity: .9;
    }

    .cert-card-img-wrap {
        position: relative;
        height: 170px;
        overflow: hidden;
        flex-shrink: 0;
        background: var(--cert-bg-light);
    }

    .cert-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .4s ease;
    }

    .cert-card:hover .cert-card-img {
        transform: scale(1.07);
    }

    .cert-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 11px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        backdrop-filter: blur(3px);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        font-family: 'Roboto', sans-serif;
    }

    .cert-badge--vigente {
        background: var(--cert-vigente);
        color: var(--cert-white);
    }

    .cert-badge--vencido {
        background: var(--cert-vencido);
        color: var(--cert-white);
    }

    .cert-badge--proximo {
        background: var(--cert-proximo);
        color: var(--cert-white);
        animation: certPulso 2s ease-in-out infinite;
    }

    @keyframes certPulso {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: .65;
        }
    }

    .cert-card-body {
        padding: 16px 18px 18px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .cert-card-nombre {
        font-size: var(--cert-fz-card-title);
        font-weight: 700;
        margin: 0 0 8px;
        line-height: 1.3;
        font-family: var(--cert-font);
        letter-spacing: 0.2px;
        color: var(--cert-azul);
    }

    .cert-card-ubicacion {
        margin: 0 0 14px;
        font-size: 12px;
        line-height: 1.4;
        color: var(--cert-texto-muted);
    }

    .cert-card-ubicacion i {
        font-size: 13px;
        color: var(--cert-azul);
    }

    .cert-detalles {
        background: var(--cert-bg-light);
        border-radius: 8px;
        padding: 12px 14px;
        margin-bottom: 14px;
        flex: 1;
        border: 1px solid var(--cert-border);
    }

    .cert-fila {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 6px 0;
        border-bottom: 1px solid var(--cert-border);
        font-size: 12px;
        gap: 8px;
    }

    .cert-fila:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .cert-fila:first-child {
        padding-top: 0;
    }

    .cert-label {
        color: var(--cert-texto-muted);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 10px;
        letter-spacing: .6px;
        flex-shrink: 0;
    }

    .cert-valor {
        color: var(--cert-texto);
        font-weight: 600;
        text-align: right;
        font-size: 12px;
    }

    .cert-valor small {
        font-size: 10px;
        font-weight: 500;
        margin-top: 2px;
    }

    .cert-numero {
        font-family: 'Roboto Mono', 'Courier New', monospace;
        font-size: 11px;
        color: var(--cert-azul);
        font-weight: 700;
    }

    .cert-fecha-proximo {
        color: var(--cert-proximo) !important;
        font-weight: 700 !important;
    }

    /* ── Botones del partial ── */
    .cert-btn-descarga {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        width: 100%;
        padding: 10px 12px;
        background: var(--cert-azul);
        color: var(--cert-white) !important;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        text-decoration: none !important;
        transition: background .2s, transform .15s, box-shadow .2s;
        margin-top: auto;
        font-family: var(--cert-font);
        border: none;
        cursor: pointer;
    }

    .cert-btn-descarga:hover {
        background: var(--cert-azul-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0, 60, 166, 0.3);
        color: var(--cert-white) !important;
    }

    .cert-btn-descarga--vencido {
        background: var(--cert-texto-light);
    }

    .cert-btn-descarga--vencido:hover {
        background: var(--cert-texto-muted);
    }

    .cert-btn-solicitar {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        width: 100%;
        padding: 10px 12px;
        background: #D50032;
        color: var(--cert-white) !important;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        text-decoration: none !important;
        transition: background .2s, transform .15s, box-shadow .2s;
        margin-top: auto;
        font-family: var(--cert-font);
        border: none;
        cursor: pointer;
    }

    .cert-btn-solicitar:hover {
        background: var(--cert-rojo-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(237, 0, 19, 0.35);
        color: var(--cert-white) !important;
    }

    .cert-acciones {
        margin-top: auto;
    }

    .cert-sin-pdf {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-align: center;
        padding: 10px 12px;
        border: 1px dashed var(--cert-border-strong);
        border-radius: 7px;
        margin-top: auto;
        color: var(--cert-texto-muted);
        font-size: 12px;
        font-weight: 500;
        background: var(--cert-bg-light);
    }

    @media (max-width: 575px) {
        .cert-grid {
            grid-template-columns: 1fr;
        }

        .cert-stat-num {
            font-size: 24px;
        }

        .cert-card-img-wrap {
            height: 150px;
        }
    }

    @media (min-width: 576px) and (max-width: 767px) {
        .cert-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* ═══════════════════════════════════════════════════════════════════
       ANIMACIONES SUTILES (respetando reduced-motion)
       ═══════════════════════════════════════════════════════════════════ */
    @media (prefers-reduced-motion: no-preference) {

        .cert-general-card,
        .cert-general-card-btn,
        .cert-cta-btn,
        .cert-card,
        .cert-btn-descarga,
        .cert-btn-solicitar {
            will-change: transform;
        }

        @keyframes certFadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .cert-general-card,
        .cert-card {
            animation: certFadeInUp .6s ease both;
        }

        .cert-general-card:nth-child(1) {
            animation-delay: .05s;
        }

        .cert-general-card:nth-child(2) {
            animation-delay: .1s;
        }

        .cert-general-card:nth-child(3) {
            animation-delay: .15s;
        }

        .cert-general-card:nth-child(4) {
            animation-delay: .2s;
        }

        .cert-general-card:nth-child(5) {
            animation-delay: .25s;
        }

        .cert-general-card:nth-child(6) {
            animation-delay: .3s;
        }

        .cert-general-card:nth-child(7) {
            animation-delay: .35s;
        }

        .cert-general-card:nth-child(8) {
            animation-delay: .4s;
        }
    }
</style>
@stop

@section('customJS')
@parent
<script>
    $(function() {
        // No se necesita AJAX; el mosaico ya está renderizado.
    });
</script>
@stop