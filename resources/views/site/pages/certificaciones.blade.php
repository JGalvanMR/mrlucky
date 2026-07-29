@section('title', 'Certificaciones')
@extends('site.layouts.master')
@php $active = 'certificaciones'; @endphp

@section('page')

<section class="padding bg-gris-claro">
    <div class="container">
        {{-- Título y descripción --}}
        <div class="text-center mb-5">
            <h1 class="azul-marino f600">
                {{ App::currentLocale() == 'es' ? 'Nuestras Certificaciones' : 'Our Certifications' }}
            </h1>
            <p class="gris m400 mx-auto">
                {{ App::currentLocale() == 'es'
                    ? 'Contamos con las más exigentes certificaciones internacionales que avalan nuestro compromiso con la calidad e inocuidad alimentaria.'
                    : 'We hold the most demanding international certifications that endorse our commitment to quality and food safety.' }}
            </p>
        </div>

        {{-- Galería de logos --}}
        <div class="bg-white shadow p-4 rounded mb-5">
            <h4 class="azul-marino f600 text-uppercase text-center mb-4">
                {{ App::currentLocale() == 'es' ? 'Certificados Vigentes' : 'Current Certificates' }}
            </h4>
            <div class="row text-center align-items-center justify-content-center">
                <div class="col-6 col-md-3 col-lg-2 mb-3">
                    <a href="{{ route(App::currentLocale() == 'en' ? 'en.certificaciones.ver_general' : 'certificaciones.ver_general', 'ccof') }}" target="_blank" rel="noopener">
                        <img src="/site/img/certificaciones/01.jpg" class="img-fluid" loading="lazy" alt="CCOF">
                    </a>
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-3">
                    <a href="{{ route(App::currentLocale() == 'en' ? 'en.certificaciones.ver_general' : 'certificaciones.ver_general', 'c-tpat') }}" target="_blank" rel="noopener">
                        <img src="/site/img/certificaciones/02.jpg" class="img-fluid" loading="lazy" alt="C-TPAT">
                    </a>
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-3">
                    <a href="{{ route(App::currentLocale() == 'en' ? 'en.certificaciones.ver_general' : 'certificaciones.ver_general', 'sqf') }}" target="_blank" rel="noopener">
                        <img src="/site/img/certificaciones/04.jpg" class="img-fluid" loading="lazy" alt="SQF">
                    </a>
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-3">
                    <a href="{{ route(App::currentLocale() == 'en' ? 'en.certificaciones.ver_general' : 'certificaciones.ver_general', 'kosher') }}" target="_blank" rel="noopener">
                        <img src="/site/img/certificaciones/03.jpg" class="img-fluid" loading="lazy" alt="Kosher">
                    </a>
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-3">
                    <a href="{{ route(App::currentLocale() == 'en' ? 'en.certificaciones.ver_general' : 'certificaciones.ver_general', 'ftusa') }}" target="_blank" rel="noopener">
                        <img src="/site/img/certificaciones/06.jpg" class="img-fluid" loading="lazy" alt="FTUSA">
                    </a>
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-3">
                    <a href="{{ route(App::currentLocale() == 'en' ? 'en.certificaciones.ver_general' : 'certificaciones.ver_general', 'smeta') }}" target="_blank" rel="noopener">
                        <img src="/site/img/certificaciones/05.jpg" class="img-fluid" loading="lazy" alt="SMETA">
                    </a>
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-3">
                    <a href="" target="_blank" rel="noopener">
                        <img src="/site/img/certificaciones/07.jpg" class="img-fluid" loading="lazy" alt="">
                    </a>
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-3">
                    <a href="" target="_blank" rel="noopener">
                        <img src="/site/img/certificaciones/08.png" class="img-fluid" loading="lazy" alt="">
                    </a>
                </div>
            </div>
        </div>

        {{-- Sección PrimusGFS --}}
        <div class="bg-white shadow p-4 rounded">
            <div class="d-flex align-items-center mb-3 flex-wrap">
                @if(file_exists(public_path('site/img/certificaciones/primusgfs-logo.png')))
                <img src="/site/img/certificaciones/primusgfs-logo.png"
                    alt="PrimusGFS"
                    style="height:50px; margin-right:15px;"
                    loading="lazy">
                @else
                <h4 class="azul-marino f600 mr-3">PrimusGFS</h4>
                @endif
                <p class="gris small mb-0">
                    {{ App::currentLocale() == 'es'
                        ? 'Ranchos certificados bajo el estándar PrimusGFS, garantizando la inocuidad alimentaria desde el campo.'
                        : 'Ranches certified under the PrimusGFS standard, ensuring food safety from the field.' }}
                </p>
            </div>

            @include('site.partials.certificados-mosaico', [
            'ranchos' => $ranchos,
            'tipoCertificacion' => $tipoCertificacion ?? null
            ])
        </div>

    </div>
</section>
@stop

@section('customCSS')
@parent
{{-- Aquí copias todo el CSS del mosaico (cert-grid, cert-card, etc.) --}}
<style>
    /* ===== MÓDULO CERTIFICACIONES ===== */
    .cert-resumen-bar {
        background: #fff;
        border-radius: 10px;
        padding: 16px 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .cert-stat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .cert-stat-num {
        font-size: 26px;
        font-weight: 800;
        line-height: 1;
    }

    .cert-stat-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-top: 3px;
    }

    .cert-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 18px;
    }

    .cert-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 3px 14px rgba(0, 0, 0, 0.10);
        overflow: hidden;
        transition: transform .25s ease, box-shadow .25s ease;
        border: 2px solid transparent;
        display: flex;
        flex-direction: column;
    }

    .cert-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 32px rgba(0, 0, 0, 0.16);
    }

    .cert-card--vigente {
        border-color: #e8f5e9;
    }

    .cert-card--proximo {
        border-color: #FF6F00;
    }

    .cert-card--vencido {
        border-color: #ef9a9a;
        opacity: .88;
    }

    .cert-card-img-wrap {
        position: relative;
        height: 170px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .cert-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .4s ease;
    }

    .cert-card:hover .cert-card-img {
        transform: scale(1.06);
    }

    .cert-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 4px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        display: flex;
        align-items: center;
        gap: 4px;
        backdrop-filter: blur(3px);
    }

    .cert-badge--vigente {
        background: rgba(0, 131, 62, 0.90);
        color: #fff;
    }

    .cert-badge--vencido {
        background: rgba(198, 40, 40, 0.90);
        color: #fff;
    }

    .cert-badge--proximo {
        background: rgba(230, 81, 0, 0.92);
        color: #fff;
        animation: certPulso 2s ease-in-out infinite;
    }

    @keyframes certPulso {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: .62;
        }
    }

    .cert-card-body {
        padding: 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .cert-card-nombre {
        font-size: 15px;
        margin: 0 0 6px;
        line-height: 1.3;
    }

    .cert-card-ubicacion {
        margin: 0 0 12px;
    }

    .cert-detalles {
        background: #F5F5F5;
        border-radius: 7px;
        padding: 10px 12px;
        margin-bottom: 14px;
        flex: 1;
    }

    .cert-fila {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 4px 0;
        border-bottom: 1px solid #e8e8e8;
        font-size: 12px;
    }

    .cert-fila:last-child {
        border-bottom: none;
    }

    .cert-label {
        color: #888;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 10px;
        letter-spacing: .3px;
        flex-shrink: 0;
        padding-right: 8px;
    }

    .cert-valor {
        color: #333;
        font-weight: 500;
        text-align: right;
    }

    .cert-numero {
        font-family: monospace;
        font-size: 11px;
        color: #003CA6;
    }

    .cert-fecha-proximo {
        color: #E65100 !important;
        font-weight: 700 !important;
    }

    .cert-btn-descarga {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 9px;
        background: #003CA6;
        color: #fff !important;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none !important;
        transition: background .2s, transform .15s;
        margin-top: auto;
    }

    .cert-btn-descarga:hover {
        background: #002d80;
        transform: translateY(-1px);
    }

    .cert-btn-descarga--vencido {
        background: #9e9e9e;
    }

    .cert-btn-descarga--vencido:hover {
        background: #757575;
    }

    .cert-sin-pdf {
        display: block;
        text-align: center;
        padding: 9px;
        border: 1px dashed #ddd;
        border-radius: 7px;
        margin-top: auto;
    }

    @media (max-width: 575px) {
        .cert-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (min-width: 576px) and (max-width: 767px) {
        .cert-grid {
            grid-template-columns: repeat(2, 1fr);
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
