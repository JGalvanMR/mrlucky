@extends('admin.layouts.master')

@section('titulo', 'Detalle del producto')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Producto</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('productos') }}">Productos</a></li>
                    <li class="breadcrumb-item active">Ver</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('productos.editar_form', ['hash_id'=>Hashids::encode($producto->id)]) }}" class="btn btn-primary btn-xs">
                Editar <i class="fa fa-pencil-square-o"></i>
            </a>
            <a href="{{ route('productos') }}" class="btn btn-warning btn-xs">
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
                                    {{ $producto->titulo ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Slug</h5>
                                <p>
                                    {{ $producto->slug ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Estatus</h5>
                                <p>
                                    @if($producto->activo == '1')
                                        <span class="label label-success">Activo</span>
                                    @else
                                        <span class="label label-warning">Inactivo</span>
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12">
                                <h5>Descripción</h5>
                                <p>
                                    {!! $producto->descripcion ?? '--' !!}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12">
                                <h5>Nutrición</h5>
                                <p>
                                    {!! $producto->nutricion ?? '--' !!}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12">
                                <h5>Usos</h5>
                                <p>
                                    {!! $producto->usos ?? '--' !!}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12">
                                <h5>Conservación</h5>
                                <p>
                                    {!! $producto->conservacion ?? '--' !!}
                                </p>
                                <hr>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @includeIf('admin.modules.productos._imagenes')

    </div>


    @yield('modals')
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">
    <style>
        .label-btn{ cursor: pointer; }
        .imagen h3{ font-weight: 600; margin:0; }
        .imagen{ cursor: move; }
        .imagen:hover{ background-color: #E9ECEF; }
        .ghost{ opacity: 0; }
        .current{ background-color: #00ADBA !important; opacity: .5 !important; }
        .select2-container--default .select2-selection--multiple .select2-selection__choice{
            background-color: #58CDD1 !important; border-color: #58CDD1 !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{ color: #fff !important; }
    </style>
    @yield('partialsCSS')

@stop

@section('customJS')
    @parent    
    <script src="https://unpkg.com/sortablejs-make/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
    <x-validator />
    <script>
        $(function(){

        });
    </script> 

    @yield('partialsJS')
@stop