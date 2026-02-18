@extends('admin.layouts.master')

@section('titulo', 'Editar categoría producto')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Categorías Productos</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('categorias_productos') }}">Categorías Productos</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('categorias_productos') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Editar Categoría</h4>
                    </div>
                    <div class="card-body">
                        <form id="editarForm" action="{{ route('categorias_productos.editar', ['hash_id'=>Hashids::encode($categoria->id)]) }}" class="form-horizontal form-bordered m-t-40">
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Idioma</label>
                                    <div class="col-md-7">
                                        <select name="idioma_id" class="form-control select2" data-error="*Su nombre es requerido." required>
                                            @foreach($idiomas as $idioma)
                                                <option value="{{ $idioma->id }}" {{ ($idioma->id == $categoria->idioma_id) ? 'selected' : '' }}>{{ $idioma->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Nombre</label>
                                    <div class="col-md-7">
                                        <input type="text" name="nombre" class="form-control" value="{{ $categoria->nombre }}" data-error="*La pregunta es requerida." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Slug</label>
                                    <div class="col-md-7">
                                        <x-slugify name="slug" slug="{{ $categoria->slug }}" titulo="nombre" requerido="1" requeridoText="*El Slug es requerido." />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Banner</label>
                                    <div class="col-md-7">
                                        <input id="banner" name="bannerInput" type="file" class="file-loading">
                                        <input type="hidden" id="bannerImg" name="banner" value="{{ $categoria->banner }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Estatus</label>
                                    <div class="col-md-7">
                                        <x-bootstrap-toggle name="activo" onText="Activo" offText="Inactivo" checked="{{ $categoria->activo }}" />
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
    <x-validator />
    <x-select2 />
    

    <script>
        $(function(){

            /*----------  Slide desktop ----------*/
            $("#banner").fileinput({
                uploadUrl: "{{ route('categorias_productos.subir_banner') }}",
                uploadAsync: true,
                maxFileCount: 1,
                language: 'es',
                showUpload: false,
                theme: 'fa',
                height: '70',
                allowedFileExtensions: ["jpg", "jpeg", "png", "gif"],
                @if($categoria->banner != '')
                    initialPreview: [
                        '<img src="/uploads/{{ $categoria->banner }}" class="file-preview-image img-responsive">'
                    ],
                    initialPreviewConfig: [
                        {
                            caption: '{{ $categoria->banner }}',
                            width: '120px',
                            url: "{{ route('categorias_productos.eliminar_banner') }}", // server delete action
                            extra: {
                                categoria_id: "{{ Hashids::encode($categoria->id) }}"
                            }
                        }
                    ]
                @endif
            });
            $('#banner').on("filebatchselected", function(event, files) {
                // trigger upload method immediately after files are selected
                $('.kv-file-upload').click();
            });
            $('#banner').on('filedeleted', function(event, key, jqXHR, data) {
                $("#bannerImg").val("");
            });
            $('#banner').on('fileuploaded', function(event, data, previewId, index) {
                var form = data.form,
                    files = data.files,
                    extra = data.extra,
                    response = data.response,
                    reader = data.reader;
                $("#bannerImg").val( data.response.banner );
            });

        });
    </script>
    <x-ajax-form id="editarForm" titulo="Editar Categoría" reload="1" />
@stop