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
     HERO / BANNER DEL FORMULARIO
     ═══════════════════════════════════════════════════════════════════ --}}
<section class="cert-hero cert-hero--compact">
    <div class="cert-hero-bg" aria-hidden="true">
        <div class="cert-hero-shape cert-hero-shape--1"></div>
        <div class="cert-hero-shape cert-hero-shape--2"></div>
        <div class="cert-hero-shape cert-hero-shape--3"></div>
    </div>
    <div class="container position-relative">
        <div class="cert-hero-content text-center">
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
                    ? 'Complete el siguiente formulario para solicitar la descarga del certificado seleccionado. Nuestro equipo revisará su solicitud.'
                    : 'Please complete the form below to request the download of the selected certificate. Our team will review your request.' }}
            </p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════
     FORMULARIO DE SOLICITUD
     ═══════════════════════════════════════════════════════════════════ --}}
<section class="padding bg-gris-claro cert-main">
    <div class="container" style="max-width: 720px;">

        {{-- Tarjeta de certificado seleccionado --}}
        <div class="cert-form-target bg-white shadow rounded mb-4">
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
                        ? 'Hemos recibido su solicitud de descarga. Nuestro equipo revisará la información proporcionada y dará seguimiento a su solicitud.'
                        : 'We have received your download request. Our team will review the information provided and follow up.' }}
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
                        ? 'No fue posible enviar su solicitud en este momento. Por favor, inténtelo nuevamente más tarde.'
                        : 'We were unable to send your request at this time. Please try again later.' }}
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
                <ul class="mb-0 pl-3 mt-2">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- Formulario --}}
        <div class="cert-form-card bg-white shadow rounded">
            <div class="cert-form-card-header">
                <h2 class="cert-form-card-title">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    {{ App::currentLocale() == 'es' ? 'Datos de la solicitud' : 'Request details' }}
                </h2>
                <p class="cert-form-card-subtitle gris">
                    {{ App::currentLocale() == 'es' ? 'Los campos marcados con * son obligatorios.' : 'Fields marked with * are required.' }}
                </p>
            </div>

            <div class="cert-form-card-body">
                <form method="POST" action="{{ $rutaEnvio }}" data-analytics-event-submit="certificate_request_submit" id="formSolicitudCertificado" novalidate>
                    @csrf
                    {{-- Honeypot anti-spam: invisible para humanos, pero atractivo para bots --}}
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
                                <input type="text" id="nombre" name="nombre" class="cert-form-input" value="{{ old('nombre') }}" required maxlength="150" placeholder="{{ App::currentLocale() == 'es' ? 'Su nombre completo' : 'Your full name' }}">
                            </div>
                        </div>

                        <div class="cert-form-group cert-form-group--half">
                            <label for="puesto" class="cert-form-label">
                                {{ App::currentLocale() == 'es' ? 'Puesto' : 'Job title' }} *
                            </label>
                            <div class="cert-form-input-wrap">
                                <i class="fa fa-briefcase cert-form-input-icon" aria-hidden="true"></i>
                                <input type="text" id="puesto" name="puesto" class="cert-form-input" value="{{ old('puesto') }}" required maxlength="150" placeholder="{{ App::currentLocale() == 'es' ? 'Su puesto o cargo' : 'Your job title' }}">
                            </div>
                        </div>
                    </div>

                    <div class="cert-form-row">
                        <div class="cert-form-group cert-form-group--half">
                            <label for="empresa" class="cert-form-label">
                                {{ App::currentLocale() == 'es' ? 'Empresa' : 'Company' }} *
                            </label>
                            <div class="cert-form-input-wrap">
                                <i class="fa fa-building cert-form-input-icon" aria-hidden="true"></i>
                                <input type="text" id="empresa" name="empresa" class="cert-form-input" value="{{ old('empresa') }}" required maxlength="150" placeholder="{{ App::currentLocale() == 'es' ? 'Nombre de la empresa' : 'Company name' }}">
                            </div>
                        </div>

                        <div class="cert-form-group cert-form-group--half">
                            <label for="correo" class="cert-form-label">
                                {{ App::currentLocale() == 'es' ? 'Correo electrónico' : 'Email' }} *
                            </label>
                            <div class="cert-form-input-wrap">
                                <i class="fa fa-envelope cert-form-input-icon" aria-hidden="true"></i>
                                <input type="email" id="correo" name="correo" class="cert-form-input" value="{{ old('correo') }}" required maxlength="150" placeholder="email@ejemplo.com">
                            </div>
                        </div>
                    </div>

                    <div class="cert-form-row">
                        <div class="cert-form-group cert-form-group--half">
                            <label for="telefono" class="cert-form-label">
                                {{ App::currentLocale() == 'es' ? 'Teléfono' : 'Phone' }} *
                            </label>
                            <div class="cert-form-input-wrap">
                                <i class="fa fa-phone cert-form-input-icon" aria-hidden="true"></i>
                                <input type="tel" id="telefono" name="telefono" class="cert-form-input" value="{{ old('telefono') }}" required maxlength="30" placeholder="+1 (555) 000-0000">
                            </div>
                        </div>

                        <div class="cert-form-group cert-form-group--half">
                            <label for="contacto_gab" class="cert-form-label">
                                {{ App::currentLocale() == 'es' ? 'Contacto en GAB' : 'GAB contact' }} *
                            </label>
                            <div class="cert-form-input-wrap">
                                <i class="fa fa-handshake-o cert-form-input-icon" aria-hidden="true"></i>
                                <input type="text" id="contacto_gab" name="contacto_gab" class="cert-form-input" value="{{ old('contacto_gab') }}" required maxlength="150" placeholder="{{ App::currentLocale() == 'es' ? 'Persona de contacto en GAB' : 'Your GAB contact person' }}">
                            </div>
                        </div>
                    </div>

                    <div class="cert-form-group">
                        <label for="uso" class="cert-form-label">
                            {{ App::currentLocale() == 'es' ? 'Uso previsto' : 'Intended use' }} *
                            <small class="cert-form-hint">
                                {{ App::currentLocale() == 'es'
                                    ? 'Describa brevemente el uso que dará al certificado.'
                                    : 'Briefly describe the intended use of the certificate.' }}
                            </small>
                        </label>
                        <div class="cert-form-input-wrap cert-form-input-wrap--textarea">
                            <i class="fa fa-commenting-o cert-form-input-icon cert-form-input-icon--textarea" aria-hidden="true"></i>
                            <textarea id="uso" name="uso" class="cert-form-input cert-form-input--textarea" rows="4" required maxlength="{{ config('certificaciones.uso_max_length', 500) }}" placeholder="{{ App::currentLocale() == 'es' ? 'Ej: Auditoría de cliente, registro sanitario, licitación...' : 'E.g. Customer audit, sanitary registration, tender...' }}">{{ old('uso') }}</textarea>
                        </div>
                        <div class="cert-form-char-count">
                            <span id="usoContador">0</span> / {{ config('certificaciones.uso_max_length', 500) }}
                        </div>
                    </div>

                    <button type="submit" class="cert-btn-submit" id="btnEnviarSolicitud">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        <span>{{ App::currentLocale() == 'es' ? 'Enviar solicitud' : 'Submit request' }}</span>
                        <i class="fa fa-spinner fa-spin cert-btn-spinner" aria-hidden="true" style="display:none;"></i>
                    </button>
                </form>
            </div>
        </div>{{-- /.cert-form-card --}}

        {{-- ═══════════════════════════════════════════════════════════════════
             CORRECCIÓN DEL ERROR: Enlace de retorno
             ERROR ORIGINAL: route(App::currentLocale() == 'en' ? 'en.certificaciones' : 'certificaciones')
             -> Route [certificaciones] not defined.
             SOLUCIÓN: Usar url()->previous() o javascript:history.back()
             para evitar depender del nombre de la ruta.
             ═══════════════════════════════════════════════════════════════════ --}}
        <div class="cert-form-back text-center mt-4">
            <a href="javascript:history.back()" class="cert-form-back-link">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                {{ App::currentLocale() == 'es' ? 'Volver a certificaciones' : 'Back to certifications' }}
            </a>
        </div>

    </div>
</section>

@endsection

@section('customCSS')
@parent
<style>
    /* ═══════════════════════════════════════════════════════════════════
       TOKENS — Heredados y extendidos de certificaciones.blade.php
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
        --cert-fz-body: 0.9375rem;
        --cert-fz-small: 0.8125rem;
    }

    /* ═══════════════════════════════════════════════════════════════════
       HERO COMPACTO (adaptado para formulario)
       ═══════════════════════════════════════════════════════════════════ */
    .cert-hero--compact {
        padding: 55px 0 45px;
    }

    .cert-hero--compact .cert-hero-title {
        font-size: 2.25rem;
    }

    .cert-hero--compact .cert-hero-title-script {
        font-size: 2.75rem;
    }

    @media (max-width: 767px) {
        .cert-hero--compact {
            padding: 40px 0 30px;
        }

        .cert-hero--compact .cert-hero-title {
            font-size: 1.875rem;
        }

        .cert-hero--compact .cert-hero-title-script {
            font-size: 2.25rem;
        }
    }

    /* ═══════════════════════════════════════════════════════════════════
       TARJETA DE CERTIFICADO SELECCIONADO
       ═══════════════════════════════════════════════════════════════════ */
    .cert-form-target {
        border: 1px solid var(--cert-border);
        overflow: hidden;
        position: relative;
    }

    .cert-form-target::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--cert-azul) 0%, var(--cert-rojo) 100%);
    }

    .cert-form-target-inner {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 18px 24px;
    }

    .cert-form-target-icon {
        width: 48px;
        height: 48px;
        background: var(--cert-azul-soft);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cert-form-target-icon i {
        font-size: 22px;
        color: var(--cert-azul);
    }

    .cert-form-target-label {
        display: block;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        color: var(--cert-texto-light);
        margin-bottom: 2px;
    }

    .cert-form-target-name {
        display: block;
        font-size: 1.0625rem;
        color: var(--cert-azul);
        font-weight: 700;
        line-height: 1.3;
    }

    @media (max-width: 575px) {
        .cert-form-target-inner {
            padding: 14px 18px;
        }

        .cert-form-target-icon {
            width: 40px;
            height: 40px;
        }

        .cert-form-target-icon i {
            font-size: 18px;
        }

        .cert-form-target-name {
            font-size: 0.9375rem;
        }
    }

    /* ═══════════════════════════════════════════════════════════════════
       ALERTAS PERSONALIZADAS
       ═══════════════════════════════════════════════════════════════════ */
    .cert-alert {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 18px 22px;
        border-radius: 10px;
        margin-bottom: 20px;
        border: 1px solid transparent;
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
        font-size: 22px;
        line-height: 1;
        margin-top: 2px;
    }

    .cert-alert--success .cert-alert-icon {
        color: var(--cert-vigente);
    }

    .cert-alert--error .cert-alert-icon {
        color: var(--cert-rojo);
    }

    .cert-alert-body strong {
        display: block;
        font-size: 1rem;
        margin-bottom: 4px;
        font-weight: 700;
    }

    .cert-alert-body p,
    .cert-alert-body ul {
        font-size: var(--cert-fz-small);
        line-height: 1.5;
        margin: 0;
    }

    .cert-alert-body ul li {
        margin-bottom: 2px;
    }

    /* ═══════════════════════════════════════════════════════════════════
       TARJETA DEL FORMULARIO
       ═══════════════════════════════════════════════════════════════════ */
    .cert-form-card {
        border: 1px solid var(--cert-border);
        overflow: hidden;
    }

    .cert-form-card-header {
        padding: 28px 28px 0;
        text-align: center;
    }

    .cert-form-card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--cert-azul);
        margin: 0 0 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .cert-form-card-title i {
        color: var(--cert-rojo);
        font-size: 20px;
    }

    .cert-form-card-subtitle {
        font-size: var(--cert-fz-small);
        color: var(--cert-texto-muted);
        margin: 0;
    }

    .cert-form-card-body {
        padding: 24px 28px 32px;
    }

    @media (max-width: 575px) {
        .cert-form-card-header {
            padding: 22px 20px 0;
        }

        .cert-form-card-body {
            padding: 18px 20px 24px;
        }
    }

    /* ═══════════════════════════════════════════════════════════════════
       CAMPOS DEL FORMULARIO
       ═══════════════════════════════════════════════════════════════════ */
    .cert-form-row {
        display: flex;
        gap: 18px;
        margin-bottom: 0;
    }

    .cert-form-group {
        margin-bottom: 20px;
        flex: 1;
    }

    .cert-form-group--half {
        flex: 1 1 0;
        min-width: 0;
    }

    .cert-form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: var(--cert-texto);
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 8px;
    }

    .cert-form-hint {
        display: block;
        font-size: 12px;
        font-weight: 400;
        text-transform: none;
        letter-spacing: 0;
        color: var(--cert-texto-light);
        margin-top: 4px;
    }

    .cert-form-input-wrap {
        position: relative;
    }

    .cert-form-input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--cert-texto-light);
        font-size: 15px;
        pointer-events: none;
        transition: color .2s ease;
    }

    .cert-form-input-icon--textarea {
        top: 14px;
        transform: none;
    }

    .cert-form-input {
        width: 100%;
        height: 48px;
        padding: 0 14px 0 42px;
        border: 1.5px solid var(--cert-border);
        border-radius: 8px;
        background: var(--cert-white);
        color: var(--cert-texto);
        font-size: var(--cert-fz-body);
        font-family: var(--cert-font);
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
        outline: none;
    }

    .cert-form-input::placeholder {
        color: #B0B8C4;
    }

    .cert-form-input:hover {
        border-color: var(--cert-border-strong);
    }

    .cert-form-input:focus {
        border-color: var(--cert-azul);
        box-shadow: 0 0 0 4px rgba(0, 60, 166, 0.10);
        background: var(--cert-white);
    }

    .cert-form-input:focus+.cert-form-input-icon,
    .cert-form-input-wrap:focus-within .cert-form-input-icon {
        color: var(--cert-azul);
    }

    .cert-form-input--textarea {
        height: auto;
        padding: 12px 14px 12px 42px;
        resize: vertical;
        min-height: 100px;
    }

    .cert-form-char-count {
        text-align: right;
        font-size: 11px;
        color: var(--cert-texto-light);
        margin-top: 6px;
        font-weight: 500;
    }

    @media (max-width: 767px) {
        .cert-form-row {
            flex-direction: column;
            gap: 0;
        }
    }

    /* ═══════════════════════════════════════════════════════════════════
       BOTÓN DE ENVÍO
       ═══════════════════════════════════════════════════════════════════ */
    .cert-btn-submit {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 14px 24px;
        background: linear-gradient(135deg, var(--cert-azul) 0%, var(--cert-azul-dark) 100%);
        color: var(--cert-white) !important;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-family: var(--cert-font);
        cursor: pointer;
        transition: transform .2s ease, box-shadow .25s ease, filter .2s ease;
        box-shadow: 0 4px 14px rgba(0, 60, 166, 0.30);
        margin-top: 8px;
        position: relative;
        overflow: hidden;
    }

    .cert-btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
        transition: left .5s ease;
    }

    .cert-btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(0, 60, 166, 0.40);
        filter: brightness(1.05);
    }

    .cert-btn-submit:hover::before {
        left: 100%;
    }

    .cert-btn-submit:disabled {
        background: var(--cert-texto-light);
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
        filter: none;
    }

    .cert-btn-submit:disabled::before {
        display: none;
    }

    .cert-btn-spinner {
        font-size: 14px;
    }

    /* ═══════════════════════════════════════════════════════════════════
       ENLACE DE RETORNO
       ═══════════════════════════════════════════════════════════════════ */
    .cert-form-back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--cert-texto-muted);
        font-size: var(--cert-fz-small);
        font-weight: 600;
        text-decoration: none;
        transition: color .2s ease;
        cursor: pointer;
    }

    .cert-form-back-link:hover {
        color: var(--cert-azul);
        text-decoration: none;
    }

    /* ═══════════════════════════════════════════════════════════════════
       ANIMACIONES
       ═══════════════════════════════════════════════════════════════════ */
    @keyframes certFadeIn {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (prefers-reduced-motion: no-preference) {

        .cert-form-card,
        .cert-form-target {
            animation: certFadeIn .5s ease both;
        }

        .cert-form-target {
            animation-delay: .05s;
        }

        .cert-form-card {
            animation-delay: .1s;
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

        // Evitar doble envío y mostrar estado de carga
        form?.addEventListener('submit', function(e) {
            if (btn.disabled) {
                e.preventDefault();
                return;
            }
            btn.disabled = true;
            btnText.textContent = '{{ App::currentLocale() == "es" ? "Enviando..." : "Sending..." }}';
            btnSpinner.style.display = 'inline-block';
        });

        // Contador de caracteres para el textarea
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
