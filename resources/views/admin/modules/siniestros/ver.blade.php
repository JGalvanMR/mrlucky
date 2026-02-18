@extends('admin.layouts.master')

@section('titulo', 'Detalle del siniestro')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Siniestros</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('siniestros') }}">Siniestros</a></li>
                    <li class="breadcrumb-item active">Ver</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            @include('admin.modules.siniestros.concluir')
            @if($siniestro->estatus == 'con')
                <a href="#." id="btn-cerrar" class="btn btn-danger btn-xs" data-url="{{ route('siniestros.cerrar', ['hash_id'=>Hashids::encode($siniestro->id)]) }}">
                    Cerrar siniestro <i class="fa fa-legal"></i>
                </a>
            @endif
            <a href="{{ route('siniestros.editar_form', ['hash_id'=>Hashids::encode($siniestro->id)]) }}" class="btn btn-primary btn-xs">
                Editar <i class="fa fa-pencil-square-o"></i>
            </a>
            <a href="{{ route('siniestros') }}" class="btn btn-warning btn-xs">
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
                                <h4 class="bg-primary text-white px-2 py-1">Siniestro</h4>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Número de siniestro</h5>
                                <p>
                                    {{ $siniestro->num_siniestro ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Fecha</h5>
                                <p>
                                    @if($siniestro->fecha)
                                        {{ date('d/m/Y', strtotime($siniestro->fecha)) }}
                                    @else
                                        --
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Lugar de arribo</h5>
                                <p>
                                    {{ $siniestro->lugar_arribo ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Ajustador</h5>
                                <p>
                                    {{ $siniestro->ajustador->nombre ?? '--' }} {{ $siniestro->ajustador->apellido_paterno ?? '' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Hora de arribo</h5>
                                <p>
                                    {{ $siniestro->hora_arribo ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Hora de retiro</h5>
                                <p>
                                    {{ $siniestro->hora_retiro ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Núm. pase atención en taller</h5>
                                <p>
                                    {{ $siniestro->pase_taller ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Núm. pase atención médica</h5>
                                <p>
                                    {{ $siniestro->pase_medico ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Estatus</h5>
                                <p>
                                    @switch($siniestro->estatus)
                                        @case('pro')
                                            <span class="label label-warning">Proceso</span>
                                            @break
                                        @case('con')
                                            <span class="label label-info">Siniestro concluído</span>
                                            @break
                                        @case('cer')
                                            <span class="label label-primary">Asunto concluído</span>
                                            @break
                                        @default
                                            --
                                    @endswitch
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Servicio de grúas</h5>
                                <p>
                                    @switch($siniestro->servicio_grua)
                                        @case('noa')
                                            No aplica
                                            @break
                                        @case('loc')
                                            Local
                                            @break
                                        @case('for')
                                            Foráneo
                                            @break
                                        @default
                                            --
                                    @endswitch
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Acuerdo en crucero</h5>
                                <p>
                                    @if($siniestro->acuerdo_crucero == '1')
                                        Sí
                                    @else
                                        No
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Taller</h5>
                                <p>
                                    {{ $siniestro->taller->alias ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Comentarios</h5>
                                <p>
                                    {!! $siniestro->comentarios ?? '--' !!}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Declaración del asegurado</h5>
                                <p>
                                    {!! $siniestro->declaracion_asegurado ?? '--' !!}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Declaración de tercero</h5>
                                <p>
                                    {!! $siniestro->declaracion_tercero ?? '--' !!}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Observaciones de ajustador</h5>
                                <p>
                                    {!! $siniestro->observaciones_ajustador ?? '--' !!}
                                </p>
                                <hr>
                            </div>


                            <div class="col-12 mt-3">
                                <h4 class="bg-primary text-white px-2 py-1">Póliza</h4>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Número de póliza</h5>
                                <p>
                                    @if($siniestro->poliza->num_poliza)
                                        <a href="{{ route('polizas.ver', ['hash_id'=>Hashids::encode($siniestro->poliza_id)]) }}" target="_blank" class="">
                                            {{ $siniestro->poliza->num_poliza }}
                                        </a>
                                    @else
                                        --
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Inicio Vigencia</h5>
                                <p>
                                    @if($siniestro->poliza->vigencia_inicio)
                                        {{ date('d/m/Y', strtotime($siniestro->poliza->vigencia_inicio)) }}
                                    @else
                                        --
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Fin Vigencia</h5>
                                <p>
                                    @if($siniestro->poliza->vigencia_fin)
                                        {{ date('d/m/Y', strtotime($siniestro->poliza->vigencia_fin)) }}
                                    @else
                                        --
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Vehículo</h5>
                                <p>
                                    {{ $siniestro->poliza->submarca->marca->nombre ?? '--' }} {{ $siniestro->poliza->submarca->nombre ?? '' }} {{ $siniestro->poliza->modelo ?? ''}} ({{ $siniestro->poliza->color ?? '' }})
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Modelo</h5>
                                <p>
                                    {{ $siniestro->poliza->modelo ?? '--' }} 
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Color</h5>
                                <p>
                                    {{ $siniestro->poliza->color ?? '' }}
                                </p>
                                <hr>
                            </div>

                            
                            <div class="col-12 mt-3">
                                <h4 class="bg-primary text-white px-2 py-1">Cliente</h4>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Nombre</h5>
                                <p>
                                    {{ $siniestro->poliza->cliente->nombre ?? '--' }} {{ $siniestro->poliza->cliente->apellido_paterno ?? '' }} {{ $siniestro->poliza->cliente->apellido_materno ?? '' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Fecha de nacimiento</h5>
                                <p>
                                    @if($siniestro->poliza->cliente->fecha_nacimiento)
                                        {{ date('d/m/Y', strtotime($siniestro->poliza->cliente->fecha_nacimiento)) }}
                                    @else
                                        --
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>RFC</h5>
                                <p>
                                    {{ $siniestro->poliza->cliente->rfc ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Correo</h5>
                                <p>
                                    {{ $siniestro->poliza->cliente->correo ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Teléfono</h5>
                                <p>
                                    {{ $siniestro->poliza->cliente->telefono ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>CURP</h5>
                                <p>
                                    {{ $siniestro->poliza->cliente->curp ?? '--' }}
                                </p>
                                <hr>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @include('admin.modules.siniestros.afectados')
        @include('admin.modules.siniestros.expedientes')
        @include('admin.modules.siniestros.imagenes-siniestro')
        @include('admin.modules.siniestros.imagenes-tercero')
        

    </div>


    @yield('modals')
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">
    <style>
        .label-btn{ cursor: pointer; }
    </style>
    @yield('partialsCSS')
@stop

@section('customJS')
    @parent    
    <x-validator />
    <x-select2 />
    
    <script>
        $(function(){

            $('body').on('click','#btn-cerrar',function(){
                var url = $(this).data('url');


                swal({
                    title: "Cerrar siniestro",
                    text: "¿Desea cerrar el siniestro?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, cerrar'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            cache: false,
                            type: 'post',
                            dataType: 'json',
                            success: function(res){
                                swal({
                                    title: res.titulo,
                                    text: res.msg,
                                    type: res.class,
                                    onClose: function(){
                                        location.reload();
                                    }
                                });
                            }
                        });
                    }
                });
                return false;
            });

        });
    </script> 
    @yield('partialsJS')
@stop