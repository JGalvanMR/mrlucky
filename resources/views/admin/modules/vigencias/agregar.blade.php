@extends('admin.layouts.master')

@section('titulo', 'Agregar vigencia')

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
                    <li class="breadcrumb-item active">Agregar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('vigencias') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Agregar Vigencia</h4>
                    </div>
                    <div class="card-body">
                        <form id="agregarForm" action="{{ route('vigencias.agregar') }}" class="form-horizontal form-bordered m-t-40">
                            <div class="form-body">
                                <div class="form-group row">
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
                                    <label class="control-label text-md-right col-md-3">*Tipo de póliza</label>
                                    <div class="col-md-7">
                                        <select id="tipoPoliza" name="tipo" class="form-control select2">
                                            <option value="">- Seleccione el tipo de póliza -</option>
                                            <option value="sna" data-vigencias="52">Semanal</option>
                                            <option value="qui" data-vigencias="24">Quincenal</option>
                                            <option value="men" data-vigencias="12" selected>Mensual</option>
                                            <option value="tri" data-vigencias="4">Trimestral</option>
                                            <option value="sem" data-vigencias="2">Semestral</option>
                                            <option value="anu" data-vigencias="1">Anual</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Monto</label>
                                    <div class="col-md-7">
                                        <x-money name="monto" requerido="1" requeridoText="*El monto es requerido." />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Fecha de inicio</label>
                                    <div class="col-md-7">
                                        <x-date name="fecha_inicio" requerido="1" requeridoText="*El monto es requerido." />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Vigencias a generar</label>
                                    <div class="col-md-7">
                                        <input type="number" id="vigencias" name="num_vigencias" class="form-control" data-error="*El número de vigencias es requerido." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Días para pagar</label>
                                    <div class="col-md-7">
                                        <input type="number" name="dias_para_pagar" class="form-control" value="10" data-error="*Ingrese los días para pagar." required>
                                        <div class="help-block with-errors text-danger"></div>
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
@stop

@section('customCSS')
    @parent
    <link rel="stylesheet" href="/admin/css/pages/card-page.css">

@stop

@section('customJS')
    @parent
    <x-validator />
    <x-select2 />
    

    <script>
        $(function(){

            /*----------  Vigencias  ----------*/
            $("#tipoPoliza").on("change", function(){
                $vigencias = $(this).find(':selected').data("vigencias");
                console.log($vigencias);
                $("#vigencias").val($vigencias);
            }).change();
            
        });
    </script>
    <x-ajax-form id="agregarForm" titulo="Agregar Vigencias" reload="1" />
@stop