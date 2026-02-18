@extends('admin.layouts.master')

@section('titulo', 'Editar siniestro')

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
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('siniestros.ver', ['hash_id'=>Hashids::encode($siniestro->id)]) }}" class="btn btn-warning btn-xs">
                Ver <i class="fa fa-eye"></i>
            </a>
            <a href="{{ route('siniestros') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Editar Siniestro</h4>
                    </div>
                    <div class="card-body">
                        <form id="editarForm" action="{{ route('siniestros.editar', ['hash_id'=>Hashids::encode($siniestro->id)]) }}" class="form-horizontal form-bordered m-t-40">
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Núm. de siniestro</label>
                                    <div class="col-md-7">
                                        <input type="text" name="num_siniestro" class="form-control" value="{{ $siniestro->num_siniestro }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Póliza</label>
                                    <div class="col-md-7">
                                        <select name="poliza_id" class="form-control select2">
                                            <option value="">- Seleccione una póliza -</option>
                                            @foreach($polizas as $poliza)
                                                <option value="{{ $poliza->id }}" {{ ($poliza->id == $siniestro->poliza_id) ? 'selected' : '' }}>{{ $poliza->num_poliza }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Fecha</label>
                                    <div class="col-md-7">
                                        <x-date name="fecha" value="{{ $siniestro->fecha }}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Comentarios</label>
                                    <div class="col-md-7">
                                        <x-summernote name="comentarios" value="{!! $siniestro->comentarios !!}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Núm. pase taller</label>
                                    <div class="col-md-7">
                                        <input type="text" name="pase_taller" class="form-control" value="{{ $siniestro->pase_taller }}" data-error="*El paso a taller es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Núm. pase médico</label>
                                    <div class="col-md-7">
                                        <input type="text" name="pase_medico" class="form-control" value="{{ $siniestro->pase_medico }}">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Servicio de grúas</label>
                                    <div class="col-md-7">
                                        <select name="servicio_grua" class="form-control select2">
                                            <option value="noa" {{ ($siniestro->servicio_grua == 'noa') ? 'selected' : ''}}>NA</option>
                                            <option value="loc" {{ ($siniestro->servicio_grua == 'loc') ? 'selected' : ''}}>Local</option>
                                            <option value="for" {{ ($siniestro->servicio_grua == 'for') ? 'selected' : ''}}>Foráneo</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Acuerdo en crucero</label>
                                    <div class="col-md-7">
                                        <x-bootstrap-toggle name="acuerdo_crucero" onText="Sí" offText="No" value="1" checked="{{ $siniestro->acuerdo_crucero }}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Estatus</label>
                                    <div class="col-md-7">
                                        <select name="estatus" class="form-control select2">
                                            <option value="pro" {{ ($siniestro->estatus == 'pro') ? 'selected' : ''}}>Proceso</option>
                                            <option value="con" {{ ($siniestro->estatus == 'con') ? 'selected' : ''}}>Asunto Concluído</option>
                                            <option value="cer" {{ ($siniestro->estatus == 'cer') ? 'selected' : ''}}>Asunto Cerrado</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Declaración asegurado</label>
                                    <div class="col-md-7">
                                        <x-summernote name="declaracion_asegurado" value="{!! $siniestro->declaracion_asegurado !!}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Declaración tercero</label>
                                    <div class="col-md-7">
                                        <x-summernote name="declaracion_tercero" value="{!! $siniestro->declaracion_tercero !!}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Observaciones de ajustador</label>
                                    <div class="col-md-7">
                                        <x-summernote name="observaciones_ajustador" value="{!! $siniestro->observaciones_ajustador !!}" />
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
@stop

@section('customJS')
    @parent
    <x-validator />
    

    <script>
        $(function(){


        });
    </script>
    <x-ajax-form id="editarForm" titulo="Editar Siniestro" reload="1" />
@stop