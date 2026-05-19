@section('title', 'Contacto')
@extends('site.layouts.master')
@php
$active = 'contacto';
@endphp

@section('page')
@if(App::currentLocale() == 'es')
<img src="/site/img/banner-contacto.jpg" loading="lazy" class="img-fluid w-100">
@else
<img src="/site/img/banner-contacto-en.jpg" loading="lazy" class="img-fluid w-100">
@endif

<section class="section-contacto py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 mb-4 mb-md-2">
                <p class="azul-marino editable" data-group="contacto" data-key="form_text">
                    {!! trans('contacto.form_text') !!}
                </p>

                <form action="{{ route(App::currentLocale().'.contacto_enviar') }}" method="post" data-toggle="validator" data-disable="false" data-focus="false">
                    {{ csrf_field() }}
                    <input type="hidden" name="website" value="" />
                    <div class="form-group">
                        <select name="area" class="form-control" data-error="{!! trans('contacto.area_error') !!}" required>
                            <option value="">{!! trans('contacto.area_label') !!}</option>
                            <option value="rosa.rodriguez@mrlucky.com.mx">{!! trans('contacto.capitalhumano_label') !!}</option>
                            {{-- <option value="lescobar@brandhouse.com.mx">Capital Humano 2</option> --}}
                            <option value="mrhernandez@mrlucky.com.mx">{!! trans('contacto.calidad') !!}</option>
                            <option value="comprasmp@mrlucky.com.mx,comprasmateriales@mrlucky.com.mx">{!! trans('contacto.proveedores') !!}</option>
                            <option value="">{!! trans('contacto.mantenimiento') !!}</option>
                            <option value="mercadotecnia@mrlucky.com.mx">{!! trans('contacto.mercadotecnia') !!}</option>
                            <option value="msamano@mrluccky.com.mx">{!! trans('contacto.capitalhumano_label') !!}</option>
                            <option value="sistemas@mrlucky.com.mx">{!! trans('contacto.sistemas') !!}</option>
                            <option value="orders@mrlucky.com.mx">{!! trans('contacto.ventasexportacion') !!}</option>
                            <option value="">{!! trans('contacto.ventasnacional') !!}</option>
                        </select>
                        <small class="help-block with-errors"></small>
                        {{-- Copia a: ricardo.cortes@mrlucky.com.mxmusabiaga@mrlucky.com.mxadrian.ortega@mrlucky.com.mx --}}
                    </div>
                    <div class="form-group">
                        <input type="text" name="nombre" class="form-control" placeholder="{!! trans('contacto.nombre_label') !!}" data-error="{!! trans('contacto.nombre_error') !!}" required>
                        <small class="help-block with-errors"></small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="empresa" class="form-control" placeholder="{!! trans('contacto.empresa_label') !!}" data-error="{!! trans('contacto.empresa_error') !!}" required>
                        <small class="help-block with-errors"></small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="telefono" class="form-control" placeholder="{!! trans('contacto.telefono_label') !!}">
                        <small class="help-block with-errors"></small>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="{!! trans('contacto.email_label') !!}" data-error="{!! trans('contacto.correo_error') !!}" data-required-error="{!! trans('contacto.correo_error2') !!}" required>
                        <small class="help-block with-errors"></small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="ciudad" class="form-control" placeholder="{!! trans('contacto.ciudad_label') !!}" data-error="{!! trans('contacto.ciudad_error') !!}" required>
                        <small class="help-block with-errors"></small>
                    </div>
                    <div class="form-group">
                        <textarea name="comentarios" rows="5" class="form-control" placeholder="{!! trans('contacto.comentarios_label') !!}" data-error="{!! trans('contacto.comentario_error') !!}" required></textarea>
                        <small class="help-block with-errors"></small>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LezXjArAAAAALY_fO3Kc5EV6oN0zqx8GigB66Tu"></div>
                    </div>
                    <div class="form-group">
                        <button id="btnEnviar" class="btn btn-block btn-enviar py-3" type="submit" disabled>
                            {!! trans('contacto.enviar_btn') !!}
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-6">
                <div class="contacto-ubicaciones">
                    <div class="ubicacion">
                        <h5>
                            <spapn class="azul-marino f600 editable" data-group="contacto" data-key="planta_proceso">{!! trans('contacto.planta_proceso') !!}</spapn> <a href="https://www.google.com/maps/place/Mr.+Lucky/@20.6589272,-101.2966484,17z/data=!3m1!4b1!4m14!1m7!3m6!1s0x842c811f52024351:0xab3f024f06cfb5d3!2sMr.+Lucky!8m2!3d20.6589272!4d-101.2940735!16s%2Fg%2F11h8kv2zmt!3m5!1s0x842c811f52024351:0xab3f024f06cfb5d3!8m2!3d20.6589272!4d-101.2940735!16s%2Fg%2F11h8kv2zmt?entry=ttu" class="btn-mapa" target="_blank">Ver mapa</a>
                        </h5>
                        <div class="mt-3 d-flex">
                            <i class="fa fa-map-marker azul-cielo mr-2"></i> <span class="azul-cielo">{!! trans('contacto.direccion') !!}</span>
                            <p class="ml-3 gris">
                                Carretera Panamericana km. 5 <br>
                                Colonia Rancho Grande C.P. 36544 <br>
                                Irapuato, Guanajuato; México <br>
                                Apartado Postal 2
                            </p>
                        </div>
                        <div class="d-flex">
                            <i class="fa fa-phone azul-cielo mr-2"></i> <span class="azul-cielo">{!! trans('contacto.telefono_label') !!}</span>
                            <p class="ml-3 gris">
                                (462) 626-2663
                            </p>
                        </div>
                        <div class="d-flex">
                            <i class="fa fa-envelope azul-cielo mr-2"></i> <span class="azul-cielo">E-mail:</span>
                            <p class="ml-3 gris">
                                info@mrlucky.com.mx
                            </p>
                        </div>
                    </div>
                    <div class="ubicacion mt-5">
                        <h5>
                            <spapn class="azul-marino f600 editable" data-group="contacto" data-key="oficinas_generales">{!! trans('contacto.oficinas_generales') !!}</spapn>
                        </h5>
                        <div class="mt-3 d-flex">
                            <i class="fa fa-map-marker azul-cielo mr-2"></i> <span class="azul-cielo">{!! trans('contacto.direccion') !!}</span>
                            <p class="ml-3 gris">
                                Carretera Panamericana Km. 291-1 <br>
                                Colonia La Fortaleza C.P. 38495 <br>
                                Cortazar, Guanajuato; México
                            </p>
                        </div>
                        <div class="d-flex">
                            <i class="fa fa-phone azul-cielo mr-2"></i> <span class="azul-cielo">{!! trans('contacto.telefono_label') !!}</span>
                            <p class="ml-3 gris">
                                (411) 155-0949
                            </p>
                        </div>
                        <div class="d-flex">
                            <i class="fa fa-envelope azul-cielo mr-2"></i> <span class="azul-cielo">E-mail:</span>
                            <p class="ml-3 gris">
                                info@mrlucky.com.mx
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h3 class="text-center azul-marino pacifico mb-4 editable"
            data-group="contacto" data-key="descargas">
            {!! trans('contacto.descargas') !!}
        </h3>

        {{-- ── Catálogo ──────────────────────────────────── --}}
        <div class="boletin-14-entry py-3">

            {{-- Encabezado de la entrada --}}
            <div class="d-flex align-items-start justify-content-between flex-wrap" style="gap:12px;">
                <div class="d-flex align-items-center">
                    <img src="/site/img/icon-descarga.png" class="img-fluid mr-3" width="30" alt="">
                    <div>
                        <div class="azul-marino h5 f600 mb-0">
                            {{ App::currentLocale() == 'es'
                                ? 'Catalogo Mr. Lucky · 2026'
                                : 'Mr. Lucky Catalog · 2026' }}
                        </div>
                        <small class="gris">
                            {{ App::currentLocale() == 'es'
                                ? 'Catalogo digital interactivo · Navega página por página'
                                : 'Interactive digital catalog · Browse page by page' }}
                        </small>
                    </div>
                </div>

                {{-- Acciones: Ver como revista + Descargar PDF --}}
                <div class="d-flex align-items-center flex-wrap" style="gap:8px;">

                    {{-- Botón principal: abrir flipbook en modal --}}
                    <button type="button"
                        class="btn-boletin-flipbook"
                        data-toggle="modal"
                        data-target="#modalBoletinFlibook"
                        data-src="{{ route( App::currentLocale() . '.boletin', ['slug' => 'catalogo'] ) }}"
                        aria-label="{{ App::currentLocale() == 'es' ? 'Ver Catalogo Mr. Lucky como revista digital' : 'View Mr. Lucky Catalog as digital magazine' }}">
                        <i class="fa fa-book mr-1" aria-hidden="true"></i>
                        {{ App::currentLocale() == 'es' ? 'Ver revista' : 'View magazine' }}
                    </button>

                    {{-- Botón secundario: descarga directa --}}
                    <a href="/docs/catalogo-mrlucky.pdf"
                        download
                        class="btn-boletin-pdf"
                        title="{{ App::currentLocale() == 'es' ? 'Descargar PDF' : 'Download PDF' }}">
                        <i class="fa fa-download mr-1" aria-hidden="true"></i>
                        PDF
                    </a>
                </div>
            </div>
        </div>

        <hr>

        {{-- ── Sustentabilidad 2024 ─────────────────────── --}}
        <div class="boletin-14-entry py-3">

            {{-- Encabezado de la entrada --}}
            <div class="d-flex align-items-start justify-content-between flex-wrap" style="gap:12px;">
                <div class="d-flex align-items-center">
                    <img src="/site/img/icon-descarga.png" class="img-fluid mr-3" width="30" alt="">
                    <div>
                        <div class="azul-marino h5 f600 mb-0">
                            {{ App::currentLocale() == 'es'
                                ? 'Sustentabilidad'
                                : 'Sustainability' }}
                        </div>
                        <small class="gris">
                            {{ App::currentLocale() == 'es'
                                ? 'Revista digital interactiva · Navega página por página'
                                : 'Interactive digital magazine · Browse page by page' }}
                        </small>
                    </div>
                </div>

                {{-- Acciones: Ver como revista + Descargar PDF --}}
                <div class="d-flex align-items-center flex-wrap" style="gap:8px;">

                    {{-- Botón principal: abrir flipbook en modal --}}
                    <button type="button"
                        class="btn-boletin-flipbook"
                        data-toggle="modal"
                        data-target="#modalBoletinFlibook"
                        data-src="{{ route( App::currentLocale() . '.boletin', ['slug' => 'sustentabilidad'] ) }}"
                        aria-label="{{ App::currentLocale() == 'es' ? 'Ver Sustentabilidad como revista digital' : 'View Sustainability as digital magazine' }}">
                        <i class="fa fa-book mr-1" aria-hidden="true"></i>
                        {{ App::currentLocale() == 'es' ? 'Ver revista' : 'View magazine' }}
                    </button>

                    {{-- Botón secundario: descarga directa --}}
                    <a href="/docs/Sustentabilidad_2024.pdf"
                        download
                        class="btn-boletin-pdf"
                        title="{{ App::currentLocale() == 'es' ? 'Descargar PDF' : 'Download PDF' }}">
                        <i class="fa fa-download mr-1" aria-hidden="true"></i>
                        PDF
                    </a>
                </div>
            </div>
        </div>

        <hr>

        {{-- ── Boletín 12 ────────────────────────────────── --}}
        <div class="boletin-14-entry py-3">

            {{-- Encabezado de la entrada --}}
            <div class="d-flex align-items-start justify-content-between flex-wrap" style="gap:12px;">
                <div class="d-flex align-items-center">
                    <img src="/site/img/icon-descarga.png" class="img-fluid mr-3" width="30" alt="">
                    <div>
                        <div class="azul-marino h5 f600 mb-0">
                            {{ App::currentLocale() == 'es'
                                ? 'Boletín Informativo No. 12 · Grupo U · 2025'
                                : 'Newsletter No. 12 · Grupo U · 2025' }}
                        </div>
                        <small class="gris">
                            {{ App::currentLocale() == 'es'
                                ? 'Revista digital interactiva · Navega página por página'
                                : 'Interactive digital magazine · Browse page by page' }}
                        </small>
                    </div>
                </div>

                {{-- Acciones: Ver como revista + Descargar PDF --}}
                <div class="d-flex align-items-center flex-wrap" style="gap:8px;">

                    {{-- Botón principal: abrir flipbook en modal --}}
                    <button type="button"
                        class="btn-boletin-flipbook"
                        data-toggle="modal"
                        data-target="#modalBoletinFlibook"
                        data-src="{{ route( App::currentLocale() . '.boletin', ['slug' => 'boletin-12'] ) }}"
                        aria-label="{{ App::currentLocale() == 'es' ? 'Ver Boletín 12 como revista digital' : 'View Newsletter 12 as digital magazine' }}">
                        <i class="fa fa-book mr-1" aria-hidden="true"></i>
                        {{ App::currentLocale() == 'es' ? 'Ver revista' : 'View magazine' }}
                    </button>

                    {{-- Botón secundario: descarga directa --}}
                    <a href="/docs/Boletin-12-Grupo-U.pdf"
                        download
                        class="btn-boletin-pdf"
                        title="{{ App::currentLocale() == 'es' ? 'Descargar PDF' : 'Download PDF' }}">
                        <i class="fa fa-download mr-1" aria-hidden="true"></i>
                        PDF
                    </a>
                </div>
            </div>
        </div>
        <hr>


        {{-- ═══════════════════════════════════════════════════════
             BOLETÍN 13 — Entrada con Flipbook
             Es la única entrada que tiene el botón "Ver como revista"
        ═══════════════════════════════════════════════════════ --}}
        <div class="boletin-14-entry py-3">

            {{-- Encabezado de la entrada --}}
            <div class="d-flex align-items-start justify-content-between flex-wrap" style="gap:12px;">
                <div class="d-flex align-items-center">
                    <img src="/site/img/icon-descarga.png" class="img-fluid mr-3" width="30" alt="">
                    <div>
                        <div class="azul-marino h5 f600 mb-0">
                            {{ App::currentLocale() == 'es'
                                ? 'Boletín Informativo No. 13 · Grupo U · 2025'
                                : 'Newsletter No. 13 · Grupo U · 2025' }}
                        </div>
                        <small class="gris">
                            {{ App::currentLocale() == 'es'
                                ? 'Revista digital interactiva · Navega página por página'
                                : 'Interactive digital magazine · Browse page by page' }}
                        </small>
                    </div>
                </div>

                {{-- Acciones: Ver como revista + Descargar PDF --}}
                <div class="d-flex align-items-center flex-wrap" style="gap:8px;">

                    {{-- Botón principal: abrir flipbook en modal --}}
                    <button type="button"
                        class="btn-boletin-flipbook"
                        data-toggle="modal"
                        data-target="#modalBoletinFlibook"
                        data-src="{{ route( App::currentLocale() . '.boletin', ['slug' => 'boletin-13'] ) }}"
                        aria-label="{{ App::currentLocale() == 'es' ? 'Ver Boletín 13 como revista digital' : 'View Newsletter 13 as digital magazine' }}">
                        <i class="fa fa-book mr-1" aria-hidden="true"></i>
                        {{ App::currentLocale() == 'es' ? 'Ver revista' : 'View magazine' }}
                    </button>

                    {{-- Botón secundario: descarga directa --}}
                    <a href="/docs/Boletin-13-Grupo-U.pdf"
                        download
                        class="btn-boletin-pdf"
                        title="{{ App::currentLocale() == 'es' ? 'Descargar PDF' : 'Download PDF' }}">
                        <i class="fa fa-download mr-1" aria-hidden="true"></i>
                        PDF
                    </a>
                </div>
            </div>
        </div>
        <hr>

        {{-- ═══════════════════════════════════════════════════════
             BOLETÍN 14 — Entrada con Flipbook
             Es la única entrada que tiene el botón "Ver como revista"
        ═══════════════════════════════════════════════════════ --}}
        <div class="boletin-14-entry py-3">

            {{-- Encabezado de la entrada --}}
            <div class="d-flex align-items-start justify-content-between flex-wrap" style="gap:12px;">
                <div class="d-flex align-items-center">
                    <img src="/site/img/icon-descarga.png" class="img-fluid mr-3" width="30" alt="">
                    <div>
                        <div class="azul-marino h5 f600 mb-0">
                            {{ App::currentLocale() == 'es'
                                ? 'Boletín Informativo No. 14 · Grupo U · 2026'
                                : 'Newsletter No. 14 · Grupo U · 2026' }}
                        </div>
                        <small class="gris">
                            {{ App::currentLocale() == 'es'
                                ? 'Revista digital interactiva · Navega página por página'
                                : 'Interactive digital magazine · Browse page by page' }}
                        </small>
                    </div>
                </div>

                {{-- Acciones: Ver como revista + Descargar PDF --}}
                <div class="d-flex align-items-center flex-wrap" style="gap:8px;">

                    {{-- Botón principal: abrir flipbook en modal --}}
                    <button type="button"
                        class="btn-boletin-flipbook"
                        data-toggle="modal"
                        data-target="#modalBoletinFlibook"
                        data-src="{{ route( App::currentLocale() . '.boletin', ['slug' => 'boletin-14'] ) }}"
                        aria-label="{{ App::currentLocale() == 'es' ? 'Ver Boletín 14 como revista digital' : 'View Newsletter 14 as digital magazine' }}">
                        <i class="fa fa-book mr-1" aria-hidden="true"></i>
                        {{ App::currentLocale() == 'es' ? 'Ver revista' : 'View magazine' }}
                    </button>

                    {{-- Botón secundario: descarga directa --}}
                    <a href="/docs/Boletin-14-Grupo-U.pdf"
                        download
                        class="btn-boletin-pdf"
                        title="{{ App::currentLocale() == 'es' ? 'Descargar PDF' : 'Download PDF' }}">
                        <i class="fa fa-download mr-1" aria-hidden="true"></i>
                        PDF
                    </a>
                </div>
            </div>
        </div>
        <hr>

        {{-- ── Recetario Halloween ───────────────────────── --}}
        <div class="boletin-14-entry py-3">

            {{-- Encabezado de la entrada --}}
            <div class="d-flex align-items-start justify-content-between flex-wrap" style="gap:12px;">
                <div class="d-flex align-items-center">
                    <img src="/site/img/icon-descarga.png" class="img-fluid mr-3" width="30" alt="">
                    <div>
                        <div class="azul-marino h5 f600 mb-0">
                            {{ App::currentLocale() == 'es'
                                ? 'RECETARIO CALABAZAS MR. LUCKY'
                                : "MR. LUCKY'S PUMPKIN RECIPE BOOK" }}
                        </div>
                        <small class="gris">
                            {{ App::currentLocale() == 'es'
                                ? 'Recetario digital interactivo · Navega página por página'
                                : 'Interactive Digital Cookbook · Browse page by page' }}
                        </small>
                    </div>
                </div>

                {{-- Acciones: Ver como revista + Descargar PDF --}}
                <div class="d-flex align-items-center flex-wrap" style="gap:8px;">

                    {{-- Botón principal: abrir flipbook en modal --}}
                    <button type="button"
                        class="btn-boletin-flipbook"
                        data-toggle="modal"
                        data-target="#modalBoletinFlibook"
                        data-src="{{ route( App::currentLocale() . '.boletin', ['slug' => 'recetario'] ) }}"
                        aria-label="{{ App::currentLocale() == 'es' ? 'Ver RECETARIO CALABAZAS MR. LUCKY como recetario digital' : "View MR. LUCKY'S PUMPKIN RECIPE BOOK as Digital Cookbook" }}">
                        <i class="fa fa-book mr-1" aria-hidden="true"></i>
                        {{ App::currentLocale() == 'es' ? 'Ver recetario' : 'View cookbook' }}
                    </button>

                    {{-- Botón secundario: descarga directa --}}
                    <a href="/docs/RECETARIO CALABAZAS MR. LUCKY.pdf"
                        download
                        class="btn-boletin-pdf"
                        title="{{ App::currentLocale() == 'es' ? 'Descargar PDF' : 'Download PDF' }}">
                        <i class="fa fa-download mr-1" aria-hidden="true"></i>
                        PDF
                    </a>
                </div>
            </div>
        </div>
        <hr>

    </div>{{-- /.container --}}
</section>

{{-- ══════════════════════════════════════════════════════════
     MODAL FLIPBOOK — Boletín 14
     Bootstrap 4.5 ya cargado en master.blade.php
     El iframe apunta a la ruta del visor pdf.viewer
══════════════════════════════════════════════════════════ --}}
<div class="modal fade"
    id="modalBoletinFlibook"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modalBoletinFlibookLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered" role="document"
        style="max-width:98vw; margin:1vh auto;">
        <div class="modal-content" style="border:none; border-radius:12px; overflow:hidden; background:#0c0805;">

            {{-- Header mínimo del modal (solo botón cerrar) --}}
            <div style="position:absolute; top:10px; right:10px; z-index:100;">
                <button type="button"
                    data-dismiss="modal"
                    aria-label="{{ App::currentLocale() == 'es' ? 'Cerrar' : 'Close' }}"
                    style="width:34px; height:34px; border-radius:50%; border:1px solid rgba(255,255,255,0.15); background:rgba(0,0,0,0.5); color:#fff; cursor:pointer; display:flex; align-items:center; justify-content:center;">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            {{-- Iframe del visor — ocupa casi toda la pantalla --}}
            <div style="height:94vh; overflow:hidden;">
                <iframe id="boletinViewerFrame"
                    src=""
                    width="100%"
                    height="100%"
                    style="border:none; display:block;"
                    allow="fullscreen"
                    title="{{ App::currentLocale() == 'es' ? 'Visor de Boletín' : 'Newsletter Viewer' }}">
                </iframe>
            </div>

        </div>
    </div>
</div>

@if($preguntas->count())
<section class="section-faq padding bg-gris-claro">
    <div class="container">
        <h3 class="text-center lila pacifico mb-5 editable" data-group="contacto" data-key="preguntas_frecuentesp">{!! trans('contacto.preguntas_frecuentes') !!}</h3>
        <div id="accordion" class="preguntas-frecuentes">

            @foreach($preguntas as $pregunta)
            <div class="card">
                <div class="card-header" id="heading{{ $loop->iteration }}">
                    <h5 class="mb-0">
                        <button class="btn btn-link gris f600" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}">
                            {{ $pregunta->pregunta ?? '' }}
                        </button>
                    </h5>
                </div>
                <div id="collapse{{ $loop->iteration }}" class="collapse {{ ($loop->first) ? 'show' : '' }}" aria-labelledby="heading{{ $loop->iteration }}" data-parent="#accordion">
                    <div class="card-body">
                        {!! $pregunta->respuesta !!}
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endif

@if($blogs->count())
<section class="section-noticias-recientes py-5">
    <div class="container">
        <h3 class="azul-cielo text-center pacifico mb-4 editable" data-group="contacto" data-key="articulos_recientes">{!! trans('contacto.articulos_recientes') !!}</h3>

        <div class="row">

            @foreach($blogs as $blog)
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card shadow h-100 p-2">
                    @if($blog->imagen)
                    <img src="/uploads/{{ $blog->imagen }}" class="img-fluid" loading="lazy" alt="">
                    @endif
                    {{-- <span class="bg-verde text-white text-uppercase f600 d-block px-2 py-0 small">{{ $blog->titulo ?? '' }}</span> --}}
                    @if($blog->fecha)
                    <span class="bg-verde text-white text-uppercase f600 d-block px-2 py-0 small">{{ date('d/m/Y', strtotime($blog->fecha) ) }}</span>
                    @endif

                    <p class="py-2 mb-2">
                        {{-- {!! Str::limit($blog->contenido, 120) !!} --}}
                        {{ $blog->titulo  ?? '' }}
                    </p>
                    <a href="{{ route( App::currentLocale() . '.post', ['slug' => $blog->slug] ) }}" class="btn btn-sm btn-link text-uppercase f600 text-left">
                        {!! trans ('web.leer_mas') !!}
                    </a>
                </div>
            </div>
            @endforeach

        </div>
        <div class="text-center mt-4">
            <a href="{{ route( App::currentLocale() . '.blog') }}" class="btn btn-sm btn-link f600 text-left azul-cielo">
                {!! trans ('web.ver_mas') !!}
            </a>
        </div>
    </div>
</section>
@endif

@if($vacantes->count())
<section class="bg-gris-claro padding">
    <div class="container">

        <h2 class="text-center azul-claro pacifico mb-4">{{ trans('web.nuestras_vacantes') }}</h2>
        <div class="row vacantes">
            @foreach($vacantes as $vacante)
            <div class="col-12 col-md-4 mb-5">
                <a href="{{ route( App::currentLocale() . '.vacante', ['slug' => $vacante->slug] ) }}" class="text-decoration-none">
                    <div class="vacante card p-2 rounded shadow h-100">
                        <img src="/uploads/{{ $vacante->imagen }}" class="img-fluid" alt="{{ $vacante->titulo }}" alt="{{ $vacante->titulo }}" loading="lazy">
                        <div class="px-3 pb-2 bg-verde">
                            <span class="f600 d-block gris text-center text-white m-0 p-2">{{ $vacante->titulo }}</span>
                        </div>
                        <div class="small p-2">
                            {!! Str::limit($vacante->requisitos, 120) !!}
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="text-center mb-3">
            <a href="{{ route( App::currentLocale() . '.vacantes') }}" class="btn btn-sm btn-link f600 text-left azul-cielo">
                {!! trans ('web.ver_mas') !!}
            </a>
        </div>
    </div>
    @endif
    @stop

    @section('customCSS')
    @parent
    <style>
        /* ── Entrada Boletín 14 ─────────────────────────── */
        .boletin-14-entry {
            background: linear-gradient(135deg, #f0f7f0 0%, #e8f0fd 100%);
            border-radius: 10px;
            padding: 16px 20px !important;
            border-left: 4px solid #003ca6;
        }

        /* Botón principal: abrir flipbook */
        .btn-boletin-flipbook {
            display: inline-flex;
            align-items: center;
            padding: 9px 20px;
            background: #003ca6;
            color: #fff;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all .3s ease;
            text-transform: uppercase;
            letter-spacing: .5px;
            box-shadow: 0 3px 12px rgba(0, 60, 166, .25);
        }

        .btn-boletin-flipbook:hover {
            background: #002d80;
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(0, 60, 166, .35);
        }

        /* Botón secundario: descarga PDF */
        .btn-boletin-pdf {
            display: inline-flex;
            align-items: center;
            padding: 9px 16px;
            background: #fff;
            color: #56b276;
            border: 2px solid #56b276;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all .3s ease;
            text-decoration: none !important;
        }

        .btn-boletin-pdf:hover {
            background: #56b276;
            color: #fff;
            transform: translateY(-2px);
        }
    </style>
    @stop

    @section('customJS')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        function recaptchaCallback() {
            $('#btnEnviar').removeAttr('disabled');
        }

        $(function() {

            /*----------  Numeralia  ----------*/
            if ($(".count").length) {
                $('.count').counterUp({
                    delay: 10,
                    time: 1000
                });
            }

        });
    </script>
    <script>
        $(function() {

            /* ── Flipbook Modal — Boletín 14 ──────────────────
               Carga el iframe SOLO al abrir el modal (lazy).
               Al cerrar, limpia el src para liberar memoria.
            ────────────────────────────────────────────────── */
            $('#modalBoletinFlibook').on('show.bs.modal', function(e) {
                var src = $(e.relatedTarget).data('src');
                if (src) {
                    $('#boletinViewerFrame').attr('src', src);
                }
            });

            $('#modalBoletinFlibook').on('hidden.bs.modal', function() {
                // Limpiar iframe al cerrar — libera memoria y detiene PDF.js
                $('#boletinViewerFrame').attr('src', '');
            });

            /* ── reCAPTCHA callback (existente, no tocar) ──── */
            // recaptchaCallback ya declarado arriba en el JS inline de la vista

        });
    </script>
    @stop