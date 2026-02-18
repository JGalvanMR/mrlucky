@extends('admin.layouts.master')

@section('titulo', 'Agregar siniestro')

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
                    <li class="breadcrumb-item active">Agregar</li>
                </ol>
            </div>
        </div>
        <div class="m-t-10 m-b-10 text-right">
            <a href="{{ route('siniestros') }}" class="btn btn-warning btn-xs">
                <i class="fa fa-list"></i> Listado
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Agregar Siniestro</h4>
                    </div>
                    <div class="card-body">
                        <form id="agregarForm" action="{{ route('siniestros.agregar') }}" class="form-horizontal form-bordered m-t-40">
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
                                    <label class="control-label text-md-right col-md-3">*Fecha</label>
                                    <div class="col-md-7">
                                        <x-date name="fecha" value="{{ date('Y-m-d') }}" />
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Comentarios</label>
                                    <div class="col-md-7">
                                        <x-summernote name="comentarios" />
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
    <x-ajax-form id="agregarForm" titulo="Agregar Siniestro" reload="0" redirect="1" />
@stop