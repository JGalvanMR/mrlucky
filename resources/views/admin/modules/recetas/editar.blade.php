@extends('admin.layouts.master')

@section('titulo', 'Editar noticia')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Recetas</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('recetas') }}">Recetas</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('recetas') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Editar Receta</h4>
                    </div>
                    <div class="card-body">
                        <form id="editarForm" action="{{ route('recetas.editar', ['hash_id'=>Hashids::encode($receta->id)]) }}" class="form-horizontal form-bordered m-t-40">
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Idioma</label>
                                    <div class="col-md-7">
                                        <select id="idioma" name="idioma_id" class="form-control select2" data-error="*El idioma es requerido." required>
                                            <option value="">- Seleccione un idioma -</option>
                                            @foreach($idiomas as $idioma)
                                                <option value="{{ $idioma->id }}" {{ ($idioma->id == $receta->idioma_id) ? 'selected' : '' }}>{{ $idioma->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Categoría</label>
                                    <div class="col-md-7">
                                        <select id="categoria" name="categoria_id" class="form-control select2" data-error="*La categoría es requerida." required>
                                            <option value="">- Seleccione una categoría -</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Título</label>
                                    <div class="col-md-7">
                                        <input type="text" name="titulo" class="form-control" value="{{ $receta->titulo }}" data-error="*El título es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Slug</label>
                                    <div class="col-md-7">
                                        <x-slugify name="slug" slug="{{ $receta->slug }}" titulo="titulo" requerido="1" requeridoText="*El Slug es requerido." />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Imagen</label>
                                    <div class="col-md-7">
                                        <input id="imagen" name="imagenInput" type="file" class="file-loading">
                                        <input type="hidden" id="imagenImg" name="imagen" value="{{ $receta->imagen }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Tiempo (min.)</label>
                                    <div class="col-md-7">
                                        <input type="number" name="tiempo" class="form-control" value="{{ $receta->tiempo }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Cocción (min.)</label>
                                    <div class="col-md-7">
                                        <input type="number" name="coccion" class="form-control" value="{{ $receta->coccion }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Porciones</label>
                                    <div class="col-md-7">
                                        <input type="number" name="porciones" class="form-control" value="{{ $receta->porciones }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Ingredientes</label>
                                    <div class="col-md-7">
                                        <x-summer-note name="ingredientes" value="{!! $receta->ingredientes !!}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Procedimiento</label>
                                    <div class="col-md-7">
                                        <x-summer-note name="contenido" value="{!! $receta->contenido !!}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Estatus</label>
                                    <div class="col-md-7">
                                        <x-bootstrap-toggle name="activo" onText="Activo" offText="Inactivo" checked="{{ $receta->activo }}" />
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
            /*----------  Imagen reeta ----------*/
            $("#imagen").fileinput({
                uploadUrl: "{{ route('recetas.subir_imagen') }}",
                uploadAsync: true,
                maxFileCount: 1,
                language: 'es',
                showUpload: false,
                theme: 'fa',
                height: '70',
                allowedFileExtensions: ["jpg", "jpeg", "png", "gif"],
                @if($receta->imagen != '')
                    initialPreview: [
                        '<img src="/uploads/{{ $receta->imagen }}" class="file-preview-image img-responsive">'
                    ],
                    initialPreviewConfig: [
                        {
                            caption: '{{ $receta->imagen }}',
                            width: '120px',
                            url: "{{ route('recetas.eliminar_imagen') }}", // server delete action
                            extra: {
                                receta_id: "{{ Hashids::encode($receta->id) }}"
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

            /*----------  Categorías  ----------*/
            $('#idioma').on('change', function(){
                let categoria_id = $(this).val();

                $.ajax({
                    url: "{{ route('api.categorias_recetas', ['idioma_id' => '']) }}/"+categoria_id,
                    cache: false,
                    type: 'get',
                    dataType: 'json',
                    success: function(categorias){
                        let options = `<option value="">- Seleccione una categoría -</option>`;
                        $.each(categorias, function(key, categoria){
                            options += `<option value="${categoria.id}" ${ (categoria.id == {{ (int)$receta->categoria_id }} ) ? 'selected' : '' }>${categoria.nombre}</option>`;
                        });

                        $("#categoria").html(options).trigger('change');
                    }
                });
            });
            $('#idioma').trigger('change');
        });
    </script>
    <x-ajax-form id="editarForm" titulo="Editar Receta" reload="1" />
@stop