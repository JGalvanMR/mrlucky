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

<section class="padding bg-gris-claro">
    <div class="container" style="max-width:720px;">

        <div class="text-center mb-4">
            <h1 class="azul-marino f600 h3">
                {{ App::currentLocale() == 'es' ? 'Solicitar descarga de certificado' : 'Request certificate download' }}
            </h1>
            <p class="gris">
                {{ App::currentLocale() == 'es' ? 'Certificado:' : 'Certificate:' }}
                <strong>{{ $nombreMostrado }}</strong>
            </p>
        </div>

        @if(session('certificado_solicitud_enviada'))
        <div class="alert alert-success" role="alert" aria-live="polite">
            <strong>{{ App::currentLocale() == 'es' ? 'Solicitud enviada correctamente.' : 'Request sent successfully.' }}</strong>
            <p class="mb-0">
                {{ App::currentLocale() == 'es'
                        ? 'Hemos recibido su solicitud de descarga. Nuestro equipo revisará la información proporcionada y dará seguimiento a su solicitud.'
                        : 'We have received your download request. Our team will review the information provided and follow up.' }}
            </p>
        </div>
        @endif

        @if(session('certificado_error'))
        <div class="alert alert-danger" role="alert" aria-live="assertive">
            {{ App::currentLocale() == 'es'
                    ? 'No fue posible enviar su solicitud en este momento. Por favor, inténtelo nuevamente más tarde.'
                    : 'We were unable to send your request at this time. Please try again later.' }}
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

        <div class="bg-white shadow p-4 rounded">
            <form method="POST" action="{{ $rutaEnvio }}" data-analytics-event-submit="certificate_request_submit" id="formSolicitudCertificado">
                @csrf
                {{-- Honeypot anti-spam: invisible para humanos, pero atractivo para bots --}}
                <div style="display: none !important;" aria-hidden="true">
                    <input type="text" name="website" id="website" tabindex="-1" autocomplete="off" value="">
                </div>

                <input type="hidden" name="certificado_id" value="{{ $idOculto }}">
                <input type="hidden" name="certificado_nombre" value="{{ $nombreMostrado }}">

                <div class="form-group">
                    <label for="nombre">{{ App::currentLocale() == 'es' ? 'Nombre' : 'Name' }} *</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" required maxlength="150">
                </div>

                <div class="form-group">
                    <label for="puesto">{{ App::currentLocale() == 'es' ? 'Puesto' : 'Job title' }} *</label>
                    <input type="text" id="puesto" name="puesto" class="form-control" value="{{ old('puesto') }}" required maxlength="150">
                </div>

                <div class="form-group">
                    <label for="empresa">{{ App::currentLocale() == 'es' ? 'Empresa' : 'Company' }} *</label>
                    <input type="text" id="empresa" name="empresa" class="form-control" value="{{ old('empresa') }}" required maxlength="150">
                </div>

                <div class="form-group">
                    <label for="correo">{{ App::currentLocale() == 'es' ? 'Correo electrónico' : 'Email' }} *</label>
                    <input type="email" id="correo" name="correo" class="form-control" value="{{ old('correo') }}" required maxlength="150">
                </div>

                <div class="form-group">
                    <label for="telefono">{{ App::currentLocale() == 'es' ? 'Teléfono' : 'Phone' }} *</label>
                    <input type="tel" id="telefono" name="telefono" class="form-control" value="{{ old('telefono') }}" required maxlength="30">
                </div>

                <div class="form-group">
                    <label for="contacto_gab">{{ App::currentLocale() == 'es' ? 'Contacto en GAB' : 'GAB contact' }} *</label>
                    <input type="text" id="contacto_gab" name="contacto_gab" class="form-control" value="{{ old('contacto_gab') }}" required maxlength="150">
                </div>

                <div class="form-group">
                    <label for="uso">
                        {{ App::currentLocale() == 'es' ? 'Uso' : 'Purpose' }} *
                        <small class="d-block gris">
                            {{ App::currentLocale() == 'es'
                                ? 'Describa brevemente el uso que dará al certificado.'
                                : 'Briefly describe the intended use of the certificate.' }}
                        </small>
                    </label>
                    <textarea id="uso" name="uso" class="form-control" rows="4" required maxlength="{{ config('certificaciones.uso_max_length', 500) }}">{{ old('uso') }}</textarea>
                </div>

                <button type="submit" class="btn btn-block cert-btn-descarga" style="max-width:100%;" id="btnEnviarSolicitud">
                    {{ App::currentLocale() == 'es' ? 'Enviar solicitud' : 'Submit request' }}
                </button>
            </form>
        </div>
    </div>
</section>

@endsection

@section('customJS')
<script>
    // Evitar doble envío y mostrar estado de carga (UX punto 35).
    document.getElementById('formSolicitudCertificado')?.addEventListener('submit', function() {
        var btn = document.getElementById('btnEnviarSolicitud');
        btn.disabled = true;
        btn.innerText = '{{ App::currentLocale() == "es" ? "Enviando..." : "Sending..." }}';
    });
</script>
@endsection
