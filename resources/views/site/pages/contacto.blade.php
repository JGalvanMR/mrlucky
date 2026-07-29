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

                @if(request('send') == '1')
                <div class="alert alert-success" role="alert" aria-live="polite">
                    {{ App::currentLocale() == 'es'
                            ? '¡Gracias! Tu mensaje fue enviado correctamente.'
                            : 'Thank you! Your message was sent successfully.' }}
                </div>
                @endif

                @if(session('contacto_error'))
                <div class="alert alert-danger" role="alert" aria-live="assertive">
                    {{ App::currentLocale() == 'es'
                            ? 'No fue posible enviar tu mensaje en este momento. Por favor, inténtalo nuevamente más tarde.'
                            : 'We were unable to send your message at this time. Please try again later.' }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger" role="alert" aria-live="assertive">
                    <ul class="mb-0 pl-3">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route(App::currentLocale().'.contacto_enviar') }}" method="post" data-toggle="validator" data-disable="false" data-focus="false">
                    {{ csrf_field() }}
                    <div style="display: none !important;" aria-hidden="true">
                        <input type="text" name="website" id="website" tabindex="-1" autocomplete="off" value="">
                    </div>
                    <!-- <input type="hidden" name="website" value="" /> -->
                    <div class="form-group">
                        {{--
                            SEGURIDAD (requerimiento punto 18/24): el valor de cada <option>
                            ya NO es una dirección de correo. Es una clave interna
                            ("sistemas", "ventas_nacional", etc.) que el backend resuelve
                            contra config/contacto.php. Así el usuario nunca controla el
                            destinatario real del mensaje.
                        --}}
                        <select name="area" class="form-control" data-error="{!! trans('contacto.area_error') !!}" required>
                            <option value="">{!! trans('contacto.area_label') !!}</option>
                            <option value="capital_humano" {{ old('area') == 'capital_humano' ? 'selected' : '' }}>{!! trans('contacto.capitalhumano_label') !!}</option>
                            <option value="calidad" {{ old('area') == 'calidad' ? 'selected' : '' }}>{!! trans('contacto.calidad') !!}</option>
                            <option value="proveedores" {{ old('area') == 'proveedores' ? 'selected' : '' }}>{!! trans('contacto.proveedores') !!}</option>
                            <option value="mantenimiento" {{ old('area') == 'mantenimiento' ? 'selected' : '' }}>{!! trans('contacto.mantenimiento') !!}</option>
                            <option value="mercadotecnia" {{ old('area') == 'mercadotecnia' ? 'selected' : '' }}>{!! trans('contacto.mercadotecnia') !!}</option>
                            <option value="recursos_humanos_2" {{ old('area') == 'recursos_humanos_2' ? 'selected' : '' }}>{!! trans('contacto.capitalhumano_label') !!}</option>
                            <option value="sistemas" {{ old('area') == 'sistemas' ? 'selected' : '' }}>{!! trans('contacto.sistemas') !!}</option>
                            <option value="ventas_exportacion" {{ old('area') == 'ventas_exportacion' ? 'selected' : '' }}>{!! trans('contacto.ventasexportacion') !!}</option>
                            <option value="ventas_nacional" {{ old('area') == 'ventas_nacional' ? 'selected' : '' }}>{!! trans('contacto.ventasnacional') !!}</option>
                        </select>
                        <small class="help-block with-errors"></small>
                        {{-- Copia a: ricardo.cortes@mrlucky.com.mxmusabiaga@mrlucky.com.mxadrian.ortega@mrlucky.com.mx --}}
                    </div>
                    <div class="form-group">
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="{!! trans('contacto.nombre_label') !!}" data-error="{!! trans('contacto.nombre_error') !!}" required>
                        <small class="help-block with-errors"></small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="empresa" class="form-control" value="{{ old('empresa') }}" placeholder="{!! trans('contacto.empresa_label') !!}" data-error="{!! trans('contacto.empresa_error') !!}" required>
                        <small class="help-block with-errors"></small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}" placeholder="{!! trans('contacto.telefono_label') !!}">
                        <small class="help-block with-errors"></small>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="{!! trans('contacto.email_label') !!}" data-error="{!! trans('contacto.correo_error') !!}" data-required-error="{!! trans('contacto.correo_error2') !!}" required>
                        <small class="help-block with-errors"></small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="ciudad" class="form-control" value="{{ old('ciudad') }}" placeholder="{!! trans('contacto.ciudad_label') !!}" data-error="{!! trans('contacto.ciudad_error') !!}" required>
                        <small class="help-block with-errors"></small>
                    </div>
                    <div class="form-group">
                        <textarea name="comentarios" rows="5" class="form-control" placeholder="{!! trans('contacto.comentarios_label') !!}" data-error="{!! trans('contacto.comentario_error') !!}" required>{{ old('comentarios') }}</textarea>
                        <small class="help-block with-errors"></small>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LezXjArAAAAALY_fO3Kc5EV6oN0zqx8GigB66Tu"></div>
                        <!-- <div class="g-recaptcha" data-callback="recaptchacallback" data-sitekey="6lenp2mtaaaaaiqom3adw0ieyyxpmkljrdlxx8j_"></div> -->
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

        {{-- ── HEB ────────────────────────────────── --}}
        <div class="boletin-14-entry py-3">

            {{-- Encabezado de la entrada --}}
            <div class="d-flex align-items-start justify-content-between flex-wrap" style="gap:12px;">
                <div class="d-flex align-items-center">
                    <img src="/site/img/icon-descarga.png" class="img-fluid mr-3" width="30" alt="">
                    <div>
                        <div class="azul-marino h5 f600 mb-0">
                            {{ App::currentLocale() == 'es'
                                ? 'PASAPORTE PARA LA EXPO · H-E-B · 2026'
                                : 'PASSPORT TO PRODUCE · H-E-B · 2026' }}
                        </div>
                        <small class="gris">
                            {{ App::currentLocale() == 'es'
                                ? 'Catalogo de Productos digital interactivo · Navega página por página'
                                : 'Interactive Digital Product Catalog · Browse page by page' }}
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
                        data-src="{{ route( App::currentLocale() . '.boletin', ['slug' => 'heb'] ) }}"
                        aria-label="{{ App::currentLocale() == 'es' ? 'Ver como revista digital' : 'View as digital magazine' }}">
                        <i class="fa fa-book mr-1 text-white" aria-hidden="true"></i>
                        {{ App::currentLocale() == 'es' ? 'Ver catalogo' : 'View Catalog' }}
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
                        <i class="fa fa-book mr-1 text-white" aria-hidden="true"></i>
                        {{ App::currentLocale() == 'es' ? 'Ver catalogo' : 'View catalog' }}
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
                                ? 'Reporte digital interactivo · Navega página por página'
                                : 'Interactive digital report · Browse page by page' }}
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
                        aria-label="{{ App::currentLocale() == 'es' ? 'Ver Sustentabilidad como reporte digital' : 'View Sustainability as digital report' }}">
                        <i class="fa fa-book mr-1 text-white" aria-hidden="true"></i>
                        {{ App::currentLocale() == 'es' ? 'Ver reporte' : 'View report' }}
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
                        <i class="fa fa-book mr-1 text-white" aria-hidden="true"></i>
                        {{ App::currentLocale() == 'es' ? 'Ver boletin' : 'View magazine' }}
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
                        <i class="fa fa-book mr-1 text-white" aria-hidden="true"></i>
                        {{ App::currentLocale() == 'es' ? 'Ver boletín' : 'View newsletter' }}
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
                        <i class="fa fa-book mr-1 text-white" aria-hidden="true"></i>
                        {{ App::currentLocale() == 'es' ? 'Ver recetario' : 'View cookbook' }}
                    </button>

                    {{-- Botón secundario: descarga directa --}}
                    <a href="/docs/RECETARIO%20CALABAZAS%20MR.%20LUCKY.pdf"
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
                        <img src="/uploads/{{ $vacante->imagen }}" class="img-fluid" alt="{{ $vacante->titulo }}" loading="lazy">
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
</section> {{-- Añadida la etiqueta de cierre --}}
@endif
@stop

@section('customCSS')
@parent
<style>
    /* ══ SECCIÓN DESCARGABLES ══════════════════════════ */
    .section-descargables {
        background: #fff;
    }

    /* Grid adaptativo: 1 col mobile → 2 col tablet → 3 col desktop */
    .descargables-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    @media (min-width: 576px) {
        .descargables-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 992px) {
        .descargables-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* ── Tarjeta base ── */
    .desc-card {
        position: relative;
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 14px;
        box-shadow: 0 2px 12px rgba(0, 60, 166, 0.06);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .desc-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 28px rgba(0, 60, 166, 0.13);
    }

    /* Boletines tienen borde izquierdo azul */
    .desc-card--boletin {
        border-left: 4px solid #003ca6;
    }

    /* Boletín destacado (último/más nuevo) */
    .desc-card--nuevo {
        border-color: #56b276;
        border-left-color: #56b276;
        background: linear-gradient(135deg, #f0f7f2 0%, #ffffff 100%);
    }

    /* Badge "¡Nuevo!" */
    .desc-card-nuevo-badge {
        position: absolute;
        top: -1px;
        right: 16px;
        background: #56b276;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 3px 10px;
        border-radius: 0 0 8px 8px;
    }

    /* ── Ícono ── */
    .desc-card-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .desc-card-icon .fa {
        font-size: 20px;
        color: #fff;
    }

    /* ── Cuerpo de la tarjeta ── */
    .desc-card-body {
        flex: 1;
    }

    .desc-card-badge {
        display: inline-block;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 2px 8px;
        border-radius: 20px;
        margin-bottom: 6px;
    }

    .desc-badge-catalogo {
        background: #e3f0ff;
        color: #003ca6;
    }

    .desc-badge-reporte {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .desc-badge-boletin {
        background: #e3f0ff;
        color: #003ca6;
    }

    .desc-badge-receta {
        background: #fff8e1;
        color: #e65100;
    }

    .desc-card-title {
        font-size: 14px;
        font-weight: 600;
        line-height: 1.4;
        margin: 0 0 2px;
        color: #003ca6;
    }

    .desc-card-sub {
        font-size: 11px;
        color: #7c8ba0;
        margin: 0;
    }

    /* ── Acciones ── */
    .desc-card-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    /* Botón base */
    .desc-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 7px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s ease;
        text-decoration: none !important;
        border: 2px solid transparent;
        white-space: nowrap;
        font-family: 'Roboto', sans-serif;
    }

    /* Ver revista (principal) */
    .desc-btn-flipbook {
        background: #003ca6;
        color: #fff !important;
        border-color: #003ca6;
        box-shadow: 0 3px 10px rgba(0, 60, 166, 0.25);
    }

    .desc-btn-flipbook:hover {
        background: #002d80;
        border-color: #002d80;
        transform: translateY(-1px);
        box-shadow: 0 5px 16px rgba(0, 60, 166, 0.35);
        color: #fff !important;
    }

    /* Descargar PDF (secundario) */
    .desc-btn-pdf {
        background: #fff;
        color: #56b276 !important;
        border-color: #56b276;
    }

    .desc-btn-pdf:hover {
        background: #56b276;
        color: #fff !important;
        transform: translateY(-1px);
    }

    /* Solo descargar (sin flipbook) */
    .desc-btn-download {
        background: #f5f5f5;
        color: #003ca6 !important;
        border-color: #e1e1e1;
    }

    .desc-btn-download:hover {
        background: #003ca6;
        color: #fff !important;
        border-color: #003ca6;
    }

    /* ── Modal flipbook ── */
    .modal-flipbook-content {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        background: #0c0805;
        position: relative;
    }

    .modal-flipbook-close {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 200;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(0, 0, 0, 0.6);
        color: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: background 0.2s;
        backdrop-filter: blur(4px);
    }

    .modal-flipbook-close:hover {
        background: rgba(219, 6, 50, 0.85);
        border-color: rgba(219, 6, 50, 0.5);
    }

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
