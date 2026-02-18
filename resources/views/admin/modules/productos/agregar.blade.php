@extends('admin.layouts.master')

@section('titulo', 'Agregar producto')

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
                    <li class="breadcrumb-item active">Agregar</li>
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
                        <h4 class="m-b-0 text-white">Agregar Producto</h4>
                    </div>
                    <div class="card-body">
                        <form id="agregarForm" action="{{ route('productos.agregar') }}" class="form-horizontal form-bordered m-t-40">
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Idioma</label>
                                    <div class="col-md-7">
                                        <select id="idioma" name="idioma_id" class="form-control select2" data-error="*El idioma es requerido." required>
                                            <option value="">- Seleccione un idioma -</option>
                                            @foreach($idiomas as $idioma)
                                                <option value="{{ $idioma->id }}">{{ $idioma->nombre }}</option>
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
                                        <input type="text" name="titulo" class="form-control" data-error="*El título es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Slug</label>
                                    <div class="col-md-7">
                                        <x-slugify name="slug" slug="" titulo="titulo" requerido="1" requeridoText="*El Slug es requerido." />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Banner</label>
                                    <div class="col-md-7">
                                        <x-file-input name="imagen" route="{{ route('uploads_subir') }}" folder="productos/imagenes" filecount="1" scripts="1" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Descripción</label>
                                    <div class="col-md-7">
                                        <x-summer-note name="descripcion" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Estatus</label>
                                    <div class="col-md-7">
                                        <x-bootstrap-toggle name="activo" onText="Activo" offText="Inactivo" checked="1" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-7">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg disabled">
                                            Agregar
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

@stop

@section('customJS')
    @parent
    <x-validator />
    <x-select2 />
    

    <script>
        $(function(){

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
                            options += `<option value="${categoria.id}">${categoria.nombre}</option>`;
                        });

                        $("#categoria").html(options).trigger('change');
                    }
                });
            });
        });
    </script>
    <x-ajax-form id="agregarForm" titulo="Agregar Producto" reload="1" />
@stop