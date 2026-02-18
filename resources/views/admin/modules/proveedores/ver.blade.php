@extends('admin.layouts.master')

@section('titulo', 'Detalle del proveedor')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Proveedor</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('proveedores') }}">Proveedores</a></li>
                    <li class="breadcrumb-item active">Ver</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('proveedores.editar_form', ['hash_id'=>Hashids::encode($proveedor->id)]) }}" class="btn btn-primary btn-xs">
                Editar <i class="fa fa-pencil-square-o"></i>
            </a>
            <a href="{{ route('proveedores') }}" class="btn btn-warning btn-xs">
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
                                <h5>RFC</h5>
                                <p>
                                    {{ $proveedor->rfc ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Razón Social</h5>
                                <p>
                                    {{ $proveedor->razon_social ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Alias</h5>
                                <p>
                                    {{ $proveedor->alias ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Tipo</h5>
                                <p>
                                    @switch($proveedor->tipo)
                                        @case('tal')
                                            Taller
                                            @break
                                        @case('ref')
                                            Refaccionaria
                                            @break
                                        @case('gru')
                                            Grúa
                                            @break
                                        @default
                                            --
                                    @endswitch
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Estatus</h5>
                                <p>
                                    @if($proveedor->activo)
                                        <span class="label label-success">Activo</span>
                                    @else
                                        <span class="label label-warning">Inactivo</span>
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Ciudad</h5>
                                <p>
                                    {{ $proveedor->ciudad->ciudad ?? '--' }}, {{ $proveedor->ciudad->estado->estado ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


    @yield('modals')
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">
    <style>
        .label-btn{ cursor: pointer; }
    </style>

@stop

@section('customJS')
    @parent    

    
    <script>
        $(function(){

        });
    </script> 
    @yield('partialsJS')
@stop