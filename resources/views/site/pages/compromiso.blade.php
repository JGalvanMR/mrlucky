@extends('site.layouts.master')
@php
    $active = 'compromiso';
@endphp

@section('page')
    @if(App::currentLocale() == 'es')
        <img src="/site/img/banner-compromiso.jpg" loading="lazy" class="img-fluid w-100">
    @else
        <img src="/site/img/banner-compromiso-en.jpg" loading="lazy" class="img-fluid w-100">
    @endif

    <section class="padding bg-gris-claro">
        <div class="container">
            <div class="m400 mx-auto text-center">
                <p class="azul-marino editable" data-key="nuestra_prioridad" data-group="compromiso">
                    {!! trans('compromiso.nuestra_prioridad') !!}
                </p>
            </div>
            <div class="m500 mx-auto text-center">
                <p class="azul-marino editable" data-key="nuestro_compromiso" data-group="compromiso">
                    {!! trans('compromiso.nuestro_compromiso') !!}
                </p>
            </div>

            <div class="mt-5">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <p class="gris editable" data-key="marca_certificada" data-group="compromiso">
                            {!! trans('compromiso.marca_certificada') !!}
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <img src="/site/img/icons/seguro.png" alt="" class="mr-2">
                                <span class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="siembra">{!! trans('compromiso.siembra') !!}</span>
                            </li>
                            <li class="mb-3">
                                <img src="/site/img/icons/seguro.png" alt="" class="mr-2">
                                <span class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="cosecha">{!! trans('compromiso.cosecha') !!}</span>
                            </li>
                            <li class="mb-3"><img src="/site/img/icons/seguro.png" alt="" class="mr-2"><span class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="transporte">{!! trans('compromiso.transporte') !!}</span></li>
                            <li class="mb-3"><img src="/site/img/icons/seguro.png" alt="" class="mr-2"><span class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="empaque">{!! trans('compromiso.empaque') !!}</span></li>
                            <li class="mb-3"><img src="/site/img/icons/seguro.png" alt="" class="mr-2"><span class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="distribucion">{!! trans('compromiso.distribucion') !!}</span></li>
                        </ul>
                    </div>

                    <div class="col-12 col-md-7">
                        <div class="bg-white shadow p-4 rounded">
                            <h4 class="azul-marino f600 text-uppercase editable" data-group="compromiso" data-key="certificaciones">{!! trans('compromiso.certificaciones') !!}</h4>
                            <p class="my-4 editable" data-group="compromiso" data-key="certificaciones_text">
                                {!! trans('compromiso.certificaciones_text') !!}
                            </p>

                            {{-- ── Logos de certificaciones existentes (sin cambios) ── --}}
                            <div class="row text-center">
                                <div class="col-7 col-md">
                                    <a href="/site/certificaciones/ccof.pdf" target="_blank">
                                        <img src="/site/img/certificaciones/01.jpg" class="img-fluid" loading="lazy" alt="CCOF">
                                    </a>
                                </div>
                                <div class="col-7 col-md">
                                    <a href="/site/certificaciones/c-tpat.pdf" target="_blank">
                                        <img src="/site/img/certificaciones/02.jpg" class="img-fluid" loading="lazy" alt="C-TPAT">
                                    </a>
                                </div>
                                <div class="col-7 col-md">
                                    <a href="/site/certificaciones/sqf.pdf" target="_blank">
                                        <img src="/site/img/certificaciones/04.jpg" class="img-fluid" loading="lazy" alt="SQF">
                                    </a>
                                </div>
                                <div class="col-7 col-md">
                                    <a href="/site/certificaciones/kosher.pdf" target="_blank">
                                        <img src="/site/img/certificaciones/03.jpg" class="img-fluid" loading="lazy" alt="Kosher">
                                    </a>
                                </div>
                                <div class="col-7 col-md">
                                    <a href="/site/certificaciones/FTUSA_CRT.pdf" target="_blank">
                                        <img src="/site/img/certificaciones/06.jpg" class="img-fluid" loading="lazy" alt="FTUSA">
                                    </a>
                                </div>
                                <div class="col-7 col-md">
                                    <a href="/site/certificaciones/smeta.pdf" target="_blank">
                                        <img src="/site/img/certificaciones/05.jpg" class="img-fluid" loading="lazy" alt="SMETA">
                                    </a>
                                </div>
                                <div class="col-7 col-md">
                                    <a href="" target="_blank">
                                        <img src="/site/img/certificaciones/07.jpg" class="img-fluid" loading="lazy" alt="">
                                    </a>
                                </div>
                            </div>

                            {{-- ═══════════════════════════════════════════════════════
                                 NUEVO: Botón PrimusGFS
                                 Ubicación: dentro del card de certificaciones,
                                 debajo de los logos existentes.
                            ═══════════════════════════════════════════════════════ --}}
                            <div class="mt-4 pt-3 border-top text-center">
                                <p class="gris small mb-3">
                                    {{ App::currentLocale() == 'es'
                                        ? 'Nuestros ranchos con certificación:'
                                        : 'Our certified ranches:' }}
                                </p>

                                <button
                                    type="button"
                                    class="btn-primusgfs-trigger"
                                    data-toggle="modal"
                                    data-target="#modalPrimusGFS"
                                    data-url="{{ App::currentLocale() == 'es'
                                        ? route('es.certificaciones.primusgfs')
                                        : route('en.certificaciones.primusgfs') }}"
                                    aria-label="{{ App::currentLocale() == 'es'
                                        ? 'Ver ranchos certificados PrimusGFS'
                                        : 'View PrimusGFS certified ranches' }}"
                                >
                                    {{--
                                        Logo PrimusGFS: subir a /site/img/certificaciones/primusgfs-logo.png
                                        La vista detecta si existe y muestra el logo; si no, muestra texto estilizado.
                                    --}}
                                    @if(file_exists(public_path('site/img/certificaciones/primusgfs-logo.png')))
                                        <img src="/site/img/certificaciones/primusgfs-logo.png"
                                             alt="PrimusGFS"
                                             class="primusgfs-logo-btn"
                                             loading="lazy">
                                    @else
                                        <span class="primusgfs-nombre-btn">PrimusGFS</span>
                                    @endif

                                    <span class="primusgfs-btn-label">
                                        <i class="fa fa-certificate" aria-hidden="true"></i>
                                        {{ App::currentLocale() == 'es'
                                            ? 'Ver Ranchos Certificados'
                                            : 'View Certified Ranches' }}
                                    </span>
                                    <i class="fa fa-chevron-right primusgfs-chevron" aria-hidden="true"></i>
                                </button>
                            </div>
                            {{-- /FIN: Botón PrimusGFS --}}

                        </div>{{-- /.bg-white.shadow --}}
                    </div>{{-- /.col-12.col-md-7 --}}
                </div>{{-- /.row --}}
            </div>
        </div>
    </section>

    {{-- ═══ Resto de secciones existentes — SIN CAMBIOS ═══════════════════════ --}}

    <section class="bg-azul-marino padding">
        <div class="container">
            <div class="m600 mx-auto bg-verde text-white p-4 rounded text-uppercase text-center" style="margin-top: -130px; margin-bottom: 40px;">
                {!! trans('compromiso.sistema_calidad') !!}
            </div>
            <div id="qualityControl" class="row">
                <div class="col-6 col-md-4 col-lg-2 text-center item" data-target="#qualityControlSlider" data-slide-to="0">
                    <img src="/site/img/icons/calidad-01.png" loading="lazy" alt="" class="img-fluid">
                    <div class="text-white text-uppercase f600">{!! trans('compromiso.campo') !!}</div>
                </div>
                <div class="col-6 col-md-4 col-lg-2 text-center item" data-target="#qualityControlSlider" data-slide-to="1">
                    <img src="/site/img/icons/calidad-02.png" loading="lazy" alt="" class="img-fluid">
                    <div class="text-white text-uppercase f600">{!! trans('compromiso.siembra_titulo') !!}</div>
                </div>
                <div class="col-6 col-md-4 col-lg-2 text-center item" data-target="#qualityControlSlider" data-slide-to="2">
                    <img src="/site/img/icons/calidad-03.png" loading="lazy" alt="" class="img-fluid">
                    <div class="text-white text-uppercase f600">{!! trans('compromiso.cosecha') !!}</div>
                </div>
                <div class="col-6 col-md-4 col-lg-2 text-center item" data-target="#qualityControlSlider" data-slide-to="3">
                    <img src="/site/img/icons/calidad-04.png" loading="lazy" alt="" class="img-fluid">
                    <div class="text-white text-uppercase f600">{!! trans('compromiso.cadena_frio') !!}</div>
                </div>
                <div class="col-6 col-md-4 col-lg-2 text-center item" data-target="#qualityControlSlider" data-slide-to="4">
                    <img src="/site/img/icons/calidad-05.png" loading="lazy" alt="" class="img-fluid">
                    <div class="text-white text-uppercase f600">{!! trans('compromiso.empaque_titulo') !!}</div>
                </div>
                <div class="col-6 col-md-4 col-lg-2 text-center item" data-target="#qualityControlSlider" data-slide-to="5">
                    <img src="/site/img/icons/calidad-06.png" loading="lazy" alt="" class="img-fluid">
                    <div class="text-white text-uppercase f600">{!! trans('compromiso.distribucion_titulo') !!}</div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gris-claro padding">
        <div class="container">
            <div id="qualityControlSlider" class="carousel slide" data-ride="false">
                <ol class="carousel-indicators">
                    <li data-target="#qualityControlSlider" data-slide-to="0" class="active"></li>
                    <li data-target="#qualityControlSlider" data-slide-to="1"></li>
                    <li data-target="#qualityControlSlider" data-slide-to="2"></li>
                    <li data-target="#qualityControlSlider" data-slide-to="3"></li>
                    <li data-target="#qualityControlSlider" data-slide-to="4"></li>
                    <li data-target="#qualityControlSlider" data-slide-to="5"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-12 col-md-7">
                                <img src="/site/img/compromiso-campo.png" class="img-fluid" alt="">
                            </div>
                            <div class="col-12 col-md-5 d-flex align-items-center">
                                <div>
                                    <h3 class="azul-marino text-uppercase f600 editable" data-group="compromiso" data-key="campo">{!! trans('compromiso.campo') !!}</h3>
                                    <div class="editable" data-group="compromiso" data-key="campo_text">{!! trans('compromiso.campo_text') !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ... resto de slides igual al original ... --}}
                </div>
            </div>
        </div>
    </section>

    {{-- ... resto de secciones igual al original (responsabilidad, smeta, sustentabilidad) ... --}}


    {{-- ═══════════════════════════════════════════════════════════════════════
         MODAL PRIMUSGFS
         Bootstrap 4.5 ya está cargado en site.layouts.master — no requiere
         ninguna dependencia adicional.
         Posición: al final de @section('page'), antes de @stop.
    ════════════════════════════════════════════════════════════════════════ --}}
    <div class="modal fade"
         id="modalPrimusGFS"
         tabindex="-1"
         role="dialog"
         aria-labelledby="modalPrimusGFSLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content cert-modal-content">

                {{-- ── Header ──────────────────────────────────────────────── --}}
                <div class="modal-header cert-modal-header">
                    <div class="d-flex align-items-center">

                        @if(file_exists(public_path('site/img/certificaciones/primusgfs-logo.png')))
                            <img src="/site/img/certificaciones/primusgfs-logo.png"
                                 alt="PrimusGFS"
                                 class="mr-3"
                                 style="height:44px; filter:brightness(0) invert(1);"
                                 loading="lazy">
                        @else
                            <span class="text-white f600 h4 mr-3 mb-0">PrimusGFS</span>
                        @endif

                        <div>
                            <h5 class="modal-title text-white f600 mb-0" id="modalPrimusGFSLabel">
                                {{ App::currentLocale() == 'es'
                                    ? 'Ranchos Certificados PrimusGFS'
                                    : 'PrimusGFS Certified Ranches' }}
                            </h5>
                            <small style="opacity:.82; color:#fff;">
                                {{ App::currentLocale() == 'es'
                                    ? 'Compromiso con la inocuidad alimentaria en cada unidad productiva'
                                    : 'Food safety commitment in every production unit' }}
                            </small>
                        </div>
                    </div>

                    <button type="button"
                            class="cert-modal-close-btn"
                            data-dismiss="modal"
                            aria-label="{{ App::currentLocale() == 'es' ? 'Cerrar' : 'Close' }}">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>

                {{-- ── Body ─────────────────────────────────────────────────── --}}
                <div class="modal-body p-4" style="background:#F5F5F5; max-height:72vh; overflow-y:auto;">

                    {{-- Estado: cargando (visible por defecto) --}}
                    <div id="cert-loader" class="text-center py-5">
                        <div class="cert-spinner mx-auto mb-3"></div>
                        <p class="gris">
                            {{ App::currentLocale() == 'es'
                                ? 'Cargando certificaciones...'
                                : 'Loading certifications...' }}
                        </p>
                    </div>

                    {{-- Estado: mosaico inyectado por AJAX (oculto hasta que carga) --}}
                    <div id="cert-mosaico" style="display:none;"></div>

                    {{-- Estado: error de red --}}
                    <div id="cert-error" class="text-center py-5" style="display:none;">
                        <i class="fa fa-exclamation-triangle fa-3x naranja mb-3 d-block" aria-hidden="true"></i>
                        <p class="gris">
                            {{ App::currentLocale() == 'es'
                                ? 'Error al cargar las certificaciones.'
                                : 'Error loading certifications.' }}
                        </p>
                        <button class="button bg-azul-marino text-white mt-2" onclick="certRecargar()">
                            <i class="fa fa-refresh mr-1" aria-hidden="true"></i>
                            {{ App::currentLocale() == 'es' ? 'Reintentar' : 'Retry' }}
                        </button>
                    </div>

                </div>{{-- /.modal-body --}}

                {{-- ── Footer ───────────────────────────────────────────────── --}}
                <div class="modal-footer cert-modal-footer" id="cert-footer" style="display:none;">
                    <span class="gris small mr-auto" id="cert-resumen-texto"></span>

                    <a href="https://www.primusgfs.com"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="button bg-azul-marino text-white small">
                        <i class="fa fa-external-link mr-1" aria-hidden="true"></i>
                        {{ App::currentLocale() == 'es' ? 'Sitio oficial' : 'Official site' }}
                    </a>

                    <button type="button"
                            class="button text-white small"
                            style="background:#666;"
                            data-dismiss="modal">
                        {{ App::currentLocale() == 'es' ? 'Cerrar' : 'Close' }}
                    </button>
                </div>

            </div>{{-- /.modal-content --}}
        </div>{{-- /.modal-dialog --}}
    </div>{{-- /#modalPrimusGFS --}}

@stop


{{-- ════════════════════════════════════════════════════════════════════════════
     CSS — Se añade al bloque existente de @section('customCSS')
     Compatible con Bootstrap 4.5 + Font Awesome 4.7 ya cargados en master
════════════════════════════════════════════════════════════════════════════ --}}
@section('customCSS')
    @parent
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <style>
        /* ── CSS existente del proyecto (no tocar) ────────────────────────── */
        .slick-slider .slick-next:before { font-size: 30px; color: #003ca6; }
        .slick-slider .slick-prev:before { font-size: 30px; color: #003ca6; }
        .slick-dots li.slick-active button:before { color: #003ca6; font-size: 10px; }
        #qualityControl .item { transform: scale(1); transition: all .3s; cursor: pointer; }
        #qualityControl .item:hover { transform: scale(1.2); transition: all .3s; }
        #qualityControlSlider .carousel-indicators { bottom: -50px; }
        #qualityControlSlider .carousel-indicators li { background-color: #003ca6; }

        /* ══════════════════════════════════════════════════════════════════
           MÓDULO PRIMUSGFS — Certificaciones
           Paleta del proyecto: #003CA6 azul-marino | #4CAF50 verde | #F5F5F5 gris-claro
        ══════════════════════════════════════════════════════════════════ */

        /* ── Botón disparador ─────────────────────────────────────────── */
        .btn-primusgfs-trigger {
            display:         inline-flex;
            align-items:     center;
            gap:             10px;
            padding:         12px 24px;
            background:      #fff;
            border:          2px solid #00833E;
            border-radius:   50px;
            cursor:          pointer;
            transition:      all .3s ease;
            box-shadow:      0 3px 12px rgba(0,131,62,.20);
            font-family:     inherit;
            text-decoration: none;
        }
        .btn-primusgfs-trigger:hover,
        .btn-primusgfs-trigger:focus {
            background:  #00833E;
            box-shadow:  0 6px 24px rgba(0,131,62,.35);
            transform:   translateY(-2px);
            outline:     none;
        }
        .btn-primusgfs-trigger:hover .primusgfs-btn-label,
        .btn-primusgfs-trigger:hover .primusgfs-chevron { color: #fff; }
        .btn-primusgfs-trigger:hover .primusgfs-nombre-btn {
            color:        #fff;
            border-color: rgba(255,255,255,.4);
        }

        .primusgfs-logo-btn  { height: 36px; width: auto; object-fit: contain; }
        .primusgfs-nombre-btn {
            font-weight:    700;
            font-size:      15px;
            color:          #00833E;
            letter-spacing: .5px;
            padding:        4px 10px;
            border:         1.5px solid #00833E;
            border-radius:  4px;
            transition:     all .3s;
        }
        .primusgfs-btn-label {
            font-weight:    600;
            font-size:      13px;
            color:          #00833E;
            transition:     color .3s;
            text-transform: uppercase;
            letter-spacing: .5px;
        }
        .primusgfs-chevron { color: #00833E; font-size: 11px; transition: color .3s; }

        /* ── Modal ────────────────────────────────────────────────────── */
        .cert-modal-content {
            border:        none;
            border-radius: 12px;
            overflow:      hidden;
        }
        .cert-modal-header {
            background:    linear-gradient(135deg, #00833E 0%, #005928 100%);
            padding:       20px 24px;
            border-bottom: none;
            align-items:   center;
        }
        .cert-modal-close-btn {
            background:      rgba(255,255,255,.15);
            border:          none;
            color:           #fff;
            width:           34px;
            height:          34px;
            border-radius:   50%;
            display:         flex;
            align-items:     center;
            justify-content: center;
            cursor:          pointer;
            transition:      background .2s;
            margin-left:     auto;
            flex-shrink:     0;
        }
        .cert-modal-close-btn:hover  { background: rgba(255,255,255,.3); }
        .cert-modal-close-btn:focus  { outline: 2px solid rgba(255,255,255,.5); }

        /* ── Spinner de carga ─────────────────────────────────────────── */
        .cert-spinner {
            width:         42px;
            height:        42px;
            border:        4px solid #e0e0e0;
            border-top:    4px solid #00833E;
            border-radius: 50%;
            animation:     certSpin .75s linear infinite;
        }
        @keyframes certSpin { to { transform: rotate(360deg); } }

        /* ── Footer del modal ─────────────────────────────────────────── */
        .cert-modal-footer {
            background: #fff;
            border-top: 1px solid #eee;
            padding:    14px 24px;
            gap:        10px;
            flex-wrap:  wrap;
        }

        /* ── Barra de resumen estadístico ─────────────────────────────── */
        .cert-resumen-bar {
            background:    #fff;
            border-radius: 10px;
            padding:       16px 0;
            box-shadow:    0 2px 8px rgba(0,0,0,.06);
        }
        .cert-stat-item  { display: flex; flex-direction: column; align-items: center; }
        .cert-stat-num   { font-size: 26px; font-weight: 800; line-height: 1; }
        .cert-stat-label { font-size: 11px; text-transform: uppercase; letter-spacing: .5px; margin-top: 3px; }

        /* ── Grid del mosaico ─────────────────────────────────────────── */
        /* CSS Grid nativo: no depende de las columnas de Bootstrap.
           auto-fill + minmax produce el responsive sin media queries adicionales. */
        .cert-grid {
            display:               grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap:                   18px;
        }

        /* ── Card individual del rancho ───────────────────────────────── */
        .cert-card {
            background:     #fff;
            border-radius:  10px;
            box-shadow:     0 3px 14px rgba(0,0,0,.10);
            overflow:       hidden;
            transition:     transform .25s ease, box-shadow .25s ease;
            border:         2px solid transparent;
            display:        flex;
            flex-direction: column;
        }
        .cert-card:hover {
            transform:  translateY(-4px);
            box-shadow: 0 10px 32px rgba(0,0,0,.16);
        }
        .cert-card--vigente { border-color: #e8f5e9; }
        .cert-card--proximo { border-color: #FF6F00; }
        .cert-card--vencido { border-color: #ef9a9a; opacity: .88; }

        /* ── Imagen del rancho ────────────────────────────────────────── */
        .cert-card-img-wrap { position: relative; height: 170px; overflow: hidden; flex-shrink: 0; }
        .cert-card-img {
            width:      100%;
            height:     100%;
            object-fit: cover;
            transition: transform .4s ease;
        }
        .cert-card:hover .cert-card-img { transform: scale(1.06); }

        /* ── Badge de estado ──────────────────────────────────────────── */
        .cert-badge {
            position:        absolute;
            top:             10px;
            right:           10px;
            padding:         4px 11px;
            border-radius:   20px;
            font-size:       11px;
            font-weight:     700;
            text-transform:  uppercase;
            letter-spacing:  .4px;
            display:         flex;
            align-items:     center;
            gap:             4px;
            backdrop-filter: blur(3px);
        }
        .cert-badge--vigente { background: rgba(0,131,62,.90);  color: #fff; }
        .cert-badge--vencido { background: rgba(198,40,40,.90); color: #fff; }
        .cert-badge--proximo {
            background: rgba(230,81,0,.92);
            color:      #fff;
            animation:  certPulso 2s ease-in-out infinite;
        }
        @keyframes certPulso { 0%,100%{opacity:1} 50%{opacity:.62} }

        /* ── Cuerpo de la card ────────────────────────────────────────── */
        .cert-card-body     { padding: 16px; flex: 1; display: flex; flex-direction: column; }
        .cert-card-nombre   { font-size: 15px; margin: 0 0 6px; line-height: 1.3; }
        .cert-card-ubicacion{ margin: 0 0 12px; }

        /* ── Tabla de detalles del certificado ────────────────────────── */
        .cert-detalles {
            background:    #F5F5F5;
            border-radius: 7px;
            padding:       10px 12px;
            margin-bottom: 14px;
            flex:          1;
        }
        .cert-fila {
            display:         flex;
            justify-content: space-between;
            align-items:     flex-start;
            padding:         4px 0;
            border-bottom:   1px solid #e8e8e8;
            font-size:       12px;
        }
        .cert-fila:last-child { border-bottom: none; }
        .cert-label         { color:#888; font-weight:600; text-transform:uppercase; font-size:10px; letter-spacing:.3px; flex-shrink:0; padding-right:8px; }
        .cert-valor         { color:#333; font-weight:500; text-align:right; }
        .cert-numero        { font-family:monospace; font-size:11px; color:#003CA6; }
        .cert-fecha-proximo { color:#E65100 !important; font-weight:700 !important; }

        /* ── Botón de descarga PDF ────────────────────────────────────── */
        .cert-btn-descarga {
            display:         flex;
            align-items:     center;
            justify-content: center;
            width:           100%;
            padding:         9px;
            background:      #003CA6;
            color:           #fff !important;
            border-radius:   7px;
            font-size:       12px;
            font-weight:     600;
            text-decoration: none !important;
            transition:      background .2s, transform .15s;
            margin-top:      auto;
        }
        .cert-btn-descarga:hover {
            background:  #002d80;
            transform:   translateY(-1px);
        }
        .cert-btn-descarga--vencido       { background: #9e9e9e; }
        .cert-btn-descarga--vencido:hover { background: #757575; }

        .cert-sin-pdf {
            display:       block;
            text-align:    center;
            padding:       9px;
            border:        1px dashed #ddd;
            border-radius: 7px;
            margin-top:    auto;
        }

        /* ── Responsive ───────────────────────────────────────────────── */
        @media (max-width: 575px) {
            .cert-grid         { grid-template-columns: 1fr; }
            .cert-modal-header { flex-direction: column; gap: 12px; text-align: center; }
            .cert-modal-footer { justify-content: center; }
        }
        @media (min-width: 576px) and (max-width: 767px) {
            .cert-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
@stop


{{-- ════════════════════════════════════════════════════════════════════════════
     JS — Se añade al bloque existente de @section('customJS')
     jQuery 2.2.4 y Bootstrap 4.5 ya están cargados en master.blade.php
════════════════════════════════════════════════════════════════════════════ --}}
@section('customJS')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(function () {

            /* ── JS existente (Prácticas Slick) — sin cambios ── */
            $('.practicas').slick({
                dots: true,
                infinite: false,
                speed: 300,
                slidesToShow: 3,
                slidesToScroll: 3,
                autoplay: true,
                arrows: true,
                responsive: [
                    { breakpoint: 962, settings: { slidesToShow: 2, slidesToScroll: 2 } },
                    { breakpoint: 800, settings: { slidesToShow: 1, slidesToScroll: 1, dots: true, arrows: false } }
                ]
            });

            /* ════════════════════════════════════════════════════
               MÓDULO PRIMUSGFS — AJAX + Modal Bootstrap 4
               jQuery 2.2.4 ya disponible en el scope global.
            ════════════════════════════════════════════════════ */

            var certUrlActual = null; // URL en uso (para reintentos desde botón de error)

            /**
             * Al abrir el modal Bootstrap, leer la URL del botón disparador
             * e iniciar la carga AJAX del mosaico de ranchos.
             *
             * El evento 'show.bs.modal' recibe en e.relatedTarget el botón
             * que disparó el modal, donde guardamos la URL en data-url.
             */
            $('#modalPrimusGFS').on('show.bs.modal', function (e) {
                var url = $(e.relatedTarget).data('url');
                if (!url) return;
                certCargar(url);
            });

            /**
             * Al cerrar el modal, limpiar todo el contenido.
             * La próxima apertura siempre muestra el loader y recarga fresco.
             * Esto garantiza que el usuario siempre vea datos actualizados.
             */
            $('#modalPrimusGFS').on('hidden.bs.modal', function () {
                $('#cert-mosaico').html('').hide();
                $('#cert-loader').show();
                $('#cert-error').hide();
                $('#cert-footer').hide();
                $('#cert-resumen-texto').text('');
                certUrlActual = null;
            });

            /**
             * Carga el mosaico vía AJAX y lo inyecta en el modal.
             *
             * @param {string} url - Endpoint que devuelve {html, total, vigentes}
             */
            function certCargar(url) {
                certUrlActual = url;

                // Resetear estados visuales
                $('#cert-loader').show();
                $('#cert-mosaico').hide();
                $('#cert-error').hide();
                $('#cert-footer').hide();

                $.ajax({
                    url:     url,
                    type:    'GET',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    success: function (res) {
                        if (res.html) {
                            // Inyectar HTML del partial renderizado en servidor
                            $('#cert-mosaico').html(res.html).fadeIn(250);

                            // Actualizar texto del footer con resumen estadístico
                            var lang    = $('html').attr('lang') || 'es';
                            var label   = lang === 'en'
                                ? res.vigentes + '/' + res.total + ' ranches with valid PrimusGFS certification'
                                : res.vigentes + '/' + res.total + ' ranchos con certificación vigente';
                            $('#cert-resumen-texto').text(label);
                            $('#cert-footer').css('display', 'flex');
                        }
                        $('#cert-loader').hide();
                    },
                    error: function (xhr) {
                        console.error('[PrimusGFS] Error cargando certificaciones:', xhr.status, xhr.statusText);
                        $('#cert-loader').hide();
                        $('#cert-error').fadeIn(200);
                    }
                });
            }

            // Exponer función de reintento al scope global
            // (usada en el botón "Reintentar" del estado de error)
            window.certRecargar = function () {
                if (certUrlActual) certCargar(certUrlActual);
            };

        }); // fin $(function)
    </script>
@stop
