@extends('admin.layouts.master')

@section('titulo', 'Agregar receta')

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
                    <li class="breadcrumb-item active">Agregar</li>
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
                        <h4 class="m-b-0 text-white">Agregar Receta</h4>
                    </div>
                    <div class="card-body">
                        <form id="agregarForm" action="{{ route('recetas.agregar') }}" class="form-horizontal form-bordered m-t-40">
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
                                    <label class="control-label text-md-right col-md-3">Imagen</label>
                                    <div class="col-md-7">
                                        <x-file-input name="imagen" route="{{ route('uploads_subir') }}" folder="recetas/imagenes" filecount="1" scripts="1" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Tiempo (min.)</label>
                                    <div class="col-md-7">
                                        <input type="number" name="tiempo" class="form-control">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Cocción (min.)</label>
                                    <div class="col-md-7">
                                        <input type="number" name="coccion" class="form-control">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Porciones</label>
                                    <div class="col-md-7">
                                        <input type="number" name="porciones" class="form-control">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Ingredientes</label>
                                    <div class="col-md-7">
                                        <x-summer-note name="ingredientes" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Procedimiento</label>
                                    <div class="col-md-7">
                                        <x-summer-note name="contenido" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
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
                    url: "{{ route('api.categorias_recetas', ['idioma_id' => '']) }}/"+categoria_id,
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
    <x-ajax-form id="agregarForm" titulo="Agregar Receta" reload="1" />
@stop