@section('title', App::currentLocale() == 'es' ? 'Solicitar descarga de certificado' : 'Request certificate download')
@extends('site.layouts.master')
@php
$active = 'certificaciones';
$esGeneral = isset($slugGeneral);
$nombreMostrado = $esGeneral ? $nombreCertificado : ($certificacion->rancho->nombre . ' - ' . $certificacion->tipoCertificacion->nombre);
$idOculto = $esGeneral ? $slugGeneral : $certificacion->id;

if ($esGeneral) {
$rutaEnvio = App::currentLocale() == 'en'
? route('en.certificaciones.solicitar_descarga_general.enviar', $slugGeneral)
: route('certificaciones.solicitar_descarga_general.enviar', $slugGeneral);
} else {
$rutaEnvio = App::currentLocale() == 'en'
? route('en.certificaciones.solicitar_descarga.enviar', $certificacion->id)
: route('certificaciones.solicitar_descarga.enviar', $certificacion->id);
}
@endphp

@section('page')

{{-- ═══════════════════════════════════════════════════════════════════
     HERO + FORMULARIO — DISPOSICIÓN HORIZONTAL (máximo aprovechamiento)
     ═══════════════════════════════════════════════════════════════════ --}}
<section class="cert-main cert-main--split bg-gris-claro">
    <div class="container-fluid px-lg-4">

        <div class="row align-items-stretch g-0 g-lg-3">

            {{-- Columna izquierda: HERO (más estrecha) --}}
            <div class="col-lg-4 mb-3 mb-lg-0 d-flex">
                <div class="cert-hero-side">
                    <div class="cert-hero-side-bg" aria-hidden="true">
                        <div class="cert-hero-shape cert-hero-shape--1"></div>
                        <div class="cert-hero-shape cert-hero-shape--2"></div>
                        <div class="cert-hero-shape cert-hero-shape--3"></div>
                    </div>
                    <div class="cert-hero-side-content">
                        <span class="cert-hero-eyebrow">
                            <i class="fa fa-download" aria-hidden="true"></i>
                            {{ App::currentLocale() == 'es' ? 'Descarga de Documentos' : 'Document Download' }}
                        </span>
                        <h1 class="cert-hero-title azul-marino">
                            @if(App::currentLocale() == 'es')
                            Solicitar <span class="cert-hero-title-script">Certificado</span>
                            @else
                            Request <span class="cert-hero-title-script">Certificate</span>
                            @endif
                        </h1>
                        <div class="cert-hero-divider">
                            <span></span>
                            <i class="fa fa-certificate" aria-hidden="true"></i>
                            <span></span>
                        </div>
                        <p class="cert-hero-subtitle gris">
                            {{ App::currentLocale() == 'es'
                                ? 'Complete el formulario para solicitar la descarga del certificado.'
                                : 'Fill in the form to request the certificate download.' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Columna derecha: FORMULARIO (más ancha) --}}
            <div class="col-lg-8 d-flex">

                <div class="cert-form-wrapper w-100">

                    {{-- Tarjeta de certificado seleccionado --}}
                    <div class="cert-form-target bg-white shadow-sm rounded mb-2">
                        <div class="cert-form-target-inner">
                            <div class="cert-form-target-icon">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            </div>
                            <div class="cert-form-target-info">
                                <span class="cert-form-target-label">
                                    {{ App::currentLocale() == 'es' ? 'Certificado seleccionado' : 'Selected certificate' }}
                                </span>
                                <strong class="cert-form-target-name">{{ $nombreMostrado }}</strong>
                            </div>
                            <span class="cert-form-target-badge">
                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                                {{ App::currentLocale() == 'es' ? 'Vigente' : 'Valid' }}
                            </span>
                        </div>
                    </div>

                    {{-- Alertas de estado --}}
                    @if(session('certificado_solicitud_enviada'))
                    <div class="cert-alert cert-alert--success" role="alert" aria-live="polite">
                        <div class="cert-alert-icon">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </div>
                        <div class="cert-alert-body">
                            <strong>{{ App::currentLocale() == 'es' ? 'Solicitud enviada correctamente.' : 'Request sent successfully.' }}</strong>
                            <p class="mb-0">
                                {{ App::currentLocale() == 'es'
                                    ? 'Hemos recibido su solicitud. Revisaremos la información y daremos seguimiento.'
                                    : 'We have received your request. We will review the information and follow up.' }}
                            </p>
                        </div>
                    </div>
                    @endif

                    @if(session('certificado_error'))
                    <div class="cert-alert cert-alert--error" role="alert" aria-live="assertive">
                        <div class="cert-alert-icon">
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                        </div>
                        <div class="cert-alert-body">
                            <strong>{{ App::currentLocale() == 'es' ? 'Error al enviar' : 'Sending error' }}</strong>
                            <p class="mb-0">
                                {{ App::currentLocale() == 'es'
                                    ? 'No fue posible enviar su solicitud. Inténtelo nuevamente más tarde.'
                                    : 'Unable to send your request. Please try again later.' }}
                            </p>
                        </div>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="cert-alert cert-alert--error" role="alert" aria-live="assertive">
                        <div class="cert-alert-icon">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        </div>
                        <div class="cert-alert-body">
                            <strong>{{ App::currentLocale() == 'es' ? 'Por favor corrija los siguientes errores:' : 'Please correct the following errors:' }}</strong>
                            <ul class="mb-0 pl-3 mt-1">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    {{-- Formulario --}}
                    <div class="cert-form-card bg-white shadow-sm rounded">
                        <div class="cert-form-card-header">
                            <span class="cert-form-card-eyebrow">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                {{ App::currentLocale() == 'es' ? 'Formulario de solicitud' : 'Request form' }}
                            </span>
                            <h2 class="cert-form-card-title">
                                {{ App::currentLocale() == 'es' ? 'Datos de la solicitud' : 'Request details' }}
                            </h2>
                            <div class="cert-form-card-divider">
                                <span></span>
                                <i class="fa fa-certificate" aria-hidden="true"></i>
                                <span></span>
                            </div>
                            <p class="cert-form-card-subtitle gris">
                                {{ App::currentLocale() == 'es' ? 'Los campos marcados con * son obligatorios.' : 'Fields marked with * are required.' }}
                            </p>
                        </div>

                        <div class="cert-form-card-body">
                            <form method="POST" action="{{ $rutaEnvio }}" data-analytics-event-submit="certificate_request_submit" id="formSolicitudCertificado" novalidate>
                                @csrf
                                {{-- Honeypot --}}
                                <div style="display: none !important;" aria-hidden="true">
                                    <input type="text" name="website" id="website" tabindex="-1" autocomplete="off" value="">
                                </div>

                                <input type="hidden" name="certificado_id" value="{{ $idOculto }}">
                                <input type="hidden" name="certificado_nombre" value="{{ $nombreMostrado }}">

                                <div class="cert-form-row">
                                    <div class="cert-form-group cert-form-group--half">
                                        <label for="nombre" class="cert-form-label">
                                            {{ App::currentLocale() == 'es' ? 'Nombre' : 'Name' }} *
                                        </label>
                                        <div class="cert-form-input-wrap">
                                            <i class="fa fa-user cert-form-input-icon" aria-hidden="true"></i>
                                            <input type="text" id="nombre" name="nombre" class="cert-form-input @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required maxlength="150" placeholder="{{ App::currentLocale() == 'es' ? 'Su nombre completo' : 'Your full name' }}">
                                        </div>
                                        @error('nombre')
                                        <span class="cert-form-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="cert-form-group cert-form-group--half">
                                        <label for="puesto" class="cert-form-label">
                                            {{ App::currentLocale() == 'es' ? 'Puesto' : 'Job title' }} *
                                        </label>
                                        <div class="cert-form-input-wrap">
                                            <i class="fa fa-briefcase cert-form-input-icon" aria-hidden="true"></i>
                                            <input type="text" id="puesto" name="puesto" class="cert-form-input @error('puesto') is-invalid @enderror" value="{{ old('puesto') }}" required maxlength="150" placeholder="{{ App::currentLocale() == 'es' ? 'Su puesto o cargo' : 'Your job title' }}">
                                        </div>
                                        @error('puesto')
                                        <span class="cert-form-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="cert-form-row">
                                    <div class="cert-form-group cert-form-group--half">
                                        <label for="empresa" class="cert-form-label">
                                            {{ App::currentLocale() == 'es' ? 'Empresa' : 'Company' }} *
                                        </label>
                                        <div class="cert-form-input-wrap">
                                            <i class="fa fa-building cert-form-input-icon" aria-hidden="true"></i>
                                            <input type="text" id="empresa" name="empresa" class="cert-form-input @error('empresa') is-invalid @enderror" value="{{ old('empresa') }}" required maxlength="150" placeholder="{{ App::currentLocale() == 'es' ? 'Nombre de la empresa' : 'Company name' }}">
                                        </div>
                                        @error('empresa')
                                        <span class="cert-form-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="cert-form-group cert-form-group--half">
                                        <label for="correo" class="cert-form-label">
                                            {{ App::currentLocale() == 'es' ? 'Correo electrónico' : 'Email' }} *
                                        </label>
                                        <div class="cert-form-input-wrap">
                                            <i class="fa fa-envelope cert-form-input-icon" aria-hidden="true"></i>
                                            <input type="email" id="correo" name="correo" class="cert-form-input @error('correo') is-invalid @enderror" value="{{ old('correo') }}" required maxlength="150" placeholder="email@ejemplo.com">
                                        </div>
                                        @error('correo')
                                        <span class="cert-form-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="cert-form-row">
                                    <div class="cert-form-group cert-form-group--half">
                                        <label for="telefono" class="cert-form-label">
                                            {{ App::currentLocale() == 'es' ? 'Teléfono' : 'Phone' }} *
                                        </label>
                                        <div class="cert-form-input-wrap">
                                            <i class="fa fa-phone cert-form-input-icon" aria-hidden="true"></i>
                                            <input type="tel" id="telefono" name="telefono" class="cert-form-input @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" required maxlength="30" placeholder="+1 (555) 000-0000">
                                        </div>
                                        @error('telefono')
                                        <span class="cert-form-error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="cert-form-group cert-form-group--half">
                                        <label for="contacto_gab" class="cert-form-label">
                                            {{ App::currentLocale() == 'es' ? 'Contacto en GAB' : 'GAB contact' }} *
                                        </label>
                                        <div class="cert-form-input-wrap">
                                            <i class="fa fa-handshake-o cert-form-input-icon" aria-hidden="true"></i>
                                            <input type="text" id="contacto_gab" name="contacto_gab" class="cert-form-input @error('contacto_gab') is-invalid @enderror" value="{{ old('contacto_gab') }}" required maxlength="150" placeholder="{{ App::currentLocale() == 'es' ? 'Persona de contacto en GAB' : 'Your GAB contact person' }}">
                                        </div>
                                        @error('contacto_gab')
                                        <span class="cert-form-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="cert-form-group">
                                    <label for="uso" class="cert-form-label">
                                        {{ App::currentLocale() == 'es' ? 'Uso previsto' : 'Intended use' }} *
                                        <small class="cert-form-hint">
                                            {{ App::currentLocale() == 'es'
                                                ? 'Describa brevemente el uso que dará al certificado.'
                                                : 'Briefly describe the intended use.' }}
                                        </small>
                                    </label>
                                    <div class="cert-form-input-wrap cert-form-input-wrap--textarea">
                                        <i class="fa fa-commenting-o cert-form-input-icon cert-form-input-icon--textarea" aria-hidden="true"></i>
                                        <textarea id="uso" name="uso" class="cert-form-input cert-form-input--textarea @error('uso') is-invalid @enderror" rows="3" required maxlength="{{ config('certificaciones.uso_max_length', 500) }}" placeholder="{{ App::currentLocale() == 'es' ? 'Ej: Auditoría de cliente, registro sanitario, licitación...' : 'E.g. Customer audit, sanitary registration, tender...' }}">{{ old('uso') }}</textarea>
                                    </div>
                                    <div class="cert-form-char-count">
                                        <span id="usoContador">0</span> / {{ config('certificaciones.uso_max_length', 500) }}
                                    </div>
                                    @error('uso')
                                    <span class="cert-form-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Aviso de privacidad --}}
                                <div class="cert-form-privacy text-center">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                    {{ App::currentLocale() == 'es'
                                        ? 'Sus datos serán tratados con confidencialidad y solo se usarán para gestionar su solicitud.'
                                        : 'Your data will be treated confidentially and used only to manage your request.' }}
                                </div>

                                <button type="submit" class="cert-btn-submit" id="btnEnviarSolicitud">
                                    <i class="fa fa-paper-plane" aria-hidden="true" style="color: #ffffff"></i>
                                    <span style="color: #ffffff">{{ App::currentLocale() == 'es' ? 'Enviar solicitud' : 'Submit request' }}</span>
                                    <i class="fa fa-spinner fa-spin cert-btn-spinner" aria-hidden="true" style="display:none; color: #ffffff"></i>
                                </button>
                            </form>
                        </div>
                    </div>{{-- /.cert-form-card --}}

                    {{-- Enlace de retorno --}}
                    <div class="cert-form-back text-center mt-2">
                        <a href="{{ route(App::currentLocale() . '.certificaciones') }}" class="cert-form-back-link">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            {{ App::currentLocale() == 'es' ? 'Volver a certificaciones' : 'Back to certifications' }}
                        </a>
                    </div>

                </div>{{-- /.cert-form-wrapper --}}

            </div>{{-- /.col --}}

        </div>{{-- /.row --}}

    </div>{{-- /.container-fluid --}}
</section>

@endsection

@section('customCSS')
@parent
<style>
    /* ═══════════════════════════════════════════════════════════════════
       TOKENS (heredados)
       ═══════════════════════════════════════════════════════════════════ */
    :root {
        --cert-azul: #003CA6;
        --cert-azul-dark: #002d80;
        --cert-azul-soft: rgba(0, 60, 166, 0.08);
        --cert-rojo: #ED0013;
        --cert-rojo-dark: #c90010;
        --cert-vigente: #00833E;
        --cert-bg-light: #F4F7FB;
        --cert-bg-lighter: #FAFBFD;
        --cert-border: #E6ECF5;
        --cert-border-strong: #D4DEEB;
        --cert-texto: #2C3E50;
        --cert-texto-muted: #6B7785;
        --cert-texto-light: #98A2B3;
        --cert-white: #FFFFFF;
        --cert-font: 'Roboto', sans-serif;
        --cert-font-script: 'Pacifico', cursive;
        --cert-fz-body: 0.875rem;
        --cert-fz-small: 0.75rem;
    }

    /* ═══════════════════════════════════════════════════════════════════
       CONTENEDOR PRINCIPAL (mínimo padding)
       ═══════════════════════════════════════════════════════════════════ */
    .cert-main--split {
        padding-top: 20px;
        padding-bottom: 30px;
    }

    /* ═══════════════════════════════════════════════════════════════════
       HERO LATERAL (columna izquierda) — compacto
       ═══════════════════════════════════════════════════════════════════ */
    .cert-hero-side {
        position: relative;
        background: linear-gradient(180deg, var(--cert-white) 0%, var(--cert-bg-light) 60%, #EDF2F9 100%);
        border-radius: 10px;
        padding: 20px 18px;
        overflow: hidden;
        border: 1px solid var(--cert-border);
        width: 100%;
        display: flex;
        align-items: center;
    }

    .cert-hero-side-bg {
        position: absolute;
        inset: 0;
        pointer-events: none;
        z-index: 0;
    }

    .cert-hero-side-bg .cert-hero-shape {
        position: absolute;
        border-radius: 50%;
        opacity: .08;
    }

    .cert-hero-side-bg .cert-hero-shape--1 {
        width: 140px;
        height: 140px;
        background: var(--cert-azul);
        top: -50px;
        left: -50px;
    }

    .cert-hero-side-bg .cert-hero-shape--2 {
        width: 100px;
        height: 100px;
        background: var(--cert-azul);
        bottom: -30px;
        right: -20px;
    }

    .cert-hero-side-bg .cert-hero-shape--3 {
        width: 70px;
        height: 70px;
        background: var(--cert-rojo);
        top: 40%;
        right: 5%;
        opacity: .05;
    }

    .cert-hero-side-content {
        position: relative;
        z-index: 1;
        width: 100%;
    }

    .cert-hero-side .cert-hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--cert-azul-soft);
        color: var(--cert-azul);
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
        font-family: var(--cert-font);
    }

    .cert-hero-side .cert-hero-eyebrow i {
        color: var(--cert-rojo);
    }

    .cert-hero-side .cert-hero-title {
        font-size: 1.4rem;
        font-weight: 700;
        line-height: 1.1;
        margin: 0 0 6px;
        letter-spacing: -0.3px;
        font-family: var(--cert-font);
    }

    .cert-hero-side .cert-hero-title-script {
        font-family: var(--cert-font-script);
        font-weight: 400;
        font-size: 1.7rem;
        color: var(--cert-azul);
        display: inline-block;
        line-height: 1;
    }

    .cert-hero-side .cert-hero-divider {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 8px 0 10px;
    }

    .cert-hero-side .cert-hero-divider span {
        display: inline-block;
        width: 30px;
        height: 2px;
        background: var(--cert-azul);
        opacity: .30;
    }

    .cert-hero-side .cert-hero-divider i {
        color: var(--cert-rojo);
        font-size: 14px;
    }

    .cert-hero-side .cert-hero-subtitle {
        font-size: 0.8rem;
        line-height: 1.4;
        color: var(--cert-texto-muted);
        margin: 0;
    }

    /* ═══════════════════════════════════════════════════════════════════
       FORMULARIO (columna derecha) — compacto
       ═══════════════════════════════════════════════════════════════════ */
    .cert-form-wrapper {
        display: flex;
        flex-direction: column;
    }

    /* TARJETA DE CERTIFICADO SELECCIONADO */
    .cert-form-target {
        border: 1px solid var(--cert-border);
        overflow: hidden;
        position: relative;
        transition: box-shadow .25s ease;
    }

    .cert-form-target::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--cert-azul) 0%, var(--cert-rojo) 100%);
    }

    .cert-form-target-inner {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        flex-wrap: wrap;
    }

    .cert-form-target-icon {
        width: 38px;
        height: 38px;
        background: var(--cert-azul-soft);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cert-form-target-icon i {
        font-size: 18px;
        color: var(--cert-azul);
    }

    .cert-form-target-info {
        flex: 1;
        min-width: 120px;
    }

    .cert-form-target-label {
        display: block;
        font-size: 9px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        color: var(--cert-texto-light);
        margin-bottom: 1px;
    }

    .cert-form-target-name {
        display: block;
        font-size: 0.9rem;
        color: var(--cert-azul);
        font-weight: 700;
        line-height: 1.2;
    }

    .cert-form-target-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--cert-vigente);
        color: #fff;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 3px 10px;
        border-radius: 30px;
        white-space: nowrap;
        box-shadow: 0 2px 6px rgba(0, 131, 62, 0.2);
    }

    /* ALERTAS */
    .cert-alert {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 8px;
        margin-bottom: 12px;
        border: 1px solid transparent;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        animation: certFadeIn .4s ease both;
    }

    .cert-alert--success {
        background: #E6F4EC;
        border-color: #C3E6D3;
        color: #0f5132;
    }

    .cert-alert--error {
        background: #FBE9E9;
        border-color: #F5C2C7;
        color: #842029;
    }

    .cert-alert-icon {
        flex-shrink: 0;
        font-size: 16px;
        line-height: 1;
        margin-top: 1px;
    }

    .cert-alert--success .cert-alert-icon {
        color: var(--cert-vigente);
    }

    .cert-alert--error .cert-alert-icon {
        color: var(--cert-rojo);
    }

    .cert-alert-body strong {
        display: block;
        font-size: 0.8rem;
        margin-bottom: 2px;
        font-weight: 700;
    }

    .cert-alert-body p,
    .cert-alert-body ul {
        font-size: 0.75rem;
        line-height: 1.4;
        margin: 0;
    }

    .cert-alert-body ul li {
        margin-bottom: 1px;
    }

    /* TARJETA DEL FORMULARIO */
    .cert-form-card {
        border: 1px solid var(--cert-border);
        overflow: hidden;
    }

    .cert-form-card-header {
        padding: 14px 20px 2px;
        text-align: center;
    }

    .cert-form-card-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: var(--cert-azul-soft);
        color: var(--cert-azul);
        padding: 3px 12px;
        border-radius: 30px;
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }

    .cert-form-card-eyebrow i {
        color: var(--cert-rojo);
    }

    .cert-form-card-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--cert-azul);
        margin: 0 0 3px;
    }

    .cert-form-card-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin: 6px 0 4px;
    }

    .cert-form-card-divider span {
        display: inline-block;
        width: 28px;
        height: 2px;
        background: var(--cert-azul);
        opacity: .25;
    }

    .cert-form-card-divider i {
        color: var(--cert-rojo);
        font-size: 12px;
    }

    .cert-form-card-subtitle {
        font-size: 0.7rem;
        color: var(--cert-texto-muted);
        margin: 0;
    }

    .cert-form-card-body {
        padding: 12px 20px 18px;
    }

    /* CAMPOS */
    .cert-form-row {
        display: flex;
        gap: 14px;
        margin-bottom: 0;
    }

    .cert-form-group {
        margin-bottom: 12px;
        flex: 1;
    }

    .cert-form-group--half {
        flex: 1 1 0;
        min-width: 0;
    }

    .cert-form-label {
        display: block;
        font-size: 0.65rem;
        font-weight: 600;
        color: var(--cert-texto);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .cert-form-hint {
        display: block;
        font-size: 0.65rem;
        font-weight: 400;
        text-transform: none;
        letter-spacing: 0;
        color: var(--cert-texto-light);
        margin-top: 1px;
    }

    .cert-form-input-wrap {
        position: relative;
    }

    .cert-form-input-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--cert-texto-light);
        font-size: 13px;
        pointer-events: none;
        transition: color .2s ease;
    }

    .cert-form-input-icon--textarea {
        top: 10px;
        transform: none;
    }

    .cert-form-input {
        width: 100%;
        height: 38px;
        padding: 0 10px 0 34px;
        border: 1.5px solid var(--cert-border);
        border-radius: 6px;
        background: var(--cert-white);
        color: var(--cert-texto);
        font-size: 0.8rem;
        font-family: var(--cert-font);
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
        outline: none;
    }

    .cert-form-input::placeholder {
        color: #B0B8C4;
        font-size: 0.75rem;
    }

    .cert-form-input:hover {
        border-color: var(--cert-border-strong);
    }

    .cert-form-input:focus {
        border-color: var(--cert-azul);
        box-shadow: 0 0 0 3px rgba(0, 60, 166, 0.08);
        background: var(--cert-white);
    }

    .cert-form-input:focus+.cert-form-input-icon,
    .cert-form-input-wrap:focus-within .cert-form-input-icon {
        color: var(--cert-azul);
    }

    .cert-form-input.is-invalid {
        border-color: var(--cert-rojo);
        box-shadow: 0 0 0 3px rgba(237, 0, 19, 0.08);
    }

    .cert-form-input--textarea {
        height: auto;
        padding: 8px 10px 8px 34px;
        resize: vertical;
        min-height: 65px;
    }

    .cert-form-char-count {
        text-align: right;
        font-size: 0.6rem;
        color: var(--cert-texto-light);
        margin-top: 3px;
        font-weight: 500;
    }

    .cert-form-error {
        display: block;
        font-size: 0.65rem;
        color: var(--cert-rojo);
        margin-top: 2px;
        font-weight: 500;
    }

    @media (max-width: 767px) {
        .cert-form-row {
            flex-direction: column;
            gap: 0;
        }
    }

    /* PRIVACIDAD */
    .cert-form-privacy {
        font-size: 0.7rem;
        color: var(--cert-texto-muted);
        padding: 6px 0 10px;
        border-top: 1px solid var(--cert-border);
        margin-top: 2px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .cert-form-privacy i {
        color: var(--cert-azul);
        font-size: 13px;
    }

    /* BOTÓN ENVIAR (compacto) */
    .cert-btn-submit {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        width: 100%;
        padding: 10px 16px;
        background: linear-gradient(135deg, var(--cert-azul) 0%, var(--cert-azul-dark) 100%);
        color: #fff !important;
        border: none;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        font-family: var(--cert-font);
        cursor: pointer;
        transition: transform .2s ease, box-shadow .25s ease, filter .2s ease;
        box-shadow: 0 3px 10px rgba(0, 60, 166, 0.25);
        position: relative;
        overflow: hidden;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
    }

    .cert-btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.12), transparent);
        transition: left .5s ease;
    }

    .cert-btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(0, 60, 166, 0.35);
        filter: brightness(1.05);
    }

    .cert-btn-submit:hover::before {
        left: 100%;
    }

    .cert-btn-submit:disabled {
        background: var(--cert-texto-light);
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
        filter: none !important;
        text-shadow: none;
    }

    .cert-btn-submit:disabled::before {
        display: none;
    }

    .cert-btn-spinner {
        font-size: 12px;
    }

    /* ENLACE DE RETORNO (compacto) */
    .cert-form-back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--cert-white);
        color: var(--cert-azul);
        font-size: 0.7rem;
        font-weight: 600;
        padding: 6px 18px;
        border-radius: 30px;
        border: 1.5px solid var(--cert-border);
        text-decoration: none;
        transition: background .2s ease, border-color .2s ease, box-shadow .2s ease;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.02);
    }

    .cert-form-back-link:hover {
        background: var(--cert-azul-soft);
        border-color: var(--cert-azul);
        text-decoration: none;
        box-shadow: 0 3px 10px rgba(0, 60, 166, 0.06);
    }

    /* ANIMACIONES */
    @keyframes certFadeIn {
        from {
            opacity: 0;
            transform: translateY(-6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (prefers-reduced-motion: no-preference) {

        .cert-form-target,
        .cert-form-card {
            animation: certFadeIn .4s ease both;
        }

        .cert-form-target {
            animation-delay: .05s;
        }

        .cert-form-card {
            animation-delay: .1s;
        }
    }

    /* ═══════════════════════════════════════════════════════════════════
       RESPONSIVE
       ═══════════════════════════════════════════════════════════════════ */
    @media (max-width: 991px) {
        .cert-main--split {
            padding-top: 15px;
            padding-bottom: 20px;
        }

        .cert-hero-side {
            padding: 16px 16px;
        }

        .cert-hero-side .cert-hero-title {
            font-size: 1.2rem;
        }

        .cert-hero-side .cert-hero-title-script {
            font-size: 1.4rem;
        }

        .cert-hero-side .cert-hero-divider span {
            width: 24px;
        }

        .cert-hero-side .cert-hero-subtitle {
            font-size: 0.75rem;
        }
    }

    @media (max-width: 575px) {
        .cert-form-target-inner {
            padding: 10px 14px;
            flex-direction: column;
            align-items: flex-start;
        }

        .cert-form-target-icon {
            width: 34px;
            height: 34px;
        }

        .cert-form-target-icon i {
            font-size: 16px;
        }

        .cert-form-target-badge {
            align-self: flex-start;
        }

        .cert-form-card-header {
            padding: 12px 14px 2px;
        }

        .cert-form-card-body {
            padding: 10px 14px 16px;
        }

        .cert-hero-side .cert-hero-title {
            font-size: 1.1rem;
        }

        .cert-hero-side .cert-hero-title-script {
            font-size: 1.3rem;
        }

        .cert-main--split {
            padding-top: 10px;
            padding-bottom: 15px;
        }
    }
</style>
@stop

@section('customJS')
@parent
<script>
    (function() {
        var form = document.getElementById('formSolicitudCertificado');
        var btn = document.getElementById('btnEnviarSolicitud');
        var btnText = btn.querySelector('span');
        var btnSpinner = btn.querySelector('.cert-btn-spinner');
        var uso = document.getElementById('uso');
        var contador = document.getElementById('usoContador');
        var maxLength = parseInt(uso.getAttribute('maxlength'), 10) || 500;

        form?.addEventListener('submit', function(e) {
            if (btn.disabled) {
                e.preventDefault();
                return;
            }
            btn.disabled = true;
            btnText.textContent = '{{ App::currentLocale() == "es" ? "Enviando..." : "Sending..." }}';
            btnSpinner.style.display = 'inline-block';
        });

        function actualizarContador() {
            var len = uso.value.length;
            contador.textContent = len;
            if (len >= maxLength) {
                contador.style.color = 'var(--cert-rojo)';
            } else if (len > maxLength * 0.85) {
                contador.style.color = 'var(--cert-proximo, #E65100)';
            } else {
                contador.style.color = '';
            }
        }

        if (uso && contador) {
            uso.addEventListener('input', actualizarContador);
            actualizarContador();
        }
    })();
</script>
@endsection