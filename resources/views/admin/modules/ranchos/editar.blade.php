@extends('admin.layouts.master')

@section('titulo', 'Editar rancho')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Ranchos & Certificaciones</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('ranchos') }}">Ranchos</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>

        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('ranchos') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Editar Rancho: {{ $rancho->nombre }}</h4>
                    </div>
                    <div class="card-body">

                        @php
                            $cert = $rancho->certificacion->first();
                        @endphp

                        <form id="editarForm"
                              action="{{ route('ranchos.editar', ['hash_id' => Hashids::encode($rancho->id)]) }}"
                              class="form-horizontal form-bordered m-t-40">

                            {{-- ══ DATOS DEL RANCHO ══════════════════════════════════════ --}}
                            <h5 class="text-themecolor m-b-20">
                                <i class="fa fa-map-marker mr-1"></i> Datos del Rancho
                            </h5>

                            <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">*Nombre</label>
                                <div class="col-md-7">
                                    <input type="text"
                                           name="nombre"
                                           id="nombre"
                                           class="form-control"
                                           value="{{ $rancho->nombre }}"
                                           data-error="*El nombre es requerido."
                                           required>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">*Ubicación</label>
                                <div class="col-md-7">
                                    <input type="text"
                                           name="ubicacion"
                                           id="ubicacion"
                                           class="form-control"
                                           value="{{ $rancho->ubicacion }}"
                                           data-error="*La ubicación es requerida."
                                           required>
                                    <small class="text-muted">Texto visible en la card del mosaico público.</small>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">Municipio</label>
                                <div class="col-md-4">
                                    <input type="text"
                                           name="municipio"
                                           id="municipio"
                                           class="form-control"
                                           value="{{ $rancho->municipio }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text"
                                           name="estado"
                                           id="estado_rancho"
                                           class="form-control"
                                           value="{{ $rancho->estado }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">Orden</label>
                                <div class="col-md-3">
                                    <input type="number"
                                           name="orden"
                                           class="form-control"
                                           value="{{ $rancho->orden }}"
                                           min="0">
                                    <small class="text-muted">Menor número = aparece primero en el mosaico.</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">Estatus</label>
                                <div class="col-md-7">
                                    <x-bootstrap-toggle name="activo" onText="Activo" offText="Inactivo" checked="{{ $rancho->activo }}" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">Imagen del rancho</label>
                                <div class="col-md-7">
                                    <input id="imagenInput" name="imagenFileInput" type="file" class="file-loading">
                                    <input type="hidden" id="imagenImg" name="imagen" value="{{ $rancho->imagen }}">
                                    <small class="text-muted">JPG, PNG o WebP. Tamaño recomendado: 600×400 px.</small>
                                </div>
                            </div>

                            <hr class="m-t-20 m-b-20">

                            {{-- ══ CERTIFICACIÓN ════════════════════════════════════════ --}}
                            <h5 class="text-themecolor m-b-20">
                                <i class="fa fa-certificate mr-1"></i> Certificación
                                @if($cert)
                                    @if($cert->es_vigente)
                                        <span class="label label-success ml-2">
                                            <i class="fa fa-check-circle"></i> Vigente
                                        </span>
                                    @else
                                        <span class="label label-danger ml-2">
                                            <i class="fa fa-times-circle"></i> Vencida
                                        </span>
                                    @endif
                                @endif
                            </h5>

                            <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">Tipo de certificación</label>
                                <div class="col-md-7">
                                    <select name="tipo_certificacion_id"
                                            id="tipo_cert"
                                            class="form-control select2">
                                        <option value="">— Sin certificación —</option>
                                        @foreach($tiposCertificacion as $tipo)
                                            <option value="{{ $tipo->id }}"
                                                {{ ($cert && $cert->tipo_certificacion_id == $tipo->id) ? 'selected' : '' }}>
                                                {{ $tipo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="camposCert">

                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">N° de Certificado</label>
                                    <div class="col-md-7">
                                        <input type="text"
                                               name="numero_certificado"
                                               class="form-control"
                                               value="{{ $cert->numero_certificado ?? '' }}"
                                               maxlength="100">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Organismo Auditor</label>
                                    <div class="col-md-7">
                                        <input type="text"
                                               name="organismo_auditor"
                                               class="form-control"
                                               value="{{ $cert->organismo_auditor ?? '' }}"
                                               maxlength="200">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Fecha de Emisión</label>
                                    <div class="col-md-3">
                                        <input type="date"
                                               name="fecha_emision"
                                               id="fecha_emision"
                                               class="form-control"
                                               value="{{ $cert?->fecha_emision?->format('Y-m-d') ?? '' }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Fecha de Vencimiento</label>
                                    <div class="col-md-3">
                                        <input type="date"
                                               name="fecha_vencimiento"
                                               id="fecha_vencimiento"
                                               class="form-control"
                                               value="{{ $cert?->fecha_vencimiento?->format('Y-m-d') ?? '' }}">
                                        <div class="help-block with-errors text-danger"></div>
                                        {{-- Indicador de vigencia actual --}}
                                        @if($cert && $cert->fecha_vencimiento)
                                            <small id="diasRestantes">
                                                @if($cert->es_vigente && $cert->proximo_a_vencer)
                                                    <span class="text-warning">
                                                        <i class="fa fa-clock-o mr-1"></i>⚠ {{ $cert->dias_para_vencer }} días restantes
                                                    </span>
                                                @elseif($cert->es_vigente)
                                                    <span class="text-success">
                                                        <i class="fa fa-check-circle mr-1"></i>{{ $cert->dias_para_vencer }} días restantes
                                                    </span>
                                                @else
                                                    <span class="text-danger">
                                                        <i class="fa fa-times-circle mr-1"></i>Certificado vencido
                                                    </span>
                                                @endif
                                            </small>
                                        @else
                                            <small id="diasRestantes" class="help-block"></small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Estado del certificado</label>
                                    <div class="col-md-4">
                                        <select name="estado_cert" class="form-control">
                                            <option value="vigente"    {{ ($cert && $cert->estado == 'vigente')    ? 'selected' : '' }}>✅ Vigente</option>
                                            <option value="vencido"    {{ ($cert && $cert->estado == 'vencido')    ? 'selected' : '' }}>❌ Vencido</option>
                                            <option value="suspendido" {{ ($cert && $cert->estado == 'suspendido') ? 'selected' : '' }}>⚠️ Suspendido</option>
                                            <option value="en_proceso" {{ ($cert && $cert->estado == 'en_proceso') ? 'selected' : '' }}>🔄 En proceso</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Visible al público</label>
                                    <div class="col-md-7">
                                        <x-bootstrap-toggle name="visible_publico" onText="Sí" offText="No" checked="{{ $cert->visible_publico ?? 1 }}" scripts="0" />
                                        <br><small class="text-muted">Si está desactivado, el rancho no aparece en el mosaico del sitio.</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Certificado PDF</label>
                                    <div class="col-md-7">
                                        {{-- PDF actual --}}
                                        @if($cert && $cert->pdf_path)
                                            <div class="alert alert-info p-2 mb-2">
                                                <i class="fa fa-file-pdf-o text-danger mr-1"></i>
                                                <strong>PDF actual:</strong>
                                                {{ $cert->pdf_nombre_original ?? 'certificado.pdf' }}
                                                <a href="{{ route('certificaciones.descargar', $cert->id) }}"
                                                   target="_blank"
                                                   class="btn btn-xs btn-danger ml-2">
                                                    <i class="fa fa-download mr-1"></i> Descargar
                                                </a>
                                                <span class="text-muted small d-block mt-1">
                                                    Sube un nuevo PDF para reemplazarlo.
                                                </span>
                                            </div>
                                        @endif

                                        <input id="pdfInput" name="pdfFileInput" type="file" class="file-loading">
                                        <input type="hidden" id="pdfPath" name="pdf_path" value="">
                                        <input type="hidden" id="pdfNombre" name="pdf_nombre_original" value="">
                                        <small class="text-muted">
                                            Solo PDF. Máx. 20 MB. Guardado de forma <strong>privada</strong>.
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Notas internas</label>
                                    <div class="col-md-7">
                                        <textarea name="notas"
                                                  class="form-control"
                                                  rows="2">{{ $cert->notas ?? '' }}</textarea>
                                    </div>
                                </div>

                            </div>{{-- /#camposCert --}}

                            <div class="form-group row">
                                <div class="col-md-3"></div>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg disabled">
                                        Guardar cambios
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/css/fileinput.min.css" />
    <style>
        #camposCert { transition: opacity .2s; }
        #camposCert.deshabilitado { opacity: .4; pointer-events: none; }
    </style>
@stop

@section('customJS')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/fileinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/themes/fa/theme.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/locales/es.min.js"></script>
    <x-validator />
    <x-select2 />

    <script>
        $(function(){

            /*---------- Mostrar/ocultar campos de certificación ----------*/
            function toggleCampos(){
                if($('#tipo_cert').val()){
                    $('#camposCert').removeClass('deshabilitado');
                    $('#fecha_emision, #fecha_vencimiento').prop('required', true);
                } else {
                    $('#camposCert').addClass('deshabilitado');
                    $('#fecha_emision, #fecha_vencimiento').prop('required', false);
                }
            }
            $('#tipo_cert').on('change', toggleCampos);
            toggleCampos();

            /*---------- Indicador días restantes (en tiempo real) ----------*/
            $('#fecha_vencimiento').on('change', function(){
                var fecha = new Date($(this).val());
                var hoy   = new Date(); hoy.setHours(0,0,0,0);
                var diff  = Math.floor((fecha - hoy) / 86400000);
                var $span = $('#diasRestantes');
                if(diff > 30)       $span.html('<span class="text-success"><i class="fa fa-clock-o mr-1"></i>'+diff+' días restantes</span>');
                else if(diff > 0)   $span.html('<span class="text-warning"><i class="fa fa-clock-o mr-1"></i>⚠ '+diff+' días (próximo a vencer)</span>');
                else if(diff === 0) $span.html('<span class="text-danger">Vence hoy</span>');
                else                $span.html('<span class="text-danger"><i class="fa fa-times-circle mr-1"></i>Fecha vencida</span>');
            });

            /*---------- Imagen — bootstrap-fileinput ----------*/
            $("#imagenInput").fileinput({
                uploadUrl: "{{ route('ranchos.subir_imagen') }}",
                uploadAsync: true,
                maxFileCount: 1,
                language: 'es',
                showUpload: false,
                theme: 'fa',
                allowedFileExtensions: ["jpg", "jpeg", "png", "gif", "webp"],
                @if($rancho->imagen != '')
                    initialPreview: [
                        '<img src="/uploads/{{ $rancho->imagen }}" class="file-preview-image img-responsive">'
                    ],
                    initialPreviewConfig: [
                        {
                            caption: '{{ $rancho->imagen }}',
                            width: '120px',
                            url: "{{ route('ranchos.eliminar_imagen') }}",
                            extra: { rancho_id: "{{ Hashids::encode($rancho->id) }}" }
                        }
                    ]
                @endif
            });
            $('#imagenInput').on("filebatchselected", function(){ $('.kv-file-upload').click(); });
            $('#imagenInput').on('filedeleted', function(){ $("#imagenImg").val(""); });
            $('#imagenInput').on('fileuploaded', function(event, data){
                $("#imagenImg").val(data.response.imagen);
            });

            /*---------- PDF — bootstrap-fileinput (disco privado) ----------*/
            $("#pdfInput").fileinput({
                uploadUrl: "{{ route('ranchos.subir_pdf') }}",
                uploadAsync: true,
                maxFileCount: 1,
                language: 'es',
                showUpload: false,
                theme: 'fa',
                allowedFileExtensions: ["pdf"],
                @if($cert && $cert->pdf_path)
                    @php
                        $pdfUrl      = route('certificaciones.descargar', $cert->id);
                        $pdfCaption  = $cert->pdf_nombre_original ?? 'certificado.pdf';
                        $pdfElimUrl  = route('ranchos.eliminar_pdf');
                        $pdfCertId   = Hashids::encode($cert->id);
                    @endphp
                    initialPreview: [
                        '<embed src="{{ $pdfUrl }}" class="w-100" style="height:80px;"/>'
                    ],
                    initialPreviewConfig: [
                        {
                            caption: "{{ $pdfCaption }}",
                            width: "120px",
                            url: "{{ $pdfElimUrl }}",
                            extra: { cert_id: "{{ $pdfCertId }}" }
                        }
                    ]
                @endif
            });
            $('#pdfInput').on("filebatchselected", function(){ $('.kv-file-upload').click(); });
            $('#pdfInput').on('filedeleted', function(){
                $('#pdfPath').val('');
                $('#pdfNombre').val('');
            });
            $('#pdfInput').on('fileuploaded', function(event, data){
                $('#pdfPath').val(data.response.pdf);
                $('#pdfNombre').val(data.response.pdf_nombre_original);
            });

        });
    </script>

    <x-ajax-form id="editarForm" titulo="Editar Rancho" reload="1" />
@stop
