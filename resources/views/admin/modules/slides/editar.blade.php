@extends('admin.layouts.master')

@section('titulo', 'Editar Slide')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Slides</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('slides') }}">Slides</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('slides') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Editar Slide</h4>
                    </div>
                    <div class="card-body">
                        <form id="editarForm" action="{{ route('slides.editar', ['hash_id'=>Hashids::encode($slide->id)]) }}" class="form-horizontal form-bordered m-t-40">
                             <div class="form-group row">
                                <label class="control-label text-md-right col-md-3">*Idioma</label>
                                <div class="col-md-7">
                                    <select id="idioma" name="idioma_id" class="form-control select2" data-error="*El idioma es requerido." required>
                                        <option value="">- Seleccione un idioma -</option>
                                        @foreach($idiomas as $idioma)
                                            <option value="{{ $idioma->id }}" {{ ($idioma->id == $slide->idioma_id) ? 'selected' : '' }}>{{ $idioma->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Slide</label>
                                    <div class="col-md-7">
                                        <input id="imagen" name="imagenInput" type="file" class="file-loading">
                                        <input type="hidden" id="imagenImg" name="imagen" value="{{ $slide->imagen }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Slide móvil</label>
                                    <div class="col-md-7">
                                        <input id="imagenMovil" name="imagenMovilInput" type="file" class="file-loading">
                                        <input type="hidden" id="imagenMovilImg" name="imagen_movil" value="{{ $slide->imagen_movil }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Enlace</label>
                                    <div class="col-md-7">
                                        <input type="text" name="enlace" value="{{ $slide->enlace }}" class="form-control">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Abrir en otra pestaña</label>
                                    <div class="col-md-7">
                                        <x-bootstrap-toggle name="target_blank" onText="Sí" offText="No" checked="{{ $slide->target_blank }}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                {{-- <x-orden name="orden" value="{{ $slide->orden }}" /> --}}
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Estatus</label>
                                    <div class="col-md-7">
                                        <x-bootstrap-toggle name="activo" onText="Activo" offText="Inactivo" checked="{{ $slide->activo }}" scripts="0" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-7">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg disabled">
                                            Guardar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-data-tables />
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">
    {{-- fileinput --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/css/fileinput.min.css" />

@stop

@section('customJS')
    @parent
    {{-- Fileinput --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/fileinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/themes/fa/theme.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/locales/es.min.js"></script>

    <script>
        $(function(){

            /*----------  Slide desktop ----------*/
            $("#imagen").fileinput({
                uploadUrl: "{{ route('slides.subir_imagen') }}",
                uploadAsync: true,
                maxFileCount: 1,
                language: 'es',
                showUpload: false,
                theme: 'fa',
                height: '70',
                allowedFileExtensions: ["jpg", "jpeg", "png", "gif"],
                @if($slide->imagen != '')
                    initialPreview: [
                        '<img src="/uploads/{{ $slide->imagen }}" class="file-preview-image img-responsive">'
                    ],
                    initialPreviewConfig: [
                        {
                            caption: '{{ $slide->imagen }}',
                            width: '120px',
                            url: "{{ route('slides.eliminar_imagen') }}", // server delete action
                            extra: {
                                slide_id: "{{ Hashids::encode($slide->id) }}"
                            }
                        }
                    ]
                @endif
            });
            $('#imagen').on("filebatchselected", function(event, files) {
                // trigger upload method immediately after files are selected
                $('.kv-file-upload').click();
            });
            $('#imagen').on('filedeleted', function(event, key, jqXHR, data) {
                $("#imagenImg").val("");
            });
            $('#imagen').on('fileuploaded', function(event, data, previewId, index) {
                var form = data.form,
                    files = data.files,
                    extra = data.extra,
                    response = data.response,
                    reader = data.reader;
                $("#imagenImg").val( data.response.imagen );
            });

            /*----------  Slide móvil ----------*/
            $("#imagenMovil").fileinput({
                uploadUrl: "{{ route('slides.subir_imagen_movil') }}",
                uploadAsync: true,
                maxFileCount: 1,
                language: 'es',
                showUpload: false,
                theme: 'fa',
                height: '70',
                allowedFileExtensions: ["jpg", "jpeg", "png", "gif"],
                @if($slide->imagen_movil != '')
                    initialPreview: [
                        '<img src="/uploads/{{ $slide->imagen_movil }}" class="file-preview-image img-responsive">'
                    ],
                    initialPreviewConfig: [
                        {
                            caption: '{{ $slide->imagen_movil }}',
                            width: '120px',
                            url: "{{ route('slides.eliminar_imagen_movil') }}", // server delete action
                            extra: {
                                slide_id: "{{ Hashids::encode($slide->id) }}"
                            }
                        }
                    ]
                @endif
            });
            $('#imagenMovil').on("filebatchselected", function(event, files) {
                // trigger upload method immediately after files are selected
                $('.kv-file-upload').click();
            });
            $('#imagenMovil').on('filedeleted', function(event, key, jqXHR, data) {
                $("#imagenMovilImg").val("");
            });
            $('#imagenMovil').on('fileuploaded', function(event, data, previewId, index) {
                var form = data.form,
                    files = data.files,
                    extra = data.extra,
                    response = data.response,
                    reader = data.reader;
                $("#imagenMovilImg").val( data.response.imagenMovil );
            });
        });
    </script>
    <x-validator />
    <x-ajax-form id="editarForm" titulo="Editar Slide" reload="1" />
@stop