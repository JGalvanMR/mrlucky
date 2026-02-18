@extends('admin.layouts.master')

@section('titulo', 'Ver vigencia')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Vigencias</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('vigencias') }}">Vigencias</a></li>
                    <li class="breadcrumb-item active">Ver</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('vigencias.agregar_form') }}" class="btn btn-success btn-xs">
                Agregar <i class="fa fa-plus-circle"></i>
            </a>
            
            @include('admin.modules.vigencias.editar')

            <a href="{{ route('vigencias') }}" class="btn btn-warning btn-xs">
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
                            <div class="col-12">
                                <h4 class="bg-primary text-white px-2 py-1">Información de la póliza</h4>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Póliza</h5>
                                <p>
                                    {{ $vigencia->poliza->num_poliza ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Fecha de inicio <small data-toggle="tooltip" title="Inicio de la vigencia a partir de las 12:00 hrs.">[?]</small></h5>
                                <p>
                                    @if($vigencia->fecha_inicio)
                                        {{ date('d/m/Y', strtotime($vigencia->fecha_inicio)) }}
                                    @else
                                        --
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Fecha de fin <small data-toggle="tooltip" title="Día que finaliza la vigencia a las 12:00 hrs.">[?]</small></h5>
                                <p>
                                    @if($vigencia->fecha_fin)
                                        {{ date('d/m/Y', strtotime($vigencia->fecha_fin)) }}
                                    @else
                                        --
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Monto</h5>
                                <p>
                                    @if($vigencia->monto)
                                        ${{ number_format($vigencia->monto,2) }}
                                    @else
                                        --
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Estatus</h5>
                                <p>
                                    @switch($vigencia->estatus)
                                        @case('pen')
                                            <span class="label label-warning">Pendiente</span>
                                            @break
                                        @case('ven')
                                            <span class="label label-danger">Vencida</span>
                                            @break
                                        @case('can')
                                            <span class="label label-inverse">Cancelada</span>
                                            @break
                                        @case('act')
                                            <span class="label label-success">Activa</span>
                                            @break
                                    @endswitch                              
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Fecha de vencimiento <small data-toggle="tooltip" title="Fecha límite de pago">[?]</small></h5>
                                <p>
                                    @if($vigencia->fecha_vencimiento)
                                        {{ date('d/m/Y', strtotime($vigencia->fecha_vencimiento)) }}
                                    @else
                                        --
                                    @endif
                                </p>
                                <hr>
                            </div>

                            <div class="mt-3 col-12 text-right">
                                
                                @include('admin.modules.vigencias.pagos')

                            </div>

                            <div class="col-12">
                                
                                @if($vigencia->pagos->count())
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <h4 class="p-2 bg-primary text-white">Pagos</h4>
                                            <div class="pagos">
                                                @foreach($vigencia->pagos as $pago)
                                                    <div class="row my-3 py-2" style="border-bottom: dashed 1px #E25C33;">
                                                        <div class="col-12 col-md-3">
                                                            <p>
                                                                <h5>Monto</h5>
                                                                ${{ number_format($pago->monto,2) }}
                                                            </p>
                                                            <hr>
                                                        </div>
                                                        <div class="col-12 col-md-3">
                                                            <p>
                                                                <h5>Fecha de pago</h5>
                                                                {{ date('d/m/Y', strtotime($pago->fecha_pago)) }}
                                                            </p>
                                                            <hr>
                                                        </div>
                                                        <div class="col-12 col-md-3">
                                                            <p>
                                                                <h5>Método de pago</h5>
                                                                @switch($pago->metodo_pago)
                                                                    @case('efe')
                                                                        Efectivo
                                                                        @break
                                                                    @case('dep')
                                                                        Depósito
                                                                        @break
                                                                    @case('tra')
                                                                        Transferencia
                                                                        @break
                                                                    @case('tar')
                                                                        Tarjéta de Débito/Crédito
                                                                        @break
                                                                @endswitch
                                                            </p>
                                                            <hr>
                                                        </div>
                                                        <div class="col-12 col-md-3">
                                                            <p>
                                                                <h5>Estatus</h5>
                                                                @switch($pago->estatus)
                                                                    @case('pen')
                                                                        <span class="label label-warning">Pendiente</span>
                                                                        @break
                                                                    @case('con')
                                                                        <span class="label label-success">Confirmado</span>
                                                                        @break
                                                                    @case('can')
                                                                        <span class="label label-danger">Cancelado</span>
                                                                        @break
                                                                @endswitch
                                                            </p>
                                                            <hr>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <p>
                                                                <h5>Comentario</h5>
                                                                {!! $pago->comentario ?? '--' !!}
                                                            </p>
                                                            <hr>
                                                        </div>
                                                        <div class="col-12 col-md-3">
                                                            <p>
                                                                <h5>Comprobante</h5>
                                                                @if($pago->comprobante)
                                                                    <a href="/uploads/{{ $pago->comprobante }}" class="btn btn-success btn-xs magnificImg">
                                                                        <i class="fa fa-file-image-o"></i>
                                                                    </a>
                                                                @else
                                                                    --
                                                                @endif
                                                            </p>
                                                            <hr>
                                                        </div>
                                                        <div class="col-12 col-md-3">
                                                            <p>
                                                                <h5>Acciones</h5>

                                                                @include('admin.modules.vigencias.editar-pago')
                                                                
                                                                @if($pago->estatus == 'con')
                                                                    <a href="{{ route('pagos.imprimir', ['hash_id'=>Hashids::encode($pago->id)]) }}" class="btn btn-xs btn-info" data-toggle="tooltip" title="Imprimir recibo" target="_blank"><i class="fa fa-print"></i></a>
                                                                @endif

                                                                <x-btn-eliminar titulo="Eliminar Pago" url="{{ route('pagos.eliminar', ['hash_id'=>Hashids::encode($pago->id)]) }}" scripts="{{ $loop->first }}" btn="1" />


                                                            </p>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>


                            {{-- @if($vigencia->facturas->count())
                            <div class="row mt-5">
                                <div class="col-12">
                                    <h4 class="p-2 bg-primary text-white">Facturas</h4>
                                    <div class="pagos">
                                        @foreach($vigencia->facturas as $factura)
                                            <div class="row m-3 pt-2 pb-2" style="border-bottom: dashed 1px #E25C33;">
                                                <div class="col-12 col-md-3">
                                                    <p>
                                                        <h5>Acciones</h5>
                                                        
                                                    <hr>
                                                </div>
                                                @if($factura->pdf)
                                                    <div class="col-12 col-md-3">
                                                        <p>
                                                            <h5>Factura PDF</h5>
                                                                <a href="/uploads/{{ $factura->pdf }}" class="btn btn-info btn-sm" download="{{ $factura->pdf }}">Descargar PDF <i class="fa fa-download"></i></a>
                                                        </p>
                                                        <hr>
                                                    </div>
                                                @endif
                                                @if($factura->xml)
                                                    <div class="col-12 col-md-3">
                                                        <p>
                                                            <h5>Factura XML</h5>
                                                                <a href="/uploads/{{ $factura->xml }}" class="btn btn-info btn-sm" download="{{ $factura->xml }}">Descargar XML <i class="fa fa-download"></i></a>
                                                        </p>
                                                        <hr>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif --}}

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
        .slide{
            cursor: move;
        }
        .slide:hover{
            background-color: #E9ECEF;
        }
        .ghost{
            opacity: 0;
        }
        .current{
            background-color: #00ADBA !important;
            opacity: .5 !important;
        }
    </style>
    @yield('partialsCSS')
@stop

@section('customJS')
    @parent
    <x-validator />
    <x-select2 />
    <script src="https://unpkg.com/sortablejs-make/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
    <script>
        $(function(){


        });
    </script>

    @yield('partialsJS')
@stop