@extends('admin.layouts.master')

@section('titulo', 'Editar producto')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Productos</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('productos') }}">Productos</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('productos') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Editar Producto</h4>
                    </div>
                    <div class="card-body">
                        <form id="editarForm" action="{{ route('productos.editar', ['hash_id'=>Hashids::encode($producto->id)]) }}" class="form-horizontal form-bordered m-t-40">
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Idioma</label>
                                    <div class="col-md-7">
                                        <select id="idioma" name="idioma_id" class="form-control select2" data-error="*El idioma es requerido." required>
                                            <option value="">- Seleccione un idioma -</option>
                                            @foreach($idiomas as $idioma)
                                                <option value="{{ $idioma->id }}" {{ ($idioma->id == $producto->categoria->idioma_id) ? 'selected' : '' }}>{{ $idioma->nombre }}</option>
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
                                        <input type="text" name="titulo" class="form-control" value="{{ $producto->titulo }}" data-error="*El título es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Slug</label>
                                    <div class="col-md-7">
                                        <x-slugify name="slug" slug="{{ $producto->slug }}" titulo="titulo" requerido="1" requeridoText="*El Slug es requerido." />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Imagen</label>
                                    <div class="col-md-7">
                                        <input id="imagen" name="imagenInput" type="file" class="file-loading">
                                        <input type="hidden" id="imagenImg" name="imagen" value="{{ $producto->imagen }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Descripción</label>
                                    <div class="col-md-7">
                                        <x-summer-note name="descripcion" value="{!! $producto->descripcion !!}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Nutrición</label>
                                    <div class="col-md-7">
                                        <x-summer-note name="nutricion" value="{!! $producto->nutricion !!}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Usos</label>
                                    <div class="col-md-7">
                                        <x-summer-note name="usos" value="{!! $producto->usos !!}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Conservación</label>
                                    <div class="col-md-7">
                                        <x-summer-note name="conservacion" value="{!! $producto->conservacion !!}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Ficha</label>
                                    <div class="col-md-7">
                                        <input id="ficha" name="fichaInput" type="file" class="file-loading">
                                        <input type="hidden" id="fichaImg" name="ficha" value="{{ $producto->ficha }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Tabla nutrimental</label>
                                    <div class="col-md-7">
                                        <input id="tabla_nutrimental" name="tabla_nutrimentalInput" type="file" class="file-loading">
                                        <input type="hidden" id="tabla_nutrimentalImg" name="tabla_nutrimental" value="{{ $producto->tabla_nutrimental }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Estatus</label>
                                    <div class="col-md-7">
                                        <x-bootstrap-toggle name="activo" onText="Activo" offText="Inactivo" checked="{{ $producto->activo }}" />
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
    <x-validator />
    <x-select2 />
    {{-- Fileinput --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/fileinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/themes/fa/theme.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/locales/es.min.js"></script>

    <script>
        $(function(){

            /*----------  Imagen producto ----------*/
            $("#imagen").fileinput({
                uploadUrl: "{{ route('productos.subir_imagen') }}",
                uploadAsync: true,
                maxFileCount: 1,
                language: 'es',
                showUpload: false,
                theme: 'fa',
                height: '70',
                allowedFileExtensions: ["jpg", "jpeg", "png", "gif"],
                @if($producto->imagen != '')
                    initialPreview: [
                        '<img src="/uploads/{{ $producto->imagen }}" class="file-preview-image img-responsive">'
                    ],
                    initialPreviewConfig: [
                        {
                            caption: '{{ $producto->imagen }}',
                            width: '120px',
                            url: "{{ route('productos.eliminar_imagen') }}", // server delete action
                            extra: {
                                producto_id: "{{ Hashids::encode($producto->id) }}"
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

             /*----------  Ficha ----------*/
            $("#ficha").fileinput({
                uploadUrl: "{{ route('productos.subir_ficha') }}",
                uploadAsync: true,
                maxFileCount: 1,
                language: 'es',
                showUpload: false,
                theme: 'fa',
                height: '70',
                allowedFileExtensions: ["pdf"],
                @if($producto->ficha != '')
                    initialPreview: [
                        '<embed src="/uploads/{{ $producto->ficha }}" class="w-100 h-100"/>'
                    ],
                    initialPreviewConfig: [
                        {
                            caption: '{{ $producto->ficha }}',
                            width: '120px',
                            url: "{{ route('productos.eliminar_ficha') }}", // server delete action
                            extra: {
                                producto_id: "{{ Hashids::encode($producto->id) }}"
                            }
                        }
                    ]
                @endif
            });
            $('#ficha').on("filebatchselected", function(event, files) {
                // trigger upload method immediately after files are selected
                $('.kv-file-upload').click();
            });
            $('#ficha').on('filedeleted', function(event, key, jqXHR, data) {
                $("#fichaImg").val("");
            });
            $('#ficha').on('fileuploaded', function(event, data, previewId, index) {
                var form = data.form,
                    files = data.files,
                    extra = data.extra,
                    response = data.response,
                    reader = data.reader;
                $("#fichaImg").val( data.response.ficha );
            });

            /*----------  Tabla Nutrimental ----------*/
            $("#tabla_nutrimental").fileinput({
                uploadUrl: "{{ route('productos.subir_tabla_nutrimental') }}",
                uploadAsync: true,
                maxFileCount: 1,
                language: 'es',
                showUpload: false,
                theme: 'fa',
                height: '70',
                allowedFileExtensions: ["pdf"],
                @if($producto->tabla_nutrimental != '')
                    initialPreview: [
                        '<embed src="/uploads/{{ $producto->tabla_nutrimental }}" class="w-100 h-100"/>'
                    ],
                    initialPreviewConfig: [
                        {
                            caption: '{{ $producto->tabla_nutrimental }}',
                            width: '120px',
                            url: "{{ route('productos.eliminar_tabla_nutrimental') }}", // server delete action
                            extra: {
                                producto_id: "{{ Hashids::encode($producto->id) }}"
                            }
                        }
                    ]
                @endif
            });
            $('#tabla_nutrimental').on("filebatchselected", function(event, files) {
                // trigger upload method immediately after files are selected
                $('.kv-file-upload').click();
            });
            $('#tabla_nutrimental').on('filedeleted', function(event, key, jqXHR, data) {
                $("#tabla_nutrimentalImg").val("");
            });
            $('#tabla_nutrimental').on('fileuploaded', function(event, data, previewId, index) {
                var form = data.form,
                    files = data.files,
                    extra = data.extra,
                    response = data.response,
                    reader = data.reader;
                $("#tabla_nutrimentalImg").val( data.response.tabla_nutrimental );
            });

            /*----------  Categorías  ----------*/
            $('#idioma').on('change', function(){
                let categoria_id = $(this).val();
                
                $.ajax({    
                    url: "{{ route('api.categorias', ['idioma_id' => '']) }}/"+categoria_id,
                    cache: false,
                    type: 'get',
                    dataType: 'json',
                    success: function(categorias){
                        let options = `<option value="">- Seleccione una categoría -</option>`;
                        $.each(categorias, function(key, categoria){
                            options += `<option value="${categoria.id}" ${ (categoria.id == {{ $producto->categoria_id}} ) ? 'selected' : '' }>${categoria.nombre}</option>`;
                        });

                        $("#categoria").html(options).trigger('change');
                    }
                });
            });
            $('#idioma').trigger('change');
        });
    </script>
    <x-ajax-form id="editarForm" titulo="Editar Producto" reload="1" />
@stop