@extends('admin.layouts.master')

@section('titulo', 'Configuraciones')

@section('page')
    @php
        $config = new Larapack\ConfigWriter\Repository('dportek');
    @endphp
	<div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Configuraciones</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Admin</a>
                    </li>
                    <li class="breadcrumb-item active">Configuraciones</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-info">
                        <h4 class="m-b-0 text-white">Editar configuración</h4>
                    </div>
                    <div class="card-body">
                        
                         <form id="editarForm" action="{{ route('configuraciones.editar_whatsapp') }}" class="form-horizontal form-bordered m-t-40">
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Número WhatsApp</label>
                                    <div class="col-md-7">
                                        <input type="text" name="num_whatsapp" class="form-control" data-error="*Ingresa un número a 10 dígitos." value="{{ $config->get('num_whatsapp') }}" minlength="10" maxlength="10">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Saludo</label>
                                    <div class="col-md-7">
                                        <textarea name="whatsapp_saludo" class="form-control" rows="3">{{ $config->get('whatsapp_saludo') }}</textarea>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Mensaje</label>
                                    <div class="col-md-7">
                                        <textarea name="whatsapp_mensaje" class="form-control" rows="3">{{ $config->get('whatsapp_mensaje') }}</textarea>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Estatus</label>
                                    <div class="col-md-7">
                                        <x-bootstrap-toggle name="whatsapp_activo" onText="Activo" offText="Inactivo" checked="{{ $config->get('whatsapp_activo') }}" />
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


@stop

@section('customCSS')
    @parent

@stop

@section('customJS')
    @parent

    <x-validator /> 
    <x-ajax-form id="editarForm" titulo="Editar configuración" reload="1" />
@stop