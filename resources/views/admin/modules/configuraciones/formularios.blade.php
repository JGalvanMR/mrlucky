@extends('admin.layouts.master')

@section('titulo', 'Configuraciones')

@section('page')
    @php
        $config = new Larapack\ConfigWriter\Repository('dportek');

        //dd($config);
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
                        
                         <form id="editarForm" action="{{ route('configuraciones.editar_formularios_enviar') }}" class="form-horizontal form-bordered m-t-40">
                            <div class="form-body">

                                <div class="form-group row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-7">
                                        <h4 class="bg-primary px-4 py-1 text-white">Contacto</h4>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Enviar a</label>
                                    <div class="col-md-7">
                                        <input type="text" name="formulario_contacto" class="form-control" value="{!! $config->get('formulario_contacto') !!}" data-role="tagsinput" data-error="*Ingrese al menos un correo." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Copia</label>
                                    <div class="col-md-7">
                                        <input type="text" name="formulario_contacto_copia" class="form-control" value="{!! $config->get('formulario_contacto_copia') !!}" data-role="tagsinput">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                   <div class="col-md-3"></div>
                                    <div class="col-md-7">
                                        <h4 class="bg-primary px-4 py-1 text-white">Distribuidores</h4>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">*Enviar a</label>
                                    <div class="col-md-7">
                                        <input type="text" name="formulario_distribuidores" class="form-control" value="{!! $config->get('formulario_distribuidores') !!}" data-role="tagsinput" data-error="*Ingrese al menos un correo." required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-md-right col-md-3">Copia</label>
                                    <div class="col-md-7">
                                        <input type="text" name="formulario_distribuidores_copia" class="form-control" value="{!! $config->get('formulario_distribuidores_copia') !!}" data-role="tagsinput">
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

    <x-tags-input /> 
    <x-validator /> 
    <x-ajax-form id="editarForm" titulo="Editar configuración" reload="1" />
@stop