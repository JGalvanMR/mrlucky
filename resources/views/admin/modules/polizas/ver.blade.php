@extends('admin.layouts.master')

@section('titulo', 'Detalle de la póliza')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Pólizas</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('polizas') }}">Pólizas</a></li>
                    <li class="breadcrumb-item active">Detalle</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            
            <a href="{{ route('polizas.imprimir', ["hash_id"=>Hashids::encode($poliza->id)]) }}" class="btn btn-info btn-xs" data-toggle="tooltip" title="Imprimir" target="_blank">
                Imprimir <i class="fa fa-print"></i>
            </a>

            <a href="{{ route('polizas.agregar_form') }}" class="btn btn-success btn-xs">
                Agregar <i class="fa fa-plus-circle"></i>
            </a>
            <a href="{{ route('polizas.editar_form', ['hash_id'=>Hashids::encode($poliza->id)]) }}" class="btn btn-primary btn-xs">
                Editar <i class="fa fa-pencil-square-o"></i>
            </a>
            <a href="{{ route('polizas') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Información General</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            {{-- Póliza --}}
                            <div class="col-12">
                                <h4 class="bg-primary text-white px-2 py-1">Información de la póliza</h4>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Núm. de Póliza</h5>
                                <p>
                                    {{ $poliza->num_poliza ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Inicio Vigencia</h5>
                                <p>
                                    @if($poliza->vigencia_inicio)
                                        {{ date('d/m/Y', strtotime($poliza->vigencia_inicio)) }} 12:00 hrs.
                                    @else
                                        --
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Fin Vigencia</h5>
                                <p>
                                    @if($poliza->vigencia_fin)
                                        {{ date('d/m/Y', strtotime($poliza->vigencia_fin)) }} 12:00 hrs.
                                    @else
                                        --
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Estatus</h5>
                                <p>
                                    @if($poliza->estatus == 'act')
                                        <span class="label label-success">Activa</span>
                                    @else
                                        <span class="label label-success">Inactiva</span>
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Tipo de póliza</h5>
                                <p>
                                    @switch($poliza->tipo)
                                        @case('anu')
                                            Anual
                                            @break
                                        @case('sem')
                                            Semestral
                                            @break
                                        @case('tri')
                                            Trimestral
                                            @break
                                        @case('men')
                                            Mensual
                                            @break
                                        @default
                                            --
                                    @endswitch
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Cobertura</h5>
                                <p>
                                    @switch($poliza->cobertura)
                                        @case('1')
                                            Cobertura Amplia
                                            @break
                                        @case('2')
                                            Cobertura Intermedia
                                            @break
                                        @case('3')
                                            Cobertura Intermedia Tipo A
                                            @break
                                        @case('4')
                                            Cobertura Intermedia Tipo B
                                            @break
                                        @case('5')
                                            Cobertura Intermedia Tipo C
                                            @break
                                        @default
                                            --
                                    @endswitch
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Asesor</h5>
                                <p>
                                    --
                                </p>
                                <hr>
                            </div>
                            

                            {{-- Titular --}}
                            <div class="col-12 mt-3">
                                <h4 class="bg-primary text-white px-2 py-1">Datos del titular</h4>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Nombre</h5>
                                <p>
                                    {{ $poliza->cliente->nombre ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Apellido Paterno</h5>
                                <p>
                                    {{ $poliza->cliente->apellido_paterno ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Apellido Materno</h5>
                                <p>
                                    {{ $poliza->cliente->apellido_materno ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Fecha de nacimiento</h5>
                                <p>
                                    @if($poliza->cliente->fecha_nacimiento)
                                        {{ date('d/m/Y', strtotime($poliza->cliente->fecha_nacimiento)) }}
                                    @else
                                        --
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Género</h5>
                                <p>
                                    @if($poliza->cliente->genero == 'h')
                                        Hombre
                                    @else
                                        Mujer
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>RFC</h5>
                                <p>
                                    {{ $poliza->cliente->rfc ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>CURP</h5>
                                <p>
                                    {{ $poliza->cliente->curp ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Correo</h5>
                                <p>
                                    {{ $poliza->cliente->correo ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Teléfono</h5>
                                <p>
                                    {{ $poliza->cliente->telefono ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Dirección</h5>
                                <p>
                                    {{ $poliza->cliente->direccion ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Colonia</h5>
                                <p>
                                    {{ $poliza->cliente->colonia ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Código Postal</h5>
                                <p>
                                    {{ $poliza->cliente->codigo_postal ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Ciudad</h5>
                                <p>
                                    {{ $poliza->cliente->ciudad->ciudad.',' ?? '--' }} {{ $poliza->cliente->ciudad->estado->estado ?? '' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Acciones</h5>
                                <a href="{{ route('clientes.ver', ['hash_id'=>Hashids::encode($poliza->cliente_id)]) }}" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Ver" target="_blank">
                                    Ver <i class="fa fa-eye"></i> 
                                </a>
                                <a href="{{ route('clientes.editar', ['hash_id'=>Hashids::encode($poliza->cliente_id)]) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Editar" target="_blank">
                                    Editar <i class="fa fa-pencil-square-o"></i>
                                </a>
                                <hr>
                            </div>

                            {{-- Vehículo --}}
                            <div class="col-12 mt-3">
                                <h4 class="bg-primary text-white px-2 py-1">Vehículo asegurado</h4>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Marca</h5>
                                <p>
                                    {{ $poliza->submarca->marca->nombre ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Marca</h5>
                                <p>
                                    {{ $poliza->submarca->nombre ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Modelo</h5>
                                <p>
                                    {{ $poliza->modelo ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Color</h5>
                                <p>
                                    {{ $poliza->color ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Placas</h5>
                                <p>
                                    {{ $poliza->placas ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Capacidad</h5>
                                <p>
                                    {{ $poliza->capacidad ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Núm. de serie</h5>
                                <p>
                                    {{ $poliza->num_serie ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Núm. de motor</h5>
                                <p>
                                    {{ $poliza->num_motor ?? '--' }}
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.modules.polizas.imagenes')
        @include('admin.modules.polizas.choferes')
    </div>

    @yield('modals')
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">

@stop

@section('customJS')
    @parent
    <x-validator />
    <script>
        $(function(){

        });
    </script>

    @yield('partialsJS')
@stop
