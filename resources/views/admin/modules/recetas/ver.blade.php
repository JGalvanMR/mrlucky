@extends('admin.layouts.master')

@section('titulo', 'Detalle de la receta')

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
                    <li class="breadcrumb-item active">Ver</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('recetas.editar_form', ['hash_id'=>Hashids::encode($receta->id)]) }}" class="btn btn-primary btn-xs">
                Editar <i class="fa fa-pencil-square-o"></i>
            </a>
            <a href="{{ route('recetas') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Datos generales</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <h5>Título</h5>
                                <p>
                                    {{ $receta->titulo ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Slug</h5>
                                <p>
                                    {{ $receta->slug ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Estatus</h5>
                                <p>
                                    @if($receta->activo == '1')
                                        <span class="label label-success">Activo</span>
                                    @else
                                        <span class="label label-warning">Inactivo</span>
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Fecha</h5>
                                <p>
                                    @if($receta->fecha)
                                        {{ date('d/m/Y', strtotime($receta->fecha)) }}
                                    @else
                                        --
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Orden</h5>
                                <p>
                                    {{ $receta->orden ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12">
                                <h5>Contenido</h5>
                                <p>
                                    {!! $receta->contenido ?? '--' !!}
                                </p>
                                <hr>
                            </div>

                            
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Ingredientes</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form id="agregarForm" action="{{ route('recetas.agregar_ingredientes') }}" method="post">
                                    <input type="hidden" name="receta_id" value="{{ $receta->id }}">
                                    <div class="form-group">
                                        <select name="ingredientes[]" class="form-control select2"  multiple>
                                            @php
                                                $ingredientesIds = $receta->ingredientes()->pluck('id')->toArray();
                                            @endphp
                                            <option value="">- Seleccione un ingrediente -</option>
                                            @foreach($ingredientes as $ingrediente)
                                                <option value="{{ $ingrediente->id }}" {{ (in_array($ingrediente->id, $ingredientesIds)) ? 'selected' : '' }}>{{ $ingrediente->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <small class="help-block with-errors"></small>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
           {{--  <div class="col-12 col-md-5">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Agregar Ingrediente</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <form id="agregarForm" action="{{ route('recetas.agregar_ingrediente') }}" method="post">
                                    <input type="hidden" name="receta_id" value="{{ $receta->id }}">
                                    <div class="form-group">
                                        <select name="ingrediente_id" class="form-control select2" data-error="*El ingrediente es requerido." required>
                                            <option value="">- Seleccione un ingrediente -</option>
                                            @foreach($ingredientes as $ingrediente)
                                                <option value="{{ $ingrediente->id }}">{{ $ingrediente->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <small class="help-block with-errors"></small>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg">Guardar</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div> --}}
        </div>



    </div>


    @yield('modals')
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">
    <style>
        .label-btn{ cursor: pointer; }
        .select2-container--default .select2-selection--multiple .select2-selection__choice{ background-color: #0D2AAD; color: #fff; border-color: #0D2AAD; }
        .select2-container--default .select2-results__option[aria-selected=true]{ background-color: #0D2AAD; color: #fff; }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{ color: #fff; }
    </style>

@stop

@section('customJS')
    @parent    
    <x-select2 />
    <x-validator />
    <x-ajax-form id="agregarForm" titulo="Agregar Ingrediente" reload="1" />
    
    <script>
        $(function(){

        });
    </script> 
@stop