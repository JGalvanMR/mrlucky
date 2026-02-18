@extends('admin.layouts.master')

@section('titulo', 'Agregar categoría receta')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Categorías Recetas</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('categorias_recetas') }}">Categorías Recetas</a></li>
                    <li class="breadcrumb-item active">Agregar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('categorias_recetas') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Agregar Categoría</h4>
                    </div>
                    <div class="card-body">
                        <form id="agregarForm" action="{{ route('categorias_recetas.agregar') }}" class="form-horizontal form-bordered m-t-40">
                            <input type="hidden" name="orden" value="99">
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Idioma</label>
                                    <div class="col-md-7">
                                        <select name="idioma_id" class="form-control select2" data-error="*Su nombre es requerido." required>
                                            @foreach($idiomas as $idioma)
                                                <option value="{{ $idioma->id }}">{{ $idioma->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Nombre</label>
                                    <div class="col-md-7">
                                        <input type="text" name="nombre" class="form-control" data-error="*La pregunta es requerida." required>
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

            
        });
    </script>
    <x-ajax-form id="agregarForm" titulo="Agregar Categoría" reload="1" />
@stop