@extends('admin.layouts.master')

@section('titulo', 'Detalle de la asistencia')

@section('page')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Asistencias</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('asistencias') }}">Asistencias</a></li>
                    <li class="breadcrumb-item active">Ver</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('asistencias.editar_form', ['hash_id'=>Hashids::encode($asistencia->id)]) }}" class="btn btn-primary btn-xs">
                Editar <i class="fa fa-pencil-square-o"></i>
            </a>
            <a href="{{ route('asistencias') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Datos Generales</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <h5>Folio</h5>
                                <p>
                                    {{ $asistencia->folio ?? '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Tipo</h5>
                                <p>
                                    @if($asistencia->tipo == 'ase')
                                        Asegurado
                                    @else
                                        Particular
                                    @endif
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Fecha</h5>
                                <p>
                                    {{ ($asistencia->fecha) ? date('d/m/Y', strtotime($asistencia->fecha)) : '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Tipo de asistencia</h5>
                                <p>
                                    @switch($asistencia->tipo_asistencia)
                                        @case('gas')
                                            Gasolina
                                            @break
                                        @case('cam')
                                            Cambio de llanta
                                            @break
                                        @case('pas')
                                            Paso de corriente
                                            @break
                                        @case('gru')
                                            Grúa
                                            @break
                                        @case('aju')
                                            Ajustador
                                            @break
                                        @case('cer')
                                            Cerrajero
                                            @break
                                        @default
                                            --
                                    @endswitch
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Hora de arribo</h5>
                                <p>
                                    {{ ($asistencia->hora_arribo) ? date('H:m', strtotime($asistencia->hora_arribo)) : '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Hora de retiro</h5>
                                <p>
                                    {{ ($asistencia->hora_retiro) ? date('H:m', strtotime($asistencia->hora_retiro)) : '--' }}
                                </p>
                                <hr>
                            </div>
                            <div class="col-12 col-md-4">
                                <h5>Estatus</h5>
                                <p>
                                    @if($asistencia->estatus == '1')
                                        <span class="label label-success">Terminado</span>
                                    @else
                                        <span class="label label-warning">Proceso</span>
                                    @endif
                                </p>
                                <hr>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="m-t-10 m-b-10 text-right">
            <a href="#." class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalAgregarImagenes">
                Agregar <i class="fa fa-plus-circle"></i>
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Imágenes de la Asistencia</h4>
                    </div>
                    <div class="card-body">
                        
                        <div class="row">
                            @forelse($asistencia->imagenes as $imagen)
                                <div class="col-12 col-md-4 my-4">
                                    <div style="border: dashed 1px; padding: 10px;" class="h-100 d-flex align-items-center justify-content-center">
                                        <div>
                                            <img src="/uploads/{{ $imagen->imagen }}" class="img-fluid" loading="lazy" alt="">   
                                        </div>
                                    </div>
                                    <div class="actions pt-1 text-right">
                                        <x-btn-eliminar titulo="Eliminar imagen" url="{{ route('asistencias.eliminar_imagen', ['hash_id'=>Hashids::encode($imagen->id)]) }}" scripts="{{ $loop->first }}" btn="1" />
                                    </div>
                                </div>  
                            @empty
                                <div class="col-12">
                                    <h5>No se encontraron imágenes.</h5>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Modal Agregar Fotos --}}
    <div class="modal fade" id="modalAgregarImagenes" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Agregar Imágenes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarImagenes" action="{{ route('asistencias.agregar_imagen') }}" data-focus="false" data-disable="false">
                        <input type="hidden" name="asistencia_id" value="{{ $asistencia->id }}">
                        <div class="form-group mb-2">
                            <label for="">Imágenes</label>
                            <x-file-input name="imagen" route="{{ route('uploads_subir') }}" folder="asistencias/{{ $asistencia->id }}" filecount="50" scripts="1" />
                        </div>
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Agregar</button>
                        </div>
                    </form>
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
    
    <script>
        $(function(){

        });
    </script>
    <x-ajax-form id="formAgregarImagenes" titulo="Agregar Imágenes" reload="1" /> 
    @yield('partialsJS')
@stop