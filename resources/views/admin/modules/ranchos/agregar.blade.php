@extends('admin.layouts.master')

@section('titulo', 'Agregar rancho')

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
                <li class="breadcrumb-item active">Agregar</li>
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
                    <h4 class="m-b-0 text-white">Agregar Rancho</h4>
                </div>
                <div class="card-body">

                    <form id="agregarForm"
                        action="{{ route('ranchos.agregar') }}"
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
                                    placeholder="Ej: Rancho El Júpiter"
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
                                    placeholder="Ej: Caborca, Sonora"
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
                                    placeholder="Ej: Caborca">
                            </div>
                            <div class="col-md-3">
                                <input type="text"
                                    name="estado"
                                    id="estado_rancho"
                                    class="form-control"
                                    placeholder="Ej: Sonora"
                                    value="Sonora">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-md-right col-md-3">Orden</label>
                            <div class="col-md-3">
                                <input type="number"
                                    name="orden"
                                    class="form-control"
                                    value="0"
                                    min="0">
                                <small class="text-muted">Menor número = aparece primero en el mosaico.</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-md-right col-md-3">Estatus</label>
                            <div class="col-md-7">
                                <x-bootstrap-toggle name="activo" onText="Activo" offText="Inactivo" checked="1" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-md-right col-md-3">Imagen del rancho</label>
                            <div class="col-md-7">
                                <x-file-input name="imagen" route="{{ route('ranchos.subir_imagen') }}" folder="ranchos/imagenes" filecount="1" scripts="1" />
                                <small class="text-muted">JPG, PNG o WebP. Tamaño recomendado: 600×400 px.</small>
                            </div>
                        </div>

                        <hr class="m-t-20 m-b-20">

                        {{-- ══ CERTIFICACIÓN ════════════════════════════════════════ --}}
                        <h5 class="text-themecolor m-b-20">
                            <i class="fa fa-certificate mr-1"></i> Certificación
                            <small class="text-muted font-weight-normal">(opcional)</small>
                        </h5>

                        <div class="form-group row">
                            <label class="control-label text-md-right col-md-3">Tipo de certificación</label>
                            <div class="col-md-7">
                                <select name="tipo_certificacion_id"
                                    id="tipo_cert"
                                    class="form-control select2">
                                    <option value="">— Sin certificación —</option>
                                    @foreach($tiposCertificacion as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Campos que se muestran al seleccionar un tipo --}}
                        <div id="camposCert">

                            <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">N° de Certificado</label>
                                <div class="col-md-7">
                                    <input type="text"
                                        name="numero_certificado"
                                        class="form-control"
                                        placeholder="Ej: PGFS-ABC12345"
                                        maxlength="100">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">Organismo Auditor</label>
                                <div class="col-md-7">
                                    <input type="text"
                                        name="organismo_auditor"
                                        class="form-control"
                                        placeholder="Ej: Primus Labs"
                                        maxlength="200">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">*Fecha de Emisión</label>
                                <div class="col-md-3">
                                    <input type="date"
                                        name="fecha_emision"
                                        id="fecha_emision"
                                        class="form-control">
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">*Fecha de Vencimiento</label>
                                <div class="col-md-3">
                                    <input type="date"
                                        name="fecha_vencimiento"
                                        id="fecha_vencimiento"
                                        class="form-control">
                                    <div class="help-block with-errors text-danger"></div>
                                    <small id="diasRestantes" class="help-block"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">Estado del certificado</label>
                                <div class="col-md-4">
                                    <select name="estado_cert" class="form-control">
                                        <option value="vigente">✅ Vigente</option>
                                        <option value="vencido">❌ Vencido</option>
                                        <option value="suspendido">⚠️ Suspendido</option>
                                        <option value="en_proceso">🔄 En proceso</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">Visible al público</label>
                                <div class="col-md-7">
                                    <x-bootstrap-toggle name="visible_publico" onText="Sí" offText="No" checked="1" scripts="0" />
                                    <br><small class="text-muted">Si está desactivado, el rancho no aparece en el mosaico del sitio.</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">Certificado PDF</label>
                                <div class="col-md-7">
                                    {{-- PDF sube vía bootstrap-fileinput a ruta privada; el path llega como hidden --}}
                                    <input id="pdfInput" name="pdfFileInput" type="file" class="file-loading">
                                    <input type="hidden" id="pdfPath" name="pdf_path" value="">
                                    <input type="hidden" id="pdfNombre" name="pdf_nombre_original" value="">
                                    <small class="text-muted">
                                        Solo PDF. Máx. 20 MB.
                                        El archivo se guarda de forma <strong>privada</strong>
                                        (no accesible por URL directa).
                                    </small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">Notas internas</label>
                                <div class="col-md-7">
                                    <textarea name="notas"
                                        class="form-control"
                                        rows="2"
                                        placeholder="Notas internas (no visibles en el sitio público)"></textarea>
                                </div>
                            </div>

                        </div>{{-- /#camposCert --}}

                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-7">
                                <button type="submit" class="btn btn-primary btn-block btn-lg disabled">
                                    Agregar Rancho
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
    #camposCert {
        transition: opacity .2s;
    }

    #camposCert.deshabilitado {
        opacity: .4;
        pointer-events: none;
    }
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
    $(function() {

        /*---------- Mostrar/ocultar campos de certificación ----------*/
        function toggleCampos() {
            if ($('#tipo_cert').val()) {
                $('#camposCert').removeClass('deshabilitado');
                $('#fecha_emision, #fecha_vencimiento').prop('required', true);
            } else {
                $('#camposCert').addClass('deshabilitado');
                $('#fecha_emision, #fecha_vencimiento').prop('required', false);
            }
        }
        $('#tipo_cert').on('change', toggleCampos);
        toggleCampos();

        /*---------- Auto-completar Ubicación ----------*/
        function autoUbicacion() {
            var municipio = $('#municipio').val().trim();
            var estado = $('#estado_rancho').val().trim();
            var $ubic = $('#ubicacion');
            if (municipio && estado && $ubic.data('auto') !== false) {
                $ubic.val(municipio + ', ' + estado).data('autoSet', true);
            }
        }
        $('#municipio, #estado_rancho').on('input', autoUbicacion);
        $('#ubicacion').on('input', function() {
            $(this).data('auto', false);
        });

        /*---------- Indicador días restantes ----------*/
        $('#fecha_vencimiento').on('change', function() {
            var fecha = new Date($(this).val());
            var hoy = new Date();
            hoy.setHours(0, 0, 0, 0);
            var diff = Math.floor((fecha - hoy) / 86400000);
            var $span = $('#diasRestantes');
            if (diff > 30) $span.html('<span class="text-success"><i class="fa fa-clock-o mr-1"></i>' + diff + ' días restantes</span>');
            else if (diff > 0) $span.html('<span class="text-warning"><i class="fa fa-clock-o mr-1"></i>⚠ ' + diff + ' días (próximo a vencer)</span>');
            else if (diff === 0) $span.html('<span class="text-danger">Vence hoy</span>');
            else $span.html('<span class="text-danger"><i class="fa fa-times-circle mr-1"></i>Fecha vencida</span>');
        });

        /*---------- PDF upload (disco privado) ----------*/
        $("#pdfInput").fileinput({
            uploadUrl: "{{ route('ranchos.subir_pdf') }}",
            uploadAsync: true,
            maxFileCount: 1,
            language: 'es',
            showUpload: false,
            theme: 'fa',
            allowedFileExtensions: ["pdf"],
        });
        $('#pdfInput').on("filebatchselected", function(event, files) {
            $('.kv-file-upload').click();
        });
        $('#pdfInput').on('fileuploaded', function(event, data) {
            $('#pdfPath').val(data.response.pdf);
            $('#pdfNombre').val(data.response.pdf_nombre_original);
        });
        $('#pdfInput').on('filedeleted', function() {
            $('#pdfPath').val('');
            $('#pdfNombre').val('');
        });

    });
</script>

<x-ajax-form id="agregarForm" titulo="Agregar Rancho" reload="1" />
@stop
