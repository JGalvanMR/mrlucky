@extends('admin.layouts.master')

@section('titulo', 'Detalle del cliente')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Clientes</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('clientes') }}">Clientes</a></li>
                    <li class="breadcrumb-item active">Ver</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('clientes.editar_form', ['hash_id'=>Hashids::encode($cliente->id)]) }}" class="btn btn-primary btn-xs">
                Editar <i class="fa fa-pencil-square-o"></i>
            </a>
            <a href="{{ route('clientes') }}" class="btn btn-warning btn-xs">
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
                                <h5>Nombre</h5>
                                <p>
                                    {{ $cliente->nombre ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Apellido paterno</h5>
                                <p>
                                    {{ $cliente->apellido_paterno ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Apellido materno</h5>
                                <p>
                                    {{ $cliente->apellido_materno ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>RFC</h5>
                                <p>
                                    {{ $cliente->rfc ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>CURP</h5>
                                <p>
                                    {{ $cliente->curp ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Género</h5>
                                <p>
                                    @if($cliente->genero == 'h')
                                        Hombre
                                    @else
                                        Mujer
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Dirección</h5>
                                <p>
                                    {{ $cliente->direccion ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Colonia</h5>
                                <p>
                                    {{ $cliente->colonia ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Código postal</h5>
                                <p>
                                    {{ $cliente->codigo_postal ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Ciudad</h5>
                                <p>
                                    {{ $cliente->ciudad->ciudad ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Estado</h5>
                                <p>
                                    {{ $cliente->ciudad->estado->estado ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Asesor</h5>
                                <p>
                                    {{ $cliente->asesor->name ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Foto</h5>
                                <p>
                                    @include('admin.modules.clientes.foto') 
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>INE Frontal</h5>
                                <p>
                                    @include('admin.modules.clientes.ine-frontal') 
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>INE Reverso</h5>
                                <p>
                                    @include('admin.modules.clientes.ine-reverso')
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
    <x-validator />
    <x-select2 />
    
    <script>
        $(function(){

        });
    </script> 
    @yield('partialsJS')
@stop