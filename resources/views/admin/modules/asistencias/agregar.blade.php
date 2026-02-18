@extends('admin.layouts.master')

@section('titulo', 'Agregar Asistencia')

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
                    <li class="breadcrumb-item active">Agregar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('asistencias') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Agregar Asistencia</h4>
                    </div>
                    <div class="card-body">
                        <form id="agregarForm" action="{{ route('asistencias.agregar') }}" class="form-horizontal form-bordered m-t-40">
                            {{-- <input type="hidden" name="orden" value="99"> --}}
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Tipo</label>
                                    <div class="col-md-7">
                                        <select id="tipo" name="tipo" class="form-control select2" data-error="*El tipo es requerido." required>
                                            <option value="">- Seleccione el tipo de asistencia -</option>
                                            <option value="ase">Asegurado</option>
                                            <option value="par">Particular</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div id="polizasContainer" class="form-group row d-none">
                                    <label class="control-label text-md-right col-md-3">*Póliza</label>
                                    <div class="col-md-7">
                                        <select name="poliza_id" class="form-control select2">
                                            <option value="">- Seleccione una póliza -</option>
                                            @foreach($polizas as $poliza)
                                                <option value="{{ $poliza->id }}">{{ $poliza->num_poliza }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Fecha</label>
                                    <div class="col-md-7">
                                        <x-date name="fecha" value="{{ date('Y-m-d') }}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Tipo de asistencia</label>
                                    <div class="col-md-7">
                                        <select name="tipo_asistencia" class="form-control select2" data-error="Seleccione un tipo de asistencia." required>
                                           <option value="gas">Gasolina</option>
                                           <option value="cam">Cambio llanta</option>
                                           <option value="pas">Paso de corriente</option>
                                           <option value="gru">Grúa</option>
                                           <option value="aju">Ajustador</option>
                                           <option value="cer">Cerrajero</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Hora de arribo</label>
                                    <div class="col-md-7">
                                        <div class="input-group clockpicker">
                                            <input type="text" name="hora_arribo" value="" class="form-control hora"> 
                                            <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Hora de retiro</label>
                                    <div class="col-md-7">
                                        <div class="input-group clockpicker">
                                            <input type="text" name="hora_retiro" value="" class="form-control hora"> 
                                            <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                        </div>
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
    <x-select2 />
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">
    <link rel="stylesheet" href="/admin/assets/plugins/clockpicker/dist/jquery-clockpicker.min.css">
@stop

@section('customJS')
    @parent
    <script src="/admin/assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <x-validator />
    

    <script>
        $(function(){

            /*----------  Tipo de póliza  ----------*/
            $('#tipo').on('change', function(){
                let tipo = $(this).val();

                if(tipo == 'ase'){
                    $('#polizasContainer').removeClass('d-none');
                }else{
                    $('#polizasContainer').addClass('d-none');
                }
            });

             /*----------  Hora  ----------*/
            $('.hora').clockpicker({
                placement: 'bottom',
                align: 'left',
                autoclose: true,
                'default': 'now'
            });

        });
    </script>
    <x-ajax-form id="agregarForm" titulo="Agregar Asistencia" reload="1" />
@stop