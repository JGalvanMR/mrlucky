@extends('admin.layouts.master')

@section('titulo', 'Editar Asistencia')

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
                    <li class="breadcrumb-item active">Editar</li>
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
                        <h4 class="m-b-0 text-white">Editar Asistencia</h4>
                    </div>
                    <div class="card-body">
                        <form id="editarForm" action="{{ route('asistencias.editar', ['hash_id'=>Hashids::encode($asistencia->id)]) }}" class="form-horizontal form-bordered m-t-40">
                            {{-- <input type="hidden" name="orden" value="99"> --}}
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Folio</label>
                                    <div class="col-md-7">
                                        <input type="text" name="folio" class="form-control" value="{{ $asistencia->folio }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Tipo</label>
                                    <div class="col-md-7">
                                        <select id="tipo" name="tipo" class="form-control select2" data-error="*El tipo es requerido." required>
                                            <option value="">- Seleccione el tipo de asistencia -</option>
                                            <option value="ase" {{ ($asistencia->tipo == 'ase') ? 'selected' : '' }}>Asegurado</option>
                                            <option value="par" {{ ($asistencia->tipo == 'par') ? 'selected' : '' }}>Particular</option>
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
                                                <option value="{{ $poliza->id }}" {{ ($poliza->id == $asistencia->poliza_id) ? 'selected' : '' }}>{{ $poliza->num_poliza }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Fecha</label>
                                    <div class="col-md-7">
                                        <x-date name="fecha" value="{{ $asistencia->fecha }}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Tipo de asistencia</label>
                                    <div class="col-md-7">
                                        <select name="tipo_asistencia" class="form-control select2" data-error="Seleccione un tipo de asistencia." required>
                                           <option value="gas" {{ ($asistencia->tipo_asistencia == 'gas') ? 'selected' : '' }}>Gasolina</option>
                                           <option value="cam" {{ ($asistencia->tipo_asistencia == 'cam') ? 'selected' : '' }}>Cambio llanta</option>
                                           <option value="pas" {{ ($asistencia->tipo_asistencia == 'pas') ? 'selected' : '' }}>Paso de corriente</option>
                                           <option value="gru" {{ ($asistencia->tipo_asistencia == 'gru') ? 'selected' : '' }}>Grúa</option>
                                           <option value="aju" {{ ($asistencia->tipo_asistencia == 'aju') ? 'selected' : '' }}>Ajustador</option>
                                           <option value="cer" {{ ($asistencia->tipo_asistencia == 'cer') ? 'selected' : '' }}>Cerrajero</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Hora de arribo</label>
                                    <div class="col-md-7">
                                        <div class="input-group clockpicker">
                                            <input type="text" name="hora_arribo" value="{{ $asistencia->hora_arribo }}" class="form-control hora"> 
                                            <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Hora de retiro</label>
                                    <div class="col-md-7">
                                        <div class="input-group clockpicker">
                                            <input type="text" name="hora_retiro" value="{{ $asistencia->hora_retiro }}" class="form-control hora"> 
                                            <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Estatus</label>
                                    <div class="col-md-7">
                                        <x-bootstrap-toggle name="estatus" onText="Terminado" offText="Proceso" checked="{{ $asistencia->estatus }}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-7">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg disabled">
                                            Guardar
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
            $('#tipo').change();

             /*----------  Hora  ----------*/
            $('.hora').clockpicker({
                placement: 'bottom',
                align: 'left',
                autoclose: true,
                'default': 'now'
            });

        });
    </script>
    <x-ajax-form id="editarForm" titulo="Editar Asistencia" reload="1" />
@stop