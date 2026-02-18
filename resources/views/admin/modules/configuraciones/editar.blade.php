@extends('admin.layouts.master')

@section('titulo', 'Configuraciones')

@section('page')
    @php
        $config = new Larapack\ConfigWriter\Repository('rentas');
    @endphp
	<div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Configuraciones</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item active">Configuraciones</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Editar configuración</h4>
                    </div>
                    <div class="card-body">
                        
                         <form id="editarForm" action="{{ route('configuraciones.editar') }}" class="form-horizontal form-bordered m-t-40">
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Nombre Aplicación</label>
                                    <div class="col-md-7">
                                        <input type="text" name="app_name" class="form-control" data-error="*El nombre de la aplicación es requerido." value="{{ str_replace('"','',EnvEditor::getKey('APP_NAME')) }}" required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3 text-md-right">
                                        <label class="control-label">Logo</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input id="logo" name="logoInput" type="file" class="file-loading" multiple>
                                        <input type="hidden" id="logoImg" name="logo" value="{{ $config->get('logo') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3 text-md-right">
                                        <label class="control-label">Logo Header</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input id="logo_header" name="logo_headerInput" type="file" class="file-loading" multiple>
                                        <input type="hidden" id="logo_headerImg" name="logo_header" value="{{ $config->get('logo_header') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3 text-md-right">
                                        <label class="control-label">Portada (1920px * 1080px)</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input id="portada" name="portadaInput" type="file" class="file-loading" multiple>
                                        <input type="hidden" id="portadaImg" name="portada" value="{{ $config->get('portada') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3 text-md-right">
                                        <label class="control-label">Favicon (60px * 60px)</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input id="favicon" name="faviconInput" type="file" class="file-loading" multiple>
                                        <input type="hidden" id="faviconImg" name="favicon" value="{{ $config->get('favicon') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Color principal</label>
                                    <div class="col-md-7">
                                        <input type="text" name="colorPrincipal" class="form-control colorPicker" data-error="*El color es requerido." value="{{ $config->get('colorPrincipal') }}" required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Color secundario</label>
                                    <div class="col-md-7">
                                        <input type="text" name="colorSecundario" class="form-control colorPicker" data-error="*El color es requerido." value="{{ $config->get('colorSecundario') }}" required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Color enlaces</label>
                                    <div class="col-md-7">
                                        <input type="text" name="colorEnlaces" class="form-control colorPicker" data-error="*El color es requerido." value="{{ $config->get('colorEnlaces') }}" required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Texto Copy</label>
                                    <div class="col-md-7">
                                        <input type="text" name="copy" class="form-control"  value="{{ $config->get('copy') }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Prefijo</label>
                                    <div class="col-md-7">
                                        <input type="text" name="prefijo" class="form-control" value="{{ $config->get('prefijo') }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div> --}}
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


@stop

@section('customCSS')
    @parent

    <link rel="stylesheet" href="/admin/css/pages/card-page.css">
    {{-- fileinput --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/css/fileinput.min.css" />
    {{-- Spectrum --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.css" />
@stop

@section('customJS')
    @parent
    
    {{-- fileinput --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/fileinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/themes/fa/theme.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/locales/es.min.js"></script>
    {{-- spectrum --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.js"></script>
    <script>

        $(function(){

            /*----------  Color Picker  ----------*/
            $('.colorPicker').spectrum({
                preferredFormat: "hex",
                showInput: true,
                chooseText: "Seleccionar",
                cancelText: "Cancelar"
            });

            /*===============================
            =            Logo               =
            ===============================*/
            $("#logo").fileinput({
                uploadUrl: "{{ route('configuraciones.subir_logo') }}",
                uploadAsync: true,
                maxFileCount: 1,
                language: 'es',
                showUpload: false,
                theme: 'fa',
                height: '100',

                @if($config->get('logo') != '')
                    initialPreview: [
                        '<img src="/uploads/{{ $config->get('logo') }}" class="file-preview-image img-responsive">'
                    ],
                    initialPreviewConfig: [
                        {
                            caption: '{{ $config->get('logo') }}', 
                            width: '120px', 
                            url: "{{ route('configuraciones.eliminar_logo') }}", // server delete action
                        }
                    ]
                @endif
            });

            $('#logo').on("filebatchselected", function(event, files) {
                // trigger upload method immediately after files are selected
                $('.kv-file-upload').click();
            });

             $('#logo').on('filedeleted', function(event, key, jqXHR, data) {
                $("#logoImg").val("");
            });

            $('#logo').on('fileuploaded', function(event, data, previewId, index) {
                var form = data.form, files = data.files, extra = data.extra, response = data.response, reader = data.reader;
                //console.log(data.response.imagen);
                $("#logoImg").val(data.response.imagen);
            });           
            /*=====  End of Logo  ======*/


            /*----------  Logo Header  ----------*/
            $("#logo_header").fileinput({
                uploadUrl: "{{ route('configuraciones.subir_logo_header') }}",
                uploadAsync: true,
                maxFileCount: 1,
                language: 'es',
                showUpload: false,
                theme: 'fa',
                height: '100',

                @if($config->get('logo_header') != '')
                    initialPreview: [
                        '<img src="/uploads/{{ $config->get('logo_header') }}" class="file-preview-image img-responsive">'
                    ],
                    initialPreviewConfig: [
                        {
                            caption: '{{ $config->get('logo_header') }}', 
                            width: '120px', 
                            url: "{{ route('configuraciones.eliminar_logo_header') }}", // server delete action
                        }
                    ]
                @endif
            });

            $('#logo_header').on("filebatchselected", function(event, files) {
                // trigger upload method immediately after files are selected
                $('.kv-file-upload').click();
            });

             $('#logo_header').on('filedeleted', function(event, key, jqXHR, data) {
                $("#logo_headerImg").val("");
            });

            $('#logo_header').on('fileuploaded', function(event, data, previewId, index) {
                var form = data.form, files = data.files, extra = data.extra, response = data.response, reader = data.reader;
                //console.log(data.response.imagen);
                $("#logo_headerImg").val(data.response.imagen);
            });   



            /*===============================
            =            Portada            =
            ===============================*/
            $("#portada").fileinput({
                uploadUrl: "{{ route('configuraciones.subir_portada') }}",
                uploadAsync: true,
                maxFileCount: 1,
                language: 'es',
                showUpload: false,
                theme: 'fa',
                height: '100',

                @if($config->get('portada') != '')
                    initialPreview: [
                        '<img src="/uploads/{{ $config->get('portada') }}" class="file-preview-image img-responsive">'
                    ],
                    initialPreviewConfig: [
                        {
                            caption: '{{ $config->get('portada') }}', 
                            width: '120px', 
                            url: "{{ route('configuraciones.eliminar_portada') }}", // server delete action
                        }
                    ]
                @endif
            });

            $('#portada').on("filebatchselected", function(event, files) {
                // trigger upload method immediately after files are selected
                $('.kv-file-upload').click();
            });

             $('#portada').on('filedeleted', function(event, key, jqXHR, data) {
                $("#portadaImg").val("");
            });

            $('#portada').on('fileuploaded', function(event, data, previewId, index) {
                var form = data.form, files = data.files, extra = data.extra, response = data.response, reader = data.reader;
                //console.log(data.response.imagen);
                $("#portadaImg").val(data.response.imagen);
            });           
            /*=====  End of Logo  ======*/


            /*===============================
            =            Favicon            =
            ===============================*/
            $("#favicon").fileinput({
                uploadUrl: "{{ route('configuraciones.subir_favicon') }}",
                uploadAsync: true,
                maxFileCount: 1,
                language: 'es',
                showUpload: false,
                theme: 'fa',
                height: '60',

                @if($config->get('favicon') != '')
                    initialPreview: [
                        '<img src="/uploads/{{ $config->get('favicon') }}" class="file-preview-image img-responsive">'
                    ],
                    initialPreviewConfig: [
                        {
                            caption: '{{ $config->get('favicon') }}', 
                            width: '60px', 
                            url: "{{ route('configuraciones.eliminar_favicon') }}", // server delete action
                        }
                    ]
                @endif
            });

            $('#favicon').on("filebatchselected", function(event, files) {
                // trigger upload method immediately after files are selected
                $('.kv-file-upload').click();
            });

             $('#favicon').on('filedeleted', function(event, key, jqXHR, data) {
                $("#faviconImg").val("");
            });

            $('#favicon').on('fileuploaded', function(event, data, previewId, index) {
                var form = data.form, files = data.files, extra = data.extra, response = data.response, reader = data.reader;
                //console.log(data.response.imagen);
                $("#faviconImg").val(data.response.imagen);
            });           
            /*=====  End of Logo  ======*/


  
        });
    </script>

    <x-validator /> 
    <x-ajax-form id="editarForm" titulo="Editar configuración" reload="1" />
@stop